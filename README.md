# GroMart - Your Online Grocery Store

> A modern e-commerce platform built with CodeIgniter 4.6.1, providing a seamless grocery shopping experience.

## Project Overview

GroMart aims to revolutionize the way people buy groceries online. We understand the challenges of traditional grocery shopping: long queues, limited selection, and the hassle of transportation. GroMart solves these problems by offering a wide range of products, convenient delivery options, and a user-friendly interface. Our platform empowers customers to shop from the comfort of their homes, saving time and effort while gaining access to fresh, high-quality groceries. The value proposition is clear: **Convenience, Choice, and Quality – Delivered to Your Doorstep.**

## Key Features

- **Extensive Product Catalog:** Browse a wide selection of groceries, including fresh produce, pantry staples, and specialty items.
- **User-Friendly Interface:** An intuitive and responsive design for a seamless shopping experience on any device.
- **Advanced Search and Filtering:** Easily find the products you need with powerful search and filtering options.
- **Secure Payment Gateway:** Integrated with trusted payment providers for secure and hassle-free transactions.
- **Flexible Delivery Options:** Choose from a variety of delivery options to fit your schedule and location.
- **Order Tracking:** Track your order status in real-time from placement to delivery.
- **Personalized Recommendations:** Discover new products based on your past purchases and preferences.
- **Customer Support:** Dedicated customer support team ready to assist with any questions or issues.
- **Admin Dashboard**: A robust admin dashboard for managing products, orders, and customer data.

## Visual Demo

> _[Folder Screenshot]_

## Prerequisites

Before you begin, ensure you have the following installed:

- **PHP:** Version 8.1 or higher
- **Composer:** Latest version
- **Database:** MySQL 5.7+ or MariaDB 10.2+
- **Web Server:** Apache 2.4+ or Nginx 1.10+

**PHP Extensions:**

- intl
- mbstring
- json (enabled by default)
- mysqlnd (if using MySQL)
- libcurl (if using the HTTP\CURLRequest library)
- gd (for image manipulation)
- xml
- zip

## Installation

1.  **Clone the repository:**

bash / Terminal / Command Prompt

    cp env .env
    database.default.hostname = localhost
    database.default.database = gromart_db
    database.default.username = root
    database.default.password = your_db_password
    database.default.DBDriver = MySQLi

bash / Terminal / Command Prompt

    php spark migrate
    php spark db:seed DataSeeder
    php spark serve

> Open your browser and navigate to `http://localhost:8080` (or the base URL you configured).

## Configuration

GroMart offers various configuration options to customize the application to your needs.

> **Application Settings:**
>
> These settings can be found in `app/Config/App.php`.
>
> - `baseURL`: The base URL of your application.
> - `indexPage`: The index page to use (e.g., 'index.php').
> - `defaultLocale`: The default language for the application.
>
> **Database Settings:**
>
> Configure your database connection in the `.env` file or `app/Config/Database.php`.
>
> **Email Settings:**
>
> Configure your email settings in `app/Config/Email.php` to enable features like password reset and order confirmation emails. Example:
>
> ## Usage

### Basic Usage

1.  **Browse Products:** Navigate to the homepage to view the product catalog.
2.  **Add to Cart:** Click "Add to Cart" to add products to your shopping cart.
3.  **View Cart:** Click the cart icon to view your cart and proceed to checkout.
4.  **Checkout:** Follow the on-screen instructions to enter your shipping and payment information.
5.  **Place Order:** Review your order and click "Place Order" to complete your purchase.

## Security Notes

- **Input Validation:** Always validate user input to prevent SQL injection, cross-site scripting (XSS), and other security vulnerabilities.
- **Output Escaping:** Escape output to prevent XSS attacks.
- **CSRF Protection:** Enable CSRF protection to prevent cross-site request forgery attacks.
- **Password Hashing:** Use strong password hashing algorithms (e.g., bcrypt) to protect user passwords.
- **Regular Security Audits:** Conduct regular security audits to identify and address potential vulnerabilities.
- **Keep Dependencies Updated:** Stay up-to-date with the latest security patches for CodeIgniter 4 and its dependencies.
- **.env Security:** Ensure your `.env` file is not accessible from the web.

## Roadmap

- **Phase 1: Core Functionality:**
  - Implement basic product catalog and shopping cart features.
  - Integrate with a secure payment gateway.
  - Develop a user-friendly checkout process.
- **Phase 2: Advanced Features:**
  - Implement order tracking and delivery management.
  - Develop a personalized recommendation engine.
  - Add customer reviews and ratings.
- **Phase 3: Mobile App Development:**
  - Develop a native mobile app for iOS and Android.
  - Integrate with push notifications.
  - Implement offline support.
- **Phase 4: Expansion and Partnerships:**
  - Expand product categories and selection.
  - Partner with local grocery stores and suppliers.
  - Offer subscription services and loyalty programs.

## Contributing Guidelines

We welcome contributions to GroMart! Please follow these guidelines:

1.  Fork the repository.
2.  Create a new branch for your feature or bug fix.
3.  Write clear and concise commit messages.
4.  Submit a pull request with a detailed description of your changes.
5.  Adhere to the project's coding standards.

> For more detailed guidelines, please refer to the [CONTRIBUTING.md](CONTRIBUTING.md) file.

## License Information

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details.

## Contact/Support Details
