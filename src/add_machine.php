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
    <title>Add Machine</title>
    
</head>
<body>

    <h1>Add New Machine and Assign Operator</h1>
    
    <form action="add_machine-form.php" method="POST">
        <label for="machine_name">Machine Name:</label>
        <input type="text" id="machine_name" name="machine_name" required><br><br>
        
        <label for="operator">Assign Operator:</label>
        <select id="operator" name="operator_id" required>
            <option value="" disabled selected>Select Operator</option>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . htmlspecialchars($row['employee_id']) . "'>" 
                         . htmlspecialchars($row['full_name']) . "</option>";
                }
            } else {
                echo "<option value=''>No operators available</option>";
            }
            ?>
        </select><br><br>
        
        <button type="submit" name="addMachine">Save</button>
    </form>

</body>
</html>


