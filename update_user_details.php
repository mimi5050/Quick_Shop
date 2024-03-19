<?php
session_start();
include 'connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $user_id = $_POST['user_id'];
    $name = $_POST['Name'];
    $email = $_POST['Email'];
    $password = password_hash($_POST['Password'], PASSWORD_DEFAULT); // Hash the password
    $role = $_POST['Role'];

    // Update the user details in the database
    $sql = "UPDATE Users SET Name = ?, Email = ?, Password = ?, Role = ? WHERE UserID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $name, $email, $password, $role, $user_id);

    if ($stmt->execute()) {
        // Redirect to a success page or display a success message
        header("location: manage_users.php");
    } else {
        // Handle the update failure
        echo "Update failed: " . $stmt->error;
    }
}

// Close the database connection
$conn->close();
?>
