<?php
session_start();
include 'connection.php';

// Check if the product ID, user ID, price, and quantity are provided
if (isset($_POST['product_id'], $_SESSION['UserID'], $_POST['price'], $_POST['quantity'])) {
    $product_id = $_POST['product_id'];
    $user_id = $_SESSION['UserID'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $today = date('Y-m-d');

    // Insert a new order into the Orders table
    $sql = "INSERT INTO Orders (Date, TotalAmount, UserID) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdi", $today, $price, $user_id);
    $stmt->execute();

    // Retrieve the auto-incremented OrderID
    $order_id = $stmt->insert_id;

    // Insert the order details into the OrderDetails table
    $sql = "INSERT INTO OrderDetails (OrderID, ProductID, Price, Quantity) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iidi", $order_id, $product_id, $price, $quantity);
    $stmt->execute();

    // Update the Products table to decrement the stock quantity
    $sql = "UPDATE Products SET StockQuantity = StockQuantity - ? WHERE ProductID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $quantity, $product_id);
    $stmt->execute();

    // Redirect to the orders page
    header("location:Customer-SearchProduct.php");
} else {
    echo "Invalid request.";
}

// Close the database connection
$conn->close();
?>
