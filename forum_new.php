<?php
include_once './main.php';
if (!isset($_SESSION['username'])) {
    header('Location: forum.php');
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $author = $_SESSION['username'];
    if ($title && $content) {
        $stmt = $conn->prepare("INSERT INTO forum_posts (author, title, content) VALUES (?, ?, ?)");
        $stmt->bind_param('sss', $author, $title, $content);
        $stmt->execute();
        header('Location: forum.php');
        exit();
    } else {
        $error = 'Vui lòng nhập đầy đủ tiêu đề và nội dung.';
    }
}
?>
<div class="container mt-4">
    <h2>Đăng bài mới</h2>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <form method="post">
        <div class="mb-3">
            <label for="title" class="form-label">Tiêu đề</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Nội dung</label>
            <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Đăng bài</button>
        <a href="forum.php" class="btn btn-secondary">Quay lại</a>
    </form>
</div>