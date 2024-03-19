<?php
// Include the database connection file
include 'connection.php';

// Start session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check user credentials
    $sql = "SELECT * FROM users WHERE Email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User found, verify password
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['Password'])) {
            // Password is correct, set session variables and redirect to appropriate dashboard
            $_SESSION['UserID'] = $row['UserID'];
            $_SESSION['Name'] = $row['Name'];
            $_SESSION['Role'] = $row['Role'];
            
            // Redirect based on user's role
            switch ($_SESSION['Role']) {
                case 'administrator':
                    header("Location: admin.php");
                    exit();
                case 'customer':
                    header("Location: Customer-Homepage.php");
                    exit();
                case 'sales_manager':
                    header("Location: sales_dash.php");
                    exit();
                case 'inventory_manager':
                    header("Location: manageorders.php");
                    exit();
                default:
                    // Default redirection if role is not recognized
                    header("Location: login.php");
                    exit();
            }
        } else {
            // Incorrect password
            $_SESSION['error'] = "Incorrect email or password";
            header("Location: login.php");
            exit();
        }
    } else {
        // User not found
        $_SESSION['error'] = "User not found";
        header("Location: login.php");
        exit();
    }
}

// Close the database connection
$conn->close();
?>
