<?php 
session_start();
require_once "./api/dbconn.inc.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auditor-home-page</title>
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
            <p>Database</p>
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

        </div>
    </header>

   

<main class="table-content">
    <div class="summary"><a class="summary" href="auditor-summary.php">Generate Summary Report</a></div>
<!--filter-->
<div class="filter">
    
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
        <a class="reset-btn" href="auditorDB.php?<?php 
        ?>
        
        "><img class="reset-img" src="../public\static/images/icons/reset.png"></a>
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

     // setting the start from value
     $start = 0;
     // setting the number of rows to display in a page
     $rows_per_page = 50;
     // get total number of rows 
     $records = $conn->query("SELECT COUNT(*) as count FROM logs;");
     $num_of_rows = $records->num_rows;
     
     $row = mysqli_fetch_assoc($records);
     $count = $row["count"];
     // calculatiing the number of pages 
    $pages = ceil($count / $rows_per_page);
    // if user clicks on pagination buttons, set a new starting point
    if(isset($_GET['page-nr'])) {
        $page = $_GET['page-nr'] - 1;
        $start = $page * $rows_per_page;
    }

    if(isset($_GET['from_date']) && isset($_GET['from_date']) != '' && isset($_GET['to_date']) && isset($_GET['to_date']) != '') {
       
        $_SESSION['from_date'] = $_GET['from_date'];
        $_SESSION['to_date'] = $_GET['to_date'];
        $sql = "SELECT * FROM logs WHERE timestamp BETWEEN '{$_SESSION['from_date']}' AND '{$_SESSION['to_date']}' LIMIT $start, $rows_per_page;";
    } else {
        $sql = "SELECT * FROM logs LIMIT $start, $rows_per_page;";
    }

    if (!isset($_SESSION['from_date'])) {
        $timestamp = $conn->query("SELECT MIN(timestamp) as timestamp FROM logs;");
        $from_date = $timestamp;
    } else {
        $from_date = $_SESSION['from_date'];
    }

    if (!isset($_SESSION['to_date'])) {
        $timestamp = $conn->query("SELECT MAX(timestamp) as timestamp FROM logs;");
        $to_date = $timestamp;
    } else {
        $to_date = $_SESSION['to_date'];
    }




    $page_number = 1;

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

<div class="pagination">

<?php 
    if(isset($_GET['page-nr']) && $_GET['page-nr'] > 1 ) {
        echo '<a href="?page-nr=' . $_GET['page-nr'] - 1 . '">Previous</a>';
    } else {
        echo    '<a>Previous</a>';
    }
?>

<?php 
    if(!isset($_GET['page-nr'])) {
        $page = 1;
    } else {
        $page = $_GET['page-nr'];
    }
?>

<span class="msg">Showing <?php echo  $page?> of <?php echo  $pages?> pages </span>

    <?php 
        if(!isset($_GET['page-nr'])) {
            echo '<a href="?page-nr=2">Next</a>';
        } else {
            if($_GET['page-nr'] >= $pages) {
                echo '<a>Next</a>';
            } else {
                echo '<a href="?page-nr=' . $_GET['page-nr'] + 1 . '">Next</a>';
            }
        }

    ?>
</div>
</main>
</body>

</html>