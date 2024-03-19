<?php
// Include the connection file
include 'connection.php';

// Check if delete button is clicked
if (isset($_GET['delete']) && isset($_GET['delete'])) {
    // Get the user ID to be deleted
    $userID = $_GET['delete'];

    // Prepare and execute SQL DELETE statement
    $sql = "DELETE FROM users WHERE UserID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userID);

    if ($stmt->execute()) {
        // Redirect to manage_users.php after successful deletion
        header("Location: manage_users.php");
        exit(); // Ensure that script execution stops after redirection
    } else {
        // Error deleting user
        echo "Error deleting user: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
