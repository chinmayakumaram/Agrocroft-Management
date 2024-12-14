<?php
session_start();
include "conn.php";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data safely
    $name = isset($_POST['search']) ? $_POST['search'] : '';
    $filter =trim($_POST['filter'] );
    $season = isset($_POST['season']) ? $_POST['season'] : '';
    $description = isset($_POST['dis']) ? $_POST['dis'] : '';

    // Check if all required fields are provided
    if (empty($name) || empty($filter) || empty($season) || empty($description)) {
        echo "<p style='color: red;'>All fields are required.</p>";
    } else {
        // Insert crop data into the database
        $sql = "INSERT INTO crops (name, category, season, description) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        
        if ($stmt) {
            // Bind the parameters and execute the statement
            $stmt->bind_param("ssss", $name, $filter, $season, $description);
            
            if ($stmt->execute()) {
                echo "<script>alert('Added Successfully');</script>";
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
            background: url("https://i0.wp.com/razzanj.com/wp-content/uploads/2016/07/nature-landscape-nature-landscape-hd-image-download-wheat-farm-hd-wallpaper-notebook-background-wheat-farmers-wheat-farming-process-wheat-farming-in-kenya.jpg?ssl=1") ;
            background-size: cover;
            background-color: #f4f4f4;
         
        }
        .container {
            max-width: 900px;
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
        
        .logout-button {
            width: 100%;
            padding: 12px;
            background-color:#28a745;
            border: none;
            border-radius: 6px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            text-align:center;
            text-decoration:none;
        }
        .logout-button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Farmer Crop Guide</h1>
        <div class="search">
            <form method="POST">
                <label for="search">Crops:</label>
                <input type="text" name="search" placeholder="Enter crop name..." required>
                
                <label for="filter">Category:</label>
                <select name="filter" required>
                    <option value="">Select Category</option>
                    <option value="Fruit">Fruit</option>
                    <option value="Vegetable">Vegetable</option>
                    <option value="Grain">Grain</option>
                </select>

                <label for="season">Season:</label>
                <input type="text" id="season" name="season" placeholder="e.g., Summer" required>

                <label for="dis">Description:</label>
                <input type="text" id="dis" name="dis" required>

                <button type="submit">Add Crop Suggestions</button>
                <h5>OR</h5>
             <a href="update_crop.php" class="logout-button">Update Crop Suggestions</a>
            </form>
        </div>
    </div>
    
</body>
</html>
