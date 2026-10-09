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
  <title><?= e($cfg['brand']) ?> | NZ &amp; AU Accounting, Tax &amp; Firm Outsourcing</title>
  <meta name="description" content="India-based accounting &amp; tax practice providing dedicated support for NZ &amp; Australian businesses, sole traders, and accounting firms. Save 40-60% with 100% IRD compliance.">
  <meta name="theme-color" content="#1b9a89">
  
  <!-- Favicon & Fonts -->
  <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect width='100' height='100' rx='20' fill='%231b9a89'/><text x='50' y='68' font-size='60' font-family='sans-serif' font-weight='bold' fill='white' text-anchor='middle'>C</text></svg>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  
  <link rel="stylesheet" href="assets/style.css?v=<?= e($version) ?>">
  <?= sc_pixel() ?>
</head>
<body>

<!-- Top Announcement Bar -->
<div class="top-bar">
  <div class="wrap">
    <span class="tag">🇮🇳 India-Based Practice</span>
    <span>Specialized Accounting &amp; Tax for Businesses • Outsourced Capacity for Accounting Firms • Save 40–60%</span>
  </div>
</div>

<!-- Header with Clean Desktop Nav, Country Switcher & Mobile Responsive Controls -->
<header class="site-header">
  <div class="wrap header-inner">
    <!-- Brand Logo -->
    <div class="brand-wrap" data-view="home" role="button" tabindex="0" title="City Business Consulting Home">
      <div class="brand-icon">C</div>
      <div class="brand-info">
        <span class="brand-title"><?= e($cfg['brand']) ?></span>
        <span class="brand-sub">NZ &amp; AU Tax • Offshore Practice</span>
      </div>
    </div>

    <!-- Center Segmented Pill Navigation -->
    <nav class="nav-links" aria-label="Main Navigation">
      <button type="button" class="nav-btn" data-view="business">
        <span>For Businesses</span>
      </button>
      <button type="button" class="nav-btn" data-view="firm">
        <span>For Accounting Firms</span>
      </button>
      <button type="button" class="nav-btn" data-view="about">
        <span>About Us</span>
      </button>
    </nav>

    <!-- Right Actions: Country Switcher, WhatsApp & CTA -->
    <div class="header-actions">
      <div class="country-selector" title="Select Country / Jurisdiction">
        <select id="country-select-dropdown" class="country-select" aria-label="Select Country">
          <option value="nz">🇳🇿 New Zealand (IRD)</option>
          <option value="au">🇦🇺 Australia (ATO)</option>
        </select>
      </div>

      <?php if ($wa !== ''): ?>
        <a class="header-icon-btn whatsapp-icon-btn" href="https://wa.me/<?= e($wa) ?>" target="_blank" rel="noopener" title="Chat on WhatsApp" aria-label="Chat on WhatsApp">
          <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.007c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86.173.086.275.072.376-.044.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.043.073.043.419-.101.824z"/></svg>
        </a>
      <?php endif; ?>

      <?php if ($tel !== ''): ?>
        <a class="header-phone-link" href="tel:<?= e($tel) ?>" title="Call Us">
          <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
          <span class="phone-text"><?= e($cfg['phone']) ?></span>
        </a>
      <?php endif; ?>

      <a class="btn btn-primary header-cta-btn" href="#enquire">Free Consultation</a>
    </div>
  </div>

  <!-- Mobile Quick Nav Scroll Strip -->
  <div class="mobile-nav-strip">
    <button type="button" class="mob-pill active" data-view="home">Overview</button>
    <button type="button" class="mob-pill" data-view="business">For Businesses</button>
    <button type="button" class="mob-pill" data-view="firm">For Accounting Firms</button>
    <button type="button" class="mob-pill" data-view="about">About Us</button>
  </div>
</header>

