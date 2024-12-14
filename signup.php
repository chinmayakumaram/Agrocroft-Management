<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background:url("https://plus.unsplash.com/premium_photo-1661962692059-55d5a4319814?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D") ;
            background-size: cover;
        }
        .login-card {
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
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 95%;
            padding: 12px;
            border-radius: 6px;
            border: 1px solid #ddd;
        }
        .form-group button {
            width: 100%;
            padding: 12px;
            background-color: #28a745;
            border: none;
            border-radius: 6px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #218838;
        }
       
        .createName {
            text-align: center;
            text-decoration:none;
        }
        select {
            width: 100%;
            border-radius: 50px;
            height: 30px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body><?php
// Start session
session_start();

include "conn.php";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $name = trim($_POST['name']);
    $password = trim($_POST['password']);
    $confirmpassword = trim($_POST['confirmpassword']);
    $usertype = trim($_POST['usertype']);
    
    // Validate inputs
    if (empty($username) ||empty($name)|| empty($password) ||empty( $confirmpassword) ||empty($usertype)) {
        echo "<script>alert('All fields are required!'); window.location.href='signup.php';</script>";
        exit();
    } else if (strlen($password) < 6) {
        echo "<script>alert('Password must be at least 6 characters long!'); window.location.href='signup.php';</script>";
        exit();
    }
    
    if ($password !== $confirmpassword) {
        echo "<script>alert('Passwords do not match!'); window.location.href='signup.php';</script>";
        exit();
    }
    

    // Check if the username already exists
    $stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Username already exists. Please choose another!')</script>";
    }
    elseif($usertype=="Admin" && $password=="20052005" && $confirmpassword =="20052005")
    { 
         // Insert user into the database
         $stmt = $conn->prepare("INSERT INTO user (username,name, password,  usertype) VALUES (?, ?, ?,?)");
         $stmt->bind_param("ssss", $username,$name, $password , $usertype);
 
         if ($stmt->execute()) {
             echo "<script>alert('Registered Successfully !!!'); window.location.href='login.php';</script>";
         exit();
         } else {
             echo "Error: " . $stmt->error;
         }

    }  
    


    elseif($usertype=="User" || $usertype=="Farmer" ) {
        // Insert user into the database
        $stmt = $conn->prepare("INSERT INTO user (username,name, password, usertype) VALUES (?,  ?,?,?)");
        $stmt->bind_param("ssss", $username,$name, $password, $usertype);

        if ($stmt->execute()) {
            echo "<script>alert('Registered Successfully !!!'); window.location.href='login.php';</script>";
        exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    $stmt->close();
}


$conn->close();
?>


    <div class="login-card">
        <h2>Sign Up</h2>
        <form action="" method="post" id="loginForm">
        <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="chinmaya@gmail.com">
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" placeholder="chinmaya">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="chinmaya@2005">
            </div>
            <div class="form-group">
                <label for="confirmpassword">Confirm Password</label>
                <input type="confirmpassword" id="confirmpassword" name="confirmpassword" placeholder="chinmaya@2005">
            </div>
            <div class="form-group">
            <select name="usertype" required>
                        <option value="">Select Usertype</option>
                        <option value="Admin">Admin</option>
                        <option value="Farmer">Farmer</option>
                        <option value="User">Customer</option>
                    </select>
            </div>
            <div class="form-group">
                <button type="submit">Sign Up</button>
            </div>
            <div class="createName">
                    <a href="login.php" class="createName">Already have an account? Login</a>
                </div>
           </form>
    </div>
</body>
</html>
