# Clainex Technologies

A PHP website for Clainex Technologies, an ICT services company. The site includes service listings, a service request and quote flow, a cart and checkout, contact forms, and an admin area for managing services, categories, customers, and orders.

## Requirements

- PHP with PDO MySQL enabled
- MySQL or MariaDB
- Apache (XAMPP is suitable for local development)

## Local setup with XAMPP

1. Place the project in the XAMPP `htdocs` directory. The configured local URL expects the project to be available at `http://localhost/Clainex-Technologies`.
2. Start Apache and MySQL from the XAMPP Control Panel.
3. In phpMyAdmin, import [`database/clainex_db.sql`](database/clainex_db.sql). This creates and seeds the `clainex_db` database. Import it into a fresh database; the seed inserts are not designed to be run repeatedly.
4. Check the site and database settings in [`config.php`](config.php). The defaults are:
   - Site URL: `http://localhost/Clainex-Technologies`
   - Database: `clainex_db`
   - Host: `localhost`
   - User: `root`
   - Password: empty
5. If the project is not served at `/Clainex-Technologies`, set `SITE_URL` in the environment or update the local default in `config.php`.
6. Open `http://localhost/Clainex-Technologies` in your browser.

## Project structure

- `index.php`, `about.php`, `contact.php`, and other root PHP files: public pages
- `auth/`: registration, login, logout, and a password recovery page (reset functionality is not wired up)
- `admin/`: administrative pages
- `includes/`: shared page layout and application helpers
- `assets/`: assets used by the PHP application
- `public/`: static HTML frontend and copied assets for static hosting
- `database/clainex_db.sql`: database schema and initial data

## Production deployment

This project is a PHP/MySQL application with server-side sessions. Vercel's documented function runtimes do not include PHP, so this repository cannot be deployed to Vercel as-is. Run it on a PHP-compatible host with Apache rewrite support, PHP 8.2 or newer, PDO MySQL, HTTPS, and a production MySQL/MariaDB database. Point the domain to that host; adding a Vercel configuration file alone will not make the PHP app runnable there.

Configure these environment variables in the PHP host (never commit production credentials):

- `APP_ENV=production`
- `SITE_URL=https://clainextechnologies.co.ke`
- `DB_HOST`, `DB_PORT`, `DB_NAME`, `DB_USER`, and `DB_PASS`

In production the application does not fall back to local database credentials. Import the schema into a fresh production database and replace or remove the seeded admin account before making the site public. Enforce HTTPS; production session cookies are marked secure and HttpOnly.

The domain currently needs to be connected to the selected PHP host: the public URL is serving a generic hosting placeholder rather than this application.

## Static Vercel frontend

The `public/` directory contains static HTML snapshots of the public homepage, about, services, contact, privacy, and terms pages, plus their assets. To deploy only these files on Vercel, set the project's Root Directory to `public`. The PHP application remains outside that deployment.

Static forms and request/cart links require a separate PHP backend. Set `window.CLAINEX_BACKEND_URL` in [`public/assets/js/backend-config.js`](public/assets/js/backend-config.js) to the backend's actual HTTPS origin before deploying. It currently uses the supplied domain; that will not execute PHP if the domain is served only by Vercel. Configure a separate PHP host and route the backend there before relying on these actions.

## Notes

- Service cards are currently provided by the `serviceCatalog()` helper in `includes/functions.php`.
- The `.htaccess` rules protect private source/data paths and prevent dynamic pages from being cached as public content. They require Apache and do not apply on Vercel.
- `public/` is a static snapshot; keep it synchronized with the PHP pages when public content changes and check that PHP form endpoints still target the configured backend.
