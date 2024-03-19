<?php
session_start();
include 'connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $product_id = $_POST['products_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $quantity = $_POST['Quantity'];
    $price = $_POST['Price'];

    // Update the product in the database
    $sql = "UPDATE Products SET Name = ?, Description = ?, StockQuantity = ?, Price = ? WHERE ProductID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssidi", $name, $description, $quantity, $price, $product_id);

    if ($stmt->execute()) {
        // Redirect to a success page or display a success message
        header("location: inventory_products.php");
    } else {
         // Handle invalid requests
    echo "Error updating";
    }
} else {
    // Handle invalid requests
    echo "Invalid request.";
}

// Close the database connection
$conn->close();
?>
