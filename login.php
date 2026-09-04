<?php
require 'config.php';

$message = "";

if (isset($_SESSION["message"])) {
    $message = $_SESSION["message"];
    unset($_SESSION["message"]);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if (empty($username) || empty($password)) {
        $message = "Please fill in all fields.";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user["password"])) {
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["username"] = $user["username"];
            header("Location: profile.php");
            exit();
        } else { $message = "Incorrect username or password."; }
    }
}
?>

<?php include 'header.php'; ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<section class="content">        
        <body>
            <h2>Customer Login</h2>

            <?php if (!empty($message)) echo "<p style='color:red;'>" . htmlspecialchars($message). "</p>"; ?>

            <form method="POST" action="">
                <label>User Name</label><br>
                <input type="text" name="username"><br><br>

                <label>Password</label><br>
                <input type="password" name="password"><br><br>

                <button type="submit">Login</button>
            </form>
        </body>
</section>

<?php include 'footer.php'; ?>
</body>
</html>