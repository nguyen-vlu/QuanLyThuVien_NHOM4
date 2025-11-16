<?php
require 'config.php';
$message = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $ho_ten = trim($_POST['ho_ten'] ?? '');
    $msv = trim($_POST['msv'] ?? '');
    $ngay_sinh = $_POST['ngay_sinh'] ?: null;
    $dia_chi = trim($_POST['dia_chi'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $mat_khau_input = $_POST['mat_khau'] ?? '';

    if (!$ho_ten || !$email || !$mat_khau_input) {
        $message = "Vui lòng điền đủ thông tin bắt buộc.";
    } else {
        // kiểm tra email
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if($stmt->rowCount() > 0){
            $message = "Email đã được đăng ký!";
        } else {
            $mat_khau = password_hash($mat_khau_input, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (ho_ten, msv, ngay_sinh, dia_chi, email, mat_khau) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$ho_ten, $msv, $ngay_sinh, $dia_chi, $email, $mat_khau]);
            $message = "Đăng ký thành công! <a href='login.php'>Đăng nhập ngay</a>";
        }
    }
}




