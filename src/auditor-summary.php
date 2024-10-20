<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auditor-summary</title>
    <link rel="stylesheet" href="../public/static/css/normalize.css">
    <link rel="stylesheet" href="../public/static/css/colours.css">
    <link rel="stylesheet" href="../public/static/css/utility.css">
    <link rel="stylesheet" href="../public/static/css/index.css">
    <link rel="stylesheet" href="../public/static/css/auditor.css">

</head>
<body>
<header>
<div class="navbar">
            <img src="../public/static/images/logo.png" alt="COMPANY LOGO" class="logo">
            <p>Summary</p>
            <div class="spacer"></div>

            <a  href="login.php"><div class="nav-item">
                <img src="../public/static/images/icons/logout.png" alt="LOGOUT ICON">
                <p>Logout</p>
            </div></a>

            <a  href="dashboard.auditors.php">
            <div class="nav-item">
                <img src="../public/static/images/icons/dashboard.png" alt="DASHBOARD ICON">
                <p>Dashboard</p>
            </div></a>

            <a  href="auditorDB.php">
            <div class="nav-item">
                <img src="../public/static/images/icons/tasks.png" alt="DASHBOARD ICON">
                <p>Database</p>
            </div></a>

        </div>
    </header>
    <body>
    <div class="summary-report">
    <?php 
    require_once "./api/dbconn.inc.php"; 

    if (!isset($_SESSION['from_date'])) {
        $timestamp = $conn->query("SELECT MIN(timestamp) as timestamp FROM logs;");
        $from_date = "2024-04-01";
    } else {
        $from_date = $_SESSION['from_date'];
    }

    if (!isset($_SESSION['to_date'])) {
        $timestamp = $conn->query("SELECT MAX(timestamp) as timestamp FROM logs;");
        $to_date = "2024-07-01";
    } else {
        $to_date = $_SESSION['to_date'];
    }

    echo  '
    <div> 
    <h3>Factory Summary Report</h3>
    </div>
    <h2>Date Range: ' .  $from_date . ' to ' . $to_date . '</h3>
    
    <table class="card"> 
    <thead>
        <tr>
            <th>MACHINE_NAME</th>
            <th>TOTAL_PRODUCTION</th>
            <th>AVG_PRODUCTION</th>
            <th>AVG_POWER_CONSUMPTION</th>
            <th>AVG_TEMPERATURE</th>
            <th>ACTIVE_PERCENTAGE</th>
            <th>MAINTENANCE_PERCENTAGE</th>
            <th>IDLE_PERCENTAGE</th>

           
        </tr>
    </thead>
    <tbody>'; 

    // determining the percentage of operational_status

    // put in for loop to cycle through machines
    for ($i = 0; $i <= 10; $i++) {

    $TOTAL_STATUS = $conn->query("SELECT COUNT(machine_name) as count FROM logs WHERE machine_id = $i;");
    $row = mysqli_fetch_assoc($TOTAL_STATUS);
    $total_count = $row['count'];
    $ACTIVE_STATUS = $conn->query("SELECT COUNT(machine_name) as count FROM logs WHERE machine_id = $i AND status = 'active';");
    $row = mysqli_fetch_assoc($ACTIVE_STATUS);
    $active_count = $row['count'];
    $MAINTENACE_STATUS = $conn->query("SELECT COUNT(machine_name) as count FROM logs WHERE machine_id = $i AND status = 'maintenance';");
    $row = mysqli_fetch_assoc($MAINTENACE_STATUS);
    $maintenance_count = $row['count'];
    $IDLE_STATUS = $conn->query("SELECT COUNT(machine_name) as count FROM logs WHERE machine_id = $i AND status = 'idle';");
    $row = mysqli_fetch_assoc($IDLE_STATUS);
    $idle_count = $row['count'];

    if ($total_count == 0) {
        $active = "N/A";
        $maintenance = "N/A";
        $idle = "N/A"; 
    } else {
    $active = ($active_count / $total_count)*100;
    $maintenance = ($maintenance_count / $total_count)*100;
    $idle = ($idle_count / $total_count)*100;
    }

    $MACHINE = "SELECT machine_name FROM logs WHERE machine_id = $i GROUP BY machine_id;";
    $TOT_PRODUCTION = "SELECT COUNT(production) as total_production FROM logs WHERE machine_id = $i GROUP BY machine_id;";
    $AVG_PRODUCTION = "SELECT AVG(production) as production FROM logs WHERE machine_id = $i GROUP BY machine_id;";
    $AVG_POWER = "SELECT AVG(power_consumption) as power_consumption FROM logs WHERE machine_id = $i GROUP BY machine_id;";
    $AVG_TEMP = "SELECT AVG(temperature) as temperature FROM logs WHERE machine_id = $i GROUP BY machine_id;";
    
    if ($result = mysqli_query($conn, $MACHINE)) {
        if (mysqli_num_rows($result) >= 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo 
            '<tr>
            <td>' . $row["machine_name"] . '</td>
           
       ';

             }
        }
    } 
    if ($result = mysqli_query($conn, $TOT_PRODUCTION)) {
        if (mysqli_num_rows($result) >= 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo 
            '
            <td>' . $row["total_production"] . '</td>
           
        ';

             }
        }
    } 
    if ($result = mysqli_query($conn, $AVG_PRODUCTION)) {
        if (mysqli_num_rows($result) >= 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo 
            '
            <td>' . $row["production"] . '</td>
           
        ';

             }
        }
    } 
    if ($result = mysqli_query($conn, $AVG_POWER)) {
        if (mysqli_num_rows($result) >= 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo 
            '
            <td>' . $row["power_consumption"] . '</td>
           
       ';

             }
        }
    } 
    if ($result = mysqli_query($conn, $AVG_TEMP)) {
        if (mysqli_num_rows($result) >= 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo 
            '
            <td>' . $row["temperature"] . '</td>
            <td>' . $active . '</td>
            <td>' . $maintenance . '</td>
            <td>' . $idle . '</td>
           
        </tr>';

             }
        }
    } 
     
} 
    mysqli_free_result($result);
    mysqli_close($conn);

   echo  '</tbody>';
    ?>
    </div>
    </body>
    </html>