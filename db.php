<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$dsn = 'mysql:dbname=memo_app_db;host=localhost;charset=utf8mb4';
$user = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
    ]);
} catch (PDOException $e) {
    exit('DB接続エラー: ' . $e->getMessage());
}

/* --- users テーブル --- */
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(64) UNIQUE,
    password CHAR(255)
)";
$pdo->query($sql);

/* --- memos テーブル（user_id付き）--- */
$sql = "CREATE TABLE IF NOT EXISTS memos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    content TEXT,
    created_at DATETIME,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id)
)";
$pdo->query($sql);