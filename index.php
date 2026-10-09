<?php
declare(strict_types=1);
require __DIR__ . '/inc.php';

$cfg   = sc_config();
$flash = $_SESSION['sc_flash'] ?? ['errors' => [], 'old' => []];
unset($_SESSION['sc_flash']);
$errors = $flash['errors'];
$old    = $flash['old'];

$tel      = preg_replace('/[^\d+]/', '', (string) ($cfg['phone'] ?? '')) ?? '';
$wa       = sc_digits((string) ($cfg['whatsapp'] ?? ''));
$services = array_column($cfg['services'] ?? [], 'title');
$version  = (string) @filemtime(__DIR__ . '/assets/style.css');
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($cfg['brand']) ?> | NZ Accounting, Tax Returns & Business Advisory</title>
  <meta name="description" content="Expert NZ accounting, income tax returns, GST filings, and Xero bookkeeping for small businesses and sole traders in Auckland and nationwide. Get your free tax review today.">
  <meta name="theme-color" content="#c5221f">
  
  <!-- Favicon & Fonts -->
  <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect width='100' height='100' rx='20' fill='%23c5221f'/><text x='50' y='68' font-size='60' font-family='sans-serif' font-weight='bold' fill='white' text-anchor='middle'>C</text></svg>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@600;700;800&family=Plus+Sans:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  
  <link rel="stylesheet" href="assets/style.css?v=<?= e($version) ?>">
  <?= sc_pixel() ?>
</head>
<body>

<!-- Top Announcement Bar -->
<div class="top-bar">
  <div class="wrap">
    <span class="tag">🇳🇿 NZ Tax Special</span>
    <span>Get Your Free 2024/2025 Tax Diagnostic & IRD Compliance Review — No Obligation</span>
  </div>
</div>

<!-- Header -->
<header class="site-header">
  <div class="wrap">
    <a class="brand-wrap" href="./">
      <div class="brand-icon">C</div>
      <div class="brand-info">
        <span class="brand-title"><?= e($cfg['brand']) ?></span>
        <span class="brand-sub">Accounting &amp; Tax • New Zealand</span>
      </div>
    </a>

    <div class="header-trust">
      <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/></svg>
      <span>Registered NZ Tax Agent Support</span>
    </div>

    <div class="header-actions">
      <?php if (!empty($cfg['facebook_url'])): ?>
        <a href="<?= e($cfg['facebook_url']) ?>" target="_blank" rel="noopener" aria-label="Facebook Page" style="display: flex; align-items: center; color: #1877F2; padding: 6px;" title="Visit Facebook Page">
          <svg width="22" height="22" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
        </a>
      <?php endif; ?>
      <?php if ($tel !== ''): ?>
        <a class="header-phone-link" href="tel:<?= e($tel) ?>">
          <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
          <span><?= e($cfg['phone']) ?></span>
        </a>
      <?php endif; ?>
      <a class="btn btn-primary" href="#enquire">Free Consultation</a>
    </div>
  </div>
</header>

