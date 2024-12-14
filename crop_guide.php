<?php
// Farmer Crop Guide Page

// Database connection (replace with your actual database credentials)
$host = 'localhost';
$dbname = 'agriculture_management';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Fetch crops based on user search or filter
$search = isset($_GET['search']) ? $_GET['search'] : '';
$filter = isset($_GET['filter']) ? $_GET['filter'] : '';

$query = "SELECT * FROM crops WHERE name LIKE :search";
$params = [':search' => "%$search%"];

if ($filter) {
    $query .= " AND category = :filter";
    $params[':filter'] = $filter;
}

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$crops = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
            display: flex;
            justify-content: space-between;
        }
        .search input, .search select {
            padding: 10px;
            width: 48%;
            font-size: 16px;
        }
        .search button {
            padding: 10px;
            font-size: 16px;
            background: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
        .search button:hover {
            background: #218838;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f8f9fa;
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
    <div class="container">
        <h1>Farmer Crop Guide</h1>

        <div class="search">
            <form method="get" style="width: 100%; display: flex;">
                <input type="text" name="search" placeholder="Search for crops..." value="<?php echo htmlspecialchars($search); ?>">
                <select name="filter">
                    <option value="">All Categories</option>
                    <option value="Fruit" <?php if ($filter === 'Fruit') echo 'selected'; ?>>Fruit</option>
                    <option value="Vegetable" <?php if ($filter === 'Vegetable') echo 'selected'; ?>>Vegetable</option>
                    <option value="Grain" <?php if ($filter === 'Grain') echo 'selected'; ?>>Grain</option>
                </select>
                <button type="submit">Search</button>
            </form>
        </div>

        <?php if (count($crops) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Season</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($crops as $crop): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($crop['name']); ?></td>
                            <td><?php echo htmlspecialchars($crop['category']); ?></td>
                            <td><?php echo htmlspecialchars($crop['season']); ?></td>
                            <td><?php echo htmlspecialchars($crop['description']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p  style="color: red;">No crops found. Try adjusting your search or filter.</p>
        <?php endif; ?>
    </div>
    <footer>
        <p>&copy; <?= date('Y'); ?> Farmer Dashboard</p>
    </footer>
</body>
</html>
