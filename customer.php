<?php
session_start();

// Database connection
$host = 'localhost';
$dbname = 'agriculture_management';
$username = 'root'; // Your database username
$password = ''; // Your database password


try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}

// Handle add-to-cart action
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $quantity = intval($_POST['quantity']);

    if ($quantity > 0) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['quantity'] += $quantity;
        } else {
            $_SESSION['cart'][$product_id] = ['name' => $product_name, 'quantity' => $quantity];
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Buy Crops, Vegetables & Fruits</title>
    <link rel="stylesheet" href="styles.css">
    <style>
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
   
    color: #4CAF50;
    text-align: center;
    padding: 50px;
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

/* Products container grid */
.products-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 20px;
    margin-top: 30px;
}

/* Individual product item styling */
.product-item {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 12px;
    padding: 20px;
    width: 250px;
    text-align: center;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.product-item:hover {
    transform: translateY(-10px);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
}

/* Product Image */
.product-item img {
    width: 100%;
    height: auto;
    border-radius: 12px;
    margin-bottom: 15px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.product-item img:hover {
    transform: scale(1.05);
}

/* Product Name */
.product-item h3 {
    font-size: 1.8em;
    color: #4CAF50;
    margin-bottom: 10px;
    text-transform: capitalize;
    font-weight: bold;
}

/* Product Price */
.product-item p {
    font-size: 1.3em;
    color: #555;
    margin-bottom: 15px;
    font-weight: 600;
}

/* Form for adding to cart */
.product-item form {
    display: flex;
    flex-direction: column;
    align-items: center;
}

/* Quantity input styling */
.product-item input[type="number"] {
    width: 80px;
    padding: 8px;
    margin: 10px 0;
    text-align: center;
    font-size: 1.1em;
    border-radius: 8px;
    border: 1px solid #ccc;
    transition: border-color 0.3s ease;
}

.product-item input[type="number"]:focus {
    outline: none;
    border-color: #4CAF50;
}

/* Add to Cart button */
.product-item button {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 12px 25px;
    border-radius: 8px;
    cursor: pointer;
    font-size: 1.2em;
    transition: background-color 0.3s, transform 0.2s;
    width: 100%;
}

.product-item button:hover {
    background-color: #45a049;
    transform: scale(1.05);
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
    position: fixed;
    width: 120px;
    
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
    background-color:c;
}
.button{
    display: flex;
    justify-content:end;
}
        .navbar {
            height: 50px;
            display: flex;
           justify-content:end;
            align-items: center;
            background-color: #4CAF50;
            padding: 1rem;
       
            position: fixed;
            width: 100%;
           
        }
        .navbar a {
            font-size:20px;
            margin:20px;
       color:white;
            text-decoration: none;
            padding: 0.5rem 1rem;
        }
        .navbar a:hover {
            background-color:black;
            border-radius: 5px;
        }
        .content {
            padding: 3rem;
            text-align: center;
        }
        .navbar .icons {
            display: flex;
            align-items: center;
        }
    </style>

</head>
<body>
     <div class="navbar">
        <a href="customer.php">Home</a>
        <a href="buy_crops.php">Buy Crops</a>
        <a href="faqc.php">FAQs</a>
        <div class="icons">
        <a href="cart.php">Cart🛒</a>
        <a href="logout.php">Logout</a>
        <a href="profile.php">🙎</a>
    </div>
       
    </div>
    <header>
        <h1>Welcome to the Online Crop & Vegetable Market</h1>
    </header>
    <div class="button">
    <a href="cart.php" class="btn">View Cart</a>
    </div>
    
    <main>
        <h2>Available Products</h2>
      
        <div class="products-container">
            <?php
            // Fetch products from database
            $stmt = $pdo->prepare("SELECT * FROM products1");
            $stmt->execute();
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($products as $product) {
                 echo '
                <div class="product-item">
                  <img class="product-image" src="images/' . strtolower(str_replace(' ', '_', $product['name'])) . '.jpg" alt="' . htmlspecialchars($product['name']) . '">
                    <h3>' . htmlspecialchars($product['name']) . '</h3>
                    <p>Price: $' . number_format($product['price'], 2) . '</p>
                    <form method="POST">
                        <input type="hidden" name="product_id" value="' . $product['id'] . '">
                        <input type="hidden" name="product_name" value="' . $product['name'] . '">
                        <label for="quantity">Quantity:</label>
                        <input type="number" name="quantity" min="1" value="1">
                        <button type="submit">Add to Cart</button>
                    </form>
                </div>
            ';
            }
            ?>
        </div>
       
    </main>
    <footer>
        <p>&copy; 2024 Crop Market</p>
    </footer>
</body>
</html>
