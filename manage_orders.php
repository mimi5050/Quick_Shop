<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QuickShop - Manage Orders</title>
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
    <a href="manage_users.php"><i class="fas fa-users-cog"></i> Manage Users</a>
    <a href="manage_product.php"><i class="fas fa-box-open"></i> Manage Products</a>
    <a href="manage_orders.php"><i class="fas fa-clipboard-list"></i> Manage Orders</a>
    <a href="manage_orderdetails.php"><i class="fas fa-database"></i> Manage Order Deatails</a>
    <a href="Logout.php"><i class="fas fa-power-off"></i> Log Out</a>
  </div>

  <div class="content-view">
    <h3>Manage Orders</h3>
    <table>
      <thead>
        <tr>
          <th>Order ID</th>
          <th>Date</th>
          <th>UserID</th>
          <th>Total Amount</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
      <?php
      // Include the connection file
          include 'connection.php';
          // Fetch data from the "Products" table
          $sql = "SELECT * FROM orders";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
          ?>
          <tr>
            <td><?php echo $row["OrderID"]; ?></td>
            <td><?php echo $row["Date"]; ?></td>
            <td><?php echo $row["UserID"]; ?></td>
            <td>$<?php echo $row["TotalAmount"]; ?></td>

            <td>
            <form action="delete_order.php" method="get">
                <button type="submit" name="delete" value="<?php echo $row["OrderID"]; ?>">Delete</button>
            </form>
            <div style="margin-top: 10px;"></div>
            <button type="submit" name="update" onclick="popUp('<?php echo $row['OrderID']; ?>', '<?php echo $row['Date']; ?>','<?php echo $row['TotalAmount']; ?>', '<?php echo $row['UserID']; ?>')">Update</button>
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
    function popUp(OrderID, Date, TotalAmount, UserID) {
    var container = document.querySelector("body"); // Selecting the body element to append the popup
    var popup = document.createElement("div");
    popup.classList.add("overlay");
    popup.style.display = "flex";
    popup.innerHTML =
    `<div class='popup'>
        <form id='feedback-form' action='admin_update_order.php' method='post'>
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
function closePopup() {
    var popup = document.querySelector('.overlay');
    popup.parentNode.removeChild(popup); // Remove the popup element from the DOM
}
  </script>
</body>
</html>
