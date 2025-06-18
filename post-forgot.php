<?php
require_once("CMain/connect.php");
$post = json_decode(file_get_contents('php://input'), true);

// Something to write to txt log
$log  = "Host: ".$_SERVER['REMOTE_ADDR'].' - '.date("F j, Y, g:i a").PHP_EOL.
        "Content FORGOT: ".json_encode($post).PHP_EOL.
        "-------------------------".PHP_EOL;

// Save string to log, use FILE_APPEND to append.
file_put_contents('./logs/log_'.date("j.n.Y").'.log', $log, FILE_APPEND);

$username = $post['username'];
$phone = $post['phone'];
$code = $post['code'];
$type = $post['type'];

try {
    $checkUserResult = mysqli_query($conn, "SELECT username FROM player WHERE username = '".$username."' AND phone = '".$phone."' LIMIT 1");

    if($checkUserResult == false || mysqli_num_rows($checkUserResult) < 1){
        echo '{"code": "04", "text": "Thông tin không tồn tại trên hệ thống."}';
        return;
    } else if($type == "check") {
        echo('{"code": "00", "text": "Thông tin chính xác."}');
    } else if($type == "otp") {
        $sql = mysqli_query($conn, "UPDATE `player` SET `password` = '".$code."', `updated_at` = '".date("Y-m-d H:i:s")."' WHERE `username` = '".$username."' AND `phone` = '".$phone."'");

        if($sql) {
            echo '{"code": "00", "text": "Cấp lại mật khẩu thành công."}';
        } else {
            echo '{"code": "99", "text": "Hệ thống gặp lỗi. Vui lòng liên hệ quản trị viên để được hỗ trợ."}';
        }
    }
} catch(Exception $e) {
    echo '{"code": "99", "text": "Hệ thống gặp lỗi. Vui lòng liên hệ quản trị viên để được hỗ trợ."}';
}
?>
