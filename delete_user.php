<?php
// Include the database connection file
include 'conn.php';

// Check if the user ID is provided via GET or POST
if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']); // Sanitize the input

    // Prepare the SQL statement to delete the user
    $sql = "DELETE FROM user WHERE id = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        // Bind the user ID to the prepared statement
        $stmt->bind_param("i", $user_id);

        // Execute the statement
        if ($stmt->execute()) {
            echo "User with ID $user_id has been deleted successfully.";
        } else {
            echo "Error: Could not execute the delete operation.";
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error: Could not prepare the delete statement.";
    }
} else {
    echo "Error: No user ID provided.";
}

// Close the database connection
$conn->close();
?>
