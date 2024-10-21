<?php

require_once '../src/api/dbconn.inc.php';



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $job_id = $_POST['job_id'];
    
    $sql = "DELETE FROM jobs WHERE job_id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $job_id); //binding parameters to the statement to prevent sql injection
   
    if (mysqli_stmt_execute($stmt)) {
        echo "<p> Succesful </p>";
        
    
    } else {
        echo "Error deleting employee: " . mysqli_error($conn);
    }

   
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

  
    header("Location: factoryworkerdashboard.php");
    exit;
}

?>