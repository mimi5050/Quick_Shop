<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QuickShop - Administrator</title>
  <script src="https://kit.fontawesome.com/a3c696c988.js" crossorigin="anonymous"></script>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
    }

    #navbar {
      background-color: maroon; /* Changed to maroon */
      color: #fff;
      text-align: center;
      padding: 10px;
    }

    #navbar h2 {
      margin: 0;
      color: #fff; /* Changed to white */
    }

    #sidenav {
      width: 250px;
      background-color: #800000; /* Changed to maroon */
      padding-top: 20px;
      position: fixed;
      top: 0;
      left: 0;
      height: 100%;
      overflow-x: hidden;
      padding-bottom: 60px; /* Increased margin-bottom by 40px */
    }

    #sidenav a {
      padding: 10px;
      text-decoration: none;
      font-size: 18px; /* Changed to default size */
      color: #fff; /* Changed to white */
      display: block;
      margin-bottom: 20px; /* Added margin-bottom */
    }

    #sidenav a:hover {
      background-color: #ddd;
      color: maroon; /* Changed to maroon */
    }

    .content-view {
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
  <div id="navbar">
    <h2>QUICKSHOP|ADMINISTRATOR</h2>
  </div>

  <div id="sidenav">
    <a href="admin.php" style="font-size: 24px;">MS Administrator</a> <!-- Increased font size -->
    <a href="admin.php"><i class="fas fa-home"></i> Home</a>
    <a href="manage_users.php"><i class="fas fa-users-cog"></i> Manage Users</a>
    <a href="manage_product.php"><i class="fas fa-box-open"></i> Manage Products</a>
    <a href="manage_orders.php"><i class="fas fa-clipboard-list"></i> Manage Orders</a>
    <a href="manage_database.php"><i class="fas fa-database"></i> Manage Database</a>
    <a href="logout.php"><i class="fas fa-power-off"></i> Log Out</a>
  </div>

  <div class="content-view">
    <div class="welcome-message">Welcome, Administrator!</div>
    <div class="admin-content">
      <p>This is the administrator's home page. Here, you can manage users, products, orders, and database. Use the links on the left sidebar to navigate through different sections.</p>
      <p>If you need any assistance or have any questions, feel free to contact our support team.</p>
    </div>
  </div>

</body>
</html>
