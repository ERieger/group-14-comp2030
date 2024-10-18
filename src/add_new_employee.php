<?php

require_once '../src/api/dbconn.inc.php';

$sql = "SELECT employee_id, CONCAT(f_name, ' ', l_name) AS full_name FROM employees WHERE role = 'Production Operator'";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Employee</title>
    
</head>
<body>

    <h1>Add New Employee and Assign Machine </h1>
    
    <form action="add_new_employee-form.php" method="POST">
        <label for="Fist_name">Employee Name:</label>
        <input type="text" id="first_name" name="first_name" required><br><br>
        <label for="Last_name">Employee Name:</label>
        <input type="text" id="last_name" name="last_name" required><br><br>
        
        <label for="Machine Name">Machine Name:</label>
        <select id="Machine Name" name="machine_name" required>
            <option value="" disabled selected>Select Operator</option>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . htmlspecialchars($row['machine_id']) . "'>" 
                         . htmlspecialchars($row['full_name']) . "</option>";
                }
            } else {
                echo "<option value=''>No machines available</option>";
            }
            ?>
        </select><br><br>
        
        <button type="submit" name="addNewEmployee">Save</button>
    </form>

</body>
</html>


