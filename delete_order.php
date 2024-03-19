<?php
// Include the connection file
include 'connection.php';

if(isset($_GET['delete'])) {
    // Get the order ID to be deleted
    $orderID = $_GET['delete'];
    
    // Delete related records in the "orderdetails" table
    $deleteDetailsSql = "DELETE FROM orderdetails WHERE OrderID = $orderID";
    if ($conn->query($deleteDetailsSql) === TRUE) {
        // Proceed to delete the order
        $deleteOrderSql = "DELETE FROM orders WHERE OrderID = $orderID";
        if ($conn->query($deleteOrderSql) === TRUE) {
            // Redirect back to manage_orders.php
            header("Location: manage_orders.php");
            exit(); // Ensure no further code execution after redirection
        } else {
            echo "Error deleting order: " . $conn->error;
        }
    } else {
        echo "Error deleting order details: " . $conn->error;
    }
    
    // Close the database connection
    $conn->close();
} else {
    echo "Order ID not provided.";
}
?>
