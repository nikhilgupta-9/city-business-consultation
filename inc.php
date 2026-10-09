<?php
declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params(['httponly' => true, 'samesite' => 'Lax']);
    session_start();
}

function sc_config(): array
{
    static $config = null;
    if ($config === null) {
        $config = require __DIR__ . '/config.php';
    }
    return $config;
}

function e($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function sc_csrf(): string
{
    if (empty($_SESSION['sc_csrf'])) {
        $_SESSION['sc_csrf'] = bin2hex(random_bytes(16));
    }
    return $_SESSION['sc_csrf'];
}

function sc_pdo(): ?PDO
{
    $db = sc_config()['db'] ?? [];
    try {
        return new PDO(
            sprintf('mysql:host=%s;dbname=%s;charset=utf8mb4', $db['host'] ?? '127.0.0.1', $db['name'] ?? ''),
            (string) ($db['user'] ?? ''),
            (string) ($db['pass'] ?? ''),
            [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_TIMEOUT            => 3,
            ]
        );
    } catch (Throwable $ex) {
        error_log('[softcity] database connection failed: ' . $ex->getMessage());
        return null;
    }
}

/**
 * Safety net: if the database is down, the enquiry is still written to a CSV
 * so a paid lead is never lost. Cells that start with a formula character are
 * prefixed so the file is safe to open in Excel.
 */
function sc_save_csv(array $row): bool
{
    $file = __DIR__ . '/storage/leads-fallback.csv';
    $cells = array_map(static function ($v): string {
        $v = (string) $v;
        if ($v === '' || strpos('=+-@', $v[0]) === false) {
            return $v;
        }
        // Phone numbers such as "+64 21 555 0123" are digits and punctuation only, so they are safe as they are.
        if (preg_match('/^[+\-]\d[\d\s().\-]*$/', $v)) {
            return $v;
        }
        return "'" . $v;
    }, $row);

    $isNew = !file_exists($file);
    $fh = @fopen($file, 'ab');
    if ($fh === false) {
        return false;
    }
    flock($fh, LOCK_EX);
    if ($isNew) {
        fputcsv($fh, array_keys($row));
    }
    fputcsv($fh, $cells);
    flock($fh, LOCK_UN);
    fclose($fh);
    return true;
}

/**
 * Meta Pixel base code. Returns '' until a numeric pixel_id is set in config.php.
 * $event is only ever a literal from our own code (e.g. 'Lead').
 */
function sc_pixel(?string $event = null): string
{
    $id = (string) (sc_config()['pixel_id'] ?? '');
    if (!preg_match('/^\d{5,20}$/', $id)) {
        return '';
    }
    $base = <<<'JS'
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,document,'script','https://connect.facebook.net/en_US/fbevents.js');
JS;
    $track = "fbq('init','" . $id . "');fbq('track','PageView');";
    if ($event !== null) {
        $track .= "fbq('track','" . $event . "');";
    }
    return '<script>' . $base . $track . '</script>'
        . '<noscript><img height="1" width="1" style="display:none" alt="" src="https://www.facebook.com/tr?id=' . $id . '&amp;ev=PageView&amp;noscript=1"></noscript>';
}

function sc_digits(string $value): string
{
    return preg_replace('/\D+/', '', $value) ?? '';
}
