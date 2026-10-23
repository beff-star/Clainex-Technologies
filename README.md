# Clainex Technologies

A PHP website for Clainex Technologies, an ICT services company. The site includes service listings, customer registration and login, a service request cart and checkout, contact forms, and an admin area for managing services, categories, customers, and orders.

## Requirements

- PHP with PDO MySQL enabled
- MySQL or MariaDB
- Apache (XAMPP is suitable for local development)

## Local setup with XAMPP

1. Place the project in the XAMPP `htdocs` directory. The configured local URL expects the project to be available at `http://localhost/clainex`.
2. Start Apache and MySQL from the XAMPP Control Panel.
3. In phpMyAdmin, import [`database/clainex_db.sql`](database/clainex_db.sql). This creates and seeds the `clainex_db` database. Import it into a fresh database; the seed inserts are not designed to be run repeatedly.
4. Check the site and database settings in [`config.php`](config.php). The defaults are:
   - Site URL: `http://localhost/clainex`
   - Database: `clainex_db`
   - Host: `localhost`
   - User: `root`
   - Password: empty
5. If the project is not served at `/clainex`, update `BASE_URL` in `config.php` to match its local URL.
6. Open `http://localhost/clainex` in your browser.

## Project structure

- `index.php`, `about.php`, `contact.php`, and other root PHP files: public pages
- `auth/`: registration, login, logout, and a password recovery page (reset functionality is not wired up)
- `admin/`: administrative pages
- `includes/`: shared page layout and application helpers
- `assets/`: stylesheets, JavaScript, and images
- `database/clainex_db.sql`: database schema and initial data

## Notes

- Service cards are currently provided by the `serviceCatalog()` helper in `includes/functions.php`.
- Configure appropriate application and database settings before deploying outside a local development environment. Do not use the default local database credentials in production.
