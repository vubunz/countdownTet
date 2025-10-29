<?php
// SEO Meta Configuration
$site_url = "https://realbunz.site/"; // Có thể bỏ qua khi chạy local
$site_title = "Đếm Ngược Tết 2026 - Countdown Giao Thừa Việt Nam 🎆";
$site_description = "Trang đếm ngược đến Tết 2026 – xem còn bao nhiêu ngày, giờ, phút, giây nữa là đến Giao Thừa. Cập nhật thời gian thực, nhẹ và dễ dùng.";
$site_keywords = "đếm ngược tết, countdown giao thừa, tết 2026, năm mới 2026, đếm ngược năm mới, countdown tết việt nam, lịch tết 2026, giao thừa 2026";

// Dùng đường dẫn tương đối để hiển thị icon/ảnh khi chạy local
$og_image = "assets/images/og-image.jpg";
$favicon = "assets/images/favicon.ico";
?>

<!-- Primary Meta Tags -->
<title><?php echo $site_title; ?></title>
<meta name="title" content="<?php echo $site_title; ?>">
<meta name="description" content="<?php echo $site_description; ?>">
<meta name="keywords" content="<?php echo $site_keywords; ?>">
<meta name="author" content="Đếm Ngược Việt Nam">
<meta name="robots" content="index, follow">
<meta name="language" content="Vietnamese">
<meta name="revisit-after" content="1 days">

<!-- Canonical URL (bỏ qua nếu chạy local) -->
<?php if (!empty($site_url) && strpos($site_url, 'your-domain.com') === false): ?>
    <link rel="canonical" href="<?php echo $site_url; ?>">
<?php endif; ?>

<!-- Favicon (relative paths for local) -->
<link rel="shortcut icon" href="<?php echo $favicon; ?>">
<link rel="icon" type="image/x-icon" href="<?php echo $favicon; ?>">
<link rel="apple-touch-icon" sizes="180x180" href="assets/images/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon-16x16.png">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<?php if (!empty($site_url) && strpos($site_url, 'your-domain.com') === false): ?>
    <meta property="og:url" content="<?php echo $site_url; ?>">
<?php endif; ?>
<meta property="og:title" content="Đếm Ngược Tết 2026 🎇">
<meta property="og:description" content="Cùng xem còn bao lâu nữa là đến Giao Thừa 2026!">
<meta property="og:image" content="<?php echo $og_image; ?>">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:site_name" content="Đếm Ngược Việt Nam">
<meta property="og:locale" content="vi_VN">

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<?php if (!empty($site_url) && strpos($site_url, 'your-domain.com') === false): ?>
    <meta name="twitter:url" content="<?php echo $site_url; ?>">
<?php endif; ?>
<meta name="twitter:title" content="Đếm Ngược Tết 2026 🎉">
<meta name="twitter:description" content="Xem thời gian đếm ngược đến Giao Thừa 2026 - Cập nhật thời gian thực.">
<meta name="twitter:image" content="<?php echo $og_image; ?>">

<!-- Additional SEO Meta -->
<meta name="theme-color" content="#ffcc00">
<meta name="msapplication-TileColor" content="#ffcc00">
<meta name="msapplication-config" content="/browserconfig.xml">

<!-- Preconnect to external domains -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">

<!-- Schema.org JSON-LD -->
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebPage",
        "name": "Đếm Ngược Tết 2026",
        "description": "Trang đếm ngược đến Tết 2026 tại Việt Nam.",
        "url": "<?php echo $site_url; ?>",
        "inLanguage": "vi",
        "isPartOf": {
            "@type": "WebSite",
            "name": "Đếm Ngược Việt Nam",
            "url": "<?php echo $site_url; ?>"
        },
        "publisher": {
            "@type": "Organization",
            "name": "Đếm Ngược Việt Nam",
            "url": "<?php echo $site_url; ?>"
        },
        "mainEntity": {
            "@type": "Event",
            "name": "Tết Nguyên Đán 2026",
            "startDate": "2026-02-17T00:00:00+07:00",
            "description": "Giao Thừa Tết Nguyên Đán 2026 tại Việt Nam",
            "location": {
                "@type": "Country",
                "name": "Việt Nam"
            }
        }
    }
</script>