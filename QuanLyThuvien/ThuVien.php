<?php
require_once 'config.php';

$q = trim($_GET['q'] ?? '');
$cat = intval($_GET['cat'] ?? 0);

// categories
$categories = $pdo->query("SELECT * FROM categories ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);

// query books
$sql = "SELECT b.*, c.name AS category_name 
        FROM books b 
        LEFT JOIN categories c ON b.category_id = c.id 
        WHERE 1=1";
$params = [];

if ($q) {
    $sql .= " AND (b.title LIKE ? OR b.author LIKE ? OR b.description LIKE ?)";
    $like = "%$q%";
    $params[] = $like; 
    $params[] = $like; 
    $params[] = $like;
}

if ($cat) {
    $sql .= " AND b.category_id = ?";
    $params[] = $cat;
}

// CHỈ SỬ DỤNG created_at NẾU CÓ TRONG DATABASE
$sql .= " ORDER BY b.id DESC LIMIT 200";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);

include 'header.php';
?>
<div class="main" style="display:flex; gap:20px;">
  <aside class="left">
    <div class="left-box">
      <h3>DANH MỤC THƯ VIỆN</h3>
      <ul>
        <li><a href="ThuVien.php">Tất cả sách</a></li>
        <?php foreach($categories as $c): ?>
          <li><a href="ThuVien.php?cat=<?= $c['id'] ?>"><?= e($c['name']) ?></a></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </aside>

  <section class="right">
    <div class="box">
      <h3>Kết quả tìm kiếm: <?= $q ? e($q) : 'Tất cả sách' ?></h3>

      <?php if (!$books): ?>
        <p>Không có sách phù hợp.</p>
      <?php else: ?>
        <div class="picture">
          <?php foreach($books as $b): ?>
            <div style="width:300px;border:1px solid #eee;padding:8px;">
              
              <?php if ($b['image'] && file_exists($b['image'])): ?>
                <img src="<?= e($b['image']) ?>" style="width:100%;height:200px;object-fit:cover">
              <?php else: ?>
                <div style="width:100%;height:200px;background:#f2f2f2;display:flex;align-items:center;justify-content:center">No Image</div>
              <?php endif; ?>

              <h4><?= e($b['title']) ?></h4>
              <div><strong>Tác giả:</strong> <?= e($b['author']) ?></div>
              <div><strong>Thể loại:</strong> <?= e($b['category_name'] ?? 'Chưa phân loại') ?></div>
              <p style="height:60px;overflow:hidden"><?= nl2br(e($b['description'])) ?></p>

              <?php if ($b['file_path'] && file_exists($b['file_path'])): ?>
                <a href="<?= e($b['file_path']) ?>" target="_blank">Xem/ Tải xuống</a>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

    </div>
  </section>
</div>

<?php include 'footer.php'; ?>
