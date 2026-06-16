-- ====================================================================
-- MASTER DATABASE SCHEMA SCRIPT FOR BIT3208 WEEK 6 CRUD DELIVERABLES
-- ====================================================================

CREATE DATABASE IF NOT EXISTS studentdb;
USE studentdb;

-- 1. Practical Task 1: Student Records Table Structure
CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    course VARCHAR(50) NOT NULL
);

-- 2. Practical Task 2: Library Inventory Table Structure
CREATE TABLE IF NOT EXISTS books (
    book_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    author VARCHAR(100) NOT NULL,
    category VARCHAR(50) NOT NULL
);

-- 3. Practical Task 3: Employee Management & System Security Tables
CREATE TABLE IF NOT EXISTS system_users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS employees (
    emp_id INT AUTO_INCREMENT PRIMARY KEY,
    emp_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    department VARCHAR(50) NOT NULL
);

-- Insert a default system administrative user profile entry
INSERT IGNORE INTO system_users (username, password) 
VALUES ('admin', '$2y$10$W1qB7r7ZtL1wT7O7K7o8eO5A8q/eT77WbKz7S99X4E0e6LqP3g6W2');