<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
// Giao thừa: 00:00 ngày 17/02/2026
$tet = strtotime("2026-02-17 00:00:00");
$now = time();
$remain = $tet - $now;

if ($remain <= 0) {
    $text = "🎉 Chúc mừng năm mới 2026! Chúc bạn một năm an khang, thịnh vượng! 🎊";
} else {
    $days = floor($remain / 86400);
    $hours = floor(($remain % 86400) / 3600);
    $minutes = floor(($remain % 3600) / 60);
    $seconds = $remain % 60;
    $text = "Còn $days ngày, $hours giờ, $minutes phút, $seconds giây";
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Include SEO Meta -->
    <?php include 'includes/seo-meta.php'; ?>

    <!-- CSS (cache-busting) -->
    <?php $css_ver = @filemtime(__DIR__ . '/assets/css/style.css') ?: time(); ?>
    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo $css_ver; ?>">
</head>

<body>
    <div class="content">
        <div class="layout">
            <div class="main-col">
                <main>
                    <h1>ĐẾM NGƯỢC ĐẾN TẾT 2026 OKEY CU 🎆</h1>
                    <h2>Tết Nguyên Đán 2026 rơi vào ngày 17 tháng 2 năm 2026 !</h2>
                    <div class="count-grid" aria-label="Đếm ngược theo đơn vị">
                        <div class="count-card">
                            <div class="count-value" id="count-days">0</div>
                            <div class="count-label">NGÀY</div>
                        </div>
                        <div class="count-card">
                            <div class="count-value" id="count-hours">0</div>
                            <div class="count-label">GIỜ</div>
                        </div>
                        <div class="count-card">
                            <div class="count-value" id="count-minutes">0</div>
                            <div class="count-label">PHÚT</div>
                        </div>
                        <div class="count-card">
                            <div class="count-value" id="count-seconds">0</div>
                            <div class="count-label">GIÂY</div>
                        </div>
                    </div>
                </main>
            </div>
            <aside class="chat">
                <h3>Gửi lời chúc Tết</h3>
                <div id="chat-messages" class="chat-messages"></div>
                <form id="chat-form" class="chat-form">
                    <input id="chat-name" type="text" maxlength="100" placeholder="Tên của bạn" required>
                    <textarea id="chat-content" rows="3" maxlength="1000" placeholder="Lời chúc / thông điệp..." required></textarea>
                    <button type="submit">Gửi lời chúc</button>
                    <div id="chat-status" class="chat-status"></div>
                </form>
            </aside>
        </div>

        <footer>
            © 2025 - realBunz | Chúc bạn một năm mới hạnh phúc 💖
        </footer>
    </div>

    <!-- JavaScript (cache-busting) -->
    <?php $js_ver = @filemtime(__DIR__ . '/assets/js/script.js') ?: time(); ?>
    <script src="assets/js/script.js?v=<?php echo $js_ver; ?>"></script>
    <?php $chat_js_ver = @filemtime(__DIR__ . '/assets/js/chat.js') ?: time(); ?>
    <script src="assets/js/chat.js?v=<?php echo $chat_js_ver; ?>"></script>

    <!-- Background Video (placed at the end, behind all content) -->
    <video class="bg-video" autoplay muted loop playsinline style="position:fixed;top:0;left:0;width:100%;height:100%;object-fit:cover;z-index:0;pointer-events:none">
        <source src="assets/videos/bg_tet.mp4" type="video/mp4">
    </video>
</body>

</html>