/**
 * City Business Consulting Landing Page Scripts
 * Dual-Audience Pathway Explorer, Subtabs Navigation, Country Switcher & Lead Tracking
 */
document.addEventListener('DOMContentLoaded', function () {
  // 1. Capture UTM and Meta Ad tracking parameters
  var keys = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term', 'fbclid'];
  var params = new URLSearchParams(window.location.search);

  keys.forEach(function (key) {
    var value = params.get(key);
    try {
      if (value) {
        sessionStorage.setItem('cbc_' + key, value);
      } else {
        value = sessionStorage.getItem('cbc_' + key);
      }
    } catch (err) { /* ignore storage error */ }

    var field = document.querySelector('input[name="' + key + '"]');
    if (field && value) {
      field.value = value.slice(0, 150);
    }
  });

  // 2. Prevent Double Submits on the enquiry form
  var form = document.getElementById('enquiry-form');
  if (form) {
    var submitBtn = form.querySelector('button[type="submit"]');
    var originalLabel = submitBtn ? submitBtn.innerHTML : 'Submit';

    form.addEventListener('submit', function () {
      if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span>Processing your request...</span>';
      }
    });

    window.addEventListener('pageshow', function () {
      if (submitBtn) {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalLabel;
      }
    });
  }

  // 3. Interactive FAQ Accordion
  var faqQuestions = document.querySelectorAll('.faq-question');
  faqQuestions.forEach(function (btn) {
    btn.addEventListener('click', function () {
      var item = this.parentElement;
      var isOpen = item.classList.contains('open');

      document.querySelectorAll('.faq-item').forEach(function (el) {
        el.classList.remove('open');
      });

      if (!isOpen) {
        item.classList.add('open');
      }
    });
  });

  var firstFaq = document.querySelector('.faq-item');
  if (firstFaq) {
    firstFaq.classList.add('open');
  }

  // 4. Dual-Audience Explorer Data & Logic (get-accountant style)
  var explorerData = {
    business: {
      label: 'FOR BUSINESSES',
      title: 'Practical Accounting & Tax Support for Your Business.',
      copy: 'Choose the support you need, understand what is included, and discuss a transparent fixed scope that fits your small business or sole proprietorship.',
      cta: 'Book a Business Consultation →',
      servicePreselect: 'Complete Accounting & Tax Package',
      tabs: {
        'Services Included': `
          <p>Complete end-to-end cloud accounting tailored for Kiwi business owners:</p>
          <ul>
            <li><strong>Bookkeeping & Bank Reconciliations:</strong> Daily/weekly transaction coding, receipt management via Dext/Hubdoc, and clean Xero ledger maintenance.</li>
            <li><strong>Tax Returns, GST & Annual Accounts:</strong> Preparation of financial statements, IR3/IR4 income tax returns, and 2-monthly or 6-monthly GST filings.</li>
            <li><strong>Payroll, PAYE & KiwiSaver:</strong> Payday filing compliant with NZ employment law and employee leave management.</li>
            <li><strong>Business Advisory:</strong> Cash flow forecasting, budget planning, and periodic management reports.</li>
          </ul>
        `,
        'Fixed Pricing': `
          <p>Transparent monthly fees with zero hourly billing surprises:</p>
          <ul>
            <li><strong>Sole Trader / Tradie Pack:</strong> From NZ $120/mo — Annual IR3 return, home office deductions, GST filings, and phone support.</li>
            <li><strong>Small Business Xero Pack:</strong> From NZ $240/mo — Full Xero bookkeeping, 2-monthly GST, annual company accounts (IR4), and payroll.</li>
            <li><strong>Growing Company Pack:</strong> Custom fixed fee — Complete outsourced accounting department, monthly management reporting, and CFO advisory.</li>
          </ul>
        `,
        'How It Works': `
          <p>Simple, frictionless 3-step onboarding:</p>
          <ul>
            <li><strong>1. Free 15-Min Discovery Call:</strong> We review your current accounts, identify missed tax deductions, and understand your pain points.</li>
            <li><strong>2. Agree Scope & Fixed Fee:</strong> Clear written proposal with transparent deliverables and zero hidden costs.</li>
            <li><strong>3. Connect & Begin:</strong> Seamless connection to Xero/MYOB and hassle-free handover from your previous accountant.</li>
          </ul>
        `,
        'Common FAQs': `
          <p>Key questions from NZ business owners:</p>
          <ul>
            <li><strong>Is switching accountants difficult?</strong> No! We handle the ethical clearance and record transfer directly from your old accountant.</li>
            <li><strong>Can you help with overdue GST or tax returns?</strong> Yes, we specialize in bringing backdated returns up to date and negotiating IRD payment plans.</li>
            <li><strong>Are my records safe?</strong> We use bank-grade 256-bit encrypted cloud accounting platforms (Xero/MYOB) with strict NDA confidentiality.</li>
          </ul>
        `
      }
    },
    firm: {
      label: 'FOR ACCOUNTING FIRMS & CPA PRACTICES',
      title: 'Dedicated Offshore Capacity for Accounting Practices.',
      copy: 'Scale your accounting firm without hiring bottlenecks. Our India-based Chartered Accountants prepare workpapers, year-end accounts, and tax returns following your exact standards and review processes.',
      cta: 'Discuss a Pilot Engagement →',
      servicePreselect: 'Accounting Firm Outsourcing (Workpapers & Tax Prep)',
      tabs: {
        'Outsourcing Services': `
          <p>High-quality production support tailored for NZ & Australian accounting firms:</p>
          <ul>
            <li><strong>Bookkeeping & Reconciliation Production:</strong> Bank reconciliations, loan amortizations, fixed asset register maintenance, and year-end trial balance preparation.</li>
            <li><strong>Year-End Accounts & Workpaper Preparation:</strong> Complete electronic workpaper binders referenced and cross-checked ready for partner review.</li>
            <li><strong>Tax Return Preparation:</strong> IR3, IR4, IR6, and company tax return calculations ready for final firm sign-off.</li>
            <li><strong>Seasonal Capacity:</strong> Flexible surge support during peak NZ tax and GST filing deadlines.</li>
          </ul>
        `,
        'How We Work': `
          <p>Structured, quality-controlled practice integration:</p>
          <ul>
            <li><strong>1. Scope a Pilot Engagement:</strong> Test our delivery on 2–3 client jobs with zero long-term commitment.</li>
            <li><strong>2. Agree Templates & Workpapers:</strong> We adopt your firm’s checklists, software stack, and formatting standards.</li>
            <li><strong>3. Preparation & 2-Tier Quality Review:</strong> Every job is prepared by a qualified accountant and reviewed internally before delivery.</li>
            <li><strong>4. Partner Handover:</strong> Ready-for-review pack delivered with detailed query sheets for swift partner sign-off.</li>
          </ul>
        `,
        'Quality & Security': `
          <p>Uncompromising compliance and data protection:</p>
          <ul>
            <li><strong>Strict Confidentiality & NDAs:</strong> All client relationships remain 100% owned by your firm. White-label delivery guaranteed.</li>
            <li><strong>Qualified Professional Team:</strong> Senior Chartered Accountants with in-depth knowledge of NZ IRD & Australian ATO rules.</li>
            <li><strong>Secure Cloud Workflows:</strong> Direct login to your firm’s cloud environment with no local unencrypted file storage.</li>
          </ul>
        `,
        'Engagement Options': `
          <p>Flexible engagement models designed for practices of all sizes:</p>
          <ul>
            <li><strong>Ad-Hoc / Project-Based:</strong> Fixed price per job (e.g. annual financial statements + tax return bundle).</li>
            <li><strong>Dedicated Full-Time Equivalent (FTE):</strong> Dedicated senior accountant assigned exclusively to your practice.</li>
            <li><strong>Seasonal Surge Capacity:</strong> Pre-booked hours during busy filing quarters.</li>
          </ul>
        `
      }
    },
    about: {
      label: 'ABOUT CITY BUSINESS CONSULTING',
      title: 'India-Based Accounting Excellence for New Zealand & Australia.',
      copy: 'Combining top-tier Indian Chartered Accountants with deep New Zealand and Australian tax expertise to deliver high accuracy and massive cost efficiency.',
      cta: 'Explore Support Options →',
      servicePreselect: 'Not sure yet',
      tabs: {
        'Our Delivery Team': `
          <p>Meet our practice foundation:</p>
          <ul>
            <li><strong>Top Chartered Accountants:</strong> Rigorously trained in New Zealand Inland Revenue (IRD) compliance and Australian tax legislation.</li>
            <li><strong>Xero & MYOB Certified:</strong> Platinum-level proficiency across modern cloud platforms, Dext, Hubdoc, and payroll systems.</li>
            <li><strong>Direct Advisor Communication:</strong> Work directly with experienced senior accountants via email, phone, and WhatsApp.</li>
          </ul>
        `,
        'Our Approach': `
          <p>Why clients and CPA practices choose our offshore delivery model:</p>
          <ul>
            <li><strong>40%–60% Cost Reduction:</strong> Dramatically lower overhead costs while maintaining or elevating work quality.</li>
            <li><strong>Timezone Synergy:</strong> Fast overnight turnarounds and real-time collaboration during NZ working hours.</li>
            <li><strong>Client-First Standard:</strong> Transparent fixed fees, no surprise invoices, and 24-hour reply commitment.</li>
          </ul>
        `
      }
    }
  };

  var homeSection = document.querySelector('.pathway-hub');
  var detailSection = document.querySelector('.interactive-detail');
  var detailLabel = document.querySelector('.detail-eyebrow');
  var detailTitle = document.querySelector('.detail-title');
  var detailCopy = document.querySelector('.detail-copy');
  var detailSubnav = document.querySelector('.detail-subnav');
  var panelTitle = document.querySelector('.panel-title');
  var panelContent = document.querySelector('.panel-content');
  var detailActionBtn = document.querySelector('.detail-action-btn');
  var countrySelect = document.querySelector('.country-select');
  var regionSpan = document.querySelector('.hub-region-name');
  var serviceSelect = document.getElementById('f-service');

  function renderDetailView(viewKey) {
    if (!explorerData[viewKey]) {
      if (homeSection) homeSection.hidden = false;
      if (detailSection) detailSection.hidden = true;
      document.querySelectorAll('.nav-btn').forEach(function (b) { b.classList.remove('active'); });
      return;
    }

    var isAU = countrySelect && countrySelect.value === 'au';
    var data = explorerData[viewKey];

    if (homeSection) homeSection.hidden = true;
    if (detailSection) detailSection.hidden = false;

    // Update active nav
    document.querySelectorAll('.nav-btn').forEach(function (b) {
      if (b.dataset.view === viewKey) {
        b.classList.add('active');
      } else {
        b.classList.remove('active');
      }
    });

    if (detailLabel) detailLabel.textContent = (isAU ? 'AUSTRALIA' : 'NEW ZEALAND') + ' / ' + data.label;
    if (detailTitle) detailTitle.textContent = data.title;
    if (detailCopy) detailCopy.textContent = isAU ? data.copy.replace(/New Zealand/g, 'Australia').replace(/NZ/g, 'AU') : data.copy;
    if (detailActionBtn) {
      detailActionBtn.textContent = data.cta;
      detailActionBtn.onclick = function () {
        selectServiceAndScroll(data.servicePreselect);
      };
    }

    // Render Subnav Tabs
    if (detailSubnav) {
      detailSubnav.innerHTML = '';
      var tabEntries = Object.entries(data.tabs);
      tabEntries.forEach(function (entry, idx) {
        var tabName = entry[0];
        var tabHtml = entry[1];
        var btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'subnav-btn' + (idx === 0 ? ' active' : '');
        btn.textContent = tabName;
        btn.onclick = function () {
          detailSubnav.querySelectorAll('.subnav-btn').forEach(function (b) { b.classList.remove('active'); });
          btn.classList.add('active');
          if (panelTitle) panelTitle.textContent = tabName;
          if (panelContent) panelContent.innerHTML = tabHtml;
        };
        detailSubnav.appendChild(btn);

        if (idx === 0) {
          if (panelTitle) panelTitle.textContent = tabName;
          if (panelContent) panelContent.innerHTML = tabHtml;
        }
      });
    }

    // Smooth scroll to detail view
    if (detailSection) {
      detailSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  }

  // Bind view switchers
  document.querySelectorAll('[data-view]').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var view = this.dataset.view;
      if (view === 'home') {
        if (homeSection) homeSection.hidden = false;
        if (detailSection) detailSection.hidden = true;
        document.querySelectorAll('.nav-btn').forEach(function (b) { b.classList.remove('active'); });
        if (homeSection) homeSection.scrollIntoView({ behavior: 'smooth' });
      } else {
        renderDetailView(view);
      }
    });
  });

  // Country switch listener
  if (countrySelect) {
    countrySelect.addEventListener('change', function () {
      var isAU = this.value === 'au';
      if (regionSpan) {
        regionSpan.textContent = isAU ? 'Australia' : 'New Zealand';
      }
      var activeNav = document.querySelector('.nav-btn.active');
      if (activeNav && activeNav.dataset.view) {
        renderDetailView(activeNav.dataset.view);
      }
    });
  }

  // Preselect service in form and scroll
  window.selectServiceAndScroll = function (serviceName) {
    if (serviceSelect && serviceName) {
      var found = false;
      for (var i = 0; i < serviceSelect.options.length; i++) {
        if (serviceSelect.options[i].text.toLowerCase().indexOf(serviceName.toLowerCase()) !== -1 ||
            serviceSelect.options[i].value.toLowerCase().indexOf(serviceName.toLowerCase()) !== -1) {
          serviceSelect.selectedIndex = i;
          found = true;
          break;
        }
      }
      if (!found) {
        serviceSelect.value = serviceName;
      }
    }
    var target = document.getElementById('enquire');
    if (target) {
      target.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
  };
});
