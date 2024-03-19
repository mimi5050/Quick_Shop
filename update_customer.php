<?php
session_start();
include 'connection.php';

// Check if the user is logged in and the form is submitted
if (isset($_SESSION['UserID']) && isset($_POST['submit'])) {
    $name = $_POST['Name'];
    $user_id = $_SESSION['UserID'];
    $Email = $_POST['email'];
    $Role = $_POST['role'];

    $sql = "UPDATE users SET Name = ?, Email= ?, Role = ? WHERE UserID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $Email, $Role, $user_id);

    if ($stmt->execute()) {
        header("location: Customer-profile.php");
        exit(); // Stop further execution
        
    } else {
        echo "Update failed: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}

// Close the database connection
$conn->close();
?>
