CREATE DATABASE IF NOT EXISTS mvc_lab07 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE mvc_lab07;
CREATE TABLE students(id INT AUTO_INCREMENT PRIMARY KEY,name VARCHAR(120) NOT NULL,email VARCHAR(160) NOT NULL,course VARCHAR(100) NOT NULL,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
INSERT INTO students(name,email,course) VALUES('Aarav Singh','aarav@example.com','MCA'),('Sara Khan','sara@example.com','BCA');