<main>
  <!-- Hero Section with Above the Fold Form -->
  <section class="hero">
    <div class="wrap hero-grid">
      <div class="hero-content">
        <div class="rating-chip">
          <span class="rating-stars">★★★★★</span>
          <span class="rating-text">4.9/5 Rating from 120+ NZ Businesses</span>
        </div>

        <h1>
          <?= e($cfg['headline_1']) ?><br>
          <span class="accent"><?= e($cfg['headline_2']) ?></span>
        </h1>

        <p class="hero-intro">
          <?= e($cfg['intro']) ?>
        </p>

        <ul class="hero-ticks">
          <li>
            <div class="tick-icon">
              <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
            </div>
            <span><strong>100% IRD Compliant:</strong> Maximize legitimate tax deductions and avoid costly penalties.</span>
          </li>
          <li>
            <div class="tick-icon">
              <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
            </div>
            <span><strong>Extension of Time (EOT):</strong> Extended IRD tax return and payment deadlines for our clients.</span>
          </li>
          <li>
            <div class="tick-icon">
              <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
            </div>
            <span><strong>Fixed Monthly Packages:</strong> No surprise hourly bills. Unlimited phone &amp; email support.</span>
          </li>
          <li>
            <div class="tick-icon">
              <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
            </div>
            <span><strong>Certified Xero &amp; MYOB Advisors:</strong> Smooth setup, bank reconciliations &amp; payroll.</span>
          </li>
        </ul>

        <div class="hero-media-card">
          <img src="assets/images/hero-team.jpg" alt="City Business Consulting Auckland Team" width="600" height="300" loading="eager">
          <div class="hero-media-badge">
            <span>
              <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
              Auckland &amp; Nationwide Team
            </span>
            <span class="highlight">99.8% On-Time IRD Returns</span>
          </div>
        </div>
      </div>

      <!-- Lead Capture Form Card -->
      <div class="lead-card" id="enquire">
        <div class="lead-card-header">
          <span class="lead-pill">Free • No Obligation</span>
          <h2><?= e($cfg['offer']) ?></h2>
          <p>Takes 45 seconds. We review your books and reply within <?= e($cfg['response_time']) ?>.</p>
        </div>

        <?php if ($errors): ?>
          <div class="alert" role="alert">
            <strong>Please check the following:</strong>
            <ul><?php foreach ($errors as $msg): ?><li><?= e($msg) ?></li><?php endforeach; ?></ul>
          </div>
        <?php endif; ?>

        <form id="enquiry-form" class="lead-form" action="lead.php" method="post">
          <input type="hidden" name="csrf" value="<?= e(sc_csrf()) ?>">
          <?php foreach (['utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term', 'fbclid'] as $k): ?>
            <input type="hidden" name="<?= e($k) ?>" value="">
          <?php endforeach; ?>
          <div class="hp" aria-hidden="true">
            <label>Leave empty <input type="text" name="website" tabindex="-1" autocomplete="off"></label>
          </div>

          <div class="form-group">
            <label for="f-name">Your Full Name</label>
            <div class="input-wrap">
              <span class="input-icon">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
              </span>
              <input id="f-name" class="form-control" type="text" name="name" required placeholder="e.g. Liam Smith" maxlength="120" autocomplete="name" value="<?= e($old['name'] ?? '') ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="f-phone">NZ Phone Number</label>
            <div class="input-wrap">
              <span class="input-icon">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
              </span>
              <input id="f-phone" class="form-control" type="tel" name="phone" required placeholder="021 000 0000 or +64" maxlength="40" autocomplete="tel" inputmode="tel" value="<?= e($old['phone'] ?? '') ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="f-email">Email Address</label>
            <div class="input-wrap">
              <span class="input-icon">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
              </span>
              <input id="f-email" class="form-control" type="email" name="email" required placeholder="liam@business.co.nz" maxlength="190" autocomplete="email" value="<?= e($old['email'] ?? '') ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="f-service">What Service Do You Need?</label>
            <div class="input-wrap">
              <span class="input-icon">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
              </span>
              <select id="f-service" class="form-control" name="service">
                <option value="">Select your main requirement</option>
                <?php foreach ($services as $s): ?>
                  <option value="<?= e($s) ?>"<?= (($old['service'] ?? '') === $s) ? ' selected' : '' ?>><?= e($s) ?></option>
                <?php endforeach; ?>
                <option value="Complete Accounting &amp; Tax Package"<?= (($old['service'] ?? '') === 'Complete Accounting & Tax Package') ? ' selected' : '' ?>>Complete Business Package (Tax + GST + Books)</option>
                <option value="Overdue Returns &amp; IRD Support"<?= (($old['service'] ?? '') === 'Overdue Returns & IRD Support') ? ' selected' : '' ?>>Overdue Tax Returns / IRD Debt Support</option>
                <option value="Not sure yet"<?= (($old['service'] ?? '') === 'Not sure yet') ? ' selected' : '' ?>>I am not sure yet (Need Advice)</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="f-message">Business Name / Notes <span class="opt">(optional)</span></label>
            <textarea id="f-message" class="form-control" name="message" maxlength="1000" rows="2" placeholder="e.g. Sole trader builder in Auckland, need 2024 tax return &amp; GST setup"><?= e($old['message'] ?? '') ?></textarea>
          </div>

          <label class="form-consent">
            <input type="checkbox" name="consent" value="1" required checked>
            <span>I agree to be contacted regarding my tax review enquiry. Read our <a href="privacy.php" target="_blank">privacy policy</a>.</span>
          </label>

          <button class="btn btn-primary btn-block btn-lg" type="submit">
            <span><?= e($cfg['cta_label']) ?></span>
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
          </button>

          <div class="form-secure-note">
            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/></svg>
            <span>100% Confidential • No Obligation • Fast 24hr Reply</span>
          </div>
        </form>
      </div>
    </div>
  </section>

  <!-- Trust & Credibility Badges -->
  <section class="trust-bar">
    <div class="wrap">
      <div class="trust-bar-grid">
        <div class="trust-item">
          <div class="trust-item-icon">
            <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/></svg>
          </div>
          <span>Inland Revenue (IRD) Registered</span>
        </div>

        <div class="trust-item">
          <div class="trust-item-icon">
            <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 14l-5-5 1.41-1.41L12 14.17l7.59-7.59L21 8l-9 9z"/></svg>
          </div>
          <span>Certified Xero Platinum Advisor</span>
        </div>

        <div class="trust-item">
          <div class="trust-item-icon">
            <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
          </div>
          <span>MYOB Certified Partner</span>
        </div>

        <div class="trust-item">
          <div class="trust-item-icon">
            <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20a2 2 0 002 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10z"/></svg>
          </div>
          <span>Fixed Pricing — No Hourly Surprises</span>
        </div>

        <div class="trust-item">
          <div class="trust-item-icon">
            <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
          </div>
          <span>Auckland Based • NZ Nationwide</span>
        </div>
      </div>
    </div>
  </section>

  <!-- Comparison / Why Us Section -->
  <section class="section section-light">
    <div class="wrap">
      <div class="section-head">
        <span class="section-tag">The Difference</span>
        <h2>Why NZ Businesses Are Switching To Us</h2>
        <p>Accounting shouldn't be stressful, slow, or full of surprise bills. Here is how we do things differently.</p>
      </div>

      <div class="comparison-grid">
        <div class="comparison-card bad">
          <h3>
            <svg width="24" height="24" fill="#ef4444" viewBox="0 0 24 24"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/></svg>
            <span>Traditional Accountants</span>
          </h3>
          <ul class="comparison-list">
            <li class="bad-item">
              <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
              <span>Bill you every time you send an email or ask a question.</span>
            </li>
            <li class="bad-item">
              <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
              <span>Take weeks to reply and leave tax returns until the last second.</span>
            </li>
            <li class="bad-item">
              <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
              <span>Talk in complex accounting jargon that leaves you confused.</span>
            </li>
            <li class="bad-item">
              <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
              <span>Only do retroactive filings without proactive tax savings advice.</span>
            </li>
          </ul>
        </div>

        <div class="comparison-card good">
          <div class="card-ribbon">Client-First Standard</div>
          <h3>
            <svg width="24" height="24" fill="#10b981" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
            <span>City Business Consulting</span>
          </h3>
          <ul class="comparison-list">
            <li class="good-item">
              <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
              <span><strong>Transparent Fixed Monthly Pricing:</strong> Unlimited calls and emails included.</span>
            </li>
            <li class="good-item">
              <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
              <span><strong>24-Hour Reply Guarantee:</strong> Prompt, friendly communication whenever you need it.</span>
            </li>
            <li class="good-item">
              <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
              <span><strong>Plain English Advice:</strong> We explain your numbers clearly so you make confident decisions.</span>
            </li>
            <li class="good-item">
              <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
              <span><strong>Proactive Tax Planning:</strong> We actively find legal deductions to keep more cash in your business.</span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- Comprehensive Services Grid -->
  <section class="section section-accent" id="services">
    <div class="wrap">
      <div class="section-head">
        <span class="section-tag">Complete Solutions</span>
        <h2>Everything Your NZ Business Needs</h2>
        <p>From sole trader year-end tax returns to complete company Xero bookkeeping and payroll management.</p>
      </div>

      <div class="services-grid">
        <?php foreach ($cfg['services'] as $svc): ?>
          <div class="service-card">
            <div class="service-card-top">
              <div class="service-icon-box">
                <?php if (($svc['icon'] ?? '') === 'tax'): ?>
                  <svg width="26" height="26" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                <?php elseif (($svc['icon'] ?? '') === 'gst'): ?>
                  <svg width="26" height="26" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <?php elseif (($svc['icon'] ?? '') === 'bookkeeping'): ?>
                  <svg width="26" height="26" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                <?php elseif (($svc['icon'] ?? '') === 'payroll'): ?>
                  <svg width="26" height="26" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                <?php elseif (($svc['icon'] ?? '') === 'company'): ?>
                  <svg width="26" height="26" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                <?php else: ?>
                  <svg width="26" height="26" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                <?php endif; ?>
              </div>
              <span class="service-badge"><?= e($svc['badge'] ?? 'NZ Tax') ?></span>
            </div>

            <h3><?= e($svc['title']) ?></h3>
            <p><?= e($svc['text']) ?></p>

            <a class="service-card-cta" href="#enquire" onclick="selectServiceAndScroll('<?= e($svc['title']) ?>'); return false;">
              <span>Enquire About This Service</span>
              <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </a>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- Interactive Package Selector / Estimator Widget -->
  <section class="section section-light">
    <div class="wrap">
      <div class="section-head">
        <span class="section-tag">Quick Package Finder</span>
        <h2>Find The Right Fit For Your Business</h2>
        <p>Click your business structure below to see what is included in our tailored NZ packages.</p>
      </div>

      <div class="interactive-box">
        <div class="calc-grid">
          <div class="calc-options">
            <h3>Select Your Business Type:</h3>
            <div class="pill-selector">
              <button type="button" class="pill-btn active" data-biz-type="sole-trader">Sole Trader / Tradie</button>
              <button type="button" class="pill-btn" data-biz-type="small-business">Small Business (LTD)</button>
              <button type="button" class="pill-btn" data-biz-type="company-starter">New Startup / Setup</button>
              <button type="button" class="pill-btn" data-biz-type="overdue-catchup">Overdue Returns &amp; IRD</button>
            </div>

            <p style="color: var(--muted); font-size: 0.95rem; line-height: 1.6;">
              All packages include a dedicated senior accountant in New Zealand, Xero cloud integration, direct IRD liaison, and transparent fixed fees with zero hidden costs.
            </p>
          </div>

          <div class="calc-result-box">
            <span class="tag">Recommended Solution</span>
            <div class="result-title" id="calc-plan-title">Sole Trader &amp; Contractor Tax Pack</div>
            <p id="calc-plan-desc" style="font-size: 0.92rem; color: #e2e8f0; margin-bottom: 20px;">
              Annual income tax return (IR3), expense deduction maximization, GST returns, home office claims, and direct IRD support.
            </p>

            <ul class="calc-features">
              <li>
                <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                <span>Full NZ Inland Revenue (IRD) Filing</span>
              </li>
              <li>
                <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                <span>Extension of Time (EOT) Included</span>
              </li>
              <li>
                <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                <span>Free Initial Discovery &amp; Tax Review</span>
              </li>
            </ul>

            <a class="btn btn-primary btn-block" href="#enquire">Get Exact Quote &amp; Free Review</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 3 Simple Steps -->
  <section class="section section-accent" id="how-it-works">
    <div class="wrap">
      <div class="section-head">
        <span class="section-tag">How It Works</span>
        <h2>Getting Started Is Simple &amp; Fast</h2>
        <p>No tedious paperwork or complicated onboarding. We take care of everything in 3 quick steps.</p>
      </div>

      <div class="steps-grid">
        <div class="step-card">
          <div class="step-number">1</div>
          <h3>Send A Quick Enquiry</h3>
          <p>Fill out the short 45-second form above or message us on WhatsApp. Tell us what your business does and what you need help with.</p>
        </div>

        <div class="step-card">
          <div class="step-number">2</div>
          <h3>Free 15-Min Strategy Call</h3>
          <p>We review your current tax and bookkeeping setup, identify missed deductions or IRD compliance gaps, and give you a fixed quote.</p>
        </div>

        <div class="step-card">
          <div class="step-number">3</div>
          <h3>Relax &amp; Focus On Business</h3>
          <p>We handle your Xero books, GST returns, payroll, and IRD filings seamlessly. You get peace of mind and more time to make money.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Meet Advisor & Auckland Office Presence -->
  <section class="section section-light">
    <div class="wrap">
      <div class="advisor-grid">
        <div class="advisor-image-wrap">
          <img src="assets/images/advisor.jpg" alt="City Business Consulting Senior Accountant" width="500" height="400" loading="lazy">
          <div class="advisor-badge-float">
            <div class="icon">
              <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
            </div>
            <div>
              <strong style="display:block; font-size: 0.95rem; color: var(--dark);">Direct Advisor Access</strong>
              <span style="font-size: 0.8rem; color: var(--muted);">Talk to the person doing the work</span>
            </div>
          </div>
        </div>

        <div class="advisor-content">
          <span class="section-tag">Auckland &amp; NZ Nationwide</span>
          <h2>Experienced NZ Tax Advisors You Can Actually Talk To</h2>
          <p>
            At <?= e($cfg['brand']) ?>, you are never just a client account number passed around junior staff. You get a dedicated, experienced accountant who understands New Zealand tax law, GST rules, and small business realities.
          </p>
          <p>
            Whether you are a builder in Auckland, an e-commerce retailer in Christchurch, or a consultant in Wellington, we provide proactive advice that keeps you ahead of Inland Revenue deadlines and protects your bottom line.
          </p>

          <div class="advisor-pillars">
            <div class="pillar-item">
              <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
              <span>100% NZ Owned &amp; Operated</span>
            </div>
            <div class="pillar-item">
              <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
              <span>Seamless Handover From Old Accountant</span>
            </div>
            <div class="pillar-item">
              <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
              <span>Xero &amp; Cloud Accounting Specialists</span>
            </div>
            <div class="pillar-item">
              <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
              <span>IRD Audit Protection &amp; Support</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Client Reviews / Social Proof -->
  <section class="section section-accent" id="reviews">
    <div class="wrap">
      <div class="section-head">
        <span class="section-tag">Client Success</span>
        <h2>Trusted by NZ Business Owners</h2>
        <p>Here is what Kiwi business owners say about working with City Business Consulting.</p>
      </div>

      <div class="testimonials-grid">
        <div class="testimonial-card">
          <div class="testimonial-stars">★★★★★</div>
          <p class="testimonial-quote">
            "Switching to City Business Consulting was the best decision for our construction business. They cleaned up our messy Xero accounts, sorted out 2 overdue GST returns, and saved us over $6,000 in legitimate deductions. Highly recommended!"
          </p>
          <div class="testimonial-author">
            <div class="author-avatar">MB</div>
            <div class="author-details">
              <h4>Mark Bradley</h4>
              <p>Director, Apex Building Ltd (Auckland)</p>
            </div>
          </div>
        </div>

        <div class="testimonial-card">
          <div class="testimonial-stars">★★★★★</div>
          <p class="testimonial-quote">
            "Fast, reliable, and completely transparent with fixed monthly fees. Whenever I have a question about payroll or GST, I get an answer on the same day. No surprise invoices like our old accountant used to send!"
          </p>
          <div class="testimonial-author">
            <div class="author-avatar">SL</div>
            <div class="author-details">
              <h4>Sophie Leung</h4>
              <p>Founder, Artisan Café &amp; Bakery (Wellington)</p>
            </div>
          </div>
        </div>

        <div class="testimonial-card">
          <div class="testimonial-stars">★★★★★</div>
          <p class="testimonial-quote">
            "As a sole trader IT contractor, tax was always a headache. City Business Consulting set me up on Xero, automated my receipt tracking, and filed my IR3 return seamlessly. Gives me total peace of mind with IRD."
          </p>
          <div class="testimonial-author">
            <div class="author-avatar">DW</div>
            <div class="author-details">
              <h4>Daniel Walker</h4>
              <p>IT &amp; Cloud Consultant (Christchurch)</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- FAQ Accordion -->
  <section class="section section-light" id="faq">
    <div class="wrap">
      <div class="section-head">
        <span class="section-tag">Common Questions</span>
        <h2>Frequently Asked Questions</h2>
        <p>Everything you need to know about our New Zealand accounting and tax services.</p>
      </div>

      <div class="faq-wrap">
        <?php foreach ($cfg['faqs'] as $faq): ?>
          <div class="faq-item">
            <button type="button" class="faq-question">
              <span><?= e($faq['q']) ?></span>
              <span class="faq-toggle-icon">+</span>
            </button>
            <div class="faq-answer">
              <p><?= e($faq['a']) ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- Closing Call to Action Banner -->
  <section class="closing-cta">
    <div class="wrap">
      <h2>Ready To Take The Stress Out Of Your Taxes?</h2>
      <p>
        Book your free 30-minute tax diagnostic &amp; fixed quote. No obligation, no sales pitch—just practical advice from registered NZ tax specialists.
      </p>

      <div class="closing-actions">
        <a class="btn btn-white btn-lg" href="#enquire">
          <span>Claim Free NZ Tax Review</span>
          <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </a>

        <?php if ($tel !== ''): ?>
          <a class="btn btn-closing-outline btn-lg" href="tel:<?= e($tel) ?>">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
            <span>Call <?= e($cfg['phone']) ?></span>
          </a>
        <?php endif; ?>

        <?php if ($wa !== ''): ?>
          <a class="btn btn-whatsapp btn-lg" href="https://wa.me/<?= e($wa) ?>" target="_blank" rel="noopener">
            <span>WhatsApp Us</span>
          </a>
        <?php endif; ?>
      </div>
    </div>
  </section>
