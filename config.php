<?php
// config.php - Базамен байланыс конфигурациясы

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'root'); // MAMP үшін әдетте "root"
define('DB_NAME', 'univer_db');

// Сессия бастау
session_start();

// Базамен байланыс
function getDBConnection() {
    try {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $conn->set_charset("utf8mb4");
        
        if ($conn->connect_error) {
            throw new Exception("Базаға қосылу қатесі: " . $conn->connect_error);
        }
        return $conn;
    } catch (Exception $e) {
        die("Қате: " . $e->getMessage());
    }
}

// Қолданушы мәліметтерін алу
function getUserData($username) {
    $conn = getDBConnection();
    $sql = "SELECT u.*, s.* FROM users u 
            LEFT JOIN students s ON u.student_id = s.id 
            WHERE u.username = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    
    $stmt->close();
    $conn->close();
    
    return $user;
}

// Суретті БД-ге сақтау
function saveProfileImage($studentId, $imageData, $imageType, $imageSize) {
    $conn = getDBConnection();
    
    // Бұрынғы суретті тексеру
    $checkSql = "SELECT profile_image FROM students WHERE student_id = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("s", $studentId);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();
    
    if ($checkResult->num_rows > 0) {
        // Жаңарту
        $sql = "UPDATE students SET profile_image = ?, image_type = ?, image_size = ?, updated_at = NOW() WHERE student_id = ?";
    } else {
        // Кіріс
        $sql = "UPDATE students SET profile_image = ?, image_type = ?, image_size = ?, updated_at = NOW() WHERE student_id = ?";
    }
    
    $stmt = $conn->prepare($sql);
    $null = NULL;
    $stmt->bind_param("bsis", $null, $imageType, $imageSize, $studentId);
    $stmt->send_long_data(0, $imageData);
    
    $success = $stmt->execute();
    
    $stmt->close();
    $conn->close();
    
    return $success;
}

// Суретті БД-ден алу
function getProfileImage($studentId) {
    $conn = getDBConnection();
    $sql = "SELECT profile_image, image_type FROM students WHERE student_id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $studentId);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($imageData, $imageType);
    $stmt->fetch();
    
    $image = null;
    if ($imageData) {
        $image = [
            'data' => $imageData,
            'type' => $imageType
        ];
    }
    
    $stmt->close();
    $conn->close();
    
    return $image;
}

// Суретті көрсету үшін URL жасау
function getProfileImageUrl($studentId) {
    return "get_image.php?student_id=" . urlencode($studentId) . "&t=" . time();
}
?>