<?php
require 'config.php';

$message = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $ho_ten = $_POST['ho_ten'];
    $msv = $_POST['msv'];
    $ngay_sinh = $_POST['ngay_sinh'];
    $dia_chi = $_POST['dia_chi'];
    $email = $_POST['email'];
    $mat_khau = password_hash($_POST['mat_khau'], PASSWORD_DEFAULT); // mã hóa mật khẩu
