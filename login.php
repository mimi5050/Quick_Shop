<?php
// Start session
session_start();

// Check if there's an error message in the session
$error_message = isset($_SESSION['error']) ? $_SESSION['error'] : '';
unset($_SESSION['error']); // Clear the error message from session after displaying it

// Include the database connection file
include 'connection.php';

// Timeout duration in seconds (e.g., 30 minutes)
$timeout_duration = 1800;

// Define $stmt outside the if ($_SERVER["REQUEST_METHOD"] == "POST") block
$stmt = null;

// Check if the user is logged in
if (isset($_SESSION['logged_in'])) {
    // Check if the last activity time is set
    if (isset($_SESSION['last_activity'])) {
        // Calculate the difference between the current time and the last activity time
        $last_activity_time = $_SESSION['last_activity'];
        $current_time = time();
        $elapsed_time = $current_time - $last_activity_time;

        // Check if the elapsed time exceeds the timeout duration
        if ($elapsed_time > $timeout_duration) {
            // Destroy the session and log the user out
            session_destroy();
            header("Location: login.php");
            exit();
        }
    }

    // Update the last activity time
    $_SESSION['last_activity'] = time();

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
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare SQL statement to select user with given email
    $stmt = $conn->prepare("SELECT * FROM users WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User found, verify password
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['Password'])) {
            // Password is correct, set session variables and redirect to appropriate dashboard
            $_SESSION['logged_in'] = true;
            $_SESSION['UserID'] = $row['UserID'];
            $_SESSION['Name'] = $row['Name'];
            $_SESSION['Role'] = $row['Role'];
            $_SESSION['last_activity'] = time(); // Set the last activity time

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
            $_SESSION['error'] = " Ooooops!Incorrect email or password";
            header("Location: login.php");
            exit();
        }
    } else {
        // User not found
        $_SESSION['error'] = " Ooooops! User not found";
        header("Location: login.php");
        exit();
    }
}

// Close the database connection only if $stmt is not null
if ($stmt !== null) {
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - QuickShop Administrator</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .login-container {
      background-color: #fff;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      max-width: 400px;
      width: 100%;
      text-align: center;
    }

    .login-container h2 {
      margin-top: 0;
      color: #A5494D;
    }

    .form-group {
      margin-bottom: 20px;
      text-align: left;
    }

    .form-group label {
      display: block;
      font-weight: bold;
      color: #A5494D;
      margin-bottom: 5px;
    }

    .form-group input[type="email"],
    .form-group input[type="password"] {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    button[type="submit"] {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      color: #fff;
      background-color: #A5494D;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button[type="submit"]:hover {
      background-color: #800000;
    }

    .footer-text {
      margin-top: 20px;
      font-size: 14px;
      color: #666;
    }

    .error-message {
      color: red;
      margin-bottom: 10px;
      text-align:bottom;
      font-size:18px;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>Login to QuickShop</h2>
    <?php if (!empty($error_message)): ?>
      <p class="error-message"><?php echo $error_message; ?></p>
    <?php endif; ?>
    <form id="login-form" action="login.php" method="POST">
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
      </div>
      <button type="submit">Login</button>
    </form>
    <p class="footer-text">Don't have an account? <a href="signUp.php">Register here</a></p>
  </div>
</body>
</html>
