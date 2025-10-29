<?php
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
require_once __DIR__ . '/includes/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'error' => 'Method not allowed']);
    exit;
}

$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$content = isset($_POST['content']) ? trim($_POST['content']) : '';

if ($name === '' || $content === '') {
    echo json_encode(['ok' => false, 'error' => 'Vui lòng nhập tên và nội dung']);
    exit;
}

if (mb_strlen($name) > 100) {
    echo json_encode(['ok' => false, 'error' => 'Tên quá dài (tối đa 100 ký tự)']);
    exit;
}

if (mb_strlen($content) > 1000) {
    echo json_encode(['ok' => false, 'error' => 'Nội dung quá dài (tối đa 1000 ký tự)']);
    exit;
}

$stmt = $mysqli->prepare('INSERT INTO messages(name, content, created_at) VALUES(?, ?, NOW())');
if (!$stmt) {
    echo json_encode(['ok' => false, 'error' => 'DB error']);
    exit;
}
$stmt->bind_param('ss', $name, $content);
$ok = $stmt->execute();
$stmt->close();

echo json_encode(['ok' => $ok]);
