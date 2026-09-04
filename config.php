<?php
session_start();

$host   = "your-db-host:3306";
$dbname = "your-db-name";
$user   = "your-db-user";
$pass   = "your-db-password";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
