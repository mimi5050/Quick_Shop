<?php
session_start();
include 'connection.php';

// Check if the order details ID is provided and the user is logged in
if (isset($_POST['order_details_id'], $_POST['orders_id'], $_POST['product_id'], $_POST['Quantity'], $_POST['Price'], $_SESSION['UserID'])) {
    $order_details_id = $_POST['order_details_id'];
    $order_id = $_POST['orders_id'];
    $user_id = $_SESSION['UserID'];
    $product_id =  $_POST['product_id'];
    $quantity = $_POST['Quantity'];
    $price = $_POST['Price'];

    $sql = "UPDATE orderdetails SET Quantity = ?, Price = ?, ProductID = ?, OrderID = ? WHERE OrderDetailID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiii", $quantity, $price, $product_id, $order_id, $order_details_id);

    if ($stmt->execute()) {
        header("location: orders.php");
    } else {
        echo "Update failed: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}

// Close the database connection
$conn->close();
?>
