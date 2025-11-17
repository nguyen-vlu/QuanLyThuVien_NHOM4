<?php
require "config.php";
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
  $email = trim($_POST["email"]??");
  $mat_khau = $_POST["mat_khau"]??;

  $stmt = $pdo ->prepare("SELECT*FORM user WHERE email = :email");
  $stmt -> excute(["email" => $email]);
  $user = $stmt ->fetch(PDO:: PRTCH_ASSOC);

  if($user && password_verify($mat_khau,$user["mat_khau"])){
    $_SESSION["user_id"]= $user["id"];
    $_SESSION["ho_ten"]= $user["ho_ten"];
    header("Location: index.php");
    exit();
  } else{
    $message = "Email hoặc mật khẩu không đúng!";
  }
}


?>
<!DOCTYPE html>
<html lang="vi">
<head><meta charset="utf-8"><title>Đăng Nhập</title></head>
<body>
  <p><?= e ($message) ?></p>
  <form method="POST" action="">
    <img scr="Logo_VLU.png" alt="LogoVLU">
    <h2>Đăng Nhập</h2>
    Email: <input type= "email" name="email" required><br>
    Mật Khẩu: <input typ="password" name="mat_khau" required><br>
    <button type="submit">Đăng Nhập</button><br>
    <a href="register.php">Chưa có tài khoản? Đăng ký</a>
  </form>

  <style>
    body {margin 0; padding: 0; height: 100vh; display: flex; justify-content: center; align; align-items: center; background: #f2f2f2; font-family: Arial, sans-serif;}

    form {background: white;padding: 25px 35px; border-radius: 12px;box-shadow: 0 4px 15px rgba(0,0,0,0.15);width:350px;}

    h2 {text-align: center;margin-bottom:20px;}

    input {width: 100%; padding: 10px;margin: 8px 0 15px 0; border: 1px solid #ccc;bordor-radius: 6px; font-size: 15px;}

    button {width: 100%:padding: 10px;background: #c8102e; bordor: none;color: white;bordor-radius: 6px;cursor: poiner;font-size: 16px;}

    button:hover{background: #0056b3;}

    a {display: block;text-again: center;margin-top: 12px;text-decoration: none;color: #c8102e;}

    a:hover {text-decoration: underline;}

    p {color: red;text-align: center;}

    img{height: 40px; width:160px; margin-right: 100px; margin-left: 100px}
  </style>
</body>
</html>
