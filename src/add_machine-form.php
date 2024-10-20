<?php
require_once '../src/api/dbconn.inc.php';



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $machine_name = $_POST['machine_name'];
    $operator_id = $_POST['operator_id'];


    
    $sql_machine = "INSERT INTO machines (machine_name) VALUES (?)";
    $stmt_machine = mysqli_prepare($conn, $sql_machine);
    mysqli_stmt_bind_param($stmt_machine, 's', $machine_name);
    $machine_id = mysqli_insert_id($conn);
    if (mysqli_stmt_execute($stmt_machine)) {
        echo "<p> Succesull </p>";
        
    
    } else {
        echo "Error adding machine: " . mysqli_error($conn);
    }

   
    mysqli_stmt_close($stmt_machine);
    mysqli_close($conn);

  
    header("Location: factoryworkerdashboard.php");
    exit;
}

?>