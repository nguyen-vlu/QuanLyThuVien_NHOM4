<?php
require_once 'config.php';
include 'header.php';
?>
<div class="main" style="display:flex;gap:20px">
  <div class="left">
    <div class="left-box">
      <h3>PHIẾU MƯỢN</h3>
      <p>Gửi thông tin mượn sách-hệ thống hiện chỉ ghi nhận ở client (có thể mở rộng lưu DB</p>
    </div>
  </div>

  <div class="right_PhieuMuon">
    <div class="box_PhieuMuon">
      <h2>PHIẾU MƯỢN SÁCH</h2>
      <form method="post" action ="process_phieumuon.php">
        <label><strong>Họ Và Tên</strong></label><br>
        <input type ="text" name="fullname"><br>

        <label><strong>Mã Số Sinh Viên</strong></label><br>
        <input type="text" name="student_id"><br><br>

        <lable><strong>Địa Chỉ</strong></lable><br>
        <input type="text" name="address"><br><br>

        <lable><strong>Email</strong></lable><br>
        <input type="email" name="email"><br><br>

        <lable><strong>Tên sách cần mượn</strong></lable><br>
        <input type="text" name="book_title"><br><br>

        <lable><strong>Thời gian mượn</strong></lable><br>
        <input type="date" name="start_date"><br><br>

        <lable><strong>Thời gian trả</strong></lable><br>
        <input type="date" name="end_date"><br><br>

        <button type="submit"><strong>Hoàn Tất</strong></button>
      </form>
    </div>
  </div>
</div>
<?php include 'footer.php'; ?>
