<?php
// MAMP әдепкі деректері
$host = 'localhost';
$db   = 'univer_db'; // Сіздің дерекқорыңыздың атауы
$user = 'root';
$pass = 'root'; // Егер MAMP-тың әдепкі құпия сөзі болса (немесе бос '')
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// $pdo айнымалысы енді барлық жерде дерекқормен жұмыс істеуге дайын.
?>