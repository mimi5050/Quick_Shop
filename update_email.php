<?php
session_start();
include 'connection.php';

// Check if the user is logged in
if (isset($_SESSION['UserID'])) {
    $user_id = $_SESSION['UserID'];
    $new_email = $_POST['new_email'];
    $password = $_POST['password'];

    // Retrieve the hashed password from the database
    $sql = "SELECT Password FROM users WHERE UserID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['Password'];

        // Verify the password against the hashed password
        if (password_verify($password, $hashed_password)) {
            // Update the email address in the database
            $update_sql = "UPDATE users SET Email=? WHERE UserID=?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("si", $new_email, $user_id);
            if ($update_stmt->execute()) {
                echo "Email updated successfully.";
            } else {
                echo "Failed to update email: " . $conn->error;
            }
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "User not found.";
    }
} else {
    echo "Invalid request.";
}

// Close the database connection
$conn->close();
?>
