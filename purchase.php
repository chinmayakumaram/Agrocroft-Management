<?php
// Database connection
$host = 'localhost';
$db = 'agriculture_management';
$user = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Initialize cart if not already done
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Function to fetch products from the database
function fetchProducts()
{
    global $conn;
    $stmt = $conn->query("SELECT * FROM products");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Function to add items to cart in the database
function addToCart($productId, $quantity)
{
    global $conn;

    // Check if the product already exists in the cart
    $stmt = $conn->prepare("SELECT * FROM cart WHERE product_id = :product_id");
    $stmt->execute(['product_id' => $productId]);
    $item = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($item) {
        // Update the quantity if it exists
        $newQuantity = $item['quantity'] + $quantity;
        $stmt = $conn->prepare("UPDATE cart SET quantity = :quantity WHERE product_id = :product_id");
        $stmt->execute(['quantity' => $newQuantity, 'product_id' => $productId]);
    } else {
        // Insert new product into the cart
        $stmt = $conn->prepare("INSERT INTO cart (product_id, quantity) VALUES (:product_id, :quantity)");
        $stmt->execute(['product_id' => $productId, 'quantity' => $quantity]);
    }
}
  
// Function to display the cart
function displayCart()
{
    global $conn;

    $stmt = $conn->query("SELECT c.quantity, p.name, p.price FROM cart c JOIN products p ON c.product_id = p.id");
    $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($cartItems)) {
        echo "<p>Your cart is empty.</p>";
    } else {
        echo "<table border='1'>";
        echo "<tr><th>Product</th><th>Price</th><th>Quantity</th><th>Total</th></tr>";
        $total = 0;
        foreach ($cartItems as $item) {
            $itemTotal = $item['price'] * $item['quantity'];
            $total += $itemTotal;
            echo "<tr>
                    <td>{$item['name']}</td>
                    <td>\${$item['price']}</td>
                    <td>{$item['quantity']}</td>
                    <td>\${$itemTotal}</td>
                  </tr>";
        }
        echo "<tr><td colspan='3'>Total</td><td>\${$total}</td></tr>";
        echo "</table>";
    }
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_to_cart'])) {
        $productId = (int)$_POST['product_id'];
        $quantity = (int)$_POST['quantity'];
        if ($quantity > 0) {
            addToCart($productId, $quantity);
        } else {
            echo "<p>Please enter a valid quantity.</p>";
        }
    } elseif (isset($_POST['checkout'])) {
        echo "<h2>Order Summary</h2>";
        displayCart();
        echo "<p>Thank you for your purchase!</p>";
        $conn->query("TRUNCATE TABLE cart"); // Clear cart after checkout
        exit;
    }
}

$products = fetchProducts();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Farmer's Store</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            text-align:center;
            margin-bottom:30px;
            margin-top:0px;
        }
        h1 {
            text-align: center;
            background-color: #4CAF50;
            color: white;
            padding: 20px 0;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .product-image {
            width: 100px;
            height: 100px;
        }
        footer {
    text-align: center;
    padding: 1rem 0;
    background: #333;
    color: #fff;
}
    </style>
</head>
<body>
    <h1>Welcome to Farmer's Store</h1>

    <h2>Products</h2>
    <table>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><img class="product-image" src="images/<?php echo strtolower(str_replace(' ', '_', $product['name'])); ?>.jpg" alt="<?php echo $product['name']; ?>"></td>
                <td><?php echo $product['name']; ?></td>
                <td><?php echo $product['category']; ?></td>
                <td>$<?php echo $product['price']; ?></td>
                <td>
                    <form method="post">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <input type="number" name="quantity" min="1" value="1">
                        <button type="submit" name="add_to_cart">Add to Cart</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Your Cart</h2>
    <?php displayCart(); ?>

    <form method="post">
        <button type="submit" name="checkout">Checkout</button>
    </form>
    <footer>
        <p>&copy; <?= date('Y'); ?> Farmer Dashboard</p>
    </footer>
</body>
</html>
