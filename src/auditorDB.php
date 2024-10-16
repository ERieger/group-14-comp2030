<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auditor home page</title>
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
            <p>Dashboard</p>
            <div class="spacer"></div>
            <div class="nav-item">
                <img src="../public/static/images/icons/logout.png" alt="LOGOUT ICON">
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

   

<main class="table-content">
<!--filter-->
<div class="filter">
    <!-- <div class="nav-container">
        <ul>
            <li><a>Dashboard</a></li>
            <li><a>Summary</a></li>
        </ul>
    </div> -->

    <form class="form-container" action="" method="GET">
    <div class="filter-item-spacer">
            
        </div>
        <div class="filter-item">
            <label for="i1" class="form-label-container">Beginning Date </label>
            <input id="i1" class="form-input-container" type="date" name="from_date" value="<?= isset($_GET['from_date']) == true ? $_GET['from_date']:'' ?>" required>
        </div>
        <div class="filter-item">
            <label for="i130" class="form-label-container">End Date </label>
            <input id="i130" class="form-input-container" type="date" name="to_date" value="<?= isset($_GET['to_date']) == true ? $_GET['to_date']:'' ?>" required>
        </div>
        <div class="filter-item">
            <button id="i2" class="form-button-container" type="submit">Filter</button>
        </div>
        <div class="filter-item">
        <a class="reset-btn" href=auditorDB.php><img class="reset-img" src="../public\static/images/icons/reset.png"></a>
        </div>
    </form>


</div>

<div class="table-wrapper">
    <div class="filter"></div>
    <div class="content">
<table class="f1-table"> 
    <thead>
        <tr>
            <th>EVENT</th>
            <th>MACHINE_ID</th>
            <th class="col1">MACHINE_NAME</th>
            <th>OPERATIONAL_STATUS</th>
            <th>TIMESTAMP</th>
            <th>TEMPERATURE</th>
            <th>PRESSURE</th>
            <th>VIBRATION</th>
            <th>HUMIDITY</th>
            <th>POWER_CONSUMPTION</th>
            <th>ERROR_CODE</th>
            <th>PRODUCTION_COUNT</th>
            <th>MAINTENANCE_LOG</th>
            <th>SPEED</th>
        </tr>
    </thead>
    
    <tbody>
    <?php 
    require_once "./api/dbconn.inc.php"; 

    if(isset($_GET['from_date']) && isset($_GET['from_date']) != '' && isset($_GET['to_date']) && isset($_GET['to_date']) != '') {
        $from_date = $_GET['from_date'];
        $to_date = $_GET['to_date'];
        $sql = "SELECT * FROM logs WHERE timestamp BETWEEN '$from_date' AND '$to_date' LIMIT 100;";
    } else {
        $sql = "SELECT * FROM logs LIMIT 100;";
    }

    if ($result = mysqli_query($conn, $sql)) {
        if (mysqli_num_rows($result) >= 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo 
            '<tr>
            <td>' . $row["event"] . '</td>
            <td>' . $row["machine_id"] . '</td>
            <td><strong>' . $row["machine_name"] . '</strong></td>
            <td><p class="status ' . $row["status"] . '">' . $row["status"] . '</p></td>
            <td>' . $row["timestamp"] . '</td>
            <td>' . $row["temperature"] . '</td>
            <td>' . $row["pressure"] . '</td>
            <td>' . $row["vibration"] . '</td>
            <td>' . $row["humidity"] . '</td>
            <td>' . $row["power_consumption"] . '</td>
            <td>' . $row["error_code"] . '</td>
            <td>' . $row["production"] . '</td>
            <td>' . $row["maintenance_log"] . '</td>
            <td>' . $row["speed"] . '</td>
        </tr>';
            }
        }
    } mysqli_free_result($result);
    mysqli_close($conn);

    ?>
    </tbody>

</table>
    </div>
</div>
<div class="msg">Max 100 rows will be displayed at a time</div>
</main>
</body>

</html>