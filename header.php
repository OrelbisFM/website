<header>
    <div class="logo">
        <a href="index.php">
            <img src="assets/logo.png" alt="Orelbis' Games Logo">
        </a>
    </div>
        <nav>
            <a href="index.php">Home</a>
            <a href="about.php">About Us</a>
            <a href="products.php">Products</a>
            <a href="checkout.php">Checkout</a>
        <?php if (isset($_SESSION["username"])): ?>
            <a href="profile.php">My Profile (<?php echo $_SESSION["username"]; ?>)</a>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="register.php">Register</a>
            <a href="login.php">Login</a>
        <?php endif; ?>
        </nav>
</header>