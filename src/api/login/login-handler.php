<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") { // ensures you access this page the correct way

    $pwd = $_POST["pwd"]; // prevents code injection use anytime you grab data from user, htlmchars is only for outputting to page
    $email = $_POST["email"];

    require_once __DIR__ . "/../dbconn.inc.php";
   

    $sql = "SELECT email, password, role FROM employees WHERE email = \"$email\";";
      
if($result = mysqli_query($conn, $sql)) {
    
    $row = mysqli_fetch_assoc($result);
    $password = $row["password"];

    $role = $row["role"] ??= "no value";
    if($role == "no value") {
        header("Location: ../../login.php?");
    }
}

// $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);


if (password_verify($pwd, $password)) {
   
    if ($role == "Admin") {
        header("Location: ../../admin-view-details.php?id=1");
    } else if ($role == "Auditor") {
        header("Location: ../../auditorDB.php?");
    } else if ($role == "Factory Manager") {
        header("Location: ../../factoryworkerdashboard.php?");
    } else if ($role == "Factory Worker") {
        header("Location: ../../dashboard.php?");
    }
} else {
    header("Location: ../../login.php?");
}
} else { 

}
mysqli_close($conn);
// header("Location: ../../login.php?"); // sends page back to index page
