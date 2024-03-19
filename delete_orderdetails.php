<?php
// Include the connection file
include 'connection.php';

// Check if the orderDetailID is set and is a valid integer
if(isset($_POST['orderDetailID']) && filter_var($_POST['orderDetailID'], FILTER_VALIDATE_INT)) {
    // Sanitize the orderDetailID to prevent SQL injection
    $orderDetailID = $_POST['orderDetailID'];

    // Prepare a DELETE statement
    $sql = "DELETE FROM orderdetails WHERE OrderDetailID = ?";

    if($stmt = $conn->prepare($sql)) {
        // Bind the parameters
        $stmt->bind_param("i", $orderDetailID);

        // Execute the statement
        if($stmt->execute()) {
            // Deletion successful
            echo "Order detail deleted successfully.";
        } else {
            // Error in execution
            echo "Error: Unable to delete order detail.";
        }

        // Close the statement
        $stmt->close();
    } else {
        // Error in preparing the statement
        echo "Error: Unable to prepare statement.";
    }
} else {
    // Invalid or missing orderDetailID parameter
    echo "Error: Invalid request.";
}

// Close the database connection
$conn->close();
?>
