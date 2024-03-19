<?php include 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
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
        }

        #products {
            margin-left: 220px;
            padding: 20px;
        }

        #productsTable {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        #productsTable th, #productsTable td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        #productsTable th {
            background-color: #f2f2f2;
        }

    </style>
</head>
<body>
      <!-- Top Menu-->
    <div id="navbar">
    <h2 style="color:white">QUICKSHOP|SALES MANAGER</h2>
    </div>
    <aside class="sidebar">
        <nav class="nav">
            <a href="sales_dash.php" class="nav-item"  style="font-size: 24px;">Ms Sales Manager</a>
            <a href="products.php" class="nav-item" id="products_txt"><i class="fa-solid fa-list"></i>
                Products Details</a>
            <a href="orders.php" class="nav-item"><i class="fa-solid fa-clipboard-list"></i>
            Orders List</a>
            <a href="login.php" class="nav-item"><i class="fas fa-power-off"></i>
            Log Out</a>
        </nav>
    </aside>

    <!-- Products Section -->
    <section id="products">
        <h2>Products</h2>
        <!-- Products table -->
        <table id="productsTable">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th> Stock Quantity </th>
                </tr>
            </thead>
            <tbody>
            <?php
          $sql = "SELECT * FROM Products";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
          ?>
          <tr>
            <td><?php echo $row["ProductID"]; ?></td>
            <td><?php echo $row["Name"]; ?></td>
            <td><?php echo $row["Description"]; ?></td>
            <td>$<?php echo $row["Price"]; ?></td>
            <td><?php echo $row["StockQuantity"]; ?></td>
          </tr>
          <?php
            }
          } 
          ?>
        </table>
    </section>
    <script>
// Get the current URL
var currentUrl = window.location.href;

// Get the products link
var profileLink = document.getElementById('products_txt');

// Check if the current URL contains 'products.php'
if (currentUrl.includes('products.php')) {
  profileLink.style.backgroundColor= '#BB666A'; // Change background color
} else {
  // Reset the styling if the current URL is not 'products.php'
  profileLink.style.backgroundColor = '#A5494D'; // Reset background color
}
</script>
</body>
</html>
