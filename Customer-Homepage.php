<?php 
session_start();?>
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
  background-color:#A5494D ;
  padding-top:50px;
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

/* Style for homepage information */
.content-view {
    margin-top:3%;
    margin-left: 250px;
    padding: 20px;
}

.fa {
  padding-right: 10px;
}

.welcome-message {
  font-size: 24px;
  margin-bottom: 20px;
}

.admin-content {
  background-color: #fff;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.admin-content p {
  font-size: 18px;
  line-height: 1.6;
  color: #333;
  margin-bottom: 10px;
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
    <a href="Customer-Homepage.php" style="font-size: 24px;" id="homepage_txt" >MS Customer</a>
    <a href="Customer-profile.php" id="Profile_txt">
      <i class="fas fa-user-alt"></i>
      Profile
    </a>
    <a href="Customer-SearchProduct.php">
      <i class="fa-solid fa-magnifying-glass"></i>
      Search Product </a>

    <a href="Customer-EditLogin.php">
    <i class="fa-solid fa-pen-to-square"></i>
        Edit Login Details</a>

    <a href="Customer-OrderHistory.php">
      <i class="fa-solid fa-clock-rotate-left"></i>
      Order History</a>
      
    <a href="Logout.php">
      <i class="fas fa-power-off"></i>
      Log Out</a>
  </div>
  <?php
  if (isset($_SESSION['UserID'])){?>
  <!--homepage information-->
  <div class="content-view">
    <div class="welcome-message">Welcome!</div>
    <div class="admin-content">
      <p>This is the customer's home page. Here, you can view order and product details and place your preferred order. Use the links on the left sidebar to navigate through different sections.</p>
      <p>If you need any assistance or have any questions, feel free to contact our support team.</p>
    </div>
  </div>
  <?php
  }
  ?>
<script src="session_timeout.js"></script>
  <!-- java script code-->
  <script>
// Get the current URL
var currentUrl = window.location.href;

// Get the homepage link
var profileLink = document.getElementById('homepage_txt');

// Check if the current URL contains 'Customer-Homepage.php'
if (currentUrl.includes('Customer-Homepage.php')) {
  profileLink.style.backgroundColor= '#BB666A'; // Change background color
} else {
  // Reset the styling if the current URL is not 'Customer-Homepage.php'
  profileLink.style.backgroundColor = '#A5494D'; // Reset background color
}
  </script>


</body>
</html>
