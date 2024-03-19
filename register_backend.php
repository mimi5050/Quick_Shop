<?php
// Include the database connection file
include 'connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Plain text password

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $role = $_POST['role'];

    // Insert data into the database using prepared statements
    $stmt = $conn->prepare("INSERT INTO users (Name, Email, Password, Role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $hashed_password, $role);
    $stmt->execute();
    $stmt->close();

    // Redirect to the login page
    header("location: login.php");
    exit();
}
?>
