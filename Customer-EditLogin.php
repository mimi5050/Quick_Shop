<?php
session_start();
include 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickShop - Customer</title>
    <script src="https://kit.fontawesome.com/a3c696c988.js" crossorigin="anonymous"></script>
    <!-- CSS code-->
    <style>
        /* body styling */
        body {
            margin: 0;
            font-family: 'Times New Roman', sans-serif;
            background-color: #ffffff;
        }

        /* Style for the top menu */
        #navbar {
            background-color: #A5494D;
            color: #fff;
            text-align: center;
            padding: 10px;
        }

        /* Style for the side navigation */
        #sidenav {
            height: 100%;
            width: 15%;
            position: fixed;
            z-index: 0;
            top: 0;
            background-color: #A5494D;
            padding-top: 50px;
            text-align: justify;
            overflow-x: hidden;
        }

        #sidenav a {
            padding: 15px 8px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: block;
        }

        #sidenav a:hover {
            background-color: #BB666A;
        }
        /* Form styling */
form {
    width: 80%; /* Use a percentage width for responsiveness */
    max-width: 600px; /* Set a maximum width to maintain a reasonable size on larger screens */
    margin: 50px auto;
    background-color: #d9d9d9; /* Grey background color for the container */
    padding: 20px;
    border: 2px solid #999; /* Border color for the container */
    border-radius: 8px; /* Border radius for rounded corners */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Box shadow for a subtle effect */
    display: flex;
    flex-direction: column; /* Arrange form elements in a column */
}

form .info {
    margin-bottom: 10px;
}

form label {
    font-weight: bold;
    margin-bottom: 5px; /* Add space between label and input */
}

form input[type="email"],
form input[type="password"] {
    width: calc(100% - 10px); /* Adjust input width to fit the container */
    padding: 5px; /* Add padding to input for better spacing */
    margin-bottom: 10px; /* Add space between inputs */
}

form button[type="submit"] {
    width: 150px;
    padding: 5px 10px;
    background-color: #A5494D;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    align-self: center; /* Center button horizontally within the form */
}


    </style>
</head>
<body>
<!-- Top Menu-->
<div id="navbar">
    <h2 style="color:white">QUICKSHOP|CUSTOMER</h2>
</div>

<!-- Side Navigation -->
<div id="sidenav">
    <a href="Customer-Homepage.php" style="font-size: 24px;">MS Customer</a>
    <a href="Customer-profile.php">
        <i class="fas fa-user-alt"></i>
        Profile
    </a>
    <a href="Customer-SearchProduct.php">
        <i class="fa-solid fa-magnifying-glass"></i>
        Search Product </a>

    <a href="Customer-EditLogin.php" id="EditLogin_txt">
        <i class="fa-solid fa-pen-to-square"></i></i>
        Edit Login Details</a>

    <a href="Customer-OrderHistory.php">
        <i class="fa-solid fa-clock-rotate-left"></i>
        Order History</a>

    <a href="Logout.php">
        <i class="fas fa-power-off"></i>
        Log Out</a>
</div>

<form method="post" action="update_email.php">
  <div class="info">
    <label>New Email:</label> <input type="email" name="new_email" required><br>
    <label>Password:</label> <input type="password" name="password" required><br>
    <button type="submit">Change Email</button>
  </div>
</form>

<form method="post" action="update_password.php">
  <div class="info">
    <label>Old Password:</label> <input type="password" name="old_password" required><br>
    <label>New Password:</label> <input type="password" name="new_password" required><br>
    <button type="submit">Change Password</button>
  </div>
</form>

<!-- java script code-->
<script>
    // Get the current URL
    var currentUrl = window.location.href;

    // Get the Profile_txt link
    var profileLink = document.getElementById('EditLogin_txt');

    // Check if the current URL contains 'Customer-profile.php'
    if (currentUrl.includes('Customer-EditLogin.php')) {
        profileLink.style.backgroundColor = '#BB666A'; // Change background color
    } else {
        // Reset the styling if the current URL is not 'Customer-profile.php'
        profileLink.style.backgroundColor = '#A5494D'; // Reset background color
    }
</script>

</body>
</html>
