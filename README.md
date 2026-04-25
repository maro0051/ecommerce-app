# 🛍️ Premium E-Commerce Platform

A fully-featured, professional e-commerce web application built with Laravel 12, SQLite, and Tailwind CSS. This platform provides a complete online shopping experience with admin dashboard, user authentication, product management, shopping cart, order processing, and real-time notifications.

## 📋 Table of Contents
- [Features](#features)
- [Technology Stack](#technology-stack)
- [System Requirements](#system-requirements)
- [Installation Guide](#installation-guide)
- [Configuration](#configuration)
- [Database Setup](#database-setup)
- [Running the Application](#running-the-application)
- [Default Credentials](#default-credentials)
- [Project Structure](#project-structure)
- [API Endpoints](#api-endpoints)
- [Features in Detail](#features-in-detail)
- [Security Features](#security-features)
- [Troubleshooting](#troubleshooting)
- [Screenshots](#screenshots)
- [License](#license)

## ✨ Features

### 👤 User Features
- ✅ User Registration & Login with Laravel Breeze
- ✅ Beautiful Dark Blue Theme with Glass Morphism Design
- ✅ Product Browsing with Search & Filter
- ✅ Product Details View with Image Gallery
- ✅ Shopping Cart Management (Add, Update, Remove)
- ✅ Secure Checkout Process
- ✅ Order History & Tracking
- ✅ User Profile Management
- ✅ Password Reset Functionality

### 👑 Admin Features
- ✅ Admin Dashboard with Statistics
- ✅ Complete Product Management (CRUD)
- ✅ Order Management with Status Updates
- ✅ Real-time Order Notifications
- ✅ Stock Management
- ✅ View All Customer Orders
- ✅ Order Status Tracking (Pending, Processing, Completed, Cancelled)

### 🔐 Security Features
- ✅ Role-Based Access Control (Admin/Customer)
- ✅ 10-Minute Inactivity Auto-Logout
- ✅ Session Management with Activity Tracking
- ✅ CSRF Protection
- ✅ XSS Prevention
- ✅ SQL Injection Prevention (Eloquent ORM)
- ✅ Password Hashing (BCrypt)

### 🎨 UI/UX Features
- ✅ Responsive Design (Mobile, Tablet, Desktop)
- ✅ Dark Blue Theme with Gradient Effects
- ✅ Glass Morphism Card Design
- ✅ Smooth Animations & Transitions
- ✅ Floating Action Buttons
- ✅ Real-time Form Validation
- ✅ Toast Notifications
- ✅ Loading Spinners
- ✅ Custom Scrollbar

### 📱 Additional Features
- ✅ REST API for Products
- ✅ Email Notifications for New Orders
- ✅ Browser Push Notifications
- ✅ Address Autocomplete (OpenStreetMap)
- ✅ Newsletter Subscription
- ✅ Contact Form
- ✅ FAQ Section
- ✅ About Us Page
- ✅ Privacy Policy & Terms Pages

## 🛠 Technology Stack

| Technology | Version | Purpose |
|------------|---------|---------|
| Laravel | 12.57.0 | Backend Framework |
| PHP | 8.4.15 | Server-side Language |
| SQLite | 3.x | Database |
| Tailwind CSS | 3.x | Styling Framework |
| Alpine.js | 3.x | Frontend Interactivity |
| jQuery | 3.x | DOM Manipulation |
| Font Awesome | 6.x | Icons |
| Google Fonts | - | Typography |
| OpenStreetMap | - | Address Autocomplete |

## 💻 System Requirements

- **PHP**: 8.2 or higher
- **Composer**: Latest version
- **Node.js**: 18.x or higher (for asset compilation)
- **NPM**: 9.x or higher
- **Web Server**: Apache/Nginx/Laravel Valet/Herd
- **Database**: SQLite (included) or MySQL/PostgreSQL
- **Storage**: Minimum 100MB free space

## 📥 Installation Guide

### Step 1: Clone the Repository

```bash
git clone https://github.com/yourusername/ecommerce-app.git
cd ecommerce-app


ecommerce-app/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── OrderController.php
│   │   │   │   └── ProductController.php
│   │   │   ├── Auth/
│   │   │   ├── CartController.php
│   │   │   ├── OrderController.php
│   │   │   ├── PageController.php
│   │   │   └── ProductController.php
│   │   ├── Middleware/
│   │   │   ├── AdminMiddleware.php
│   │   │   └── TrackUserActivity.php
│   │   └── Requests/
│   ├── Models/
│   │   ├── User.php
│   │   ├── Product.php
│   │   ├── Cart.php
│   │   ├── Order.php
│   │   └── OrderItem.php
│   ├── Notifications/
│   │   └── NewOrderNotification.php
│   └── Helpers/
│       └── SessionHelper.php
├── database/
│   ├── migrations/
│   ├── seeders/
│   └── database.sqlite
├── resources/
│   └── views/
│       ├── layouts/
│       │   ├── app.blade.php
│       │   └── navigation.blade.php
│       ├── auth/
│       │   ├── login.blade.php
│       │   └── register.blade.php
│       ├── products/
│       │   ├── index.blade.php
│       │   └── show.blade.php
│       ├── cart/
│       │   └── index.blade.php
│       ├── orders/
│       │   ├── index.blade.php
│       │   └── show.blade.php
│       ├── admin/
│       │   ├── dashboard.blade.php
│       │   ├── products/
│       │   └── orders/
│       ├── pages/
│       │   ├── about.blade.php
│       │   ├── contact.blade.php
│       │   ├── help.blade.php
│       │   ├── privacy.blade.php
│       │   └── terms.blade.php
│       └── components/
│           ├── auth-modal.blade.php
│           ├── admin-notifications.blade.php
│           └── address-autocomplete.blade.php
├── routes/
│   ├── web.php
│   └── api.php
├── public/
│   └── storage/
├── .env
├── composer.json
├── package.json
└── README.md
