<?php
require_once '../src/api/dbconn.inc.php';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $machineName = isset($_POST['machine_name']) ? $_POST['machine_name'] : null;
    $status = isset($_POST['status']) ? $_POST['status'] : null;
    $machineId = isset($_POST['machine_id']) ? $_POST['machine_id'] : null;
}
    // Validate that the required data is provided
    if ($machineName === null || $status === null || $machineId === null) {
        die("Missing required form data.");
    }
// Assuming you have established a connection to the database in $conn
$machineName = $_POST['machine_name'];
$status = $_POST['status'];
$machineId = $_POST['machine_id'];

// Initialize a statement
$statement = mysqli_stmt_init($conn);

// Prepare the query
$sql = "UPDATE logs SET machine_name = ?, status = ? WHERE machine_id = ?";

// Check if the preparation is successful
if (mysqli_stmt_prepare($statement, $sql)) {
    
    // Bind parameters to the statement: 2 strings (ss) and 1 integer (i)
    mysqli_stmt_bind_param($statement, "ssi", $machineName, $status, $machineId);
    
    // Execute the statement
    if (mysqli_stmt_execute($statement)) {
        echo "Record updated successfully";
    } else {
        echo "Error executing query: " . mysqli_stmt_error($statement);
    }
    
    // Close the statement
    mysqli_stmt_close($statement);

} else {
    echo "Error preparing query: " . mysqli_stmt_error($statement);
}

// Close the connection
mysqli_close($conn);
?>