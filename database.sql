-- MySQL setup for Tết app chat feature
-- Usage (CLI):
--   mysql -u root -p < database.sql
-- Or import via phpMyAdmin (Import -> Choose file -> database.sql)

-- Create database
CREATE DATABASE IF NOT EXISTS `tet_app`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE `tet_app`;

-- Create messages table
CREATE TABLE IF NOT EXISTS `messages` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `content` TEXT NOT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Optional: sample data (comment out if not needed)
-- INSERT INTO `messages` (`name`, `content`) VALUES
-- ('Admin', 'Chào mừng bạn đến với trang đếm ngược Tết! 🎉');


