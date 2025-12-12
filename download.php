<?php
// download.php

$jsonFile = 'library_files.json';
$uploadDir = 'uploads/library/';
$fileId = $_GET['id'] ?? null;

if (!$fileId) {
    die("Файл идентификаторы көрсетілмеген.");
}

// Файлдар тізімін жүктеу
$filesList = file_exists($jsonFile) ? json_decode(file_get_contents($jsonFile), true) : [];

$fileData = null;
$fileIndex = -1;

// ID бойынша файлды табу
foreach ($filesList as $index => $file) {
    if ($file['id'] === $fileId) {
        $fileData = $file;
        $fileIndex = $index;
        break;
    }
}

if (!$fileData) {
    die("Файл дерекқорынан табылмады.");
}

$filePath = $uploadDir . $fileData['path'];

if (!file_exists($filePath)) {
    die("Файл серверде табылмады: " . htmlspecialchars($fileData['name']));
}

// 1. Жүктеу санын арттыру
if ($fileIndex !== -1) {
    $filesList[$fileIndex]['downloads']++;
    file_put_contents($jsonFile, json_encode($filesList, JSON_PRETTY_PRINT));
}

// 2. Файлды браузерге жіберу
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream'); // Кез келген файл түрін өңдеуге арналған
header('Content-Disposition: attachment; filename="' . basename($fileData['name']) . '"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($filePath));
flush(); // Буферді тазалау
readfile($filePath);
exit;
?>