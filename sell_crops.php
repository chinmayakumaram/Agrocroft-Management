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
    $crop_name = $_POST['crop_name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $farmer_name = $_POST['farmer_name'];
    $phone = $_POST['phone'];
    $image=$_POST['image'];
    // Insert crop data into the database
    $sql = "INSERT INTO sell(crop_name, quantity, price, farmer_name ,phone , image) VALUES (?, ?, ?, ?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sidsss", $crop_name, $quantity, $price, $farmer_name , $phone,$image);

    if ($stmt->execute()) {
        echo "<script>alert('Crop Listed Successfully');</script>";
    } else {
        echo "<p style='color: red;'>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sell Crops</title>
    <style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f9f9f9;
    background-image:url("https://i0.wp.com/razzanj.com/wp-content/uploads/2016/07/nature-landscape-nature-landscape-hd-image-download-wheat-farm-hd-wallpaper-notebook-background-wheat-farmers-wheat-farming-process-wheat-farming-in-kenya.jpg?ssl=1");
    background-repeat: no-repeat;
    background-size:cover;
}

.form-container {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    max-width: 800px;
    width: 100%;
}

.form-container h1 {
    margin-bottom: 20px;
    font-size: 1.8em;
    color: #333;
    text-align: center;
}

.form-container label {
    display: block;
    margin-bottom: 8px;
    font-size: 0.9em;
    color: #555;
}

.form-container input {
    width: 95%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 0.9em;
    transition: border-color 0.3s;
}

.form-container input:focus {
    border-color: #28a745;
    outline: none;
    box-shadow: 0 0 5px rgba(40, 167, 69, 0.5);
}



@media (max-width: 768px) {
    .form-container {
        padding: 15px;
    }

    .form-container h1 {
        font-size: 1.5em;
    }

    
}

@media (max-width: 480px) {
    .form-container {
        padding: 10px;
    }

    .form-container h1 {
        font-size: 1.3em;
    }
}
.remove-btn {
       text-decoration:none;
        color: black;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 1.1em;
        background-color: #e53935;
        transition: background-color 0.3s, transform 0.2s;
        text-align: center;
    }

    .remove-btn:hover {
      
        transform: scale(1.05);
    }

    </style>
</head>
<body>
    <div class="form-container">
        <h1>Sell Your Crops</h1>
        <form method="POST" action="">
            <label for="crop_name">Crop Name:</label>
            <input type="text" id="crop_name" name="crop_name" placeholder="cropname" required>

            <label for="quantity">Quantity (kg):</label>
            <input type="number" id="quantity" name="quantity" required>

            <label for="price">Price per kg (in $):</label>
            <input type="number" id="price" name="price" step="0.01" required>

            <label for="farmer_name">Your Name:</label>
            <input type="text" id="farmer_name" name="farmer_name" required>

            <label for="phone">Your Phone NUmber:</label>
            <input type="text" id="phone" name="phone" required>
            <label for="image">Product Image(cropname.jpg):</label>
          <input type="file" name="image" accept="image/*"  required>

            <button type="submit"  class="remove-btn" style="background-color: #4CAF50;">Submit</button>
            <a href="former.php" class="remove-btn">Back</a>
        </form>
    </div>




    
</body>
</html>
