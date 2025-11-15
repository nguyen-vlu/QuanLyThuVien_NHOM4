<?php
// QuanTriVien.php
require_once 'config.php';
$user = current_user();
if (!$user || !$user['is_admin']) {
    header('Location: login.php');
    exit;
}
$categories = $pdo->query("SELECT * FROM categories ORDER BY name")->fetchAll();
$messages = [];
$errors = [];


