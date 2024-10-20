<?php
require_once '../src/api/dbconn.inc.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_no = $_POST['phone_no']; // Get the phone number from the form
    $machine_id = $_POST['machine_name'];
    $role = 'Production Operator';

    // Insert the new employee into the employees table
    $sql_employee = "INSERT INTO employees (f_name, l_name, phoneNo, role) VALUES (?, ?, ?, ?)";
    $stmt_employee = mysqli_prepare($conn, $sql_employee);
    mysqli_stmt_bind_param($stmt_employee, 'ssss', $first_name, $last_name, $phone_no, $role);
    
    if (mysqli_stmt_execute($stmt_employee)) {
        $employee_id = mysqli_insert_id($conn);
        
        // Assign the machine to the new employee
        $sql_job = "INSERT INTO jobs (employee_id, machine_id) VALUES (?, ?)";
        $stmt_job = mysqli_prepare($conn, $sql_job);
        mysqli_stmt_bind_param($stmt_job, 'ii', $employee_id, $machine_id);
        
        if (mysqli_stmt_execute($stmt_job)) {
            echo "<p>Employee added and assigned to machine successfully.</p>";
        } else {
            echo "Error assigning machine to employee: " . mysqli_error($conn);
        }
        
        mysqli_stmt_close($stmt_job);
    } else {
        echo "Error adding employee: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt_employee);
    mysqli_close($conn);

    header("Location: factoryworkerdashboard.php");
    exit;
}
