<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Include SEO Meta -->
    <?php include __DIR__ . '/seo-meta.php'; ?>

    <!-- CSS (cache-busting) -->
    <?php $css_ver = @filemtime(__DIR__ . '/../assets/css/style.css') ?: time(); ?>
    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo $css_ver; ?>">
</head>

<body>
    <header class="site-header" role="banner">
        <div class="header-inner">
            <a href="index.php" class="brand" aria-label="Trang chủ - Đếm Ngược Tết 2026">
                <img src="assets/images/favilogo.jpg" alt="Đếm Ngược Tết 2026" class="brand-logo">
            </a>
            <nav class="nav" role="navigation" aria-label="Điều hướng chính">
                <ul class="nav-list">
                    <li class="nav-item">
                        <a href="#" class="btn-primary" id="tab-greeting-card">Gửi thiệp chúc tết</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>