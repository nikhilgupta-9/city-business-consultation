<?php
declare(strict_types=1);
require __DIR__ . '/inc.php';

// Only people who just sent the form see this page, so the Lead event can't be triggered by a stray visit.
if (empty($_SESSION['sc_lead_done'])) {
    header('Location: index.php');
    exit;
}

$cfg  = sc_config();
$fire = !empty($_SESSION['sc_lead_fire']);   // fire the Lead event once, not on every refresh
unset($_SESSION['sc_lead_fire']);

$wa      = sc_digits((string) ($cfg['whatsapp'] ?? ''));
$tel     = preg_replace('/[^\d+]/', '', (string) ($cfg['phone'] ?? '')) ?? '';
$version = (string) @filemtime(__DIR__ . '/assets/style.css');
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex">
  <title>Thank You | <?= e($cfg['brand']) ?></title>
  <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect width='100' height='100' rx='20' fill='%23c5221f'/><text x='50' y='68' font-size='60' font-family='sans-serif' font-weight='bold' fill='white' text-anchor='middle'>C</text></svg>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/style.css?v=<?= e($version) ?>">
  <?= sc_pixel($fire ? 'Lead' : null) ?>
</head>
<body>

<header class="site-header">
  <div class="wrap">
    <a class="brand-wrap" href="./">
      <div class="brand-icon">C</div>
      <div class="brand-info">
        <span class="brand-title"><?= e($cfg['brand']) ?></span>
        <span class="brand-sub">Accounting &amp; Tax • New Zealand</span>
      </div>
    </a>
  </div>
</header>

<main class="section section-light" style="min-height: 70vh; display: flex; align-items: center;">
  <div class="wrap" style="max-width: 680px; text-align: center; margin: 0 auto;">
    <div style="width: 72px; height: 72px; background: #d1fae5; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 24px; color: #059669;">
      <svg width="36" height="36" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
    </div>

    <h1 style="font-size: clamp(2rem, 4vw, 2.6rem); margin-bottom: 16px;">Thank You! Your Request Has Been Received.</h1>
    <p style="font-size: 1.1rem; color: var(--ink-secondary); margin-bottom: 28px; line-height: 1.6;">
      One of our senior NZ tax specialists will review your details and contact you within <strong><?= e($cfg['response_time']) ?></strong> to arrange your free discovery call and quote.
    </p>

    <div style="background: #f8fafc; border: 1px solid var(--border); border-radius: var(--radius-md); padding: 24px; text-align: left; margin-bottom: 32px;">
      <h3 style="font-size: 1.1rem; margin-bottom: 12px; color: var(--dark);">What to prepare while you wait:</h3>
      <ul style="padding-left: 20px; color: var(--muted); font-size: 0.95rem; display: flex; flex-direction: column; gap: 8px;">
        <li>Have a recent set of your bank transactions or Xero login ready if available.</li>
        <li>Note down any specific IRD deadlines or tax questions you want us to solve.</li>
        <li>Keep your phone nearby—we will reach out from an Auckland number.</li>
      </ul>
    </div>

    <div style="display: flex; gap: 14px; justify-content: center; flex-wrap: wrap;">
      <?php if ($wa !== ''): ?>
        <a class="btn btn-whatsapp btn-lg" href="https://wa.me/<?= e($wa) ?>" target="_blank" rel="noopener">
          <span>Connect Faster on WhatsApp</span>
        </a>
      <?php endif; ?>
      <a class="btn btn-outline btn-lg" href="./">Back to Homepage</a>
    </div>
  </div>
</main>

<footer class="site-footer" style="padding: 24px 0;">
  <div class="wrap" style="text-align: center;">
    <p>&copy; <?= date('Y') ?> <?= e($cfg['brand']) ?>. All rights reserved.</p>
  </div>
</footer>

</body>
</html>
