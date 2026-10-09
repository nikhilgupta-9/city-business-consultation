/**
 * City Business Consulting Landing Page Scripts
 * Meta Ad Tracking, Smooth Interactions, Interactive Quote Estimator, FAQ Accordion
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

      // Close all items
      document.querySelectorAll('.faq-item').forEach(function (el) {
        el.classList.remove('open');
      });

      // Toggle clicked item
      if (!isOpen) {
        item.classList.add('open');
      }
    });
  });

  // Open first FAQ by default
  var firstFaq = document.querySelector('.faq-item');
  if (firstFaq) {
    firstFaq.classList.add('open');
  }

  // 4. Interactive Package / Service Selector
  var typeButtons = document.querySelectorAll('[data-biz-type]');
  var calcTitle = document.getElementById('calc-plan-title');
  var calcDescription = document.getElementById('calc-plan-desc');
  var serviceSelect = document.getElementById('f-service');

  var planDetails = {
    'sole-trader': {
      title: 'Sole Trader & Contractor Tax Pack',
      desc: 'Annual income tax return (IR3), expense deduction maximization, GST returns, home office claims, and direct IRD support.',
      serviceVal: 'Annual Tax Returns & IRD Compliance'
    },
    'small-business': {
      title: 'Complete Small Business Xero Package',
      desc: 'Monthly Xero bookkeeping, 2-monthly GST returns, end-of-year company accounts (IR4), payroll for staff, and proactive tax planning.',
      serviceVal: 'Complete Accounting & Tax Package'
    },
    'company-starter': {
      title: 'New Company Formation & Starter Pack',
      desc: 'NZ Companies Office incorporation, IRD & GST registration, Xero setup & chart of accounts, and first-year tax structuring.',
      serviceVal: 'NZ Company Incorporation & Structuring'
    },
    'overdue-catchup': {
      title: 'Overdue Returns & IRD Remediation',
      desc: 'Catch-up accounting for overdue GST & income tax returns, penalty remission requests with IRD, and installment negotiation.',
      serviceVal: 'Overdue Returns & IRD Support'
    }
  };

  typeButtons.forEach(function (btn) {
    btn.addEventListener('click', function () {
      typeButtons.forEach(function (b) { b.classList.remove('active'); });
      this.classList.add('active');

      var key = this.getAttribute('data-biz-type');
      var plan = planDetails[key];
      if (plan && calcTitle && calcDescription) {
        calcTitle.textContent = plan.title;
        calcDescription.textContent = plan.desc;
      }
    });
  });

  // Function to preselect service from CTA buttons
  window.selectServiceAndScroll = function (serviceName) {
    if (serviceSelect && serviceName) {
      for (var i = 0; i < serviceSelect.options.length; i++) {
        if (serviceSelect.options[i].text.toLowerCase().indexOf(serviceName.toLowerCase()) !== -1 ||
            serviceSelect.options[i].value.toLowerCase().indexOf(serviceName.toLowerCase()) !== -1) {
          serviceSelect.selectedIndex = i;
          break;
        }
      }
    }
    var target = document.getElementById('enquire');
    if (target) {
      target.scrollIntoView({ behavior: 'smooth' });
    }
  };
});
