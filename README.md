# 🪑 Kanha Furniture - Laravel E-commerce Platform

A modern, full-featured e-commerce platform built with **Laravel 10**, **TailwindCSS**, and **Alpine.js**. Inspired by professional furniture retail websites like Nilkamal.

![Laravel](https://img.shields.io/badge/Laravel-10.x-FF2D20?style=for-the-badge&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.4+-777BB4?style=for-the-badge&logo=php)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-3.x-38B2AC?style=for-the-badge&logo=tailwind-css)
![Alpine.js](https://img.shields.io/badge/Alpine.js-3.x-8BC34A?style=for-the-badge&logo=alpine.js)

## ✨ Features

### 🎪 **Hero Carousel**
- **Auto-sliding hero banner** with 3 promotional slides
- **Swiper.js integration** with smooth transitions
- **Navigation controls** and pagination dots
- **Responsive design** with overlay content

### 🔍 **Advanced Search**
- **Real-time search** with live dropdown suggestions
- **AJAX-powered** instant results with product images
- **Debounced input** (300ms) for optimal performance
- **JSON API** endpoint for search functionality

### 🎯 **Smart Sign-up Modal**
- **Auto-triggers** after 10 seconds on homepage
- **Professional design** with promotional offers
- **Alpine.js animations** and smooth transitions
- **Mobile-responsive** form layout

### 🛒 **E-commerce Core**
- **Session-based shopping cart** with persistent storage
- **Product catalog** with categories and search
- **Price management** with discount calculations
- **Responsive product grids** with hover effects

### 🎨 **Modern UI/UX**
- **TailwindCSS** for consistent styling
- **Custom animations** and hover effects
- **Professional product cards** with image zoom
- **Loading states** and smooth transitions

## 🚀 **Installation & Setup**

### **Prerequisites**
- PHP 8.1+
- Composer
- Node.js & NPM
- SQLite (default) or MySQL

### **Quick Start**
```bash
# Clone the repository
git clone https://github.com/samurai100996/kanha-furniture.git
cd kanha-furniture

# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Create database and run migrations
touch database/database.sqlite
php artisan migrate --seed

# Build frontend assets
npm run build
# OR for development
npm run dev

# Start the development server
php artisan serve
```

### **Access the Application**
- **Frontend**: http://localhost:8000
- **Admin Panel**: http://localhost:8000/admin (after login)

## 📊 **Database Schema**

### **Categories Table**
```sql
├── id (Primary Key)
├── name (varchar)
├── icon (varchar, nullable)
└── timestamps
```

### **Products Table**
```sql
├── id (Primary Key)
├── name (varchar)
├── slug (varchar, unique)
├── description (text)
├── price (decimal)
├── discount (decimal, default: 0)
├── image (varchar, nullable)
├── category_id (Foreign Key)
└── timestamps
```

## 🎯 **Key Features Implemented**

### **1. Dynamic Hero Carousel**
- Swiper.js integration with auto-play
- Multiple promotional slides
- Responsive navigation controls
- Custom overlay content

### **2. Live Search System**
```javascript
// Real-time search with Alpine.js
async search() {
    const response = await fetch(`/search?q=${this.query}`);
    const data = await response.json();
    this.results = data.products;
}
```

### **3. Session Cart Management**
```php
// Add to cart functionality
public function add(Request $request) {
    $cart = session()->get('cart', []);
    $cart[$productId] = ['quantity' => $quantity];
    session()->put('cart', $cart);
}
```

## 🛡️ **Security Features**

- **CSRF Protection** on all forms
- **Input validation** and sanitization
- **SQL injection prevention** with Eloquent ORM
- **Authentication** with Laravel Breeze

## 📱 **Responsive Design**

- **Mobile-first** approach with TailwindCSS
- **Responsive navigation** with mobile menu
- **Touch-friendly** carousel controls
- **Adaptive product grids**

## 🔄 **API Endpoints**

### **Search API**
```
GET /search?q={query}
Accept: application/json

Response:
{
    "products": [
        {
            "id": 1,
            "name": "Product Name",
            "slug": "product-slug",
            "price": "299.99",
            "category": "Category Name",
            "image": "image-url"
        }
    ]
}
```

## 📈 **Performance Optimizations**

- **Lazy loading** for product images
- **Debounced search** to reduce API calls
- **Optimized database queries** with eager loading
- **Compressed assets** with Vite build

## 📁 **Project Structure**

```
kanha-furniture/
├── app/
│   ├── Http/Controllers/     # Application controllers
│   ├── Models/              # Eloquent models
│   └── ...
├── database/
│   ├── migrations/          # Database migrations
│   └── seeders/            # Data seeders
├── resources/
│   ├── css/                # Styling files
│   ├── js/                 # JavaScript files
│   └── views/              # Blade templates
├── routes/
│   └── web.php             # Application routes
└── public/                 # Public assets
```

## 👨‍💻 **Developer**

**Saurav Shelke**
- GitHub: [@samurai100996](https://github.com/samurai100996)
- Email: sauravshelke2003@gmail.com
- Portfolio: [GitHub Profile](https://github.com/samurai100996)

## 📄 **License**

This project is open-sourced software licensed under the [MIT license](LICENSE).

---

⭐ **If you found this project helpful, please give it a star!**
