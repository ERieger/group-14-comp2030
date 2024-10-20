<?php 
if (isset($_GET["id"])) {

    require_once __DIR__ . "/../dbconn.inc.php";

    $sql = "DELETE FROM employees WHERE employee_id = ?;";

    $statement = mysqli_stmt_init($conn);

    mysqli_stmt_prepare($statement, $sql);

    mysqli_stmt_bind_param($statement, 's', htmlspecialchars($_GET["id"]));

    $sql1 = "SELECT MIN(employee_id) AS id FROM employees;";
    
        if($result = mysqli_query($conn, $sql1)) {
            $row = mysqli_fetch_assoc($result);
        }
    if (mysqli_stmt_execute($statement)) {
        header("Location: ../../admin-view-details.php?id=" . $row["id"]); }
        else {        
            echo mysqli_error($conn);
    }
    mysqli_close($conn);
        header("Location: ../../admin-view-details.php?id=". $row["id"]); 
    } else {
        header("Location: ../../admin-view-details.php?id=". $row["id"]); 
    } 
?>