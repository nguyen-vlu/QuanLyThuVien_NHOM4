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
        // Kiểm tra email đã tồn tại chưa
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    if($stmt->rowCount() > 0){
        $message = "Email đã được đăng ký!";
    } else {
        // Thêm user mới
        $stmt = $conn->prepare("INSERT INTO users (ho_ten, msv, ngay_sinh, dia_chi, email, mat_khau) 
                                VALUES (:ho_ten, :msv, :ngay_sinh, :dia_chi, :email, :mat_khau)");
        $stmt->execute([
            'ho_ten'=>$ho_ten,
            'msv'=>$msv,
            'ngay_sinh'=>$ngay_sinh,
            'dia_chi'=>$dia_chi,
            'email'=>$email,
            'mat_khau'=>$mat_khau
        ]);
        $message = "Đăng ký thành công! <a href='login.php'>Đăng nhập ngay</a>";
    }
}
?>


