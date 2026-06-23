# Week 7: User Authentication & Session Management Module

## Project Overview
This module contains the authentication architecture integrated into our core E-Commerce application. It enforces production security standards using MySQLi prepared statements to prevent SQL Injection exploits, secure password hashing algorithms via `password_hash()`, and structured access authorization checkpoints using native PHP variable sessions.

## File Directory Map
```text
week7/
│
├── register.php   # Customer signup platform logic handling password_hash encryption routines
├── login.php      # Sign-in security handler matching strings via password_verify filters
├── dashboard.php  # Protected application landing layout evaluating explicit session blocks
└── logout.php     # Session variable clearing interface shifting locations back to login