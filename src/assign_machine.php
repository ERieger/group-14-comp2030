<?php
require_once '../src/api/dbconn.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['machineName'])) {
    $machineName = mysqli_real_escape_string($conn, $_POST['machineName']);

    // Update the 'jobs' table to assign the machine to all employees
    $sql_update = "UPDATE jobs j
                   JOIN machines m ON j.machine_id = m.machine_id
                   SET j.machine_id = (SELECT machine_id FROM machines WHERE machine_name = '$machineName')
                   WHERE m.machine_name != '$machineName'";

    if (mysqli_query($conn, $sql_update)) {
        echo "Machine assigned successfully to all employees.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);

    // Redirect back to the main page or display a message
    header("Location: factoryworkerdashboard.php"); 
    exit();
}
?>