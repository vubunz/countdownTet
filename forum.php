<?php
ob_start();
include_once './main.php';

// Kiểm tra kết nối database
if (!isset($conn) || !$conn) {
    die("Lỗi kết nối database");
}

// Lấy danh sách bài viết mới nhất với tên ingame
$sql = "SELECT p.*, pl.name as ingame_name, (SELECT COUNT(*) FROM forum_comments WHERE post_id = p.id) AS comment_count 
        FROM forum_posts p 
        LEFT JOIN users u ON p.author = u.username 
        LEFT JOIN players pl ON u.id = pl.id 
        ORDER BY p.created_at DESC";
$result = mysqli_query($conn, $sql);

// Kiểm tra lỗi SQL
if (!$result) {
    die("Lỗi truy vấn: " . mysqli_error($conn));
}

ob_end_flush();
?>
<div class="container mt-4">
    <h2 class="mb-3">Bảng Tin Diễn Đàn</h2>
    <?php if (isset($_SESSION['username']) && !empty($_SESSION['username'])): ?>
        <a href="forum_new.php" class="btn btn-primary mb-3">Đăng bài mới</a>
    <?php endif; ?>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <div style="display:flex; align-items:flex-start; border-bottom:1px solid #e6a96b; background:#ffcc99; padding:8px 12px;">
            <img src="/images/avatar/<?= htmlspecialchars($row['author']) ?>.png" style="width:32px;height:32px;margin-right:8px;">
            <div style="flex:1;">
                <div style="font-weight:bold;color:#7a4b00;">
                    <a href="forum_post.php?id=<?= $row['id'] ?>" style="color:#7a4b00; text-decoration:none;">
                        <?= htmlspecialchars($row['title']) ?>
                        <?php if (strtotime($row['created_at']) >= strtotime('-3 days')): ?>
                            <img src="images/forum/new.gif" alt="new" style="vertical-align:middle; margin-left:4px;">
                        <?php endif; ?>
                    </a>
                </div>
                <div style="font-size:13px;color:#6d4c1b;">
                    bởi <b><?= htmlspecialchars($row['ingame_name'] ?: $row['author']) ?></b>
                    Trả lời: <?= $row['comment_count'] ?> -
                    Xem : <?= $row['views'] ?> -
                    <?= date('d/m/Y H:i', strtotime($row['created_at'])) ?>
                </div>
            </div>
            <?php if (isset($_SESSION['username']) && !empty($_SESSION['username']) && checkAdmin($conn, $_SESSION['username'])): ?>
                <a href="forum_delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Bạn chắc chắn muốn xóa?')" class="btn btn-danger btn-sm">Xóa</a>
                <?php if ($row['closed']): ?>
                    <a href="forum_toggle.php?id=<?= $row['id'] ?>&action=open" class="btn btn-success btn-sm">Mở</a>
                <?php else: ?>
                    <a href="forum_toggle.php?id=<?= $row['id'] ?>&action=close" class="btn btn-warning btn-sm">Đóng</a>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    <?php endwhile; ?>
</div>