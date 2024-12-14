<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agriculture_management";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $address = $_POST['address'];
    
    // Insert crop data into the database
    $sql = "INSERT INTO orders(customer_name,address) VALUES (?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $name,$address);

    if ($stmt->execute()) {
        echo "<script>alert('Order Confirmed');</script>";
    } else {
        echo "<p style='color: red;'>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>

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


    </style>
</head>
<body>
    <header>
        <h1>Checkout</h1>
    </header>
    <main>
        <form method="POST">
            <label for="name">Your Name:</label>
            <input type="text" name="name" required><br><br>
            <label for="address">Your Address:</label>
            <input type="text" name="address" required><br>
            <button type="submit" class="btn">Submit Order</button>
        </form>
    </main>
    <footer>

        <p>&copy; 2024 Crop Market</p>
    </footer>
</body>
</html>
