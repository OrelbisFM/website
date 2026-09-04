<?php
require 'config.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION["user_id"]]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<?php include 'header.php'; ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<section class="content">
<body>
    <h2>Welcome, <?php echo htmlspecialchars($user["username"]); ?></h2>
        <?php if (isset($_SESSION["message"])): ?>
            <p style="color:red;">
                <?php echo htmlspecialchars($_SESSION["message"]); ?>
            </p>
            <?php unset($_SESSION["message"]); ?>
        <?php endif; ?>
    <form method="POST" action="update_profile.php">
        <label>User Name (Required)</label><br>
        <input type="text" name="username" value="<?php echo htmlspecialchars($user["username"]); ?>"><br><br>

        <label>New Password</label><br>
        <input type="password" name="password"><br><br>

        <label>Confirm New Password</label><br>
        <input type="password" name="confirm_password"><br><br>

        <label>Phone Number (Required)</label><br>
        <input type="text" name="phone" value="<?php echo htmlspecialchars($user["phone"]); ?>"><br><br>

        <label>Email Address (Required)</label><br>
        <input type="text" name="email" value="<?php echo htmlspecialchars($user["email"]); ?>"><br><br>

        <label>Age (Required)</label><br>
        <input type="number" name="age" value="<?php echo htmlspecialchars($user["age"]); ?>"><br><br>
                     
        <button type="submit">Update Profile</button>
    </form>
</body>
</section>

<?php include 'footer.php'; ?>
</body>
</html>