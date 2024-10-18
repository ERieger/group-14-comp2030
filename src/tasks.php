<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks</title>
    <link rel="stylesheet" href="../public/static/css/normalize.css">
    <link rel="stylesheet" href="../public/static/css/colours.css">
    <link rel="stylesheet" href="../public/static/css/utility.css">
    <link rel="stylesheet" href="../public/static/css/index.css">
</head>

<body>
    <header>
        <div class="navbar">
            <img src="../public/static/images/logo.png" alt="COMPANY LOGO" class="logo">
            <p>Tasks</p>
            <div class="spacer"></div>
            <div class="nav-item">
                <a href="/factory-dashboard/src/login.php">
                    <img src="../public/static/images/icons/logout.png" alt="LOGOUT ICON">
                    <p>Logout</p>
                </a>
            </div>
            <div class="nav-item">
                <img src="../public/static/images/icons/helmet.png" alt="HELMET ICON">
                <p>Factory</p>
            </div>
            <div class="nav-item">
                <a href="/factory-dashboard/src/dashboard.php">
                    <img src="../public/static/images/icons/dashboard.png" alt="TASKS ICON">
                    <p>Dashboard</p>
                </a>
            </div>
            <div class="nav-item">
                <img src="../public/static/images/icons/menu.png" alt="MENU ICON">
                <p>Menu</p>
            </div>
        </div>
    </header>
    <main class="dashboard-container">
        <div class="dashboard-content">
            <?php
            require_once "./api/dbconn.inc.php";
            $sql = "SELECT j.job_id, j.job_name, e.f_name, e.l_name 
                FROM jobs j 
                INNER JOIN employees e ON j.employee_id = e.employee_id;";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '
                        <div class="quick-stats card-main card card-100p">
                        <div class="card-header">
                            <h3>Work Order For: ' . $row["job_name"] . '</h3>
                            <div class="spacer"></div>
                            <button type="button" onclick="activateTask('.$row["job_id"].')">Select Task</button>
                        </div>
                        <div class="card-content">
                            <table id="' . $row["job_id"] . '" class="table table-100">
                                <tr class="text-toupper">
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Assigned Machine</th>
                                    <th>Progress</th>
                                </tr>';
                    $sql2 = "SELECT p.item, p.qty, m.machine_name, p.progress, p.image
                    FROM parts p
                    INNER JOIN machines m ON p.machine_id=m.machine_id
                    WHERE p.job_id = '{$row["job_id"]}';";
                    $result2 = mysqli_query($conn, $sql2);
                    if (mysqli_num_rows($result2) > 0) {
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                            echo "
                            <tr>
                                <td>".$row2["item"]."</td>
                                <td>".$row2["qty"]."</td>
                                <td>".$row2["machine_name"]."</td>
                                <td>".$row2["progress"]." of " .$row2["qty"]."</td>
                            </tr>";
                        }
                    }
                    echo '</table></div></div>';
                    mysqli_free_result($result2);
                }
                mysqli_free_result($result);
            } else {
                echo "0 results";
            }
            mysqli_close($conn);
            ?>
    </main>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.14.0/jquery-ui.min.js" integrity="sha256-Fb0zP4jE3JHqu+IBB9YktLcSjI1Zc6J2b6gTjB0LpoM=" crossorigin="anonymous"></script>
    <script src="../public/static/js/paging/paging.js"></script>
    <script src="../public/static/js/Chart.js"></script>
    <script src="../public/static/js/tasks.js"></script>
</body>

</html>