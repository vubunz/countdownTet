<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');

$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'tet_app';

$mysqli = @new mysqli($dbHost, $dbUser, $dbPass);
if ($mysqli->connect_errno) {
    http_response_code(500);
    die('DB connection failed');
}

// Create database if not exists
$mysqli->query("CREATE DATABASE IF NOT EXISTS `$dbName` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
$mysqli->select_db($dbName);

// Create table if not exists
$createTableSql = "CREATE TABLE IF NOT EXISTS messages (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    content TEXT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
$mysqli->query($createTableSql);
