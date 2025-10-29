<?php
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
require_once __DIR__ . '/includes/db.php';

$limit = 50;
// Lấy 50 bản ghi mới nhất nhưng trả về theo thứ tự tăng dần để tin mới nằm dưới
$sql = "SELECT id, name, content, DATE_FORMAT(created_at, '%Y-%m-%d %H:%i') as created_at
        FROM (
          SELECT id, name, content, created_at
          FROM messages
          ORDER BY id DESC
          LIMIT $limit
        ) AS recent
        ORDER BY id ASC";
$result = $mysqli->query($sql);
$rows = [];
if ($result) {
    while ($r = $result->fetch_assoc()) {
        $rows[] = $r;
    }
}
echo json_encode(['ok' => true, 'messages' => $rows]);
