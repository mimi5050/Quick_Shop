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

        .overlay {
        display: none;
        align-items: center;
        justify-content: center;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        }

        .popup {
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
        color: black;
        max-width: 400px;
        width: 80%;
        }

        .popup label {
        display: block;
        margin-bottom: 10px;
        color: #A5494D;
        font-weight: bold;
        }

        .popup input[type="number"],
        .popup input[type="text"]
         {
        width: calc(100% - 20px);
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #A5494D;
        border-radius: 5px;
        }

        .popup button {
        width: calc(50% - 5px);
        border: none;
        border-radius: 5px;
        background-color: #4CAF50;
        color: white;
        cursor: pointer;
        }

        #cancel {
        margin-top :10px;
        background-color: #ff6666;
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
            <a href="inventory_dash.php" class="nav-item"  style="font-size: 20px;">Ms Inventory Manager</a>
            <a href="inventory_products.php" class="nav-item" id="products_txt"><i class="fa-solid fa-list"></i>
                Products Details</a>
            <a href="inventory_orders.php" class="nav-item"><i class="fa-solid fa-clipboard-list"></i>
            Orders List</a>
            <a href="Logout.php" class="nav-item"><i class="fas fa-power-off"></i>
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
                    <th> Action </th>
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
            <td><button style=" padding: 5px 10px; background-color:#4CAF50;color: white;border: none; border-radius: 3px;cursor: pointer;" 
            onclick="ProductDetailsPopup('<?php echo $row['ProductID']; ?>', '<?php echo $row['Name']; ?>','<?php echo $row['Description']; ?>',
             '<?php echo $row['Price']; ?>', '<?php echo $row['StockQuantity']; ?>')">Update</button></td>
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
function ProductDetailsPopup(ProductID, Name, Description, Price, StockQuantity) {
    var container = document.querySelector("body"); // Selecting the body element to append the popup
    var popup = document.createElement("div");
    popup.classList.add("overlay");
    popup.style.display = "flex";
    popup.innerHTML =
    `<div class='popup'>
        <form id='feedback-form' action='update_products.php' method='post'>
            <input type="hidden" id="products_id" name="products_id" value="${ProductID}"
            <label for='name'>Name:</label>
            <input type='text' id='name' name='name' value='${Name}' required>

            <label for='description'>Description:</label>
            <input type='text' id='description' name='description' value='${Description}' required>

            <label for='Quantity'> Stock Quantity:</label>
            <input type='number' id='Quantity' name='Quantity' value='${StockQuantity}' required>

            <label for='Price'>Price</label>
            <input type='number' id='Price' name='Price' value='${Price}' step="0.01" min="0.01" required>
            <button type='submit'>Update</button>
        </form>

        <button id='cancel' onclick='closePopup()'>Cancel</button>
    </div>`;
    container.appendChild(popup);
}

function closePopup() {
    var popup = document.querySelector('.overlay');
    popup.parentNode.removeChild(popup); // Remove the popup element from the DOM
}
</script>
</body>
</html>
