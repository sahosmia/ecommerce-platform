# E-commerce Platform Development

A simplified, robust e-commerce application built with the **Laravel** framework adhering to modern best practices, clean architecture, and full CRUD functionality for Categories, Subcategories, and Products.

---

## Table of Contents
1. [Project Overview](#project-overview)
2. [Key Features](#key-features)
3. [Architecture & Database Design](#architecture--database-design)
4. [Setup & Installation Instructions](#setup--installation-instructions)
5. [Testing & Quality Assurance](#testing--quality-assurance)
6. [API & Dynamic Subcategories](#api--dynamic-subcategories)

---

## Project Overview

The objective of this application is to provide a complete catalog management and e-commerce browsing experience:
- **Category Management**: Full CRUD operations with automatic SEO slug generation and soft deletes.
- **Subcategory Management**: Subcategories organized under parent categories with database-level cascading integrity.
- **Product Management**: Full CRUD operations for products containing details like category, subcategory, regular price, discount calculations (percentage / fixed amount), calculated new price, and image uploads.
- **Product Catalog by Subcategories**: Home page clearly organizes and presents products grouped under their respective subcategories with quick access to view all products under each subcategory.
- **SEO-Friendly URLs**: All categories, subcategories, and products are queryable via clean, readable URL slugs.
- **Trash & Soft Deletes**: Deleted records can be inspected, restored, or permanently deleted.

---

## Key Features

### 1. Category & Subcategory Management
- Admin interface to create, read, update, soft-delete, and permanently delete categories and subcategories.
- Database uniqueness on slugs (categories: globally unique slug; subcategories: unique per parent category).
- Cascading deletion handling ensuring relational integrity.

### 2. Product Management
- Each product maintains:
  - Parent **Category** & **Subcategory** (with validation ensuring subcategory belongs to selected category).
  - **Product Name** & **Description**.
  - **Product Image** (uploaded to public storage disk with fallback placeholder).
  - **Price** (Regular / Old Price) and **Discount Management** (Percentage / Fixed discount calculating `new_price`).
  - **SEO-Friendly Slug**.

### 3. Public Web Catalog
- **Home Page (`/`)**: Displays products categorized and grouped under their respective subcategories.
- **Category Page (`/category/{slug}`)**: Lists subcategories and products belonging to the category.
- **Subcategory Page (`/subcategory/{slug}`)**: Dedicated view for items in a specific subcategory.
- **Product Details Page (`/product/{slug}`)**: Comprehensive product view with image, pricing, descriptions, and related products.

---

## Architecture & Database Design

### Relationships
- `Category` **hasMany** `Subcategory`
- `Category` **hasMany** `Product`
- `Subcategory` **belongsTo** `Category`
- `Subcategory` **hasMany** `Product`
- `Product` **belongsTo** `Category`
- `Product` **belongsTo** `Subcategory`

### Database Schema Highlights
- `categories`: `id`, `name`, `slug`, `timestamps`, `deleted_at`
- `subcategories`: `id`, `category_id` (foreign key -> `categories`), `name`, `slug`, `timestamps`, `deleted_at`
- `products`: `id`, `category_id` (foreign key), `subcategory_id` (foreign key), `name`, `slug`, `description`, `image`, `price`, `discount_type`, `discount_value`, `timestamps`, `deleted_at`

---

## Setup & Installation Instructions

Follow these steps to run the application locally:

### 1. Clone & Enter the Repository
```bash
git clone <repository-url>
cd ecommerce-platform
```

### 2. Install PHP & Node Dependencies
```bash
composer install
npm install
```

### 3. Configure Environment Variables
Copy `.env.example` to `.env`:
```bash
cp .env.example .env
```
Generate the application key:
```bash
php artisan key:generate
```

### 4. Database Setup & Migrations
The application can run with SQLite out of the box (or MySQL as configured in `.env`).

For SQLite:
```bash
touch database/database.sqlite
```
Run migrations and sample data seeders:
```bash
php artisan migrate --seed
```

### 5. Link Storage for Media Uploads
Create the symbolic link to serve product images:
```bash
php artisan storage:link
```

### 6. Build Frontend Assets & Run Development Server
Build the assets using Vite:
```bash
npm run build
```
Run the Laravel application:
```bash
php artisan serve
```
Access the application at `http://localhost:8000`.

---

## Testing & Quality Assurance

Automated tests are written using PHPUnit / Pest covering Web views and Admin CRUD operations:
- `tests/Feature/Admin/CategoryTest.php`: Tests Category listing, creation, edit, soft-delete, restore, force-delete.
- `tests/Feature/Admin/SubcategoryTest.php`: Tests Subcategory CRUD and relationships.
- `tests/Feature/Admin/ProductTest.php`: Tests Product CRUD, image uploads, soft deletes, and relational validation.
- `tests/Feature/Web/WebProductTest.php`: Tests public catalog display by subcategory and SEO slug resolution.

To run the full test suite:
```bash
php artisan test
```

---

## API & Dynamic Subcategories
When adding or editing products in the admin panel, selecting a category dynamically fetches its subcategories via AJAX:
- `GET /api/subcategories/{category_id}`: Returns JSON array of subcategories for the selected category.
