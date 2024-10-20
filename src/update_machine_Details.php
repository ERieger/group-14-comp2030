<?php
require_once '../src/api/dbconn.inc.php';

$sql = "SELECT machine_name, machine_id FROM machines";
$result = mysqli_query($conn, $sql);  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Machine ID</title>
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
                <img src="../public/static/images/icons/helmet.png" alt="HELMET ICON">
                <p>Factory</p>
            </div>
            <div class="nav-item">
                <img src="../public/static/images/icons/tasks.png" alt="TASKS ICON">
                <p>Tasks</p>
            </div>
            <div class="nav-item">
                <img src="../public/static/images/icons/menu.png" alt="MENU ICON">
                <p>Menu</p>
            </div>
        </div>
</header>
<body>

<h1>Update Machine ID</h1>


<form action="update_machine-form.php" method="POST">
    <label for="machine">Select Machine:</label>
    <select id="machine" name="old_machine_id" required>
        <option value="" disabled selected>Select Machine</option>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . htmlspecialchars($row['machine_id']) . "'>" 
                     . htmlspecialchars($row['machine_name']) . " (ID: " 
                     . htmlspecialchars($row['machine_id']) . ")</option>";
            }
        } else {
            echo "<option value=''>No machines available</option>";
        }
        ?>
    </select><br><br>

    <label for="new_machine_id">New Machine ID:</label>
    <input type="text" id="new_machine_id" name="new_machine_id" required><br><br>
    
    <button type="submit" name="updateMachine">Update Machine ID</button>
</form>