<?php
session_start();
$host = "localhost";
$user = "root";
pass = "";
$db = "thu_vien_vlu";

try {
  $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user,$pass);
  $conn->setAttribute(PDO::ATTR_ERRNODE, PDO::ERRMODE_EXCEPTION);
} cath(PDOException $e){
  die("Database connection error:".$e->getMessage());
}
?>
