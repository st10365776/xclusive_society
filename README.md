# Xclusive Society

A PHP-based e-commerce application built for a fashion retail environment. Xclusive Society provides a complete shopping experience with product categories, cart management, checkout, user accounts, seller submissions, and an admin dashboard.

## Project Overview

Xclusive Society is a web store built using PHP, MySQL, HTML, CSS, and JavaScript. The application includes:
- Public-facing shopping pages for Men, Women, Kids, and New arrivals
- Product listing, featured products, and search support
- Shopping cart, add/remove item features, and checkout flow
- User registration, login, profile, and order history
- Admin panel for managing users, products, orders, and seller submissions
- Email support via PHPMailer for messaging and notifications

## Key Features

- Responsive product catalog with category pages
- Secure user authentication and profile management
- Shopping cart and order placement system
- Admin management dashboard for users, products, orders, and approvals
- Seller product submission workflow
- Database schema creation and maintenance helpers

## Requirements

- PHP 7.4+ (or compatible PHP environment)
- MySQL / MariaDB
- XAMPP, MAMP, or similar local development server
- Composer for PHP dependency management

## Installation

1. Clone or copy the project files to the web server document root. Example for XAMPP:

```bash
/Applications/XAMPP/xamppfiles/htdocs/xclusive_society
```

2. Install dependencies with Composer:

```bash
cd /Applications/XAMPP/xamppfiles/htdocs/xclusive_society
composer install
```

3. Create the database and tables. If the project includes a setup script, use it, or create the schema manually using the database helper scripts.

4. Configure the database connection in `includes/DBConn.php`.

5. Configure email settings if PHPMailer is used for notifications.

## Running Locally

1. Start Apache and MySQL in XAMPP.
2. Open your browser and navigate to:

```text
http://localhost/xclusive_society/
```

3. Use the homepage to browse categories, view products, register, and place orders.

## Project Structure

- `index.php` — Main landing page and featured product display
- `style.css` — Main stylesheet for layout and UI
- `includes/` — Shared header/footer, database connection, and helper scripts
- `admin/` — Admin dashboard pages and management tools
- `images/` — Product and category images
- `uploads/` — File upload destination for seller submissions or images
- `vendor/` — Composer-managed PHP dependencies (including PHPMailer)

## Admin Section

The `admin/` folder contains pages for:
- Admin login and authentication
- User management and account verification
- Product approval and seller submission handling
- Order viewing and management
- Admin messaging and communications

## Notes

- Ensure `includes/DBConn.php` points to the correct MySQL credentials.
- If the database tables are not present, run any provided setup scripts or import the schema manually.
- PHPMailer is included via Composer and can be used for email delivery if SMTP is configured.

## Contact

For support or questions about the project, inspect the source files in `includes/` and the admin dashboard for custom configuration details.
