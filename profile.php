<?php
session_start();
include "conn.php";  // Include the database connection

// Check if the user is logged in, otherwise redirect to login page
if (!isset($_SESSION['username'])) {
    // header("Location: login.php");
    exit();
}

// Get user information from the session or the database
$username = $_SESSION['username'];
$usertype = isset($_SESSION['User']) ? 'User' : (isset($_SESSION['Admin']) ? 'Admin' : (isset($_SESSION['Farmer']) ? 'Farmer' : ''));

// Fetch user details from the database (optional, depending on your needs)
$stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

$user_data = null;
if ($result->num_rows > 0) {
    $user_data = $result->fetch_assoc(); // Fetch user data
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: url("https://i0.wp.com/razzanj.com/wp-content/uploads/2016/07/nature-landscape-nature-landscape-hd-image-download-wheat-farm-hd-wallpaper-notebook-background-wheat-farmers-wheat-farming-process-wheat-farming-in-kenya.jpg?ssl=1") ;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .profile-card {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 400px;
        }
        h2 {
            margin: 0 0 20px;
            text-align: center;
        }
        .profile-info {
            margin-bottom: 20px;
        }
        .profile-info label {
            font-weight: bold;
        }
        .profile-info p {
            margin: 5px 0;
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
            text-decoration:none;
        }
        .logout-button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="profile-card">
        <h2>User Profile</h2>
        
        <?php if ($user_data): ?>
            <div class="profile-info">
                <label for="username">Username:</label>
                <p id="username"><?php echo htmlspecialchars($user_data['username']); ?></p>
            </div>
            <div class="profile-info">
                <label for="usertype">User Type:</label>
                <p id="usertype"><?php echo htmlspecialchars($usertype); ?></p>
            </div>
            <!-- Add more profile details as needed -->
        <?php else: ?>
            <p>No user data found.</p>
        <?php endif; ?>

        <a href="forgot_password.php" class="logout-button" style="background-color:#4CAF50;">change Password</a>
         <a href="logout.php" class="logout-button">Logout</a>

    </div>
</body>
</html>
