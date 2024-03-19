<?php
session_start();
include 'connection.php';
?>

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

    #navbar a {
      color: #A5494D;
      padding: 14px 16px;
      text-decoration: none;
      display: inline-block;
    }

    #navbar a:hover {
      background-color: #ddd;
      color: black;
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
      color: #fff;
      display: block;
    }

    #sidenav a:hover {
      background-color: #BB666A;
    }

    /* search product styling */   
    #OrderHistory{
      margin-top:3%;
    }

    #ordersTable{
      width: 75%;
      margin: 20px auto;
      margin-left:20%;
      border-collapse: collapse;
      border: 2px solid #A5494D;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    #ordersTable td{
      padding: 10px;
      border: 1px solid #ddd;
      text-align: center;
    }

    #ordersTable th{
      background-color: #A5494D;
      color: white;
      font-weight: bold;
    }

    #ordersTable tbody tr:nth-child(even){
      background-color: #f9f9f9;
    }

    #ordersTable tbody tr:hover{
      background-color: #ddd;
    }

    #OrderHistory h2{
      color:#A5494D;
      text-align:center;
      font-weight:bold;
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
    <a href="Customer-Homepage.php" style="font-size: 24px;">MS Customer</a>
    <a href="Customer-profile.php">
      <i class="fas fa-user-alt"></i>
      Profile
    </a>
    <a href="Customer-SearchProduct.php">
      <i class="fa-solid fa-magnifying-glass"></i>
      Search Product </a>

    <a href="Customer-EditLogin.php">
    <i class="fa-solid fa-pen-to-square"></i>
        Edit Login Details</a>

    <a href="Customer-OrderHistory.php" id="OrderHistory_txt">
      <i class="fa-solid fa-clock-rotate-left"></i>
      Order History</a>
      
    <a href="Logout.php">
      <i class="fas fa-power-off"></i>
      Log Out</a>
  </div><!-- Order History --->
 <div id="OrderHistory">
    <h2>Order History:</h2>
    <table id="ordersTable">
      <thead>
        <tr>
          <th>Date</th>
          <th>Total Amount</th>
          <th>Product Name</th>
          <th>Product Description </th>
          <th>Quantity</th>
        </tr>
      </thead>
      <tbody>
      <?php 
      if (isset($_SESSION['UserID'])) {
            $user_id = $_SESSION['UserID'];
            $sql = "SELECT * FROM orders WHERE UserID=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $order_id = $row['OrderID'];
                    $sql_order_details = "SELECT od.*, p.Name, p.Description FROM orderdetails od 
                                          JOIN products p ON od.ProductID = p.ProductID 
                                          WHERE od.OrderID=?";
                    $stmt_order_details = $conn->prepare($sql_order_details);
                    $stmt_order_details->bind_param("i", $order_id);
                    $stmt_order_details->execute();
                    $result_order_details = $stmt_order_details->get_result();
                    while ($row_order_details = $result_order_details->fetch_assoc()) {
                    ?>
        <tr>
          <td><?php echo $row["Date"]; ?></td>
          <td><?php echo $row["TotalAmount"]; ?></td>
          <td><?php echo $row_order_details["Name"]; ?></td>
          <td><?php echo $row_order_details["Description"]; ?></td>
          <td><?php echo $row_order_details["Quantity"]; ?></td>
        </tr>
        <?php
                    }
                }
            }
        }
        ?>
      </tbody>
    </table>
  </div>
<!-- java script code-->
<script src="session_timeout.js"></script>
<script>
  // Get the current URL
  var currentUrl = window.location.href;
  
  // Get the Profile_txt link
  var profileLink = document.getElementById("OrderHistory_txt");
  
  // Check if the current URL contains 'Customer-Homepage.html'
  if (currentUrl.includes('Customer-OrderHistory.php')) {
    profileLink.style.backgroundColor= '#BB666A'; // Change background color
} else {
  // Reset the styling if the current URL is not 'Customer-Homepage.php'
  profileLink.style.backgroundColor = '#A5494D'; // Reset background color
}

</script>    
</body>
</html>
