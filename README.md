# 📚 SecondBook

> **A modern Laravel-based online marketplace for buying and selling books.**

SecondBook is a full-featured online book marketplace designed to connect **book buyers and approved sellers** in one platform.

The project combines a customer-facing bookstore, seller marketplace, and comprehensive administration panel into a single Laravel application.

Users can discover books, search and filter the catalog, manage wishlists and shopping carts, place orders, track their purchases, and leave reviews. Approved sellers can manage their own stores, books, orders, and sales, while administrators can control the entire platform through a dedicated admin panel.

---

## ✨ Features

### 🛍️ Customer Marketplace

* Browse available books
* Search books by title and available information
* Filter books by condition
* Sort book listings
* Browse books by categories
* Browse books by authors
* View detailed book information
* View book condition and availability
* Add books to wishlist
* Remove books from wishlist
* Add books to shopping cart
* Update cart quantities
* Remove items from cart
* AJAX-based cart interactions
* Dynamic cart item count
* Checkout system
* Shipping information
* Estimated delivery information
* Order creation
* Order history
* Order details
* Order status information
* Buyer reviews
* Review management
* Contact system
* User profile
* Edit Profile
* Account Settings
* Password management
* Password reset with OTP verification
* Six-digit OTP verification
* User notifications
* Responsive frontend interface

---

# 🏪 Seller Marketplace

SecondBook uses a dedicated seller architecture instead of allowing every registered user to sell books.

Normal users can apply to become sellers. After administrative approval, the user's account can become a seller account and receive an associated store.

### Seller Application

* Become a Seller page
* Seller application form
* Application submission
* Application status
* Admin application management
* Admin approval
* Admin rejection
* Seller role transition after approval
* Store creation for approved sellers

### Seller Panel

Approved sellers have access to a dedicated seller panel.

Seller features include:

* Seller dashboard
* Store management
* Store information
* Store settings
* Seller profile information
* Book management
* Create books
* Edit books
* Delete books
* Manage book stock
* Manage book prices
* Manage book conditions
* Seller-specific book listings
* Seller order management
* Order details
* Order processing
* Order notes
* Processing deadlines
* Sales overview
* Seller reviews

The seller panel is separated from the administrator panel to keep seller functionality and platform administration independent.

---

# 👤 User Roles

SecondBook currently uses three main user roles:

| Role     | Description                     |
| -------- | ------------------------------- |
| `admin`  | Full platform administration    |
| `user`   | Customer / buyer account        |
| `seller` | Approved seller / store account |

### User

A regular user can:

* Browse books
* Search and filter books
* Browse categories and authors
* Manage wishlist
* Manage cart
* Checkout
* Place orders
* View order history
* View order details
* Review eligible purchases
* Manage profile
* Manage account settings
* Change password
* Apply to become a seller

Regular users **cannot directly create or sell books**. Selling functionality becomes available through the seller application and approval process.

### Seller

A seller is an approved store account that can:

* Manage their store
* Manage store settings
* Add books
* Edit books
* Delete books
* Manage inventory
* Manage prices
* Manage book conditions
* Manage seller orders
* Process orders
* Add order notes
* View sales information
* Receive buyer reviews

### Admin

Administrators have access to the platform management system and can manage users, sellers, books, orders, reviews, content, settings, reports, permissions and other administrative functionality.

---

# ⭐ Buyer Review System

SecondBook includes a buyer review system that connects reviews with the platform's users, books and orders.

The review architecture allows the platform to associate:

```text
User
  │
  └── Review
        │
        ├── Book
        └── Order
```

This makes it possible to maintain a relationship between the buyer, purchased book and corresponding order.

Review functionality includes:

* Buyer reviews
* Review creation
* Review management
* Book-review relationships
* User-review relationships
* Order-review relationships
* Admin review management
* Review detail page

---

# 📚 Book Marketplace

Books are the core marketplace entity.

A book can contain information such as:

* Title
* ISBN
* Description
* Cover
* Publication year
* Number of pages
* Language
* Price
* Stock
* Condition
* Status
* Category
* Author
* Publisher
* Seller

### Book Conditions

SecondBook supports multiple book conditions:

* `new`
* `like_new`
* `good`
* `fair`