</main>

<!-- Footer -->
<footer class="site-footer">
  <div class="wrap">
    <div class="footer-grid">
      <div class="footer-brand">
        <h3><?= e($cfg['brand']) ?></h3>
        <p>
          Dedicated accounting, tax compliance, GST returns, and Xero advisory for small businesses, contractors, and startups across New Zealand.
        </p>
        <p style="margin-top: 12px; font-weight: 600; color: #cbd5e1;">
          📍 Auckland Office • Serving NZ Nationwide
        </p>
      </div>

      <div class="footer-links">
        <h4>Key Services</h4>
        <ul>
          <li><a href="#services">Annual Tax Returns (IR3/IR4)</a></li>
          <li><a href="#services">GST Returns &amp; Provisional Tax</a></li>
          <li><a href="#services">Xero &amp; MYOB Bookkeeping</a></li>
          <li><a href="#services">Payroll &amp; PAYE Payday Filing</a></li>
          <li><a href="#services">Company Incorporation &amp; Structuring</a></li>
        </ul>
      </div>

      <div class="footer-links">
        <h4>Direct Contact</h4>
        <ul>
          <?php if ($tel !== ''): ?><li><a href="tel:<?= e($tel) ?>">Phone: <?= e($cfg['phone']) ?></a></li><?php endif; ?>
          <?php if ($wa !== ''): ?><li><a href="https://wa.me/<?= e($wa) ?>" target="_blank" rel="noopener">WhatsApp Chat</a></li><?php endif; ?>
          <?php if (!empty($cfg['facebook_url'])): ?>
            <li>
              <a href="<?= e($cfg['facebook_url']) ?>" target="_blank" rel="noopener" style="display: inline-flex; align-items: center; gap: 6px;">
                <svg width="16" height="16" fill="#1877F2" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                <span>Follow on Facebook</span>
              </a>
            </li>
          <?php endif; ?>
          <?php if (!empty($cfg['email'])): ?><li><a href="mailto:<?= e($cfg['email']) ?>"><?= e($cfg['email']) ?></a></li><?php endif; ?>
          <li><a href="privacy.php">Privacy &amp; Data Policy</a></li>
        </ul>
      </div>
    </div>

    <div class="footer-bottom">
      <p>&copy; <?= date('Y') ?> <?= e($cfg['brand']) ?>. All rights reserved.</p>
      <p>Disclaimer: General information only. Please seek individual advice before acting on tax matters.</p>
    </div>
  </div>
</footer>

<!-- Mobile Sticky Action Bar for 1-Tap Conversions -->
<div class="mobile-sticky-bar">
  <?php if ($tel !== ''): ?>
    <a class="btn btn-outline" href="tel:<?= e($tel) ?>">
      <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
      <span>Call</span>
    </a>
  <?php endif; ?>
  <?php if ($wa !== ''): ?>
    <a class="btn btn-whatsapp" href="https://wa.me/<?= e($wa) ?>" target="_blank" rel="noopener">
      <span>WhatsApp</span>
    </a>
  <?php endif; ?>
  <a class="btn btn-primary" href="#enquire">
    <span>Free Quote</span>
  </a>
</div>

<script src="assets/app.js?v=<?= e($version) ?>" defer></script>
</body>
</html>
