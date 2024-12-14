<?php
session_start();

// Remove product from the cart
if (isset($_GET['remove'])) {
    $product_id_to_remove = $_GET['remove'];
    unset($_SESSION['cart'][$product_id_to_remove]);
    header("Location: {$_SERVER['PHP_SELF']}");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart</title>
<link rel="stylesheet" href="style.css">
<style>
    /* Your existing styles here... */
             /* Global Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body and general layout */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #fafafa;
    color: #333;
    line-height: 1.6;
}

/* Header styling */
header {
    background-color: #4CAF50;
    color: white;
    text-align: center;
    padding: 20px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

header h1 {
    font-size: 2.8em;
    letter-spacing: 2px;
}

/* Main content styling */
main {
    padding: 40px 20px;
}

/* Section Titles */
h2 {
    font-size: 2.4em;
    margin-bottom: 20px;
    color: #4CAF50;
    text-transform: uppercase;
    text-align: center;
    font-weight: bold;
}



/* Cart button */
.btn {
    display: inline-block;
    background-color: #4CAF50;
    color: white;
    padding: 15px 30px;
    text-decoration: none;
    border-radius: 8px;
    margin-top: 40px;
    font-size: 1.3em;
    transition: background-color 0.3s, transform 0.2s;
    text-align: center;
}

.btn:hover {
    background-color: #45a049;
    transform: scale(1.05);
}

/* Footer Styling */
footer {
    background-color: #333;
    color: white;
    text-align: center;
    padding: 25px;
    position: relative;
    bottom: 0;
    width: 100%;
}

footer p {
    font-size: 1.1em;
}

/* Modal or Cart Popup (Optional, for cart interactions) */
.cart-modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center;
}

.cart-modal .modal-content {
    background-color: white;
    padding: 30px;
    border-radius: 8px;
    width: 400px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
}

.cart-modal .modal-content h2 {
    font-size: 2em;
    color: #4CAF50;
    text-align: center;
    margin-bottom: 15px;
}

.cart-modal .modal-content p {
    font-size: 1.3em;
    margin-bottom: 10px;
}

.cart-modal .modal-content button {
    background-color: #4CAF50;
    color: white;
    padding: 12px 25px;
    border-radius: 8px;
    font-size: 1.2em;
    cursor: pointer;
    transition: background-color 0.3s;
    width: 100%;
}

.cart-modal .modal-content button:hover {
    background-color: #45a049;3 
}
.cart-table th, .cart-table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        .cart-table {
            width: 50%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

    /* Add specific styles for Remove button */
    .remove-btn {
       text-decoration:none;
        color: black;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 1.1em;
        transition: background-color 0.3s, transform 0.2s;
        text-align: center;
    }

    .remove-btn:hover {
        background-color: #e53935;
        transform: scale(1.05);
    }

</style>
</head>
<body>
    <header>
        <h1>Your Shopping Cart</h1>
    </header>
    <main>
        <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
            <table class="cart-table">
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($_SESSION['cart'] as $product_id => $details): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($details['name']); ?></td>
                        <td><?php echo htmlspecialchars($details['quantity']); ?></td>
                        <td>
                            <!-- Remove button -->
                            <a href="?remove=<?php echo $product_id; ?>" class="remove-btn">Remove</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <a href="checkout.php" class="btn">Proceed to Checkout</a>
        <?php else: ?>
            <p style="font-size: 30px;">Your cart is empty.<br> <a href="customer.php" class="remove-btn" style="font-size:20px">Go back to shop</a></p>
        <?php endif; ?>
    </main>
    <footer>
        <p>&copy; 2024 Crop Market</p>
    </footer>
</body>
</html>
