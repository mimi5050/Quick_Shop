<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QuickShop - Manage Order Details</title>
  <script src="https://kit.fontawesome.com/a3c696c988.js" crossorigin="anonymous"></script>
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
      font-size: 14px;
      margin-right: -200px;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 5px; /* Adjust padding */
      text-align: left;
    }

    th {
      background-color: maroon;
      color: #fff;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    .content-view {
      margin-left: 250px;
      padding: 20px;
      overflow-x: auto;
    }

    .action-buttons button {
      padding: 5px 10px;
      background-color: maroon;
      color: #fff;
      border: none;
      border-radius: 3px;
      cursor: pointer;
      margin-right: 5px;
    }

    .action-buttons button:hover {
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
  <div id="navbar">
    <h2>QUICKSHOP|ADMINISTRATOR</h2>
  </div>

  <div id="sidenav">
    <a href="admin.php" style="font-size: 24px;">MS Administrator</a>
    <a href="admin.php"><i class="fas fa-home"></i> Home</a>
    <a href="manage_orderdetails.php"><i class="fas fa-database"></i> Manage Order Deatails</a>
    <a href="manage_users.php"><i class="fas fa-users-cog"></i> Manage Users</a>
    <a href="manage_product.php"><i class="fas fa-box-open"></i> Manage Products</a>
    <a href="manage_orders.php"><i class="fas fa-clipboard-list"></i> Manage Orders</a>
    <a href="logout.php"><i class="fas fa-power-off"></i> Log Out</a>
  </div>

  <div class="content-view">
    <h3>Manage Order Details</h3>
    <table>
      <thead>
        <tr>
          <th>OrderDetailID</th>
          <th>OrderID</th>
          <th>ProductID</th>
          <th>Quantity</th>
          <th>Price</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
          // Include the connection file
          include 'connection.php';

          // Fetch data from the "orderdetails" table
          $sql = "SELECT * FROM orderdetails";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
              echo "<tr>
                      <td>" . $row["OrderDetailID"] . "</td>
                      <td>" . $row["OrderID"] . "</td>
                      <td>" . $row["ProductID"] . "</td>
                      <td>" . $row["Quantity"] . "</td>
                      <td>" . $row["Price"] . "</td>
                      <td class='action-buttons'>
                        <button onclick=\"OrderDetailsPopup('" . $row['OrderDetailID'] . "', '" . $row['OrderID'] . "', '" . $row['ProductID'] . "', '" . $row['Quantity'] . "', '" . $row['Price'] . "')\">Update</button>
                        <button onclick='deleteOrder(" . $row["OrderDetailID"] . ")'>Delete</button>
                      </td>
                    </tr>";
            }
          } else {
            echo "<tr><td colspan='6'>0 results</td></tr>";
          }
          ?>
      </tbody>
    </table>
  </div>

  <script>
    function deleteOrder(orderDetailID) {
        // Send an AJAX request to delete_orderdetails.php
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // Print the response from delete_orderdetails.php
                console.log(this.responseText);
                // Reload the page after successful deletion (you can customize this behavior)
                location.reload();
            }
        };
        xhttp.open("POST", "delete_orderdetails.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("orderDetailID=" + orderDetailID);
    }
    function OrderDetailsPopup(OrderDetailID, OrderID, ProductID, Quantity, Price) {
    var container = document.querySelector("body"); // Selecting the body element to append the popup
    var popup = document.createElement("div");
    popup.classList.add("overlay");
    popup.style.display = "flex";
    popup.innerHTML =
    `<div class='popup'>
        <form id='feedback-form' action='admin_update_orderdetails.php' method='post'>
            <input type="hidden" id="orders_id" name="orders_id" value="${OrderID}">
            <input type="hidden" id="order_details_id" name="order_details_id" value="${OrderDetailID}">
            
            <label for='Quantity'>Quantity:</label>
            <input type='number' id='Quantity' name='Quantity' value='${Quantity}' required onchange="updatePrice(${Price})">

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
