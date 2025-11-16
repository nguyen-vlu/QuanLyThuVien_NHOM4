<?php
require_once 'config.php';
include 'header.php';
?>
<div class="content" style="padding:40px">
<h1>Giới thiệu Thư viện Trường Đại học Văn Lang</h1>
<p><strong>Thư viện Trường Đại học Văn Lang</strong>là trung tâm tri thức và học liệu phục vụ cho sinh viên, giảng viên và cán bộ trong toàn trường. Với không gian hiện đại, thân thiện và hệ thống quản lý thông minh, thư viện góp phần quan trọng trong việc nâng cao chất lượng giảng dạy, học tập và nghiên cứu khoa học.</p>
<h2>Cơ sở vật chất</h2>
<ul>
  <li><strong>Khu đọc sách</strong>yên tĩnh, thoáng mát và được trang bị đầy đủ bàn ghế, wifi tốc độ cao.</li>
  <li><strong>Khu tự học và học nhóm</strong>giúp sinh viên dễ dàng trao đổi kiến thức và làm việc chung.</li>
  <li><strong>Khu tra cứu điện tử</strong>với hệ thống máy tính kết nối cơ sở dữ liệu học liệu trực tuyến.</li>
</ul>
<h2>Nguồn tài nguyên học thuật</h2>
<ul>
  <li>Hơn 100.000 đầu sách chuyên ngành, tài liệu tham khảo và giáo trình.</li>
  <li>Nhiều tạp chí khoa học, luận văn, đề tài nghiên cứu của giảng viên và sinh viên.</li>
  <li>Thư viện số cho phép tra cứu và đọc tài liệu online mọi lúc, mọi nơi.</li>
</ul>
</div>
<?php include 'footer.php';?>
<?php session_start();?>
<div class="header-right">
<?php if(isset($_SESSION['user_id'])):?>
  <span>Xin chào, <?php echo $_SESSION['ho_ten'];?></span>
  <a href="logout.php"><button>ĐĂNG XUẤT</button></a>
<?php else:?>
  <a href="login.php"><button>ĐĂNG NHẬP</button></a>
  <a href="register.php"><button>ĐĂNG KÝ</button></a>
<?php endif; ?>
</div>
  
