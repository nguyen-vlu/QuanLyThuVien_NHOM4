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
?>
<!DOCTYPE html>
<html lang="vi"><head><meta charset="utf-8"><title>Đăng ký</title></head>
<body>

<p style="color:green;"><?= $message ?></p>
<form method="POST" action="">
    <img src="Logo_VLU.png" alt="LogoVLU">
    <h2>Đăng ký tài khoản</h2>
    Họ và tên: <input type="text" name="ho_ten" required><br>
    Mã số sinh viên: <input type="text" name="msv"><br>
    Ngày sinh: <input type="date" name="ngay_sinh"><br>
    Địa chỉ: <input type="text" name="dia_chi"><br>
    Email: <input type="email" name="email" required><br>
    Mật khẩu: <input type="password" name="mat_khau" required><br>
    <button type="submit">Đăng ký</button>
    <a href="login.php">Bạn đã có tài khoản? Đăng nhập</a>
</form>
<style>
    body {margin: 0; padding: 0; height: 100vh; display: flex; justify-content: center; align-items: center; background: #f2f2f2; font-family: Arial, sans-serif;}

    form {background: white;padding: 25px 35px;border-radius: 12px;box-shadow: 0 4px 15px rgba(0,0,0,0.15);width: 350px;}

    h2 {text-align: center;margin-bottom: 20px;}

    input {width: 100%;padding: 10px;margin: 8px 0 15px 0;border: 1px solid #ccc;border-radius: 6px; font-size: 15px;}

    button {width: 100%;padding: 10px;background: #c8102e;border: none;color: white;border-radius: 6px;cursor: pointer;font-size: 16px;}

    button:hover {background: #0056b3;}

    a {display: block;text-align: center;margin-top: 12px;text-decoration: none;color: #c8102e;}

    a:hover {text-decoration: underline;}

    p {color: red;text-align: center;}

    img{height:40px;width:160px;margin-right:100px;margin-left:100px}
</style>
</body>
</html>






