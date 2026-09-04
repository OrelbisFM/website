<?php include 'config.php'; ?>
<?php include 'header.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<section class="content">
    <h2>Checkout</h2>

    <form>
        <label>Full Name</label><br>
        <input type="text" name="Full Name"><br>
        
        <label>Shipping Address</label><br>
        <input type="text" name="Shipping Address"><br>
        
        <label>City</label><br>
        <input type="text" name="City"><br>
            
        <label>State</label><br>
        <input type="text" name="State"><br>
            
        <label>Zip Code</label><br>
        <input type="text" name="Zip Code"><br><br>
        <button>Place Order</button>
    </form>
</section>

<?php include 'footer.php'; ?>
</body>
</html>
