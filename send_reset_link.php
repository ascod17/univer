<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



require_once 'db_config.php'; 

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/Exception.php';
require 'PHPMailer/SMTP.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;





if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    if (empty($email)) {
        header("Location: forgot_password.php?status=error&detail=empty_email");
        exit;
    }

    // Проверяем пользователя
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if (!$user) {
        header("Location: forgot_password.php?status=error&detail=user_not_found");
        exit;
    }

    // Создаем токен
    $reset_code = rand(1000, 9999);
$code_expiry = date("Y-m-d H:i:s", time() + 300); // код действует 5 минут

$update_stmt = $pdo->prepare("UPDATE users SET reset_code = ?, code_expiry = ? WHERE email = ?");
$update_stmt->execute([$reset_code, $code_expiry, $email]);


   
    // SMTP Gmail
    $smtp_host = 'smtp.gmail.com';
    $smtp_port = 587;
    $smtp_username = 'bekbosynbuldirshin@gmail.com'; 
    $smtp_password = 'fqht geqs pylr wydf';   // ← пароль приложения Google

    $mail = new PHPMailer(true);

    try {
        // Настройки SMTP
        $mail->isSMTP();
        $mail->Host       = $smtp_host;
        $mail->SMTPAuth   = true;
        $mail->Username   = $smtp_username;
        $mail->Password   = $smtp_password;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = $smtp_port;
        $mail->CharSet    = 'UTF-8';

        // От кого
        $mail->setFrom($smtp_username, 'Администрация сайта');

        // Кому
        $mail->addAddress($email);

        // Письмо
        $mail->isHTML(true);
        $mail->Subject = 'Запрос на восстановление пароля';
        $mail->Body = "
    Сәлеметсіз бе!<br><br>
    Сіздің парольді қалпына келтіру кодыңыз:<br>
    <h2 style='font-size:32px; letter-spacing:4px;'>$reset_code</h2>
    Код 5 минутқа жарамды.<br><br>
    Егер бұл әрекетті орындамасаңыз, бұл хабарламаны елемеңіз.
";


        $mail->send();

header("Location: verify_code.php?email=" . urlencode($email) . "&status=success");
exit;
        exit;

    } catch (Exception $e) {
        header("Location: forgot_password.php?status=error&detail=" . urlencode("Mail Error: " . $mail->ErrorInfo));
        exit;
    }

} else {
    header("Location: forgot_password.php");
    exit;
}
