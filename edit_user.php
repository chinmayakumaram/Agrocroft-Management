<?php
// Include the database connection file
include 'conn.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize input data
    $user_id = intval($_POST['id']);
    $username = htmlspecialchars($_POST['username']);
    $name = filter_var($_POST['name'], FILTER_SANITIZE_EMAIL);

    // Check if required fields are provided
    if (empty($user_id) || empty($username) || empty($name)) {
        echo "Error: All fields are required.";
        exit;
    }

    // Prepare the SQL statement to update the user
    $sql = "UPDATE user SET username = ?, name= ? WHERE id = ?";

    if ($stmt = $conn->prepare($sql)) {
        // Bind the parameters to the prepared statement
        $stmt->bind_param("ssi", $username, $name, $user_id);

        // Execute the statement
        if ($stmt->execute()) {
            echo "User with ID $user_id has been updated successfully.";
        } else {
            echo "Error: Could not execute the update operation.";
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error: Could not prepare the update statement.";
    }
} else {
    // Display the edit form if the request is not POST
    if (isset($_GET['id'])) {
        $user_id = intval($_GET['id']);

        // Fetch the user details from the database
        $sql = "SELECT * FROM user WHERE id = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $user = $result->fetch_assoc();
                ?>
                <style>
                    body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f9;
    color: #333;
    line-height: 1.6;
    background:url("https://plus.unsplash.com/premium_photo-1661962692059-55d5a4319814?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D") ;
    background-size: cover;
}

form {
    max-width: 500px;
    margin: 2rem auto;
    padding: 1.5rem;
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

form label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: bold;
}

form input[type="text"],
form input[type="email"] {
    width: 100%;
    padding: 0.5rem;
    margin-bottom: 1rem;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
}

form button {
    display: inline-block;
    padding: 0.5rem 1rem;
    background: #333;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 1rem;
}

form button:hover {
    background: #555;
}

form input:focus {
    border-color: #555;
    outline: none;
    box-shadow: 0 0 3px rgba(0, 0, 0, 0.2);
}

form .error {
    color: red;
    margin-bottom: 1rem;
    font-size: 0.9rem;
}

form .success {
    color: green;
    margin-bottom: 1rem;
    font-size: 0.9rem;
}
.button {
            width: 100%;
            padding: 12px;
            background-color: #28a745;
            border: none;
            border-radius: 6px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        .button:hover {
            background-color: #218838;
        }

                </style>
                <form method="POST" action="edit_user.php">
                    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                    <label for="username">UserName:</label>
                    <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                    <br>
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
                    <br>
                    <button type="submit" class="button">Update User</button>
                </form>
                <?php
            } else {
                echo "Error: User not found.";
            }

            $stmt->close();
        } else {
            echo "Error: Could not prepare the select statement.";
        }
    } else {
        echo "Error: No user ID provided.";
    }
}

// Close the database connection
$conn->close();
?>