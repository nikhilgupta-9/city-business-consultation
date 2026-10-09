<?php
declare(strict_types=1);
require __DIR__ . '/inc.php';

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    header('Location: index.php');
    exit;
}

$cfg = sc_config();

$clean = static function (string $key, int $max): string {
    $v = isset($_POST[$key]) ? trim((string) $_POST[$key]) : '';
    $v = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/u', '', $v) ?? '';
    return mb_substr($v, 0, $max);
};

// Bots fill the hidden field. Send them back quietly without saving anything.
if (!empty($_POST['website'])) {
    header('Location: index.php');
    exit;
}

$errors = [];

if (!hash_equals((string) ($_SESSION['sc_csrf'] ?? ''), (string) ($_POST['csrf'] ?? ''))) {
    $errors[] = 'This page expired. Please check your details and send the form again.';
}
if (time() - (int) ($_SESSION['sc_last_submit'] ?? 0) < 8) {
    $errors[] = 'Please wait a few seconds before sending again.';
}

$data = [
    'name'    => trim(preg_replace('/\s+/', ' ', $clean('name', 120)) ?? ''),
    'phone'   => preg_replace('/\s+/', ' ', $clean('phone', 40)) ?? '',
    'email'   => $clean('email', 190),
    'service' => $clean('service', 120),
    'message' => $clean('message', 1000),
];

$allowed = array_merge(
    array_column($cfg['services'], 'title'),
    ['Complete Accounting & Tax Package', 'Overdue Returns & IRD Support', 'Sole Trader / Contractor Tax', 'Not sure yet']
);
if (!in_array($data['service'], $allowed, true)) {
    $data['service'] = $clean('service', 120);
}

if (mb_strlen($data['name']) < 2) {
    $errors[] = 'Enter your name.';
}
$phoneDigits = sc_digits($data['phone']);
if (!preg_match('/^[+\d][\d\s().\-]{5,}$/', $data['phone']) || strlen($phoneDigits) < 7 || strlen($phoneDigits) > 15) {
    $errors[] = 'Enter a phone number we can call, including the country code if you are overseas.';
}
if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Enter a valid email address.';
}
if (empty($_POST['consent'])) {
    $errors[] = 'Tick the box to confirm we may contact you about your enquiry.';
}

if ($errors) {
    $_SESSION['sc_flash'] = ['errors' => $errors, 'old' => $data];
    header('Location: index.php#enquire');
    exit;
}

$track = [];
foreach (['utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term'] as $k) {
    $track[$k] = $clean($k, 150);
}
$track['fbclid'] = $clean('fbclid', 255);

$row = [
    'name'         => $data['name'],
    'phone'        => $data['phone'],
    'email'        => $data['email'],
    'service'      => $data['service'],
    'message'      => $data['message'],
    'consent'      => 1,
    'utm_source'   => $track['utm_source'],
    'utm_medium'   => $track['utm_medium'],
    'utm_campaign' => $track['utm_campaign'],
    'utm_content'  => $track['utm_content'],
    'utm_term'     => $track['utm_term'],
    'fbclid'       => $track['fbclid'],
];

$saved = false;
$pdo = sc_pdo();
if ($pdo) {
    try {
        $stmt = $pdo->prepare(
            'INSERT INTO landing_leads
             (name, phone, email, service, message, consent, utm_source, utm_medium, utm_campaign, utm_content, utm_term, fbclid)
             VALUES (:name, :phone, :email, :service, :message, :consent, :utm_source, :utm_medium, :utm_campaign, :utm_content, :utm_term, :fbclid)'
        );
        $stmt->execute($row);
        $saved = true;
    } catch (Throwable $ex) {
        error_log('[softcity] saving lead failed: ' . $ex->getMessage());
    }
}
if (!$saved) {
    $saved = sc_save_csv($row + ['saved_at' => date('c')]);
}

// Email alert. A failure here never blocks the visitor, because the lead is already stored.
$to = (string) $cfg['notify_email'];
if ($saved && filter_var($to, FILTER_VALIDATE_EMAIL)) {
    $host = preg_replace('/[^A-Za-z0-9.\-]/', '', (string) ($_SERVER['HTTP_HOST'] ?? 'localhost')) ?: 'localhost';
    $from = filter_var((string) $cfg['from_email'], FILTER_VALIDATE_EMAIL) ? (string) $cfg['from_email'] : 'no-reply@' . $host;
    $body = "New enquiry for " . $cfg['brand'] . "\n\n"
        . "Name:    " . $row['name'] . "\n"
        . "Phone:   " . $row['phone'] . "\n"
        . "Email:   " . $row['email'] . "\n"
        . "Service: " . ($row['service'] ?: 'not chosen') . "\n"
        . "Message: " . ($row['message'] ?: '-') . "\n\n"
        . "Campaign: " . ($row['utm_campaign'] ?: '-') . " / " . ($row['utm_content'] ?: '-') . "\n";
    $headers = "From: " . $from . "\r\n"
        . "Reply-To: " . $row['email'] . "\r\n"
        . "Content-Type: text/plain; charset=UTF-8";
    @mail($to, 'New website enquiry: ' . $cfg['brand'], $body, $headers);
}

if (!$saved) {
    $_SESSION['sc_flash'] = ['errors' => ['Something went wrong on our side and your enquiry was not saved. Please try again, or contact us directly.'], 'old' => $data];
    header('Location: index.php#enquire');
    exit;
}

$_SESSION['sc_last_submit'] = time();
$_SESSION['sc_lead_done']   = true;
$_SESSION['sc_lead_fire']   = true;
unset($_SESSION['sc_csrf']);

header('Location: thank-you.php');
exit;
