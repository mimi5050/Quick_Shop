<?php
// Include the connection file
include 'connection.php';

if(isset($_GET['delete'])) {
    // Get the product ID to be deleted
    $productID = $_GET['delete'];
    
    // Delete related records in the "orderdetails" table
    $deleteDetailsSql = "DELETE FROM orderdetails WHERE ProductID = $productID";
    if ($conn->query($deleteDetailsSql) === TRUE) {
        // Proceed to delete the product
        $deleteProductSql = "DELETE FROM Products WHERE ProductID = $productID";
        if ($conn->query($deleteProductSql) === TRUE) {
            // Redirect back to manage_product.php
            header("Location: manage_product.php");
            exit(); // Ensure no further code execution after redirection
        } else {
            echo "Error deleting product: " . $conn->error;
        }
    } else {
        echo "Error deleting order details: " . $conn->error;
    }
    
    // Close the database connection
    $conn->close();
} else {
    echo "Product ID not provided.";
}
?>