<main>
  <!-- Dual-Pathway Hub (For Businesses vs For Accounting Firms) -->
  <section class="pathway-hub">
    <div class="wrap">
      <div class="hub-intro">
        <div class="hub-eyebrow">PEOPLE. PROCESS. POSSIBILITY.</div>
        <h1>The Right Accounting Support.<br><span>For Your Business. For Your Firm.</span></h1>
        <p>
          Choose the support you need. We deliver specialized cloud accounting, GST, payroll, and outsourced practice capacity in <span class="hub-region-name" style="font-weight: 700; color: var(--dark);">New Zealand</span> from India.
        </p>
      </div>

      <div class="path-cards-grid">
        <!-- Card 1: For Businesses -->
        <article class="path-card">
          <div class="path-kicker">FOR BUSINESSES</div>
          <h2>More time for your business.<br>Less time on the books.</h2>
          <p>Practical accounting, bookkeeping, and tax support to help you stay 100% IRD compliant and understand your numbers.</p>
          <ul class="path-list">
            <li>Bookkeeping &amp; bank reconciliations</li>
            <li>Tax returns, GST &amp; annual accounts (IR3/IR4)</li>
            <li>Payroll, PAYE &amp; ongoing business support</li>
          </ul>
          <button type="button" class="path-action-btn" data-view="business">
            <span>Explore Business Services</span>
            <span class="arrow">→</span>
          </button>
          <div class="path-caption">For business owners, sole traders, tradies &amp; growing SMEs</div>
        </article>

        <!-- Card 2: For Accounting Firms -->
        <article class="path-card firm-path">
          <div class="path-kicker">FOR ACCOUNTING FIRMS</div>
          <h2>Extra practice capacity.<br>Your standards. Your clients.</h2>
          <p>Outsourced accounting support that fits your practice’s workpapers, Xero/MYOB workflows, and review requirements.</p>
          <ul class="path-list">
            <li>Bookkeeping &amp; reconciliation production</li>
            <li>Year-end accounts &amp; workpaper preparation</li>
            <li>Tax return preparation ready for your review</li>
          </ul>
          <button type="button" class="path-action-btn" data-view="firm">
            <span>Explore Outsourcing Support</span>
            <span class="arrow">→</span>
          </button>
          <div class="path-caption">For sole practitioners, CPA firms &amp; practice managers</div>
        </article>
      </div>

      <!-- 3 Step Next Bar -->
      <div class="hub-steps">
        <div class="hub-step-item">
          <span class="hub-step-num">01</span>
          <div class="hub-step-content">
            <strong>Choose your support</strong>
            <p>Business accounting services or CPA practice outsourcing.</p>
          </div>
        </div>
        <div class="hub-step-item">
          <span class="hub-step-num">02</span>
          <div class="hub-step-content">
            <strong>Agree the scope</strong>
            <p>Discuss your needs, fixed fees, and dedicated delivery.</p>
          </div>
        </div>
        <div class="hub-step-item">
          <span class="hub-step-num">03</span>
          <div class="hub-step-content">
            <strong>Get started</strong>
            <p>A clear handover, secure cloud access, and agreed next steps.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Interactive Detail View (Tabbed Explorer) -->
  <section class="interactive-detail" hidden aria-live="polite">
    <div class="wrap">
      <button type="button" class="detail-back-btn" data-view="home">← All support options</button>
      
      <div class="detail-header-wrap">
        <div class="detail-eyebrow">NEW ZEALAND / FOR BUSINESSES</div>
        <h2 class="detail-title">Accounting and tax support for your business.</h2>
        <p class="detail-copy">Choose the support you need, understand what is included, and discuss a scope that fits your business.</p>
      </div>

      <div class="detail-subnav">
        <!-- Dynamic Subnav Buttons rendered via JS -->
      </div>

      <div class="detail-panel-box">
        <h3 class="panel-title">Services Included</h3>
        <div class="panel-content">
          <!-- Dynamic Content rendered via JS -->
        </div>
      </div>

      <div style="display: flex; gap: 14px; align-items: center; flex-wrap: wrap;">
        <button type="button" class="btn btn-primary btn-lg detail-action-btn">
          Book a Business Consultation →
        </button>
        <button type="button" class="btn btn-outline btn-lg" data-view="home">
          Back to Overview
        </button>
      </div>
    </div>
  </section>

  <!-- Hero Section with Above-the-Fold Lead Form -->
  <section class="hero" id="hero-quote-section">
    <div class="wrap hero-grid">
      <div class="hero-content">
        <div class="rating-chip">
          <span class="rating-stars">★★★★★</span>
          <span class="rating-text">4.9/5 Rating from 120+ NZ Businesses &amp; Firms</span>
        </div>

        <h1>
          Stress-Free Accounting &amp; Tax<br>
          <span class="highlight-red">For NZ Businesses &amp; Accounting Practices</span>
        </h1>

        <p class="hero-intro">
          Save 40% to 60% on accounting costs without compromising quality. Delivered by qualified Indian Chartered Accountants with deep NZ Inland Revenue (IRD) compliance and Xero expertise.
        </p>

        <ul class="hero-ticks">
          <li>
            <div class="tick-icon">
              <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
            </div>
            <span><strong>100% IRD &amp; ATO Compliant:</strong> Maximize deductions and maintain full regulatory compliance.</span>
          </li>
          <li>
            <div class="tick-icon">
              <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
            </div>
            <span><strong>Extension of Time (EOT):</strong> Extended tax return and payment deadlines for our clients.</span>
          </li>
          <li>
            <div class="tick-icon">
              <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
            </div>
            <span><strong>Transparent Fixed Monthly Pricing:</strong> No surprise hourly bills. Direct advisor communication.</span>
          </li>
          <li>
            <div class="tick-icon">
              <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
            </div>
            <span><strong>Certified Xero &amp; MYOB Advisors:</strong> Smooth setup, bank reconciliations &amp; payroll.</span>
          </li>
        </ul>

        <div class="hero-media-card">
          <img src="assets/images/hero-team.jpg" alt="City Business Consulting Senior Accounting Team" width="600" height="300" loading="eager">
          <div class="hero-media-badge">
            <span>
              <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
              Dedicated India Delivery Team
            </span>
            <span class="highlight">Save 40–60% • 99.8% On-Time Returns</span>
          </div>
        </div>
      </div>

      <!-- Lead Capture Form Card -->
      <div class="lead-card" id="enquire">
        <div class="lead-card-header">
          <span class="lead-pill">Free • No Obligation</span>
          <h2><?= e($cfg['offer']) ?></h2>
          <p>Takes 45 seconds. We review your requirements and reply within <?= e($cfg['response_time']) ?>.</p>
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
            <label for="f-phone">Phone / WhatsApp Number</label>
            <div class="input-wrap">
              <span class="input-icon">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
              </span>
              <input id="f-phone" class="form-control" type="tel" name="phone" required placeholder="021 000 0000 / +64 / +61" maxlength="40" autocomplete="tel" inputmode="tel" value="<?= e($old['phone'] ?? '') ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="f-email">Email Address</label>
            <div class="input-wrap">
              <span class="input-icon">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
              </span>
              <input id="f-email" class="form-control" type="email" name="email" required placeholder="liam@company.co.nz" maxlength="190" autocomplete="email" value="<?= e($old['email'] ?? '') ?>">
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
                <optgroup label="For Small Businesses &amp; Sole Traders">
                  <option value="Complete Accounting &amp; Tax Package"<?= (($old['service'] ?? '') === 'Complete Accounting & Tax Package') ? ' selected' : '' ?>>Complete Business Package (Tax + GST + Books)</option>
                  <option value="Annual Tax Returns &amp; IRD Compliance"<?= (($old['service'] ?? '') === 'Annual Tax Returns & IRD Compliance') ? ' selected' : '' ?>>Annual Tax Returns (IR3/IR4) &amp; Compliance</option>
                  <option value="GST Returns &amp; Provisional Tax"<?= (($old['service'] ?? '') === 'GST Returns & Provisional Tax') ? ' selected' : '' ?>>GST Returns &amp; Provisional Tax</option>
                  <option value="Xero / MYOB Bookkeeping &amp; Setup"<?= (($old['service'] ?? '') === 'Xero / MYOB Bookkeeping & Setup') ? ' selected' : '' ?>>Xero / MYOB Bookkeeping &amp; Setup</option>
                  <option value="Payroll, PAYE &amp; KiwiSaver Filing"<?= (($old['service'] ?? '') === 'Payroll, PAYE & KiwiSaver Filing') ? ' selected' : '' ?>>Payroll &amp; PAYE Payday Filing</option>
                </optgroup>
                <optgroup label="For Accounting &amp; CPA Practices">
                  <option value="Accounting Firm Outsourcing (Workpapers &amp; Tax Prep)"<?= (($old['service'] ?? '') === 'Accounting Firm Outsourcing (Workpapers & Tax Prep)') ? ' selected' : '' ?>>Practice Outsourcing (Workpapers &amp; Tax Prep)</option>
                  <option value="Dedicated Full-Time Accountant (FTE)"<?= (($old['service'] ?? '') === 'Dedicated Full-Time Accountant (FTE)') ? ' selected' : '' ?>>Dedicated Full-Time Offshore Accountant (FTE)</option>
                </optgroup>
                <optgroup label="Specialized Support">
                  <option value="Overdue Returns &amp; IRD Support"<?= (($old['service'] ?? '') === 'Overdue Returns & IRD Support') ? ' selected' : '' ?>>Overdue Tax Returns / IRD Debt Support</option>
                  <option value="Not sure yet"<?= (($old['service'] ?? '') === 'Not sure yet') ? ' selected' : '' ?>>I am not sure yet (Need Advice)</option>
                </optgroup>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="f-message">Business / Firm Details <span class="opt">(optional)</span></label>
            <textarea id="f-message" class="form-control" name="message" maxlength="1000" rows="2" placeholder="Tell us about your business or practice and what support you are looking for"><?= e($old['message'] ?? '') ?></textarea>
          </div>

          <label class="form-consent">
            <input type="checkbox" name="consent" value="1" required checked>
            <span>I agree to be contacted regarding my enquiry. Read our <a href="privacy.php" target="_blank">privacy policy</a>.</span>
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
          <span>India-Based Qualified CAs</span>
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
          <span>Specialized in NZ &amp; AU Tax</span>
        </div>

        <div class="trust-item">
          <div class="trust-item-icon">
            <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20a2 2 0 002 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10z"/></svg>
          </div>
          <span>Save 40–60% on Overheads</span>
        </div>

        <div class="trust-item">
          <div class="trust-item-icon">
            <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
          </div>
          <span>Aligned with NZ Working Hours</span>
        </div>
      </div>
    </div>
  </section>

  <!-- Comprehensive Services Grid -->
  <section class="section section-accent" id="services">
    <div class="wrap">
      <div class="section-head">
        <span class="section-tag">Complete Solutions</span>
        <h2>Services For Businesses &amp; Accounting Practices</h2>
        <p>From sole trader year-end tax returns to complete company Xero bookkeeping and white-label CPA workpaper production.</p>
      </div>

      <div class="services-grid">
        <?php foreach ($cfg['services'] as $svc): ?>
          <div class="service-card">
            <div class="service-card-top">
              <div class="service-icon-box">
                <?php if (($svc['icon'] ?? '') === 'tax'): ?>
                  <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                <?php elseif (($svc['icon'] ?? '') === 'gst'): ?>
                  <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <?php elseif (($svc['icon'] ?? '') === 'bookkeeping'): ?>
                  <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                <?php elseif (($svc['icon'] ?? '') === 'payroll'): ?>
                  <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                <?php elseif (($svc['icon'] ?? '') === 'company'): ?>
                  <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                <?php else: ?>
                  <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
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

  <!-- Meet Advisor & Delivery Model Section -->
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
              <strong style="display:block; font-size: 0.95rem; color: var(--dark);">India-Based Specialists</strong>
              <span style="font-size: 0.8rem; color: var(--muted);">Direct access to senior accountants</span>
            </div>
          </div>
        </div>

        <div class="advisor-content">
          <span class="section-tag">India Practice • NZ &amp; AU Delivery</span>
          <h2>India-Based Qualified CAs Delivering Specialized NZ Tax &amp; Accounting</h2>
          <p>
            <?= e($cfg['brand']) ?> is an India-based accounting practice that gives New Zealand small businesses, contractors, and CPA firms access to senior Chartered Accountants and certified Xero specialists at <strong>40% to 60% lower costs</strong> than domestic accounting fees.
          </p>
          <p>
            Our dedicated team is rigorously trained in New Zealand tax legislation, GST rules, PAYE payday filing, and Inland Revenue (IRD) compliance. We operate aligned with New Zealand timezones to deliver faster turnaround and seamless communication.
          </p>

          <div class="advisor-pillars">
            <div class="pillar-item">
              <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
              <span>Save 40–60% on Overheads</span>
            </div>
            <div class="pillar-item">
              <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
              <span>Qualified CAs &amp; Tax Specialists</span>
            </div>
            <div class="pillar-item">
              <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
              <span>Xero &amp; MYOB Certified Practice</span>
            </div>
            <div class="pillar-item">
              <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
              <span>Aligned with NZ Timezone &amp; Hours</span>
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
        <h2>Trusted by NZ Businesses &amp; Accounting Practices</h2>
        <p>Here is what Kiwi business owners and practice directors say about working with City Business Consulting.</p>
      </div>

      <div class="testimonials-grid">
        <div class="testimonial-card">
          <div class="testimonial-stars">★★★★★</div>
          <p class="testimonial-quote">
            "Switching to City Business Consulting was a game changer for our Auckland building business. They cleaned up our Xero accounts, filed our backdated GST, and cut our annual accounting bill by more than half while providing faster responses."
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
            "As an accounting practice partner in Christchurch, staffing during tax season was always a bottleneck. City Business Consulting provides immaculate year-end workpapers and tax return preps ready for my sign-off. Outstanding accuracy!"
          </p>
          <div class="testimonial-author">
            <div class="author-avatar">SL</div>
            <div class="author-details">
              <h4>Simon Lewis, CA</h4>
              <p>Principal, Lewis &amp; Partners Advisory (Christchurch)</p>
            </div>
          </div>
        </div>

        <div class="testimonial-card">
          <div class="testimonial-stars">★★★★★</div>
          <p class="testimonial-quote">
            "As a sole trader IT contractor, tax was always stressful. Their team set me up on Xero, automated my receipt tracking, and filed my IR3 return seamlessly. Gives me total peace of mind with IRD."
          </p>
          <div class="testimonial-author">
            <div class="author-avatar">DW</div>
            <div class="author-details">
              <h4>Daniel Walker</h4>
              <p>IT &amp; Cloud Consultant (Wellington)</p>
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
        <p>Everything you need to know about our New Zealand accounting and practice outsourcing services.</p>
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
      <h2>Ready To Take The Stress Out Of Your Taxes Or Practice Workload?</h2>
      <p>
        Book your free 30-minute consultation &amp; fixed quote. No obligation, no sales pitch—just practical expertise from qualified Chartered Accountants.
      </p>

      <div class="closing-actions">
        <a class="btn btn-white btn-lg" href="#enquire">
          <span>Claim Free Tax Review / Quote</span>
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
          India-based accounting and consulting practice providing specialized offshore accounting, NZ tax compliance, GST returns, and Xero advisory for businesses across New Zealand and Australia.
        </p>
        <p style="margin-top: 12px; font-weight: 600; color: #cbd5e1;">
          📍 Headquartered in India • Dedicated Offshore Delivery for NZ &amp; AU
        </p>
      </div>

      <div class="footer-links">
        <h4>Key Services</h4>
        <ul>
          <li><a href="#services">Annual Tax Returns (IR3/IR4)</a></li>
          <li><a href="#services">GST Returns &amp; Provisional Tax</a></li>
          <li><a href="#services">Xero &amp; MYOB Bookkeeping</a></li>
          <li><a href="#services">Payroll &amp; PAYE Payday Filing</a></li>
          <li><a href="#services">Accounting Firm Workpaper Production</a></li>
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
