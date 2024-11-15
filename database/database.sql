create database agenda;

use agenda;

CREATE TABLE users(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(500) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    gender INT NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(255) NOT NULL DEFAULT("alumno"),
    created_at DATETIME NOT NULL DEFAULT NOW()
);

CREATE TABLE agenda (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    `date` DATETIME NOT NULL,
    `type` VARCHAR(64) NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `description` VARCHAR(255) NULL,
    FOREIGN KEY (user_id) REFERENCES users (id)
);