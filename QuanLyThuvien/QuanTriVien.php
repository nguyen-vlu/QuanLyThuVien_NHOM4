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
// xử lý thêm thể loại nhanh
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_category'])) {
    $cname = trim($_POST['category_name']);
    if ($cname) {
        $stmt = $pdo->prepare("INSERT IGNORE INTO categories (name) VALUES (?)");
        $stmt->execute([$cname]);
        $messages[] = "Đã thêm thể loại: " . htmlspecialchars($cname);
        $categories = $pdo->query("SELECT * FROM categories ORDER BY name")->fetchAll();
    }
}
// xử lý upload sách
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upload_book'])) {
    $title = trim($_POST['title'] ?? '');
    $author = trim($_POST['author'] ?? '');
    $desc = trim($_POST['description'] ?? '');
    $category_id = $_POST['category_id'] ?? null;

    if (!$title) $errors[] = "Tiêu đề sách bắt buộc.";
    // xử lý ảnh
    $img_path = null;
    if (!empty($_FILES['image']['name'])) {
        $img = $_FILES['image'];
        $ext = pathinfo($img['name'], PATHINFO_EXTENSION);
        $allowed = ['jpg','jpeg','png','gif'];
        if (!in_array(strtolower($ext), $allowed)) $errors[] = "Ảnh không hợp lệ.";
        else {

    






