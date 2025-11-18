<?php
// config.php
session_start();

// DB connection
$host = "localhost";
$user = "root";
$pass = "";
$db   = "thu_vien_vlu";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // in production you should hide detailed message
    die("Database connection error: " . $e->getMessage());
}

// helper: get current user
function current_user() {
    if (empty($_SESSION['user_id'])) return null;
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// simple escape helper
function e($s){ return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }
?>
