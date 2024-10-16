<?php 
// this file is just for processing form data from post methhod whcih is stored in $_POST array
if (isset($_GET["id"])) {
    // verfies if value is avaible for given key
    //open connection to database
    require_once __DIR__ . "/../dbconn.inc.php";
    // sql statement to query database 
    $sql = "DELETE FROM employees WHERE employee_id = ?;";
    //? is place holder for task name to be extracted from $_POST
    $statement = mysqli_stmt_init($conn); // will intialise new SQL statment using stablised db connection stored in $conn
    mysqli_stmt_prepare($statement, $sql);
    mysqli_stmt_bind_param($statement, 's', htmlspecialchars($_GET["id"])); //bind variables and input santisation
    // The 's' in mysqli_stmt_bind_param indicates a string parameter 
    // this mehtod protects agaisnt SQL injection
    // execute statement 
    
    // (mysqli_stmt_execute($statement)) ? header("location: index.php") : $val = mysqli_error($conn); 
    // echo $val;
    
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
    
        header("Location: ../../admin-view-details.php?id=". $row["id"]); // sends page back to index page
    } else {
        header("Location: ../../admin-view-details.php?id=". $row["id"]); // fail safe for security 
    } 
?>