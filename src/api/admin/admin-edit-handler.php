<?php 


if ($_SERVER["REQUEST_METHOD"] == "POST") { // ensures you access this page the correct way

    $fname = $_POST["fname"]; // prevents code injection use anytime you grab data from user, htlmchars is only for outputting to page
    $lname = $_POST["lname"];
    $role = $_POST["role"];
    $phno = $_POST["phno"];
    $gender = $_POST["gender"];

    $id = $_POST["id"];

    require_once "../dbconn.inc.php";
   

    $sql = "UPDATE users SET fname = ?, lname = ?, role = ?, phoneNumber = ?, gender = ?
    WHERE id = ?;";

$statement = mysqli_stmt_init($conn); // will intialise new SQL statment using stablised db connection stored in $conn
mysqli_stmt_prepare($statement, $sql);

mysqli_stmt_bind_param($statement, "ssssss", $fname, $lname, $role, $phno, $gender, $id);
// set id to auto increment


// mysqli_stmt_bind_param($statement, ":a", $fname); //bind variables and input santisation
// mysqli_stmt_bind_param($statement, ':b', $lname); 
// mysqli_stmt_bind_param($statement, ':c', $role); 
// mysqli_stmt_bind_param($statement, ':d', $phno); 
// mysqli_stmt_bind_param($statement, ':e', $gender); 

if (mysqli_stmt_execute($statement)) {
    header("location: ../adminIndex.php"); }
    else {        
        echo mysqli_error($conn);
}
mysqli_close($conn);

    header("Location: ../adminIndex.php"); // sends page back to index page
} else {
    header("Location: ../adminIndex.php"); // fail safe for security 
}