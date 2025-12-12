<?php
// login_process.php - Кіруді өңдеу (Мысал)
session_start();
require_once 'db_config.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $login_error = '';

    try {
        $stmt = $pdo->prepare("SELECT id, username, password_hash, full_name, user_type FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        // 1. Пайдаланушы бар ма?
        if ($user) {
            // 2. Парольді тексеру (password_verify қауіпсіздік үшін)
            if (password_verify($password, $user['password_hash'])) {
                
                // 3. Сәтті кіру. Сессияны орнату! (МАҢЫЗДЫ ҚАДАМ)
                $_SESSION['logged_in'] = true;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['full_name'] = $user['full_name'];
                $_SESSION['role'] = $user['user_type'];
                
                // 4. Пайдаланушы рөліне сәйкес бағыттау
                $redirect_url = ($user['user_type'] === 'student') ? 'student/main.php' : 'teacher/main_teacher.php';
                header("Location: $redirect_url");
                exit;
                
            } else {
                $login_error = "Қате логин немесе пароль.";
            }
        } else {
            $login_error = "Қате логин немесе пароль.";
        }
    } catch (PDOException $e) {
        $login_error = 'Базада қателік: ' . $e->getMessage();
    }
    
    // Қате болса, кіру бетіне қайтару
    $_SESSION['login_error'] = $login_error;
    header("Location: index.php"); // Немесе сіздің кіру бетіңіз
    exit;
}
?>