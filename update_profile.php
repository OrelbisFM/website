<?php
require 'config.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$message = "";
$username = trim($_POST["username"]);
$password = trim($_POST["password"]);
$confirmPassword = trim($_POST["confirm_password"]);
$phone = trim($_POST["phone"]);
$email = trim($_POST["email"]);
$age = trim($_POST["age"]);

if (empty($username) || empty($phone) || empty($email) || empty($age)) {
    $_SESSION["message"] = "Please fill in all required fields.";
    header("Location: profile.php");
    exit();
}

if (!preg_match("/^[0-9]{10}$/", $phone)) {
    $_SESSION["message"] = "Phone number must be 10 digits.";
    header("Location: profile.php");
	exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION["message"] = "Invalid email format.";
    header("Location: profile.php");
    exit();
}

if (!is_numeric($age) || $age < 1 || $age > 120) {
    $_SESSION["message"] = "Invalid age.";
    header("Location: profile.php");
    exit();
}

if (!empty($password)) {
    if ($password !== $confirmPassword) {
        $_SESSION["message"] = "Passwords do not match.";
        header("Location: profile.php");
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("UPDATE users SET username=?, password=?, phone=?, email=?, age=? WHERE id=?");
    $stmt->execute([$username, $hashedPassword, $phone, $email, $age, $_SESSION["user_id"]]);
} else {
    $stmt = $pdo->prepare("UPDATE users SET username=?, phone=?, email=?, age=? WHERE id=?");
    $stmt->execute([$username, $phone, $email, $age, $_SESSION["user_id"]]);
}

$_SESSION["message"] = "Profile successfully updated.";
$_SESSION["username"] = $username;

header("Location: profile.php");
exit();
?>