### Book Status

Books can have administrative statuses such as:

* `pending`
* `approved`
* `rejected`

### Seller Relationship

Books can be associated with their seller through:

```text
Book
 └── seller_id
       └── User
```

This allows the marketplace to identify which seller owns and manages a particular book.

---

# 🛒 Cart & Checkout

SecondBook includes a complete shopping flow:

```text
Book
 ↓
Add to Cart
 ↓
Cart
 ↓
Checkout
 ↓
Shipping Information
 ↓
Payment
 ↓
Order
 ↓
Order Processing
 ↓
Delivery
```

The frontend cart uses AJAX interactions to provide a smoother shopping experience without requiring a full page reload for common cart operations.

The header cart count can also be updated dynamically after successful cart actions.

---

# 🚚 Shipping

The project includes configurable shipping functionality.

Shipping-related functionality includes:

* Shipping settings
* Delivery information
* Order shipping fields
* Estimated delivery message
* Shipping configuration
* Checkout shipping information

The estimated delivery message can be configured through the application's shipping settings.

For example:

```text
3-5 business days
```

The delivery message is handled as shipping information and is kept separate from checkout fields such as the country input.

---

# 💳 Payments

SecondBook supports multiple payment method options:

* Cash on Delivery
* Credit Card
* Debit Card
* PayPal

Payment records can contain information such as:

* Transaction ID
* Order ID
* Amount
* Payment method
* Payment status
* Paid date
* Notes

---

# 📦 Orders

The order system connects customers, books, sellers, payments and shipping information.

Order functionality includes:

* Order creation
* Order listing
* Customer order history
* Order details
* Order status
* Payment information
* Shipping information
* Seller order management
* Order processing
* Processing deadline
* Order notes
* Refund-related functionality

The seller order flow is designed around seller-owned books and seller-specific order management.

---

# ❤️ Wishlist

Users can maintain a personal wishlist.

Wishlist functionality includes:

* Add book to wishlist
* Remove book from wishlist
* Wishlist state handling
* AJAX wishlist interactions
* Wishlist database relationships

---

# 🔐 Authentication & Account Management

SecondBook includes a dedicated authentication and account management system.

### Authentication

* User registration
* User login
* Logout
* Remember me
* Account status handling
* Registration settings
* Password management
* Password reset
* OTP-based password recovery
* Six-digit OTP verification
* OTP resend flow
* Password visibility controls

The authentication interface has been redesigned around a unified premium SecondBook visual system.

The authentication pages include dedicated interfaces for:

* Login
* Registration
* Password Reset
* Password Verification

### Password Recovery

The password recovery process follows this flow:

```text
Enter Email
     ↓
Generate 6-Digit OTP
     ↓
Store OTP
     ↓
Send OTP by Email
     ↓
Verify OTP
     ↓
Create New Password
```

Password reset OTP information is stored in the `password_otps` database table.

OTP records contain:

* Email
* Six-digit OTP code
* Expiration time
* Created timestamp
* Updated timestamp

OTP codes are generated with an expiration period and are used during the password verification process.

### Password Requirements

The account password change system currently requires:

* Minimum 8 characters
* At least one lowercase letter
* At least one number
* Password confirmation
* New password must differ from the current password
* Maximum 128 characters

Uppercase characters and special characters are **not required**.

Password changes are handled through an AJAX-based interface without requiring a full page refresh.

---

# 👤 Account Management

Users have access to a dedicated account area.

Account functionality includes:

* My Profile
* Edit Profile
* Account Settings
* Password Change
* Password Requirements
* Notifications
* Orders
* Wishlist
* Reviews
* Seller Application

The profile and account-related interfaces use dedicated frontend styling and responsive layouts.

---

# 🛡️ Authorization & Permissions

The application separates access between different types of users.

The platform uses:

* Authentication middleware
* Admin middleware
* Seller middleware
* Role-based access control
* Permission-based admin access

Seller middleware helps prevent normal users from accessing seller-specific functionality.

The admin area also uses permission-based authorization for protected administrative modules.

The application therefore separates the main access layers:

```text
Customer
   │
   └── Frontend

Seller
   │
   └── Seller Panel

Admin
   │
   └── Admin Panel
```

