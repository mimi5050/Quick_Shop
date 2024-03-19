<?php
session_start();
include 'connection.php';

// Check if the user is logged in
if (isset($_SESSION['UserID'])) {
    $user_id = $_SESSION['UserID'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];

    // Retrieve the hashed password from the database
    $sql = "SELECT Password FROM users WHERE UserID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['Password'];

        // Verify the old password against the hashed password
        if (password_verify($old_password, $hashed_password)) {
            // Hash the new password
            $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Update the password in the database
            $update_sql = "UPDATE users SET Password=? WHERE UserID=?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("si", $new_hashed_password, $user_id);
            if ($update_stmt->execute()) {
                echo "Password updated successfully.";
            } else {
                echo "Failed to update password: " . $conn->error;
            }
        } else {
            echo "Incorrect old password.";
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
