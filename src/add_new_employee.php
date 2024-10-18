<?php

require_once '../src/api/dbconn.inc.php';

$sql = "SELECT * FROM machines m;";
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
        <label for="Fist_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required><br><br>
        <label for="Last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required><br><br>
        
        <label for="Machine Name">Machine Name:</label>
        <select id="Machine Name" name="machine_name" required>
            <option value="" disabled selected>Select Machines</option>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . htmlspecialchars($row['machine_id']) . "'>" 
                         . htmlspecialchars($row['machine_name']) . "</option>";
                }
            } else {
                echo "<option value=''>No machine available</option>";
            }
            ?>
        </select><br><br>
        
        <button type="submit" name="addNewEmployee">Save</button>
    </form>

</body>
</html>


