<?php
// logout.php - Жүйеден шығу (Студенттер мен Мұғалімдер үшін әмбебап)
session_start();

// Сессия деректерін толығымен тазалау
$_SESSION = array();

// Егер сессия cookie-ін қолданса, оны жою
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Сессияны жою
session_destroy();

// Негізгі бетке бағыттау
header("Location: index.php");
exit;
?>