---

# 🖥️ Admin Panel

SecondBook includes a dedicated administration interface for managing the platform.

The admin panel is separated from both the customer-facing marketplace and seller panel.

### Admin Modules

The current admin architecture includes modules for:

* Dashboard
* Books
* Categories
* Authors
* Publishers
* Book Conditions
* Book Requests
* Orders
* Payments
* Coupons
* Shipping
* Refunds
* Users
* Sellers
* Seller Applications
* Roles
* Reviews
* Messages
* Banners
* Blogs
* FAQ
* Reports
* Analytics
* Settings
* Email Settings
* Notifications
* Activity Logs
* Backup

---

# 📊 Admin Dashboard & Analytics

The administration dashboard provides platform-level information and management tools.

Dashboard information includes statistics and recent platform activity such as:

* Total books
* Total users
* Total categories
* Total authors
* Recent books
* Recent users
* Recent categories
* Order statistics
* Revenue information
* Monthly overview

The dashboard also includes chart-based data visualization.

Analytics and reporting functionality covers areas such as:

* Books
* Orders
* Users
* Sales

The administration system also contains dedicated report interfaces for platform data analysis.

---

# 🎨 Admin UI

The admin panel uses a modern dashboard-oriented interface focused on clear information hierarchy and responsive administration workflows.

The admin interface uses:

* Bootstrap 5.3
* Bootstrap Icons
* Plus Jakarta Sans
* Chart.js
* SweetAlert2
* Custom CSS architecture
* Responsive layouts
* Light theme
* Dark theme

The administration interface uses a dedicated admin visual system rather than sharing the customer-facing marketplace styling.

---

# 🌙 Admin Dark Mode

SecondBook's **dark mode is available only in the Admin Panel**.

The customer-facing frontend does not currently provide a general dark-mode switch.

The admin theme state is stored using:

```text
admin_theme
```

The interface uses:

```html
data-theme="dark"
```

for dark theme activation.

The admin dark theme is designed to cover the major administrative UI components, including:

* Dashboard elements
* Cards
* Tables
* Pagination
* Badges
* Filters
* Select controls
* Form inputs
* Alerts
* Modals
* Notifications
* Interactive components

The selected admin theme is preserved using browser storage.

---

# 📝 Content Management

SecondBook includes several content-management areas inside the admin panel.

### Banners

Administrators can manage promotional and informational banners.

### Blogs

Administrators can manage blog content and related information.

### FAQ

Frequently asked questions can be managed through the administration system.

### Messages

The messaging system includes:

* User messages
* Message management
* Message replies
* Administrative responses

---

# 🔔 Notifications

SecondBook includes notification functionality within the application.

The admin panel provides notification management functionality, including notification types and administrative controls.

The notification interface supports different notification categories such as:

* General
* Promotion

---

# 📝 Activity Logs

SecondBook includes an administrative activity logging system.

Activity logs are designed to record important administrative operations such as:

* Created records
* Updated records
* Deleted records
* Status changes

Activity logging has been integrated into important administrative areas, including:

* Users
* Books
* Categories
* Authors
* Publishers
* Orders
* Payments
* Coupons
* Sellers
* Reviews
* Seller Applications

This provides an audit trail for important administrative changes.

---

# 🎟️ Coupons

The marketplace includes coupon functionality for promotional discounts.

Administrators can manage:

* Coupon codes
* Coupon status
* Discount configuration
* Coupon availability
* Coupon-related order processing

---

# 💾 Backup

The administration system includes backup functionality as part of the platform management tools.

Backup operations are intended to help administrators manage application data backups during development and administration.

---

# 🗄️ Database & Seeders

SecondBook uses Laravel migrations and seeders to build and populate the application database.

The development database seeding process includes data for major marketplace areas such as:

* Roles and permissions
* Users
* Categories
* Publishers
* Authors
* Books
* Stores
* Seller books
* Seller orders

The main database seeding process is coordinated through:

```text
DatabaseSeeder
```

The seeders are executed in an appropriate order so that required relationships and dependent records can be created correctly.

The application database is built using Laravel migrations covering marketplace, seller, buyer, authentication, order, review, settings and administrative functionality.

