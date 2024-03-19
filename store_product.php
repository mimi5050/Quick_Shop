<?php
// Include the connection file
include 'connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all form fields are set
    if (isset($_POST['Name'], $_POST['Price'], $_POST['Description'], $_POST['StockQuantity'])) {
        // Escape user inputs for security and trim whitespace
        $name = mysqli_real_escape_string($conn, trim($_POST['Name']));
        $price = mysqli_real_escape_string($conn, trim($_POST['Price']));
        $description = mysqli_real_escape_string($conn, trim($_POST['Description']));
        $stockQuantity = mysqli_real_escape_string($conn, trim($_POST['StockQuantity']));

        // Attempt to insert data
        $sql = "INSERT INTO products (Name, Price, Description, StockQuantity) VALUES ('$name', '$price', '$description', '$stockQuantity')";

        if (mysqli_query($conn, $sql)) {
            // Redirect to Product_Added_Successfully.php
            header("Location: Product_Added_Successfully.php");
            exit(); // Make sure to exit after redirection
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        // Close connection
        mysqli_close($conn);
    } else {
        echo "Error: All form fields are required.";
    }
}
?>
