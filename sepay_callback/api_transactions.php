<?php
define('SEPAY_API_TOKEN', 'QXUXXYYKPOGIRONAFQQVIEJRZFK916RHKDCS3HHOTAGZNVIOIWM31B59CX4YEAWT'); // Thay bằng token thật của bạn
require_once 'SepayAPI.php';

header('Content-Type: application/json');

try {
    $sepay = new SepayAPI(SEPAY_API_TOKEN);
    $data = $sepay->getTransactions(['limit' => 10]);
    echo json_encode($data);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
exit;
