<?php
declare(strict_types=1);
require __DIR__ . '/inc.php';

$cfg     = sc_config();
$contact = filter_var((string) ($cfg['privacy_email'] ?? ''), FILTER_VALIDATE_EMAIL) ? (string) $cfg['privacy_email'] : '';
$version = (string) @filemtime(__DIR__ . '/assets/style.css');
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Privacy Policy | <?= e($cfg['brand']) ?></title>
  <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect width='100' height='100' rx='20' fill='%23c5221f'/><text x='50' y='68' font-size='60' font-family='sans-serif' font-weight='bold' fill='white' text-anchor='middle'>C</text></svg>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/style.css?v=<?= e($version) ?>">
  <?= sc_pixel() ?>
</head>
<body>

<header class="site-header">
  <div class="wrap">
    <a class="brand-wrap" href="./">
      <div class="brand-icon">C</div>
      <div class="brand-info">
        <span class="brand-title"><?= e($cfg['brand']) ?></span>
        <span class="brand-sub">India-Based Practice • NZ &amp; AU Tax Specialists</span>
      </div>
    </a>
  </div>
</header>

<main class="section section-light" style="padding: 60px 0;">
  <div class="wrap" style="max-width: 780px;">
    <h1 style="font-size: 2.4rem; margin-bottom: 20px;">Privacy &amp; Data Policy</h1>
    <p style="font-size: 1.05rem; color: var(--ink-secondary); margin-bottom: 24px;">
      This page explains how <?= e($cfg['brand']) ?> handles and protects your personal information when you use our website or enquire about our NZ accounting and tax services.
    </p>

    <div style="display: flex; flex-direction: column; gap: 24px; color: var(--ink-secondary); font-size: 0.98rem; line-height: 1.7;">
      <div>
        <h2 style="font-size: 1.3rem; margin-bottom: 8px; color: var(--dark);">1. Information We Collect</h2>
        <ul style="padding-left: 20px; display: flex; flex-direction: column; gap: 6px;">
          <li>Contact information you submit (e.g. name, phone number, email, company name, service requirements).</li>
          <li>Campaign tracking tags (UTM parameters, Facebook Click ID) to evaluate advertising performance.</li>
          <li>Standard browser telemetry and conversion cookies via the Meta Pixel.</li>
        </ul>
      </div>

      <div>
        <h2 style="font-size: 1.3rem; margin-bottom: 8px; color: var(--dark);">2. Purpose of Collection</h2>
        <p>Your details are used strictly to provide you with your requested free tax review, consultation, or quote, and to optimize our advertising campaigns. We do not sell or rent your personal information to third parties.</p>
      </div>

      <div>
        <h2 style="font-size: 1.3rem; margin-bottom: 8px; color: var(--dark);">3. Data Protection &amp; Confidentiality</h2>
        <p>As tax professionals, we uphold strict standards of professional confidentiality. Lead details are stored securely and accessed solely by authorized accounting personnel.</p>
      </div>

      <div>
        <h2 style="font-size: 1.3rem; margin-bottom: 8px; color: var(--dark);">4. Your Rights Under the NZ Privacy Act</h2>
        <p>You have the right to request access to or correction of any personal information we hold about you. You may also request deletion of your records at any time.</p>
        <?php if ($contact !== ''): ?>
          <p style="margin-top: 8px;">For privacy enquiries, email us at <a href="mailto:<?= e($contact) ?>"><strong><?= e($contact) ?></strong></a>.</p>
        <?php endif; ?>
      </div>
    </div>

    <div style="margin-top: 36px;">
      <a class="btn btn-outline" href="./">Back to Homepage</a>
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
