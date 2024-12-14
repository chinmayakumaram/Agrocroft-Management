<?php
// Start session and include database connection
session_start();
require_once 'conn.php';

// Fetch necessary data for the admin dashboard
$query = "SELECT * FROM orders"; // Example query to fetch user data
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        /* Inline CSS for demonstration */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            width: 100%;
        }
        
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
            width: 100%;
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
            margin: 30px;
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
            margin-top: 15px;
            margin-bottom: 1px;
            color: #4CAF50;
            text-transform: uppercase;
            text-align: center;
            font-weight: bold;
        }
        
        main {
            padding: 2rem;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 1rem 0;
        }
        
        table th, table td {
            border: 1px solid #ddd;
            padding: 0.5rem;
            text-align: center;
        }
        
        table th {
            background: #333;
            color: #fff;
        }
        
        footer {
            text-align: center;
            padding: 1rem 0;
            background: #333;
            color: #fff;
        }
        
        .logout-button {
            width: 100%;
            padding: 5px;
            background-color: #dc3545;
            border: none;
            border-radius: 6px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
        }
        
        .logout-button:hover {
            background-color: #c82333;
        }
        
        .remove-btn {
            text-decoration: none;
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

        .form-container {
            background: #fff;
            width: 100%;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
          
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin: 0 auto; /* Center the form horizontally */
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
            width: 100%;
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
    </style>
</head>
<body>

    <header>
        <h1>Customer Handling Dashboard</h1>
    </header>
    
    <main>
    <?php

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image=$_POST['image'];
    // Insert crop data into the database
    $sql = "INSERT INTO products1(name,price, image) VALUES (?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sds", $name,  $price, $image);

    if ($stmt->execute()) {
        echo "<script>alert('Produc Added Successfully');</script>";
    } else {
        echo "<p style='color: red;'>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
}


?>
    <section>
          <h2>Product Management</h2>
            <div class="form-container">
                <h1>Add Products to Customer Portal</h1>
                <form method="POST" action="">
                    <label for="crop_name">Product Name:</label>
                    <input type="text" id="name" name="name" required>

                    
                    <label for="price">Price per kg (in $):</label>
                    <input type="number" id="price" name="price" step="0.01" required>

                   
                    <label for="image">Product Image:</label>
                    <input type="file" name="image" accept="image/*" required>

                    <button type="submit" class="remove-btn" style="background-color: #4CAF50;">Submit</button>
                    <a href="admin.php" class="remove-btn">Back</a>
                </form>
            </div>
        </section>
            <h2>Order Management</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer Name</th>
                        <th>Address</th>
                        <th>Order Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?= $row['id']; ?></td>
                            <td><?= $row['customer_name']; ?></td>
                            <td><?= $row['address']; ?></td>
                            <td><?= $row['order_date']; ?></td>
                            <td>
                                <a class="logout-button" style="background-color:#4CAF50;" href="?id=<?= $row['id']; ?>">Order Accept</a>
                                <a class="logout-button"  href="?id=<?= $row['id']; ?>" onclick="return confirm('Are you sure?')">Order Reject</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </section>
        <?php
$query = "SELECT * FROM products1"; // Example query to fetch user data
$result = $conn->query($query);
?>
        <h2>Product Management</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>price</th>
        
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?= $row['id']; ?></td>
                            <td><?= $row['name']; ?></td>
                            <td><?= $row['price']; ?></td>
                        
                            <td>
                                <a class="logout-button" style="background-color:#4CAF50;" href="edit_products.php?id=<?= $row['id']; ?>">Edit</a>
                                <a class="logout-button"  href="delete_cus_product.php?id=<?= $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </section>
    </main>
    
    <footer>
        <p>&copy; <?= date('Y'); ?> Admin Dashboard</p>
    </footer>
</body>
</html>
