<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>QuickBooks Inventory Dashboard</title>
<script src="https://kit.fontawesome.com/a3c696c988.js" crossorigin="anonymous"></script>
<style>
  body {
  font-family: 'Times New Roman', sans-serif;
  margin: 0;
  padding: 0;
  background-color: #ffffff;  
  }
  #navbar {
  background-color: #A5494D;
  color: #fff;
  text-align: center;
  padding: 10px;
}

#navbar h2 {
  margin: 0;
  color: #fff;
}

.sidebar {
  width: 230px;
  height: 100%;
  position: fixed;
  padding-top: 20px;
  background-color: #A5494D;
  font-size: 18px;
  top: 0;
  left: 0;
  overflow-x: hidden;
  padding-bottom: 60px;
}

.nav {
  display: flex;
  flex-direction: column;
  gap: 10px;
}
.sidebar a:hover{
  background-color: #BB666A;
}

.nav-item {
  color: #fff;
  text-decoration: none;
  padding: 10px;
  text-align: justify;
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
  <!-- Top Menu-->
  <div id="navbar">
    <h2 style="color:white">QUICKSHOP|INVENTORY MANAGER</h2>
  </div>S

  <!-- Side menu-->
  <aside class="sidebar">
    <nav class="nav">
      <a href="inventory_dash.php" class="nav-item" id="inventorydash_txt"  style="font-size: 20px;">Ms Inventory Manager</a>
      <a href="inventory_orders.php" class="nav-item"><i class="fa-solid fa-clipboard-list"></i>
        Orders List</a>
      <a href="inventory_products.php" class="nav-item"><i class="fa-solid fa-list"></i>
        Product Details</a>
      <a href="Logout.php" class="nav-item"><i class="fas fa-power-off"></i>
        Log Out</a>
    </nav>
  </aside>

  <div class="content-view">
    <div class="welcome-message">Welcome, Inventory Manager!</div>
    <div class="admin-content">
      <p>This is the inventory manager's home page. Here, you can view order and order details tables and manage product details. Use the links on the left sidebar to navigate through different sections.</p>
      <p>If you need any assistance or have any questions, feel free to contact our support team.</p>
    </div>
  </div>
  <script>
// Get the current URL
var currentUrl = window.location.href;

// Get the salesdash link
var profileLink = document.getElementById('inventorydash_txt');

// Check if the current URL contains 'sales_dash.php'
if (currentUrl.includes('inventory_dash.php')) {
  profileLink.style.backgroundColor= '#BB666A'; // Change background color
} else {
  // Reset the styling if the current URL is not 'sales_dash.php'
  profileLink.style.backgroundColor = '#A5494D'; // Reset background color
}
</script>
</body>
</html>
