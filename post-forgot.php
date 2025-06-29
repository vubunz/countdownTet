<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once("CMain/connect.php");
require __DIR__ . '/vendor/autoload.php'; // Đường dẫn autoload của Composer

$data = json_decode(file_get_contents('php://input'), true);
$username = isset($data['username']) ? $data['username'] : '';

if (empty($username)) {
    echo json_encode(['code' => '01', 'text' => 'Tên đăng nhập không hợp lệ.']);
    exit;
}

$stmt = $conn->prepare("SELECT email, password FROM users WHERE username = ? LIMIT 1");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $email = $row['email'];
    $password = $row['password'];
    if (empty($email)) {
        echo json_encode(['code' => '04', 'text' => 'Tài khoản này chưa khai báo email, không thể gửi lại mật khẩu.']);
        exit;
    }

    // Cấu hình PHPMailer gửi qua Gmail SMTP
    $mail = new PHPMailer(true);
    try {
        $mail->CharSet = 'UTF-8'; // Đặt charset UTF-8 để không lỗi font
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'hotro.realbunz@gmail.com'; // Thay bằng Gmail của bạn
        $mail->Password   = 'bunp skdc fwqh gokc';    // Thay bằng App Password 16 ký tự
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Thông tin người gửi
        $mail->setFrom('hotro.realbunz@gmail.com', 'NINJA LEGACY');
        $mail->addAddress($email);

        $mail->isHTML(true); // Gửi HTML mail cho đẹp
        $mail->Subject = 'Khôi phục mật khẩu tài khoản NINJA LEGACY';
        $mail->Body    = "
            <div style='font-family: Arial, Helvetica, sans-serif; font-size: 15px;'>
                <b>Xin chào!</b><br><br>
                Bạn (hoặc ai đó) vừa yêu cầu khôi phục mật khẩu cho tài khoản trên <b>NINJA LEGACY</b>.<br>
                <b>Thông tin tài khoản:</b><br>
                Tên đăng nhập: <b>$username</b><br>
                Mật khẩu: <b>$password</b><br><br>
                Nếu bạn không yêu cầu, hãy bỏ qua email này.<br>
                <hr>
                <i>
                    Trân trọng,<br>
                    Đội ngũ hỗ trợ <b>NINJA LEGACY</b><br>
                    <a href='https://nsolegacy.io.vn/' target='_blank'>🌐 Website: nsolegacy.io.vn</a><br>
                    <a href='https://www.facebook.com/profile.php?id=61577114496898' target='_blank'>📘 Facebook NINJA LEGACY</a>
                </i>
            </div>
        ";
        $mail->AltBody = "Tên đăng nhập: $username\nMật khẩu: $password\nNINJA LEGACY";

        $mail->send();
        echo json_encode(['code' => '00', 'text' => 'Mật khẩu đã được gửi về email của bạn.']);
    } catch (Exception $e) {
        echo json_encode(['code' => '02', 'text' => 'Không gửi được email. Lỗi: ' . $mail->ErrorInfo]);
    }
} else {
    echo json_encode(['code' => '03', 'text' => 'Tên đăng nhập không tồn tại trên hệ thống.']);
}
$stmt->close();
