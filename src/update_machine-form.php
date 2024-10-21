<?php
require_once '../src/api/dbconn.inc.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $oldMachineId = $_POST['old_machine_id'];  
    $newMachineId = $_POST['new_machine_id'];  

    
    $sql = "UPDATE machines SET machine_id = ? WHERE machine_id = ?"; //sql query for updating machine id in machines table
    if ($stmt = mysqli_prepare($conn, $sql)) {
        
        mysqli_stmt_bind_param($stmt, "ii", $newMachineId, $oldMachineId); //binding parameters to the statement to prevent sql injection

        
        if (mysqli_stmt_execute($stmt)) {
            echo "<p>Machine ID updated successfully.</p>";
        } else {
            echo "Error updating machine: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);  
    } else {
        echo "Error preparing statement: " . mysqli_error($conn);
    }

    $conn->close();  

    
    header("Location: factoryworkerdashboard.php");
    exit;
}
?>

</body>
</html>