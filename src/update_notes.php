<?php
require_once '../src/api/dbconn.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['notes']) && isset($_POST['job_id'])) {
    $job_id = intval($_POST['job_id']);
    $notes = mysqli_real_escape_string($conn, $_POST['notes']);

    // Update the notes in the 'jobs' table
    $sql_update = "UPDATE jobs SET notes = '$notes' WHERE job_id = $job_id";

    if (mysqli_query($conn, $sql_update)) {
        echo "Notes updated successfully.";
    } else {
        echo "Error updating notes: " . mysqli_error($conn);
    }

    mysqli_close($conn);

    // Redirect back to the main page or display a message
    header("Location: factoryworkerdashboard.php"); // Replace with the actual page
    exit();
}
?>
