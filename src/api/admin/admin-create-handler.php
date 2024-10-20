<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") { // ensures you access this page the correct way
    $fname = $_POST["fname"]; // prevents code injection use anytime you grab data from user, htlmchars is only for outputting to page
    $lname = $_POST["lname"];
    $role = $_POST["role"];
    $phno = $_POST["phno"];
    $email = $_POST["email"];
    $password = $_POST["pwd"];
    
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    require_once __DIR__ . "/../dbconn.inc.php";
   

    $sql = "INSERT INTO employees (f_name, l_name, role, phoneNo, email, password)
    VALUES (?, ?, ?, ?, ?, ?);";

$statement = mysqli_stmt_init($conn); 
mysqli_stmt_prepare($statement, $sql);

mysqli_stmt_bind_param($statement, "ssssss", $fname, $lname, $role, $phno, $email, $hashedPassword);


$sql1 = "SELECT MAX(employee_id) AS id FROM employees;";
        
if($result = mysqli_query($conn, $sql1)) {
    
    $row = mysqli_fetch_assoc($result);
    $id = $row["id"] +1;
}

if (mysqli_stmt_execute($statement)) {
header("Location: ../../admin-view-details.php?id=" . $id); }
else {        
    echo mysqli_error($conn);
}
mysqli_close($conn);

header("Location: ../../admin-view-details.php?id=". $id);
} else {
header("Location: ../../admin-view-details.php?id=". $id); 
} 