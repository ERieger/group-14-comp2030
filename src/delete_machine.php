<?php
var_dump($_POST);
require_once '../src/api/dbconn.inc.php';



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $machine_id = $_POST['machine_id'];
    
    $sql = "DELETE FROM machines WHERE machine_id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $machine_id);
   
    if (mysqli_stmt_execute($stmt)) {
        echo "<p> Succesful </p>";
        
    
    } else {
        echo "Error deleting machine: " . mysqli_error($conn);
    }

   
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

  
    header("Location: factoryworkerdashboard.php");
    exit;
}

?>