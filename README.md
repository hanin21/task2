# Task 2 – Data Entry App with PHP & MySQL

## 📌 Description:
Simple web app using PHP and MySQL to enter, store, and display user data (name + age).  
Includes status toggle (0 ↔ 1) and delete functionality.

---

## 💻 Tools Used:
- PHP / MySQL  
- HTML / CSS  
- XAMPP (Apache + MySQL)  
- phpMyAdmin

---

## 🚀 How to Run:

1. Copy project to:
C:\xampp\htdocs\task2-hanin

2. Start Apache & MySQL in XAMPP

3. Go to:
http://localhost/phpmyadmin

4. Create database:
task2_db

5. Create table `users` with:

| Column | Type    | Length | PK | A_I |
|--------|---------|--------|----|-----|
| id     | INT     |        | ✅ | ✅  |
| name   | VARCHAR | 100    |    |     |
| age    | INT     |        |    |     |
| status | TINYINT |        |    |     |

6. Open in browser:
http://localhost/task2-hanin
