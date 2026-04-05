# KariPap Delights – Order Management System

A premium, pixel-perfect landing page for **KariPap Delights** (Authentic Malaysian Curry Puffs). Built with modern web technologies to provide a fast, responsive, and high-conversion ordering experience.

## ✨ Features

- **Iconic Design**: High-end aesthetics with custom HSL-tailored colors (Cream, Orange, Dark Mode support).
- **Interactive Menu**: Animated cards using `Animate.css` and `IntersectionObserver` for scroll-triggered arrivals.
- **Micro-interactions**: Pulse animations on "Add to Cart" buttons and bounce feedback on the floating cart FAB.
- **Cart System**: 
  - Dynamic cart drawer with quantity controls (Add/Remove/Qty update).
  - Real-time price calculations (Subtotal and Total).
  - Empty cart states and clear user feedback.
- **Confirmation Flow**: Beautiful order summary modal before final processing.
- **WhatsApp Integration**: Automatically formats your order and sends it directly to the seller via WhatsApp.
- **Dark Mode**: Complete dark mode support with a smooth, glassmorphism-inspired toggle.

## 🛠️ Technology Stack

- **Framework**: Tailwind CSS (CDN)
- **Icons**: HugeIcons (Stroke Rounded)
- **Animations**: Animate.css
- **Typography**: Google Fonts (Inter)
- **Logic**: Vanilla JavaScript (State management, DOM manipulation, WhatsApp API integration)

## 🚀 Getting Started

1.  Clone the repository:
    ```bash
    git clone https://github.com/mralif93/order-management-system.git
    ```
2.  Open `index.html` in any modern web browser.
3.  **To configure the WhatsApp number**:
    - Open `index.html`.
    - Search for `const SELLER_WHATSAPP`.
    - Replace `'60123456789'` with your actual phone number (include country code, but omit `+` or spaces).

## 📱 WhatsApp Order Format

Once the user clicks "Send Order via WhatsApp", the system generates a formatted message like this:

```text
🥟 KariPap Delights – New Order
📅 05 Apr 2026  🕐 11:50 pm
─────────────────────
• Chicken Curry Puff
  1 × RM 2.50 = RM 2.50
• Beef Curry Puff
  2 × RM 3.00 = RM 6.00
─────────────────────
💰 Total: RM 8.50

Thank you! Please confirm my order. 🙏
```

## 🤝 Contributing

Contributions, issues, and feature requests are welcome!

## 📜 License

[MIT](https://choosealicense.com/licenses/mit/)
