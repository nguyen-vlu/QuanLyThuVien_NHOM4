<?php
// QuanTriVien.php
require_once 'config.php';
$user = current_user();
if (!$user || !$user['is_admin']) {
    header('Location: login.php');
    exit;
}
$categories = $pdo->query("SELECT * FROM categories ORDER BY name")->fetchAll();
$messages = [];
$errors = [];
// xử lý thêm thể loại nhanh
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_category'])) {
    $cname = trim($_POST['category_name']);
    if ($cname) {
        $stmt = $pdo->prepare("INSERT IGNORE INTO categories (name) VALUES (?)");
        $stmt->execute([$cname]);
        $messages[] = "Đã thêm thể loại: " . htmlspecialchars($cname);
        $categories = $pdo->query("SELECT * FROM categories ORDER BY name")->fetchAll();
    }
}
// xử lý upload sách
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upload_book'])) {
    $title = trim($_POST['title'] ?? '');
    $author = trim($_POST['author'] ?? '');
    $desc = trim($_POST['description'] ?? '');
    $category_id = $_POST['category_id'] ?? null;

    if (!$title) $errors[] = "Tiêu đề sách bắt buộc.";
    // xử lý ảnh
    $img_path = null;
    if (!empty($_FILES['image']['name'])) {
        $img = $_FILES['image'];
        $ext = pathinfo($img['name'], PATHINFO_EXTENSION);
        $allowed = ['jpg','jpeg','png','gif'];
        if (!in_array(strtolower($ext), $allowed)) $errors[] = "Ảnh không hợp lệ.";
        else {
            $target = 'uploads/images/' . time() . '_' . preg_replace('/[^a-zA-Z0-9-_\.]/','_', $img['name']);
            if (!is_dir('uploads/images')) mkdir('uploads/images', 0777, true);
            if (move_uploaded_file($img['tmp_name'], $target)) $img_path = $target;
            else $errors[] = "Không thể lưu ảnh.";
        }
    }

    // xử lý file sách (pdf)
    $file_path = null;
    if (!empty($_FILES['bookfile']['name'])) {
        $f = $_FILES['bookfile'];
        $ext = pathinfo($f['name'], PATHINFO_EXTENSION);
        $allowedf = ['pdf','epub','txt'];
        if (!in_array(strtolower($ext), $allowedf)) $errors[] = "File sách không hợp lệ (pdf/epub/txt).";
        else {
            $targetf = 'uploads/files/' . time() . '_' . preg_replace('/[^a-zA-Z0-9-_\.]/','_', $f['name']);
            if (!is_dir('uploads/files')) mkdir('uploads/files', 0777, true);
            if (move_uploaded_file($f['tmp_name'], $targetf)) $file_path = $targetf;
            else $errors[] = "Không thể lưu file sách.";
        }
    }
    if (empty($errors)) {
        $ins = $pdo->prepare("INSERT INTO books (title, author, description, category_id, image_path, file_path, created_by) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $ins->execute([$title, $author, $desc, $category_id ?: null, $img_path, $file_path, $user['id'] ?? null]);
        $messages[] = "Đã thêm sách: ".htmlspecialchars($title);
    }
}
include 'header.php';
?>
<div class="right">
  <div class="box">
    <h2>Thẻ Quản Trị Viên</h2>
    <?php foreach($messages as $m) echo "<div style='color:green'>".htmlspecialchars($m)."</div>"; ?>
    <?php foreach($errors as $e) echo "<div style='color:red'>".htmlspecialchars($e)."</div>"; ?>

    <h3>Thêm thể loại nhanh</h3>
    <form method="post">
      <input type="text" name="category_name" placeholder="Tên thể loại...">
      <button type="submit" name="add_category">Thêm thể loại</button>
    </form>

    <hr>
    <h3>Đăng tải sách</h3>
    <form method="post" enctype="multipart/form-data">
      <label>Tên Sách</label><br>
      <input type="text" name="title" required><br><br>
      <label>Thể Loại</label><br>
      <select name="category_id">
        <option value="">-- Chọn thể loại --</option>
        <?php foreach($categories as $c): ?>
          <option value="<?= $c['id'] ?>"><?=htmlspecialchars($c['name'])?></option>
        <?php endforeach; ?>
      </select><br><br>
      <label>Tác giả</label><br>
      <input type="text" name="author"><br><br>
      <label>Nội dung chính</label><br>
      <textarea name="description" rows="4" cols="60"></textarea><br><br>
      <label>Hình ảnh bìa</label><br>
      <input type="file" name="image" accept="image/*"><br><br>
      <label>File sách (pdf/epub/txt)</label><br>
      <input type="file" name="bookfile" accept=".pdf,.epub,.txt"><br><br>
      <button type="submit" name="upload_book">Đăng Tải</button>
    </form>
  </div>
</div>
<?php include 'footer.php'; ?>

<?php session_start(); ?>
<div class="header-right">
<?php if(isset($_SESSION['user_id'])): ?>
    <span>Xin chào, <?php echo $_SESSION['ho_ten']; ?></span>
    <a href="logout.php"><button>Đăng xuất</button></a>
<?php else: ?>
    <a href="login.php"><button>ĐĂNG NHẬP</button></a>
    <a href="register.php"><button>ĐĂNG KÝ</button></a>
<?php endif; ?>
</div>





    








