<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QuickShop - Manage Products</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
    }

    #navbar {
      background-color: maroon;
      color: #fff;
      text-align: center;
      padding: 10px;
    }

    #navbar h2 {
      margin: 0;
      color: #fff;
    }

    #sidenav {
      width: 250px;
      background-color: #800000;
      padding-top: 20px;
      position: fixed;
      top: 0;
      left: 0;
      height: 100%;
      overflow-x: hidden;
      padding-bottom: 60px;
    }

    #sidenav a {
      padding: 10px;
      text-decoration: none;
      font-size: 18px;
      color: #fff;
      display: block;
      margin-bottom: 20px;
    }

    #sidenav a:hover {
      background-color: #ddd;
      color: maroon;
    }

    .content-view {
      margin-left: 250px;
      padding: 20px;
    }

    h3 {
      color: maroon;
      margin-bottom: 15px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: maroon;
      color: #fff;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    button {
      padding: 5px 10px;
      background-color: maroon;
      color: #fff;
      border: none;
      border-radius: 3px;
      cursor: pointer;
      margin-right: 5px;
    }

    button:hover {
      background-color: #800000;
    }

    ul {
      list-style-type: none;
      padding: 0;
    }

    li {
      margin-bottom: 5px;
    }

    form {
      margin-bottom: 20px;
    }

    form label {
      margin-right: 5px;
    }

    form input[type="text"] {
      padding: 5px;
      width: 200px;
      margin-right: 10px;
    }

    form button[type="submit"] {
      padding: 5px 10px;
      background-color: maroon;
      color: #fff;
      border: none;
      border-radius: 3px;
      cursor: pointer;
    }

    form button[type="submit"]:hover {
      background-color: #800000;
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
  <div id="navbar">
    <h2>QUICKSHOP|ADMINISTRATOR</h2>
  </div>

  <div id="sidenav">
    <a href="admin.php" style="font-size: 24px;">MS Administrator</a>
    <a href="admin.php"><i class="fas fa-home"></i> Home</a>
    <a href="manage_users.php"><i class="fas fa-users-cog"></i> Manage Users</a>
    <a href="manage_product.php"><i class="fas fa-box-open"></i> Manage Products</a>
    <a href="manage_orders.php"><i class="fas fa-clipboard-list"></i> Manage Orders</a>
    <a href="manage_orderdetails.php"><i class="fas fa-database"></i> Manage Order Deatails</a>
    <a href="Logout.php"><i class="fas fa-power-off"></i> Log Out</a>
  </div>

  <div class="content-view">
    <h3>Add Product</h3>
    <form id="addProductForm" action="store_product.php" method="post">
      <label for="Name">Product Name:</label>
      <input type="text" id="Name" name="Name" required><br><br>
      <label for="Price">Product Price:</label>
      <input type="text" id="Price" name="Price" required><br><br>
      <label for="Description">Product Description:</label>
      <input type="text" id="Description" name="Description" required><br><br>
      <label for="StockQuantity">Stock Quantity:</label>
      <input type="text" id="StockQuantity" name="StockQuantity" required><br><br>
      <button type="submit">Add a Product to the stock</button>
    </form>

    <h3>Manage Products</h3>
    <table>
      <thead>
        <tr>
          <th>Product ID</th>
          <th>Name</th>
          <th>Description</th>
          <th>Price</th>
          <th>Stock Quantity </th>
          <th>Action</th>

        </tr>
      </thead>
      <tbody>
      <?php
      // Include the connection file
          include 'connection.php';
          // Fetch data from the "Products" table
          $sql = "SELECT * FROM Products";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
          ?>
          <tr>
            <td><?php echo $row["ProductID"]; ?></td>
            <td><?php echo $row["Name"]; ?></td>
            <td><?php echo $row["Description"]; ?></td>
            <td>$<?php echo $row["Price"]; ?></td>
            <td><?php echo $row["StockQuantity"]; ?></td>
            <td>
            <form action="delete_product.php" method="get">
                <button type="submit" name="delete" value="<?php echo $row["ProductID"]; ?>">Delete</button>
            </form>
              <button name="update" onclick="ProductDetailsPopup('<?php echo $row['ProductID']; ?>', '<?php echo $row['Name']; ?>','<?php echo $row['Description']; ?>',
             '<?php echo $row['Price']; ?>', '<?php echo $row['StockQuantity']; ?>')">Update</button>
            </td>
          </tr>
          <?php
            }
          } else {
            echo "0 results";
          }
          ?>
      </tbody>
    </table>
  </div>
  <script>
    function ProductDetailsPopup(ProductID, Name, Description, Price, StockQuantity) {
    var container = document.querySelector("body"); // Selecting the body element to append the popup
    var popup = document.createElement("div");
    popup.classList.add("overlay");
    popup.style.display = "flex";
    popup.innerHTML =
    `<div class='popup'>
        <form id='feedback-form' action='admin_update_products.php' method='post'>
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
