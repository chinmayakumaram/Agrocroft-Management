<?php
session_start();
include "conn.php";
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
            background: url("https://i0.wp.com/razzanj.com/wp-content/uploads/2016/07/nature-landscape-nature-landscape-hd-image-download-wheat-farm-hd-wallpaper-notebook-background-wheat-farmers-wheat-farming-process-wheat-farming-in-kenya.jpg?ssl=1");
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
            background-color: #dc3545;
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
    <?php
    // Handle form submission for updating crop data
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update') {
        // Get the form data safely
        $name1 = isset($_POST['search1']) ? $_POST['search1'] : '';
        $filter1 = isset($_POST['filter1']) ? trim($_POST['filter1']) : '';
        $season1 = isset($_POST['season1']) ? $_POST['season1'] : '';
        $description1 = isset($_POST['dis1']) ? $_POST['dis1'] : '';

        // Check if all required fields are provided
        if (empty($name1) || empty($filter1) || empty($season1) || empty($description1)) {
            echo "<p style='color: red;'>All fields are required.</p>";
        } else {
            // Update crop data in the database
            $sql = "UPDATE crops SET category=?, season=?, description=? WHERE name=?";
            $stmt = $conn->prepare($sql);
            if ($stmt) {
                // Bind the parameters and execute the statement
                $stmt->bind_param("ssss", $filter1, $season1, $description1, $name1);
                if ($stmt->execute()) {
                    echo "<script>alert('Updated Successfully');</script>";
                } else {
                    echo "<p style='color: red;'>Error: " . $stmt->error . "</p>";
                }
                $stmt->close();
            } else {
                echo "<p style='color: red;'>Error preparing statement: " . $conn->error . "</p>";
            }
        }
    }

    // Handle form submission for deleting crop data
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'delete') {
        // Get the crop name
        $name1 = isset($_GET['search1']) ? $_GET['search1'] : '';

        if (!empty($name1)) {
            // Delete crop data from the database
            $sql = "DELETE FROM crops WHERE name=?";
            $stmt = $conn->prepare($sql);
            if ($stmt) {
                // Bind the parameters and execute the statement
                $stmt->bind_param("s", $name1);
                if ($stmt->execute()) {
                    echo "<script>alert('Deleted Successfully');</script>";
                } else {
                    echo "<p style='color: red;'>Error: " . $stmt->error . "</p>";
                }
                $stmt->close();
            } else {
                echo "<p style='color: red;'>Error preparing statement: " . $conn->error . "</p>";
            }
        } else {
            echo "<p style='color: red;'>Crop name is required to delete.</p>";
        }
    }
    ?>

    <div class="container">
        <h1>Update Farmer Crop Guide</h1>
        <div class="search">
            <form method="POST">
                <input type="hidden" name="action" value="update">
                <label for="search1">Crops:</label>
                <input type="text" name="search1" placeholder="Enter crop name..." required>

                <label for="filter1">Category:</label>
                <select name="filter1" required>
                    <option value="">Select Category</option>
                    <option value="Fruit">Fruit</option>
                    <option value="Vegetable">Vegetable</option>
                    <option value="Grain">Grain</option>
                </select>

                <label for="season1">Season:</label>
                <input type="text" id="season" name="season1" placeholder="e.g., Summer" required>

                <label for="dis1">Description:</label>
                <input type="text" id="dis1" name="dis1" required>

                <button type="submit">Update Crop Suggestions</button>
                <a href="farmer_handle.php" class="logout-button">Back to Farmer Handling Page</a>
            </form>
        </div>
    </div>

    <div class="container">
        <h1>Delete Farmer Crop Guide</h1>
        <div class="search">
            <form method="GET">
                <input type="hidden" name="action" value="delete">
                <label for="search1">Crops:</label>
                <input type="text" name="search1" placeholder="Enter crop name..." required>
                <button type="submit">Delete Crop Suggestions</button>
                <a href="farmer_handle.php" class="logout-button">Back to Farmer Handling Page</a>
            </form>
        </div>
    </div>
</body>
</html>
