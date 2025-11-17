<?php
// header.php
require_once 'config.php';
$user = current_user();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Thư Viện VLU</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="header">
  <div class="header-left">
    <img scr="Logo_VLU.png" alt=""Logo Văn Lang" class="logo">
  </div>
  <div class="title">THƯ VIỆN TRƯỜNG ĐẠI HỌC VĂN LANG</div>
  <div class="header-right">
    <?php if (!$user): ?>
      <a class ="btn" href ="login.php">ĐĂNG NHẬP</a>
      <a class ="btn" href ="register.php">ĐĂNG KÝ</a>
    <?php else: ?>
      <?php endif; ?>
  </div>
</div>

<nav class="menu">
  <a href="index.php">TRANG CHỦ</a>
  <a href="GioiThieu.php">GIỚI THIỆU</a>
  <a href="ThuVien.php">THƯ VIỆN</a>
  <a href="PhieuMuon.php">PHIẾU MƯỢN</a>
  <?php if ($user && $user['is_admin']):?>
    <a href="QuanTriVien.php">QUẢN TRỊ VIÊN</a>
  <?php endif; ?>
  <input id="site-search" type="search" placeholder="Tìm Kiếm...">
</nav>

<div class="container">
<script scr="script.js" defer></scipt>
</body>