---

# 🏗️ Application Architecture

SecondBook follows Laravel's MVC architecture and separates customer, seller and administrative functionality.

```text
SecondBook
│
├── app
│   ├── Http
│   │   ├── Controllers
│   │   │   ├── Admin
│   │   │   ├── Auth
│   │   │   ├── Frontend
│   │   │   └── Seller
│   │   │
│   │   └── Middleware
│   │
│   ├── Models
│   │
│   └── Services
│
├── database
│   ├── migrations
│   └── seeders
│
├── public
│   ├── admin
│   └── frontend
│
├── resources
│   └── views
│       ├── Admin
│       ├── Auth
│       ├── Frontend
│       ├── Layout
│       └── Seller
│
├── routes
│
└── README.md
```

---

# 🎨 Frontend CSS Architecture

Page-specific frontend styling is organized under:

```text
public/frontend/css/
```

The project uses dedicated stylesheets for major frontend interfaces, including:

```text
account-settings.css
auth-login.css
auth-register.css
auth-password-reset.css
auth-password-verify.css
cart.css
checkout.css
edit-profile.css
faq.css
help-center.css
notifications.css
order-details.css
order-tracking.css
orders.css
payment.css
privacy-policy.css
profile.css
return-policy.css
review.css
seller-application.css
shipping-information.css
wishlist.css
```

This page-specific CSS structure helps keep frontend styling modular and maintainable.

Legacy shared authentication styling and obsolete frontend files have also been removed as part of the frontend cleanup.

---

# 🔗 Main Relationships

SecondBook contains several important Eloquent relationships.

### User

A user can be related to:

* Orders
* Books as seller
* Reviews
* Wishlist items
* Seller application
* Store
* User settings
* Notifications

### Book

A book can belong to:

* Category
* Author
* Publisher
* Seller

A book can also have relationships with:

* Reviews
* Orders
* Wishlist items

### Store

A store belongs to an approved seller.

```text
User
 │
 └── Store
```

### Seller Application

A seller application connects a customer with the seller approval workflow.

```text
User
 │
 └── SellerApplication
```

### Review

A review connects the buyer with the relevant book and order.

```text
User
 │
 └── Review
       ├── Book
       └── Order
```

---

# 🔄 Marketplace Workflows

## Buyer Workflow

```text
Browse Books
     ↓
Book Details
     ↓
Wishlist / Cart
     ↓
Checkout
     ↓
Shipping Information
     ↓
Payment
     ↓
Order
     ↓
Order Processing
     ↓
Delivery
     ↓
Review
```

## Seller Workflow

```text
Register
     ↓
Become a Seller
     ↓
Submit Application
     ↓
Admin Review
     ↓
Approval
     ↓
Seller Account
     ↓
Store
     ↓
Add Books
     ↓
Receive Orders
     ↓
Process Orders
     ↓
Sales
```

## Admin Workflow

```text
Admin Login
     ↓
Dashboard
     ↓
Platform Management
     ↓
Users & Sellers
     ↓
Seller Applications
     ↓
Books & Orders
     ↓
Payments
     ↓
Reviews
     ↓
Reports & Analytics
     ↓
Activity Logs
     ↓
System Settings
```

---

# ⚙️ Technologies

SecondBook is built with the following technologies:

### Backend

* PHP
* Laravel
* Laravel Eloquent ORM
* Laravel Middleware
* Laravel Blade
* Laravel Validation
* Laravel Sessions
* Laravel Mail

### Frontend

* HTML5
* CSS3
* JavaScript
* Bootstrap 5.3
* Bootstrap Icons
* AJAX / Fetch API

### UI & Visualization

* Chart.js
* SweetAlert2
* Custom responsive CSS

### Database

* MySQL

### Development Environment

* Laragon
* Git
* GitHub
* Visual Studio Code
* Composer

---

# 🚀 Installation

## 1. Clone the repository

```bash
git clone https://github.com/ElmirVelizade2006/SecondBook.git
```

## 2. Enter the project directory

```bash
cd SecondBook
```

## 3. Install PHP dependencies

```bash
composer install
```

## 4. Create the environment file

```bash
cp .env.example .env
```

