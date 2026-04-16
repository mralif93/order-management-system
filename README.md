# 📦 Order Management System (OMS) — Multi-Merchant Marketplace

[![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.3-777BB4?style=for-the-badge&logo=php)](https://valet.laravel.com)
[![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-3.x-38B2AC?style=for-the-badge&logo=tailwind-css)](https://tailwindcss.com)
[![HugeIcons](https://img.shields.io/badge/Icons-HugeIcons-000000?style=for-the-badge)](https://hugeicons.com)

A state-of-the-art, enterprise-grade **Multi-Merchant Order Management System**. Designed for scalability and high-performance, OMS provides a unified platform for administrators, merchants (sellers), and customers to interact seamlessly in a modern marketplace ecosystem.

---

## 🚀 Vision & Concept

The system is built to transform standalone businesses into a cohesive marketplace. Whether it's a local food stall like **KariPap Delights** or a large-scale retail distributor, OMS provides the infrastructure to manage inventory, track orders, and engage customers through dedicated portals.

---

## 🏛️ System Architecture & Portals

### 1. 🛡️ Admin Dashboard (Super Management)
The ultimate control center for marketplace administrators.
- **Merchant Management**: Approve, onboard, and manage seller profiles.
- **Global Analytics**: High-level overview of sales, orders, and customer growth.
- **Store Configuration**: Manage public-facing store settings and marketplace defaults.
- **User Management**: Oversight of all system users (Sellers & Customers).

### 2. 🏪 Seller Portal (Merchant Hub)
A powerful, intuitive dashboard for business owners.
- **Inventory Management**: Create, edit, and categorize products with rich descriptions and pricing.
- **Order Fulfillment**: Real-time order tracking, status updates, and historical logs.
- **Storefront Customization**: Manage the public LinkTree-style landing page.
- **Sales Insights**: Merchant-specific performance metrics.

### 3. 👤 Customer Portal (Buyer Experience)
A streamlined interface for a premium shopping experience.
- **Order History**: Track current and past orders with status transparency.
- **Profile Management**: Maintain personal details and preferred settings.
- **Personalized Catalog**: Browse merchants and products in a curated environment.

### 4. 🌐 Public Storefronts
LinkTree-style landing pages optimized for mobile and conversions.
- **WhatsApp Integration**: High-conversion ordering flow that directs buyers straight to the merchant's WhatsApp.
- **Interactive Menu**: Animated product cards with real-time cart state management.
- **Responsive Design**: Pixel-perfect layout across all device sizes.

---

## ✨ Premium Features

- **Multi-Guard Authentication**: Secure, independent access for Admins, Sellers, and Customers.
- **Adaptive UI**: Full support for **Light and Dark Mode** with high-contrast, professional palettes.
- **Modern Aesthetics**: Leverages **Glassmorphism**, smooth micro-animations (Animate.css), and premium rounded icons (HugeIcons).
- **WhatsApp Smart-Ordering**: Automatically formats complex orders into readable WhatsApp messages for merchants.
- **Database Integrity**: Robust relational schema with support for hierarchical roles and multi-tenant data isolation.

---

## 🛠️ Technology Stack

| Layer | Technology |
| :--- | :--- |
| **Backend** | Laravel 11 (PHP 8.3) |
| **Frontend** | Blade Templates / Vanilla JavaScript |
| **Styling** | Tailwind CSS (Configuration-driven) |
| **Icons** | HugeIcons (Stroke Rounded) |
| **Database** | PostgreSQL / MySQL |
| **Animation** | Animate.css / GSAP |

---

## ⚙️ Installation & Setup

Follow these steps to get the development environment running:

### 1. Repository Setup
```bash
git clone https://github.com/mralif93/order-management-system.git
cd order-management-system/backend
```

### 2. Environment Configuration
```bash
cp .env.example .env
# Edit .env to configure your database credentials
```

### 3. Dependencies & Migrations
```bash
composer install
php artisan key:generate
php artisan migrate --seed
```

### 4. Assets & Development Server
```bash
npm install
npm run dev
# In a separate terminal
php artisan serve
```

---

## 📋 Default Credentials (Seeded)

| Role | Email | Password |
| :--- | :--- | :--- |
| **Admin** | `admin@oms.com` | `password` |
| **Seller** | `seller@oms.com` | `password` |
| **Customer** | `customer@oms.com` | `password` |

---

## 🤝 Contributing & Support

We welcome contributions to enhance the marketplace experience! Please feel free to open issues or submit pull requests.

## 📜 License

Distributed under the MIT License. See `LICENSE` for more information.

---
<p align="center">
  Built with ❤️ for the future of Digital Marketplaces.
</p>
