
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
    <link rel="stylesheet" href="../public/static/css/fstyle.css">
    <link rel="stylesheet" href="../public/static/css/normalize.css">
    <link rel="stylesheet" href="../public/static/css/colours.css">
    <link rel="stylesheet" href="../public/static/css/utility.css">
    <link rel="stylesheet" href="../public/static/css/index.css">
    <script src="../public/static/js/factorymanager.js" defer></script>
</head>
<header>
<div class="navbar">
            <img src="../public/static/images/logo.png" alt="COMPANY LOGO" class="logo">
            <p id="dashboard">Dashboard</p>
            <div class="spacer"></div>
            <div class="nav-item">
                <img src="../public/static/images/icons/logout.png" alt="LOGOUT ICON" onclick="window.location.href='login.php'">
                <p>Logout</p>
            </div>
            
            <div class="nav-item">
                <img src="../public/static/images/icons/tasks.png" alt="TASKS ICON" onclick="window.location.href='factoryworkerdashboard.php'">
                <p>Tasks</p>
            </div>
           
        </div>
</header>
<body>
    <div class="add-machine-container">
    <h1>Add New Machine </h1>
    
    <form action="add_machine-form.php" method="POST" class="add-machine-form" > <!-- adding new machine form-->
        <label for="machine_name">Machine Name:</label>
        <input type="text" id="machine_name" name="machine_name" required><br><br>
        
        <label for="operator">Operator Responsible:</label>
        <select id="operator" name="operator_id" required>
            <option value="" disabled selected>Select Operator</option>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . htmlspecialchars($row['employee_id']) . "'>"     //fetch and display production operators responsible for new machine as options
                         . htmlspecialchars($row['full_name']) . "</option>";
                }
            } else {
                echo "<option value=''>No operators available</option>";
            }
            ?>
        </select><br><br>
        
        <button type="submit" name="addMachine" id="add-machine-save">Save</button>  <!-- save button -->
      </form>
    </div>
</body>
</html>