On Windows PowerShell:

```powershell
Copy-Item .env.example .env
```

## 5. Generate the application key

```bash
php artisan key:generate
```

## 6. Configure the database

Update the `.env` file according to your local MySQL configuration:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=secondbook
DB_USERNAME=root
DB_PASSWORD=
```

Adjust the database credentials according to your local environment.

## 7. Run migrations

```bash
php artisan migrate
```

## 8. Seed the database

```bash
php artisan db:seed
```

For a fresh development database:

```bash
php artisan migrate:fresh --seed
```

## 9. Create the storage link

```bash
php artisan storage:link
```

## 10. Start the development server

```bash
php artisan serve
```

---

# 🧪 Development Commands

Useful Laravel development commands include:

### List routes

```bash
php artisan route:list
```

### Check migration status

```bash
php artisan migrate:status
```

### Seed the database

```bash
php artisan db:seed
```

### Clear application caches

```bash
php artisan optimize:clear
```

### Create storage link

```bash
php artisan storage:link
```

---

# 🔄 Database Reset

For a completely fresh development database:

```bash
php artisan migrate:fresh --seed
```

> ⚠️ **Warning:** This command deletes existing database tables and recreates them.

---

# 📱 Responsive Design

The application is designed to work across different screen sizes.

Responsive interfaces are provided for:

* Desktop
* Laptop
* Tablet
* Mobile

Responsive styling is implemented throughout:

* Customer marketplace
* Authentication pages
* Account pages
* Seller panel
* Admin panel

The project uses page-specific responsive CSS to maintain consistent layouts across different viewport sizes.

---

# 🔒 Security

SecondBook uses Laravel's built-in security mechanisms together with application-level authorization.

Important security areas include:

* Authentication
* CSRF protection
* Middleware
* Role-based authorization
* Permission-based authorization
* Seller authorization
* Request validation
* Protected administrative routes
* Session-based authentication

Sensitive environment configuration should remain inside `.env` and should never be committed to the repository.

---

# 🎯 Project Goals

SecondBook was developed with several goals in mind:

* Create a complete online book marketplace
* Support both buyers and approved sellers
* Provide independent seller stores
* Provide centralized platform administration
* Build a practical Laravel marketplace architecture
* Implement real-world shopping and order workflows
* Connect buyers, sellers and books through meaningful relationships
* Build a structured MVC-based codebase
* Maintain separated customer, seller and admin experiences
* Create a responsive and modern user interface
* Practice real-world Laravel application development

---

# 🔮 Future Improvements

Potential future improvements include:

* Advanced marketplace search
* More detailed seller analytics
* Improved recommendation system
* Additional payment integrations
* Advanced inventory management
* More detailed reporting
* Automated email notifications
* API expansion
* Automated testing
* CI/CD integration
* Performance optimization
* Production deployment improvements
* Additional marketplace features

---

# 🌱 Project Status

SecondBook is an actively developed Laravel marketplace project.

The core platform currently includes:

```text
Customer Marketplace
        │
        ├── Books
        ├── Categories
        ├── Authors
        ├── Wishlist
        ├── Cart
        ├── Checkout
        ├── Orders
        └── Reviews
                │
                ▼
        Seller Marketplace
                │
                ├── Applications
                ├── Stores
                ├── Books
                ├── Orders
                └── Sales
                        │
                        ▼
                  Admin Panel
                        │
                        ├── Users
                        ├── Sellers
                        ├── Books
                        ├── Orders
                        ├── Payments
                        ├── Reviews
                        ├── Reports
                        ├── Analytics
                        ├── Activity Logs
                        └── Settings
```

---

# 👨‍💻 Developer

**Elmir Velizade**

PHP • Laravel • JavaScript • Web Development

SecondBook is developed as a full-stack Laravel marketplace project with a focus on:

* Backend architecture
* Database design
* Eloquent relationships
* Authentication
* Authorization
* Marketplace workflows
* Seller systems
* Admin management
* Frontend UI/UX
* Responsive web development

---

# 📄 License

This project is currently intended as a personal and portfolio development project.

---

<div align="center">

## 📚 SecondBook

### Give every book a second life.

**Built with ❤️ using Laravel.**

</div>
