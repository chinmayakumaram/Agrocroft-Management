<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
        .error-message {
            color: red;
            margin-bottom: 15px;
        }
        .createName {
            text-align: center;
            text-decoration:none;
        }
        .twoText {
            display: flex;
            justify-content: space-between;
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
<body>
    
<?php
session_start();
include "conn.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $usertype = trim($_POST['usertype']);

    $stmt = $conn->prepare("SELECT * FROM user WHERE username = ? AND password = ? AND usertype= ?  ");
    $stmt->bind_param("sss", $username, $password,$usertype);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0 &&  $usertype=="User") {
        // Set session variable
        $_SESSION['username'] = $username;
        $_SESSION['User'] = $usertype;
        header("Location: customer.php"); // Redirect to the main page
        exit();
    } 
    elseif($result->num_rows > 0 && $usertype=="Admin" && $password=="20052005") {
        // Set session variable
        $_SESSION['username'] = $username;
        $_SESSION['Admin'] = $usertype;
        header("Location: admin.php"); // Redirect to the main page
        exit();
    } 
    elseif($result->num_rows > 0 && $usertype=="Farmer") {
        // Set session variable
        $_SESSION['username'] = $username;
        $_SESSION['Farmer'] = $usertype;
        header("Location: former.php"); // Redirect to the main page
        exit();
    } 
    
    
    else {
        echo "<script>alert('Invalid username or password');</script>";
    }
}
?>
    <div class="login-card">
        <h2>Login</h2>
        <form action="" method="post" id="loginForm">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="chinmaya@gmail.com">
            </div>
            <div class="form-group">    
                <label for="password">Password</label>
                <input type="password" id="password" name="password"  placeholder="chinmaya@2005">
            </div>
            <div class="form-group">
            <select name="usertype" required>
                        <option value="">Select Usertype</option>
                        <option value="Admin">Admin</option>
                        <option value="Farmer">Farmer</option>
                        <option value="User">Customer</option>
                    </select>
            </div>
            <div class="twoText">
                        <div>
                            <input type="checkbox" name="remember" id="remember"> Remember me
                        </div>
                        <a href="forgot_password.php"  style="  text-decoration:none;">Forgot password?</a><br>
                    </div><br>
            <div class="form-group">
                <button type="submit">Login</button>
            </div>
            <div class="createName">
                        <a href="signup.php" class="createName">Create an Account</a>
                    </div>
        
           </form>
    </div>
</body>
</html>
