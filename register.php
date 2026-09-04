<?php
require 'config.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    $confirmPassword = trim($_POST["confirm_password"]);
    $phone = trim($_POST["phone"]);
    $email = trim($_POST["email"]);
    $age = trim($_POST["age"]);

    if (empty($username) || empty($password) || empty($confirmPassword) || empty($phone) || empty($email) || empty($age)) {
        $message = "All fields are required.";
    } elseif ($password !== $confirmPassword) {
        $message = "Passwords do not match.";
    } elseif (!preg_match("/^[0-9]{10}$/", $phone)) {
        $message = "Phone number must be 10 digits.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email format.";
    } elseif (!is_numeric($age) || $age < 1 || $age > 120) {
        $message = "Enter a valid age.";
    } else {
        $check = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        $check->execute([$username, $email]);

        if ($check->rowCount() > 0) {
            $message = "Username or email already exists.";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare("INSERT INTO users (username, password, phone, email, age) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$username, $hashedPassword, $phone, $email, $age]);
            $_SESSION["message"] = "Profile successfully created.";
			header("Location: login.php");
            exit();
        }
    }
}
?>

<?php include 'header.php'; ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<section class="content">     
        <body>
            <h2>Customer Registration</h2>

            <?php if (!empty($message)) echo "<p style='color:red;'>$message</p>"; ?>

            <form method="POST" action="">
                <label>User Name</label><br>
                <input type="text" name="username"><br>

                <label>Password</label><br>
                <input type="password" name="password"><br>

                <label>Confirm Password</label><br>
                <input type="password" name="confirm_password"><br>

                <label>Phone Number</label><br>
                <input type="tel" name="phone"><br>
                    
                <label>Email Address</label><br>
                <input type="email" name="email"><br>

                <label>Age</label><br>
                <input type="number" name="age"><br><br>

                <button type="submit">Register</button>
            </form>
        </body>
</section>
        
<?php include 'footer.php'; ?>
</body>
</html>