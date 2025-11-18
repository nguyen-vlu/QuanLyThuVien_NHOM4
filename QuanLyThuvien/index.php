<?php
require_once 'config.php';
include 'header.php';

$stmt = $pdo->query("SELECT b.*, c.name as cat FROM books b LEFT JOIN categories c ON b.category_id=c.id ORDER BY b.created_at DESC LIMIT 4");
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="main" style="display:flex;gap:20px">
  <div class="left">
    <div class="left-box">
      <h3>DANH MỤC THƯ VIỆN</h3>
      <ul>
        <li><a href="ThuVien.php">Các Loại Sách</a></li>
        <li><a href="ThuVien.php">Thể Loại</a></li>
        <li><a href="ThuVien.php">Tra Cứu Tài Liệu</a></li>
        <li><a href="QuanTriVien.php">Quản Trị Viên</a></li>
      </ul>
    </div>

    <div class="left-box">
      <h3>THỜI GIAN HOẠT ĐỘNG</h3>
      <p>Thư viện trường Đại Học Văn Lang hoạt động từ Thứ hai đến thứ bảy.</p>
      <p>- Mở cửa: 7:00</p>
      <p>- Đóng cửa: 20:00</p>
    </div>
  </div>

  <div class="right">
    <div class="box">
      <h3>MỚI NHẤT</h3>
      <?php foreach($books as $b): ?>
        <a href="ThuVien.php?q=<?= urlencode($b['title']) ?>"><?= e($b['title']) ?></a><br>
      <?php endforeach; ?>

      <div class="picture" style="margin-top:12px">
        <?php foreach($books as $b): ?>
          <?php if ($b['image_path'] && file_exists($b['image_path'])): ?>
            <img src="<?= e($b['image_path']) ?>" alt="" style="width:200px;height:140px;object-fit:cover">
          <?php else: ?>
            <div style="width:200px;height:140px;background:#f2f2f2;display:flex;align-items:center;justify-content:center">No Image</div>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>



