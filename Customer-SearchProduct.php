<?php include 'connection.php'; ?>

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
    #ViewProducts{
      margin-top:3%;
    }

    #Catalog{
      width: 75%;
      margin: 20px auto;
      margin-left:20%;
      border-collapse: collapse;
      border: 2px solid #A5494D;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    #Catalog td{
      padding: 10px;
      border: 1px solid #ddd;
      text-align: center;
    }

    #Catalog th{
      background-color: #A5494D;
      color: white;
      font-weight: bold;
    }

    #Catalog tbody tr:nth-child(even){
      background-color: #f9f9f9;
    }

    #Catalog tbody tr:hover{
      background-color: #ddd;
    }

    #ProductSearch{
      margin:50px auto;
      margin-left:40%;
      padding: 10px;
      width: 40%; /* Set a standard width for the input */
      box-sizing: border-box;
      margin-bottom: 5px; /* Add a little space between the input and button */
    }

    #ProductSearchButton{
      margin:5px;
      padding: 10px;
      width: 150px;
      background-color: #A5494D;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
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
        .popup input[type="number"],
        .popup input[type="text"] {
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
    <h2 style="color:white">QUICKSHOP|CUSTOMER</h2>
  </div>

  <!-- Side Navigation -->
  <div id="sidenav">
  <a href="Customer-Homepage.php" style="font-size: 24px;">MS Customer</a>
    <a href="Customer-profile.php">
      <i class="fas fa-user-alt"></i>
      Profile
    </a>
    <a href="Customer-SearchProduct.php" id="SearchProduct_txt">
      <i class="fa-solid fa-magnifying-glass"></i>
      Search Product </a>

    <a href="Customer-EditLogin.php">
    <i class="fa-solid fa-pen-to-square"></i>
        Edit Login Details</a>

    <a href="Customer-OrderHistory.php">
      <i class="fa-solid fa-clock-rotate-left"></i>
      Order History</a>
      
    <a href="Logout.php">
      <i class="fas fa-power-off"></i>
      Log Out</a>
  </div>

  <!-- Product Search-->
  <div id="ViewProducts">
      <input type="text" id="ProductSearch" name="product_name" placeholder="Enter product name">
      <button id="ProductSearchButton" type="submit"><i class="fas fa-search"></i></button>
    <div id="ShowProducts">
      <!-- Product table -->
      <table id="Catalog">
        <thead>
          <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Stock Quantity</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = "SELECT * FROM Products";
          if(isset($_GET['product_name'])){
            $product_name = $_GET['product_name'];
            $sql .= " WHERE Name='$product_name'";
          }
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
          ?>
          <tr>
            <td><?php echo $row["Name"]; ?></td>
            <td><?php echo $row["Description"]; ?></td>
            <td>$<?php echo $row["Price"]; ?></td>
            <td><?php echo ($row["StockQuantity"] > 0) ? 'In Stock' : 'Out of Stock'; ?></td>
            <td><button style=" padding: 5px 10px; background-color:#4CAF50;color: white;border: none; border-radius: 3px;cursor: pointer;" 
            onclick="AddToCart('<?php echo $row['ProductID']; ?>', '<?php echo $row['Name']; ?>','<?php echo $row['Description']; ?>', 
            '<?php echo $row['Price']; ?>', '<?php echo $row['StockQuantity']; ?>')">Add to Cart</button></td>
          </tr>
          <?php
            }
          } else {
            echo "<tr><td colspan='6'>Sorry, we don't have that in our stock</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- java script code-->
  <script>
    // Get the current URL
    var currentUrl = window.location.href;
    
    // Get the Profile_txt link
    var profileLink = document.getElementById('SearchProduct_txt');
    
    // Check if the current URL contains 'Customer-SearchProduct.php'
    if (currentUrl.includes('Customer-SearchProduct.php')) {
      profileLink.style.backgroundColor= '#BB666A'; // Change background color
    } else {
  // Reset the styling if the current URL is not 'products.php'
  profileLink.style.backgroundColor = '#A5494D'; // Reset background color
}
function AddToCart(ProductID, Name, Description, Price, StockQuantity, ) {
    var container = document.querySelector("body"); // Selecting the body element to append the popup
    var popup = document.createElement("div");
    popup.classList.add("overlay");
    popup.style.display = "flex";
    popup.innerHTML =
    `<div class='popup'>
        <form id='feedback-form' action='customer_order.php' method='post'>
        <input type="hidden" id="product_id" name="product_id" value="${ProductID}">

        <label for='product_name'>Product Name:</label>
        <input type="text" id="product_name" name="product_name" value="${Name}" readonly>
            
        <label for='product_description'>Product Description:</label>
        <input type="text" id="product_description" name="product_description" value="${Description}" readonly>

        <label for='quantity'>Choosen Quantity:</label>
        <input type='number' id='quantity' name='quantity' step="1" min="1" max="${StockQuantity}" required onchange="updatePrice(${Price})">
        
        <label for='price'>Total Price:</label>
        <input type="number" id="price" name="price" value="${Price}" readonly>

        <button type='submit'>Order</button>
        </form>
        <button id='cancel' onclick='closePopup()'>Cancel</button>
    </div>`;
    container.appendChild(popup);
}

function closePopup() {
    var popup = document.querySelector('.overlay');
    popup.parentNode.removeChild(popup); // Remove the popup element from the DOM
}

function updatePrice(price) {
        var quantity = document.getElementById('quantity').value;
        var totalPrice = quantity * parseFloat(price);
        document.getElementById('price').value = totalPrice.toFixed(2); // Set total price with 2 decimal places
}

</script>    
</body>
</html>
