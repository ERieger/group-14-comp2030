<?php 


if ($_SERVER["REQUEST_METHOD"] == "POST") { // ensures you access this page the correct way

    $fname = $_POST["fname"]; // prevents code injection use anytime you grab data from user, htlmchars is only for outputting to page
    $lname = $_POST["lname"];
    $role = $_POST["role"];
    $phno = $_POST["phno"];
    $email = $_POST["email"];

    $id = (int)$_POST["id"]; 

   

    require_once __DIR__ . "/../dbconn.inc.php";
        $sql = "SELECT * FROM employees WHERE employee_id = $id;";
        
        $result1 = mysqli_query($conn, $sql);
        echo "test";
        if($result = mysqli_query($conn, $sql)) {
            echo "test";
            $row = mysqli_fetch_assoc($result);
            if ($fname == "") {
                $fname = $row["f_name"];
            }
            if ($lname == "") {
                $lname = $row["l_name"];
            }
            if ($role == "unchanged") {
                $role = $row["role"];
            }
            if ($phno == "") {
                $phno = $row["phoneNo"];
            }
            if ($email == "") {
                $email = $row["email"];
            }
        }
     

    require_once __DIR__ . "/../dbconn.inc.php";
   

    $sql = "UPDATE employees SET f_name = ?, l_name = ?, role = ?, phoneNo = ?, email = ?
    WHERE employee_id = ?;";

$statement = mysqli_stmt_init($conn);
mysqli_stmt_prepare($statement, $sql);

mysqli_stmt_bind_param($statement, "ssssss", $fname, $lname, $role, $phno, $email, $id);
// set id to auto increment





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
