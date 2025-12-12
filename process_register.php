<?php
// process_register.php - Тіркеуді өңдеу (MySQL PDO арқылы)
session_start();
require_once 'db_config.php'; // Базаға қосылуды қосамыз

$_SESSION['old'] = $_POST; // Ескі деректерді сақтау

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $last_name = trim($_POST['last_name'] ?? '');
    $first_name = trim($_POST['first_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? ''; // Парольді trim қолданбаймыз
    $confirm_password = $_POST['confirm_password'] ?? '';
    $user_type = trim($_POST['user_type'] ?? '');
    
    $errors = [];
    
    // 1. Валидацияны тексеру (Берілген код дұрыс)
    if (empty($last_name)) $errors['last_name'] = 'Тегіңізді енгізіңіз';
    if (empty($first_name)) $errors['first_name'] = 'Атыңызды енгізіңіз';
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email'] = 'Жарамды email енгізіңіз';
    if (empty($phone)) $errors['phone'] = 'Телефон нөміріңізді енгізіңіз';
    if (empty($username)) $errors['username'] = 'Логин енгізіңіз';
    if (empty($password)) $errors['password'] = 'Пароль енгізіңіз';
    if ($password !== $confirm_password) $errors['confirm_password'] = 'Парольдер сәйкес келмейді';
    if (empty($user_type) || !in_array($user_type, ['student', 'teacher'])) $errors['user_type'] = 'Рөлді таңдаңыз';
    
    // Пароль талаптары
    if (strlen($password) < 8) {
        $errors['password'] = 'Пароль кемінде 8 символ болуы керек';
    } else if (!preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password)) {
        // Егер 8-ден көп болса, бас әріп пен санды тексеру
        $errors['password'] = 'Парольде кемінде бір бас әріп және бір сан болуы керек';
    }

    // 2. Логин мен email бірегейлігін БД арқылы тексеру
    if (empty($errors)) {
        try {
            // Логин тексеру
            $stmt_username = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
            $stmt_username->execute([$username]);
            if ($stmt_username->fetchColumn() > 0) {
                $errors['username'] = 'Бұл логин қолданыста';
            }

            // Email тексеру
            $stmt_email = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
            $stmt_email->execute([$email]);
            if ($stmt_email->fetchColumn() > 0) {
                $errors['email'] = 'Бұл email тіркелген';
            }
        } catch (PDOException $e) {
            $errors['db'] = 'Базада қателік: ' . $e->getMessage();
        }
    }
    
    // 3. Егер қателіктер болса, регистрация бетіне қайтару
    if (!empty($errors)) {
        $_SESSION['register_errors'] = $errors;
        header("Location: register.php");
        exit;
    }
    
    // 4. Сәтті тіркелу - Деректерді базаға сақтау
    
    // Қауіпсіз пароль хэшін жасау
    $password_hash = password_hash($password, PASSWORD_BCRYPT);
    
    // Толық атын құрастыру
    $full_name = $last_name . ' ' . $first_name;
    
    try {
        $sql = "INSERT INTO users (username, email, password_hash, full_name, phone, user_type) 
                VALUES (?, ?, ?, ?, ?, ?)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $username,
            $email,
            $password_hash,
            $full_name,
            $phone,
            $user_type
        ]);
        
        // 5. Тіркелгеннен кейін сессияны орнату (пайдаланушыны бірден кіргізу)
        // Бұл қадам сіздің сұранысыңыз бойынша өте маңызды!
        
        // Жаңа пайдаланушы деректерін сессияға сақтау
        $_SESSION['logged_in'] = true;
        $_SESSION['user_id'] = $pdo->lastInsertId(); // Жаңа ID-ны алу
        $_SESSION['username'] = $username;
        $_SESSION['full_name'] = $full_name;
        $_SESSION['role'] = $user_type;
        
        unset($_SESSION['old']); // Ескі деректерді өшіру
        $_SESSION['register_success'] = "Тіркелу сәтті аяқталды! Қош келдіңіз, $full_name!";
        
        // Рөлге сәйкес бетке бағыттау
        $redirect_url = ($user_type === 'student') ? 'student/main.php' : 'teacher/main_teacher.php';
        header("Location: $redirect_url");
        exit;
        
    } catch (PDOException $e) {
        $_SESSION['register_errors']['db'] = "Деректерді сақтауда қателік орын алды: " . $e->getMessage();
        header("Location: register.php");
        exit;
    }
} else {
  
// Сәттілік хабарламасын орнатамыз (Сіздің index.php оны көрсетеді)
$_SESSION['just_registered'] = true; 
$_SESSION['tmp_username'] = $new_username; // (Егер логинді көрсеткіңіз келсе)

// Енді толық HTML мазмұны бар index.php-ке бағыттаймыз
header("Location: index.php"); // <--- ДҰРЫС БАҒЫТТАУ
exit;
}
?>