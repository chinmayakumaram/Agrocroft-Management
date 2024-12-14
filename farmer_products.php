<?php
session_start();
include "conn.php";

// Fetch necessary data for the admin dashboard
$query = "SELECT * FROM sell"; // Example query to fetch user data
$result = $conn->query($query);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data safely
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $filter =trim($_POST['filter'] );
    $price = isset($_POST['price']) ? $_POST['price'] : '';

    // Check if all required fields are provided
    if (empty($name) || empty($filter)  || empty($price)) {
        echo "<p style='color: red;'>All fields are required.</p>";
    } else {
        // Insert crop data into the database
        $sql = "INSERT INTO products (name, category, price) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        
        if ($stmt) {
            // Bind the parameters and execute the statement
            $stmt->bind_param("ssd", $name, $filter, $price);
            
            if ($stmt->execute()) {
                echo "<script>alert('product Added Successfully');</script>";
            } else {
                echo "<p style='color: red;'>Error: " . $stmt->error . "</p>";
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "<p style='color: red;'>Error preparing statement: " . $conn->error . "</p>";
        }
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmer Crop Guide</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            text-align:center;
            
        }
        .container {
            text-align:start;
            max-width:1300px;
            margin: 20px auto;
            background: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .search {
            margin-bottom: 20px;
        }
        .search form {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .search input, .search select, .search label {
            flex: 1 1 calc(50% - 10px);
            padding: 10px;
            font-size: 16px;
        }
        .search input[type="file"] {
            flex: 1 1 100%;
        }
        .search button {
            padding: 10px;
            font-size: 16px;
            background: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            flex: 1 1 100%;
        }
        .search button:hover {
            background: #218838;
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
            text-decoration:none;
        }
        .logout-button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Add Products to farmer Portal</h1>
        <div class="search">
            <form method="POST">
                <label for="name">Crops:</label>
                <input type="text" name="name"required>
                
                <label for="filter">Category:</label>
                <select name="filter" required>
                    <option value="">Select Category</option>
                    <option value="Seeds">Seeds</option>
                    <option value="Medicine">Medicines</option>
                    <option value="Farming Supplies">Farming Supplies</option>
                  
                </select>
                 <label for="price">Price:</label>
                <input type="text" id="price" name="price" required>

                <button type="submit">Add Products to farmer Portal </button>
            </form>
        </div>
    </div>
    
    <main>
        <section>
            <h2>Farmer Crops  Management</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Crop Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Farmer Name</th>
                        <th>Phone Number</th>
                    
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?= $row['id']; ?></td>
                            <td><?= $row['crop_name']; ?></td>
                            <td><?= $row['quantity']; ?></td>
                            <td><?= $row['price']; ?></td>
                            <td><?= $row['farmer_name']; ?></td>
                            <td><?= $row['phone']; ?></td>
                    
                            <td>
                                <a class="logout-button"  href="delete_farmer_product.php?id=<?= $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
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
