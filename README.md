# Altysier Group — WordPress Theme

Custom theme powering the Altysier Group corporate site. Pixel-perfect conversion of the
original static HTML site, fully editable via ACF PRO.

## Requirements

- WordPress 6.x
- PHP 8.0+
- **Advanced Custom Fields PRO** (required — repeaters, flexible content, gallery fields,
  and the options page all need PRO, not the free version)
- MySQL/MariaDB

## Install (fresh site)

1. Install WordPress normally.
2. Install & activate **ACF PRO**.
3. Clone/copy this repo into `wp-content/themes/altysier`.
4. Appearance → Themes → activate **Altysier**.
5. Create these Pages and assign the matching **Template** (Page Attributes → Template)
   before anything under them becomes ACF-editable:
   - Home → *Front Page* (Settings → Reading → set as homepage)
   - About Us → `page-about.php`
   - CSR & Sustainability → `page-csr.php`
   - Contact Us → `page-contact.php`
   - Privacy Policy → `page-privacy.php`
   - Terms of Use → `page-terms.php`
   - Group of Companies → `page-group-of-companies.php` (redirects to `/#companies`)
6. Add **Company** posts (custom post type, left menu) — one per group company.
7. Settings → **Altysier Settings** (added by the theme, left admin menu): fill in
   Gmail SMTP (App Password, not your normal password) and, if wanted, Google
   reCAPTCHA v3 keys. Both are safely inert until filled in.
8. Menus: Appearance → Menus, assign to "Primary Navigation" / footer locations.

## What does NOT come with this repo

Git only carries the **code**. It does not carry:
- The database (all page content, company data, form settings) — export/import
  separately (phpMyAdmin, WP-CLI `wp db export/import`, or a migration plugin).
- `wp-content/uploads/` (media library) — copy the folder directly, or use a
  migration plugin that bundles it.

## Structure

- `front-page.php`, `page-*.php`, `single-company.php` — page templates
- `inc/acf-fields.php` — every ACF field group (all page content lives here)
- `inc/cpt.php` — the `company` custom post type
- `inc/smtp.php`, `inc/recaptcha.php`, `inc/forms.php` — enquiry form pipeline
  (no third-party SMTP/reCAPTCHA plugin needed — all custom, credentials in
  Settings → Altysier Settings, never in code)
- `inc/seo.php` — meta tags / Open Graph / sitemap (no SEO plugin needed)
- `assets/` — CSS/JS/images migrated from the original static site
