# Soft City landing page

A one-page landing page for Meta ads, built in PHP + MySQL (same stack as the get-accountant site).
Visitors fill one form; the enquiry is saved to MySQL, emailed to the owner, and tagged with the
ad campaign it came from. The Meta Pixel `Lead` event fires on the thank-you page.

## Files

| File | What it does |
|---|---|
| `config.php` | **The only file to edit**: copy, contact details, Pixel ID, database login |
| `index.php` | The landing page and form |
| `lead.php` | Receives the form: validates, saves, emails, redirects |
| `thank-you.php` | Confirmation page; fires the Pixel `Lead` event once |
| `privacy.php` | Privacy policy **template**: have the owner review it before ads go live |
| `inc.php` | Shared helpers (database, CSRF, Pixel, CSV safety net) |
| `assets/` | `style.css`, `app.js` (captures UTM parameters) |
| `database/schema.sql` | Creates the `landing_leads` table |
| `storage/` | If MySQL is ever down, enquiries are written to `leads-fallback.csv` here |

Needs PHP 7.4 or newer and MySQL/MariaDB.

## Run it locally (XAMPP)

1. Copy this folder to `D:\xampp\htdocs\softcity-landing`.
2. In phpMyAdmin create a database called `softcity_landing`, then import `database/schema.sql`.
3. Open `http://localhost/softcity-landing/`.
4. Submit the form with test details. The row appears in the `landing_leads` table.

If the database login is different, change the `db` block in `config.php`.

## Put it live

1. Pick the address: a subdomain such as `offer.yourdomain.com` works well, and keeps ad traffic away from the main site.
2. Upload the folder to that subdomain's web root. Create the database and import `schema.sql` on the host.
3. In `config.php` set: `phone`, `whatsapp`, `notify_email`, `from_email` (a real mailbox on the same domain, so alert emails don't land in spam), `privacy_email`, and the database login.
4. Make sure `storage/` is writable by PHP. Both `storage/` and `database/` ship with a `.htaccess` that blocks web access; confirm `https://yoursite/storage/leads-fallback.csv` and `https://yoursite/database/schema.sql` return 403.
5. Submit a real test enquiry. Check three things: the row is in the database, the alert email arrived, and you land on the thank-you page.
6. Use HTTPS. Meta ads and the Pixel both expect it.

## Before ads go live (content to confirm with the client)

- Services list, "free initial consultation" offer, and the "within one business day" promise are defaults. Only keep what the client will actually deliver.
- `founder_note`: add a credential only if it is accurate and verifiable in the country you advertise in.
- Read `privacy.php` and correct anything that is not true for the business.

## Connect the Meta Pixel

1. In Meta Events Manager create a Pixel and copy its numeric ID into `pixel_id` in `config.php`.
2. Install the free **Meta Pixel Helper** Chrome extension. Open the landing page: it should show `PageView`.
3. Submit a test enquiry: the thank-you page should show `Lead`. It fires once per enquiry, not on refresh.
4. In Business Settings > Brand safety > Domains, verify the domain the landing page lives on.

## Use it in ads

Put the page URL in each ad with tracking parameters, so every enquiry records which ad it came from:

```
https://offer.yourdomain.com/?utm_source=facebook&utm_medium=paid&utm_campaign=nz_test&utm_content=ad_a
```

Change `utm_content` per ad (`ad_a`, `ad_b`, ...). In Meta's ad setup you can also use the URL parameters field with
`utm_source=facebook&utm_medium=paid&utm_campaign={{campaign.name}}&utm_content={{ad.name}}`.

## Reading your leads

Open the `landing_leads` table in phpMyAdmin. `utm_campaign` and `utm_content` show which campaign and ad each lead
came from. Use the `status` column (`new`, `contacted`, `qualified`, `won`, `lost`) to track follow-up, and `notes`
for call notes. Count leads per ad with:

```sql
SELECT utm_campaign, utm_content, COUNT(*) AS leads FROM landing_leads GROUP BY utm_campaign, utm_content;
```

## Security notes

Prepared statements for every database write, CSRF token, a hidden honeypot field for bots, a short rate limit, and
formula-safe CSV output. The form stores only what it needs (no IP address).
