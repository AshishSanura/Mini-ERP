# Mini-ERP System (Laravel 12)

This is a Mini-ERP system built with **Laravel 12**, supporting inventory management, sales order processing, PDF invoice generation, and API integration using Laravel Passport.

## 🚀 Features

- Admin & Salesperson authentication
- Product management (CRUD)
- Sales order creation with stock management
- Sales invoice PDF export
- Dashboard summary with low-stock alerts
- RESTful API using Laravel Passport

## 🧰 Tech Stack

- Laravel 12
- MySQL
- Blade (Bootstrap/Tailwind)
- Laravel Breeze (for auth)
- Passport (for API)
- DomPDF (PDF Export)

---

## 2. Install Dependencies
composer install
npm install
npm run dev

## 3. Environment Setup
cp .env.example .env
php artisan key:generate

## 4. Configure Database
DB_DATABASE=your_database
DB_USERNAME=root
DB_PASSWORD=

## 5. API Authantication Passport Setup
php artisan passport:install
php artisan migrate

## 6.  Run Migrations and Seeders
php artisan db:seed



## ⚙️ Project Setup Instructions
### 1. Clone the Repository (After Above Step Follw)
```bash
git clone https://github.com/AshishSanura/Mini-ERP.git
cd mini-erp