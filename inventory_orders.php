<?php include 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickShop - Inventory Order Page </title>
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
        height: 100%;
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
            font-size: 18px;
        }

        #orders, #order-details {
            margin-left: 220px;
            margin-top: 20px;
            padding: 20px;
        }

        #ordersTable, #orderDetailsTable {
            width: calc(100% - 40px); 
            border-collapse: collapse;
            margin-top: 10px;
        }

        #ordersTable th, #orderDetailsTable th, 
        #ordersTable td, #orderDetailsTable td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        #ordersTable th, #orderDetailsTable th {
            background-color: #f2f2f2;
        }

        #updateOrderForm {
            margin-top: 10px;
        }
       
    </style>
    </head>
<body>
  <!-- Top Menu-->
  <div id="navbar">
    <h2 style="color:white">QUICKSHOP|INVENTORY MANAGER</h2>
  </div>
    <aside class="sidebar">
        <nav class="nav">
        <a href="inventory_dash.php" class="nav-item" style="font-size: 20px;">Ms Inventory Manager</a>
        <a href="inventory_orders.php" class="nav-item" id="inventory_orders_txt"><i class="fa-solid fa-clipboard-list"></i>
            Orders List</a>
        <a href="inventory_products.php" class="nav-item"><i class="fa-solid fa-list"></i>
            Product Details</a>
        <a href="Logout.php" class="nav-item"><i class="fas fa-power-off"></i>
            Log Out</a>
        </nav>
    </aside>

    <!-- Orders Section -->
    <section id="orders">
        <h2>Orders</h2>
        <!-- Orders table -->
        <table id="ordersTable">
            <thead>
                <tr>
                    <th>Order ID</th> 
                    <th>Date</th>
                    <th>Total Amount</th>
                    <th>User ID</th>
                </tr>
            </thead>
            <tbody>
            <?php
          $sql = "SELECT * FROM Orders";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
          ?>
          <tr>
            <td><?php echo $row["OrderID"]; ?></td>
            <td><?php echo $row["Date"]; ?></td>
            <td>$<?php echo $row["TotalAmount"]; ?></td>
            <td><?php echo $row["UserID"]; ?></td>
          </tr>
          <?php
            }
          } else {
            echo "<tr><td colspan='6'>Sorry, we don't have orders  yet</td></tr>";
          }
          ?>
          </tbody>
        </table>
    </section>

    <!-- Order Details Section -->
    <section id="order-details">
        <h2>Order Details</h2>
        <!-- Order Details table -->
        <table id="orderDetailsTable">
            <thead>
                <tr>
                    <th>Detail ID</th>
                    <th>Order ID</th>
                    <th>Product ID</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM orderdetails";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row["OrderDetailID"]; ?></td>
                    <td><?php echo $row["OrderID"]; ?></td>
                    <td><?php echo $row["ProductID"]; ?></td>
                    <td><?php echo $row["Quantity"]; ?></td>
                    <td>$<?php echo $row["Price"]; ?></td>
          </tr>
                </tr>
                <?php
            }
          } else {
            echo "<tr><td colspan='6'>Sorry, we don't have order details yet</td></tr>";
          }
          ?>
            </tbody>
        </table>
    </section>
    <script>
// Get the current URL
var currentUrl = window.location.href;

// Get the products link
var profileLink = document.getElementById('inventory_orders_txt');

// Check if the current URL contains 'products.php'
if (currentUrl.includes('inventory_orders.php')) {
  profileLink.style.backgroundColor= '#BB666A'; // Change background color
} else {
  // Reset the styling if the current URL is not 'products.php'
  profileLink.style.backgroundColor = '#A5494D'; // Reset background color
}

</script>
</body>
</html>