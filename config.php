<?php
/**
 * City Business Consulting - NZ Accounting & Tax Services Landing Page Configuration
 */
return [
    'brand'         => 'City Business Consulting',
    'brand_short'   => 'City Business',
    'tagline'       => 'Accounting, Tax & Business Advisory in New Zealand',

    // Hero copy tailored for high Meta Ad conversion
    'headline_1'    => 'Stress-Free Accounting & Tax Returns',
    'headline_2'    => 'For NZ Small Businesses & Sole Traders',
    'intro'         => 'Save time, minimize tax, and stay 100% IRD compliant. Get dedicated Xero-certified accounting, GST returns, and payroll with transparent fixed monthly pricing.',

    // Founder / Lead Accountant
    'founder'       => 'City Business Consulting Advisory Team',
    'founder_note'  => 'Registered NZ tax specialists and Xero certified advisors serving clients across Auckland, Wellington, Christchurch, and nationwide.',

    // Contact details (can be set directly or configured)
    'phone'         => '+64 9 888 7654',            // NZ phone number e.g. +64 9 888 7654
    'whatsapp'      => '64210000000',               // WhatsApp international format
    'email'         => 'info@citybusinessconsulting.co.nz',
    'location'      => 'Auckland, New Zealand',

    // Lead notification settings
    'notify_email'  => 'leads@citybusinessconsulting.co.nz',
    'from_email'    => 'no-reply@citybusinessconsulting.co.nz',
    'privacy_email' => 'privacy@citybusinessconsulting.co.nz',

    // Conversion hooks
    'response_time' => 'under 24 hours',
    'offer'         => 'Claim Your Free NZ Tax Review & Quote',
    'cta_label'     => 'Get My Free Tax Review',

    // Meta Pixel ID (can be configured by ad manager)
    'pixel_id'      => '',

    'db' => [
        'host' => '127.0.0.1',
        'name' => 'softcity_landing',
        'user' => 'root',
        'pass' => '',
    ],

    // Specialized NZ Accounting & Tax Services
    'services' => [
        [
            'id'    => 'tax-returns',
            'title' => 'Annual Tax Returns & IRD Compliance',
            'icon'  => 'tax',
            'badge' => 'Most Popular',
            'text'  => 'End-of-year financial statements and income tax filings (IR3, IR4, IR6) for companies, sole traders, contractors, and trusts. Maximize legitimate deductions and get IRD filing extensions (EOT).'
        ],
        [
            'id'    => 'gst-provisional',
            'title' => 'GST Returns & Provisional Tax',
            'icon'  => 'gst',
            'badge' => 'IRD On-Time Guarantee',
            'text'  => 'Accurate 2-monthly or 6-monthly GST return preparations and filing with Inland Revenue. We calculate and manage your provisional tax schedules so there are no cash flow shocks.'
        ],
        [
            'id'    => 'bookkeeping-xero',
            'title' => 'Xero / MYOB Bookkeeping & Setup',
            'icon'  => 'bookkeeping',
            'badge' => 'Xero Certified',
            'text'  => 'Clean, automated cloud bookkeeping. Bank reconciliations, receipt management (Hubdoc / Dext), invoice chasing, and real-time financial dashboards tailored for NZ business owners.'
        ],
        [
            'id'    => 'payroll-paye',
            'title' => 'Payroll, PAYE & KiwiSaver Filing',
            'icon'  => 'payroll',
            'badge' => 'Payday Filing Ready',
            'text'  => 'Hassle-free payday filing compliant with NZ employment law. We manage wage calculations, PAYE deductions, holiday pay, KiwiSaver contributions, and employer returns.'
        ],
        [
            'id'    => 'company-formation',
            'title' => 'NZ Company Incorporation & Structuring',
            'icon'  => 'company',
            'badge' => 'New Business Starter',
            'text'  => 'Setting up a new venture? We handle NZ Companies Office registration, IRD number allocations, GST registrations, director shareholding structures, and bank setup guidance.'
        ],
        [
            'id'    => 'advisory-growth',
            'title' => 'Business Advisory & Cash Flow Planning',
            'icon'  => 'advisory',
            'badge' => 'Growth & Profit',
            'text'  => 'Strategic management accounting, budget forecasting, break-even analysis, and regular advisory check-ins to help you increase profit and grow sustainably in NZ.'
        ],
    ],

    'faqs' => [
        [
            'q' => 'How does the free initial tax review & quote work?',
            'a' => 'Simply fill out the form or reach out via WhatsApp/Phone. We schedule a friendly 15-minute consultation to look over your current setup, discuss your tax needs, and provide a transparent, fixed-fee quote tailored to your business.'
        ],
        [
            'q' => 'Can you help if I am behind on my NZ tax returns or GST?',
            'a' => 'Yes! We specialize in bringing overdue accounts, unfiled GST, and backdated income tax returns up to date. As registered tax agents, we can communicate directly with Inland Revenue (IRD) and help arrange installment plans if needed.'
        ],
        [
            'q' => 'Do you charge hourly or fixed monthly fees?',
            'a' => 'We believe in 100% price transparency. We offer agreed-upon fixed monthly packages or fixed one-off pricing for annual returns. You will never receive an unexpected bill for asking a question.'
        ],
        [
            'q' => 'Do you only work with businesses in Auckland, or all of New Zealand?',
            'a' => 'We are based in Auckland but support small businesses, contractors, tradies, and startups right across New Zealand (Auckland, Hamilton, Tauranga, Wellington, Christchurch, Queenstown & beyond) through secure cloud accounting with Xero.'
        ],
        [
            'q' => 'How easy is it to switch from my current accountant?',
            'a' => 'Switching is completely seamless and stress-free. You don’t even have to have an awkward conversation—we handle the ethical handover and transfer of records from your previous accountant for you.'
        ],
    ],
];
