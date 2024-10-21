
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
            <p>Dashboard</p>
            <div class="spacer"></div>
            <div class="nav-item">
                <img src="../public/static/images/icons/logout.png" alt="LOGOUT ICON" onclick="window.location.href='login.php'">
                <p>Logout</p>
            </div>
            
            <div class="nav-item">
                <img src="../public/static/images/icons/tasks.png" alt="TASKS ICON">
                <p>Tasks</p>
            </div>
            
        </div>
</header>
<body>
    
</head>
<body>

    <h1>Add New Employee and Assign Machine </h1>
    
    <form action="add_new_employee-form.php" method="POST">
        <label for="Fist_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required><br><br>
        <label for="Last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required><br><br>
        <label for="phoneNo">Phone Number:</label>
        <input type="text" id="phoneNo" name="phoneNo" required><br><br>
    
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
    
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        
        <label for="Machine Name">Machine Name:</label>    <!-- form for adding new employee-->
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


