# Week 6: Product Inventory CRUD Module (E-Commerce Platform)

## Project Overview
This module contains the core **Create, Read, Update, and Delete (CRUD)** inventory architecture developed for our semester E-Commerce application project. It demonstrates secure server-side communications tracking structured products, pricing configurations, and stock availability parameters within a relational database system framework.

## Project Directory Architecture
```text
week6_ecommerce/
│
├── connection.php   # Central MySQL database link wrapper
├── products.php     # Main dashboard handling item insertion and display tables (CREATE & READ)
├── edit.php         # Specialized entry script updating specific items (UPDATE)
├── delete.php       # Background processing script executing item dropped lines (DELETE)
├── schema.sql       # Structural database architecture layout file
└── README.md        # Technical execution and platform review file