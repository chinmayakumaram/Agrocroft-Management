

<?php
// Start session and include database connection
session_start();
require_once 'conn.php';


// Fetch necessary data for the admin dashboard
$query = "SELECT * FROM user WHERE usertype='Farmer' "; // Example query to fetch user data
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmer Handling Dashboard</title>
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
    margin:30px;
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
    margin-top:15px;
    margin-bottom: 1px;
    color: #4CAF50;
    text-transform: uppercase;
    text-align: center;
    font-weight: bold;
}
        .navbar {
            height: 60px;
            display: flex;
          
           justify-content:end;
            align-items: center;
            background-color: rgba(51, 51, 51, 0.8);
            padding: 1rem;
            padding: 1rem;
            position: fixed;
            width: 100%;
           
        }
        .logo{
        color:white;
        font-size:20px;
     }
        .navbar a {
            margin:20px;
       color:white;
            text-decoration: none;
            padding: 0.5rem 1rem;
            font-size:20px;
        }
        .navbar a:hover {
            background-color: #4CAF50;
            border-radius: 5px;
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
<div class="navbar">
    <div>
      
        <a href="farmer_handle.php">Home</a>
        <a href="crop_guideh.php">Crop Guide</a>
        <a href="farmer_products.php">Products</a>
    </div>
    </div>
    <header>
        <h1>Farmer Handling Dashboard</h1>
        </header>
        <body>
 
   
    <main>
        <section>
            <h2>User Management</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>UserName</th>
                        <th>Name</th>
                        <th>User Type</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?= $row['id']; ?></td>
                            <td><?= $row['username']; ?></td>
                            <td><?= $row['name']; ?></td>
                            <td><?= $row['usertype']; ?></td>
                            <td><?= $row['created_at']; ?></td>
                            <td>
                                <a class="logout-button" style="background-color:#4CAF50;" href="edit_user.php?id=<?= $row['id']; ?>">Edit</a>
                                <a class="logout-button"  href="delete_user.php?id=<?= $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
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
