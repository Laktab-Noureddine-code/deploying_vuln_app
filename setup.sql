-- =============================================
-- Student Directory Hub - Database Setup Script
-- FOR EDUCATIONAL USE ONLY
-- =============================================

CREATE DATABASE IF NOT EXISTS zap_demo;

USE zap_demo;

DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    student_major VARCHAR(100) NOT NULL
);

-- Insert dummy student data
INSERT INTO
    users (
        username,
        password,
        student_major
    )
VALUES (
        'admin',
        'adminpass',
        'System Administrator'
    ),
    (
        'jdoe',
        'password123',
        'Computer Science'
    ),
    (
        'asmith',
        'letmein',
        'Cybersecurity'
    ),
    (
        'mjohnson',
        'qwerty',
        'Data Science'
    ),
    (
        'kwilson',
        'abc123',
        'Software Engineering'
    ),
    (
        'lbrown',
        'welcome1',
        'Information Technology'
    );