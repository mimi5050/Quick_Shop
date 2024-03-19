<?php
session_start();
include 'connection.php';

// Check if the order details ID is provided
if (isset($_POST['order_details_id'], $_POST['orders_id'], $_POST['product_id'], $_POST['Quantity'], $_POST['Price'])){
    $order_details_id = $_POST['order_details_id'];
    $order_id = $_POST['orders_id'];
    $product_id =  $_POST['product_id'];
    $quantity = $_POST['Quantity'];
    $price = $_POST['Price'];

    $sql = "UPDATE orderdetails SET Quantity = ?, Price = ?, ProductID = ?, OrderID = ? WHERE OrderDetailID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiii", $quantity, $price, $product_id, $order_id, $order_details_id);

    if ($stmt->execute()) {
        header("location: manage_orderdetails.php");
    } else {
        echo "Update failed: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}

// Close the database connection
$conn->close();
?>
