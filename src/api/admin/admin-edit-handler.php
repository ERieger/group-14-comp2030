<?php 


if ($_SERVER["REQUEST_METHOD"] == "POST") { // ensures you access this page the correct way

    $fname = $_POST["fname"]; // prevents code injection use anytime you grab data from user, htlmchars is only for outputting to page
    $lname = $_POST["lname"];
    $role = $_POST["role"];
    $phno = $_POST["phno"];
    $email = $_POST["email"];

    $id = (int)$_POST["id"]; //new this was the issue araghh

   

    require_once __DIR__ . "/../dbconn.inc.php";
        // $id = $_GET["id"];
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

$statement = mysqli_stmt_init($conn); // will intialise new SQL statment using stablised db connection stored in $conn
mysqli_stmt_prepare($statement, $sql);

mysqli_stmt_bind_param($statement, "ssssss", $fname, $lname, $role, $phno, $email, $id);
// set id to auto increment


// mysqli_stmt_bind_param($statement, ":a", $fname); //bind variables and input santisation
// mysqli_stmt_bind_param($statement, ':b', $lname); 
// mysqli_stmt_bind_param($statement, ':c', $role); 
// mysqli_stmt_bind_param($statement, ':d', $phno); 
// mysqli_stmt_bind_param($statement, ':e', $gender); 


// $sql1 = "SELECT MIN(employee_id) AS id FROM employees;";
        
//         if($result = mysqli_query($conn, $sql1)) {
            
//             $row = mysqli_fetch_assoc($result);
        
//         }




if (mysqli_stmt_execute($statement)) {
    header("Location: ../../admin-view-details.php?id=" . $id); }
    else {        
        echo mysqli_error($conn);
}
mysqli_close($conn);

    header("Location: ../../admin-view-details.php?id=". $id); // sends page back to index page
} else {
    header("Location: ../../admin-view-details.php?id=". $id); // fail safe for security 
} 
// save me do more code just write a handler that puts you on the view details page with the above logic