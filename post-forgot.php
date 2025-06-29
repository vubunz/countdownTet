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
        $mail->Body = '
<div style="font-family: Arial, Helvetica, sans-serif; background: #fff;">
    <div style="background: #222; padding: 16px 0; text-align: center;">
        <img src="https://res.cloudinary.com/dcivynist/image/upload/v1751214428/lego_t6ywou.png" alt="NINJA LEGACY" style="height: 40px;">
    </div>
    <div style="background: #e53935; color: #fff; padding: 16px; font-size: 20px; font-weight: bold;">
        Thông báo khôi phục tài khoản trên <a href="https://nsolegacy.io.vn/" style="color: #fff; text-decoration: underline;">nsolegacy.io.vn</a>
        <div style="font-size: 13px; font-style: italic; color: #fff;">Email tự động – Vui lòng không trả lời</div>
    </div>
    <div style="padding: 24px;">
        <p>Thân gửi <b>' . htmlspecialchars($username) . '</b>,</p>
        <p>Cảm ơn bạn đã tin tưởng và sử dụng dịch vụ của <b>NINJA LEGACY</b>.</p>
        <p>
            Bạn hoặc ai đó vừa yêu cầu khôi phục mật khẩu cho tài khoản trên <a href="https://nsolegacy.io.vn/" target="_blank">https://nsolegacy.io.vn/</a>.<br>
            <br>
            <b>Thông tin tài khoản:</b><br>
            Tên đăng nhập: <b>' . htmlspecialchars($username) . '</b><br>
            Mật khẩu: <b>' . htmlspecialchars($password) . '</b><br>
        </p>
        <p style="color: #e53935;">
            Nếu bạn không thực hiện yêu cầu này, vui lòng bỏ qua email này.<br>
            Nếu cần hỗ trợ, hãy liên hệ đội ngũ hỗ trợ của chúng tôi.
        </p>
        <hr>
        <div style="font-size: 13px; color: #888;">
            <b>Website:</b> <a href="https://nsolegacy.io.vn/" target="_blank">nsolegacy.io.vn</a><br>
            <b>Facebook:</b> <a href="https://www.facebook.com/profile.php?id=61577114496898" target="_blank">NINJA LEGACY</a>
        </div>
    </div>
    <div style="background: #222; color: #fff; text-align: center; padding: 12px; font-size: 12px;">
        &copy; ' . date('Y') . ' NINJA LEGACY.
    </div>
</div>
';
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
