<?php include 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickShop - Order Page </title>
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

        .popup input[type="date"],
        .popup input[type="number"] {
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
    <h2 style="color:white">QUICKSHOP|SALES MANAGER</h2>
  </div>
    <aside class="sidebar">
        <nav class="nav">
        <a href="sales_dash.php" class="nav-item" id="salesdash_txt"  style="font-size: 24px;">Ms Sales Manager</a>
        <a href="#" class="nav-item" id="orders_txt"><i class="fa-solid fa-clipboard-list"></i>
            Orders List</a>
        <a href="products.php" class="nav-item"><i class="fa-solid fa-list"></i>
            Product Details</a>
        <a href="login.php" class="nav-item"><i class="fas fa-power-off"></i>
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
                    <th>Action</th>
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
            <td><button style=" padding: 5px 10px; background-color:#4CAF50;color: white;border: none; border-radius: 3px;cursor: pointer;" onclick="popUp('<?php echo $row['OrderID']; ?>', '<?php echo $row['Date']; ?>','<?php echo $row['TotalAmount']; ?>', '<?php echo $row['UserID']; ?>')">Update</button></td>
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
                    <th>Action</th>
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
                    <td><button style=" padding: 5px 10px; background-color:#4CAF50;color: white;border: none; border-radius: 3px;cursor: pointer;" onclick="OrderDetailsPopup('<?php echo $row['OrderDetailID']; ?>', '<?php echo $row['OrderID']; ?>','<?php echo $row['ProductID']; ?>', '<?php echo $row['Quantity']; ?>', '<?php echo $row['Price']; ?>')">Update</button></td>
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
var profileLink = document.getElementById('orders_txt');

// Check if the current URL contains 'products.php'
if (currentUrl.includes('orders.php')) {
  profileLink.style.backgroundColor= '#BB666A'; // Change background color
} else {
  // Reset the styling if the current URL is not 'products.php'
  profileLink.style.backgroundColor = '#A5494D'; // Reset background color
}

function popUp(OrderID, Date, TotalAmount, UserID) {
    var container = document.querySelector("body"); // Selecting the body element to append the popup
    var popup = document.createElement("div");
    popup.classList.add("overlay");
    popup.style.display = "flex";
    popup.innerHTML =
    `<div class='popup'>
        <form id='feedback-form' action='update_orders.php' method='post'>
            <input type="hidden" id="orders_id" name="orders_id" value="${OrderID}">
            
            <label for='OrderDate'>Order Date:</label>
            <input type='date' id='OrderDate' name='OrderDate' value='${Date}' required>

            <label for='TotalAmount'>Total Amount</label>
            <input type='number' id='TotalAmount' name='TotalAmount' value='${TotalAmount}' step="0.01" min="0.01" required>

            <input type="hidden" id="user_id" name="user_id" value="${UserID}">

            <button type='submit'>Update</button>
        </form>

        <button id='cancel' onclick='closePopup()'>Cancel</button>
    </div>`;
    container.appendChild(popup);
}

function OrderDetailsPopup(OrderDetailID, OrderID, ProductID, Quantity, Price) {
    var container = document.querySelector("body"); // Selecting the body element to append the popup
    var popup = document.createElement("div");
    popup.classList.add("overlay");
    popup.style.display = "flex";
    popup.innerHTML =
    `<div class='popup'>
        <form id='feedback-form' action='update_order_details.php' method='post'>
            <input type="hidden" id="orders_id" name="orders_id" value="${OrderID}">
            <input type="hidden" id="order_details_id" name="order_details_id" value="${OrderDetailID}">
            
            <label for='Quantity'>Quantity:</label>
            <input type='number' id='Quantity' name='Quantity' value='${Quantity}' required>

            <label for='Price'>Price</label>
            <input type='number' id='Price' name='Price' value='${Price}' step="0.01" min="0.01" required>

            <input type="hidden" id="product_id" name="product_id" value="${ProductID}">

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