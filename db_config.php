<?php
// db_config.php - MySQL базасына қосылу$host = 'sql123.infinityfree.com';
$db   = 'epiz_12345678_univerdb';
$user = 'epiz_12345678';
$pass = 'mypassword123';

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
     // Қосылуда қате болса, қате туралы хабарды көрсету
     die("Базаға қосылуда қате: " . $e->getMessage());
}
?>