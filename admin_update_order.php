<?php
session_start();
include 'connection.php';

// Check if the order ID is provided
if (isset($_POST['orders_id'])) {
    $order_id = $_POST['orders_id'];
    $user_id = $_SESSION['UserID'];
    $order_date = $_POST['OrderDate'];
    $totalamount = $_POST['TotalAmount'];
    $customer_id = $_POST['user_id'];

    $sql = "UPDATE Orders SET Date = ?, TotalAmount = ?, UserID = ? WHERE OrderID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $order_date, $totalamount, $customer_id, $order_id);

    if ($stmt->execute()) {
        header("location: manage_orders.php");
    } else {
        echo "Update failed: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}

// Close the database connection
$conn->close();
?>
