<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../public/static/css/normalize.css">
    <link rel="stylesheet" href="../public/static/css/colours.css">
    <link rel="stylesheet" href="../public/static/css/utility.css">
    <link rel="stylesheet" href="../public/static/css/index.css">
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
    <main class="dashboard-container">
        <div class="dashboard-content">
            <div class="quick-stats card card-50p">
                <div class="card-header">
                    <h3>Overall Factory Status</h3>
                </div>
                <div class="card-content">
                    <div class="card card-50p preview">
                        <div class="card-header card-header-no-border">
                            <h4>Overall Production</h4>
                        </div>
                        <div class="graph-preview" id="production"></div>
                    </div>
                    <div class="card card-50p preview">
                        <div class="card-header card-header-no-border">
                            <h4>Overall Status</h4>
                        </div>
                    </div>
                    <div class="card card-50p preview">
                        <div class="card-header card-header-no-border">
                            <h4>Overall Power Usage</h4>
                        </div>
                        <div class="graph-preview" id="power_consumption"></div>
                    </div>
                    <div class="card card-50p preview">
                        <div class="card-header card-header-no-border">
                            <h4>Average Speed</h4>
                        </div>
                        <div class="graph-preview" id="speed"></div>
                    </div>
                    <div class="card card-50p preview">
                        <div class="card-header card-header-no-border">
                            <h4>Factory Humidity</h4>
                        </div>
                        <div class="graph-preview" id="humidity"></div>
                    </div>
                    <div class="card card-50p preview">
                        <div class="card-header card-header-no-border">
                            <h4>Factory Temperature</h4>
                        </div>
                        <div class="graph-preview" id="temperature"></div>
                    </div>
                </div>
            </div>
            <div class="card card-50p scrolling-logs">
                <div class="card-header logs-head">
                    <h3>Current Log Messages</h3>
                    <div class="spacer"></div>
                    <form id="filter-form">
                        <select name="machine-select" id="machine-select">
                            <?php
                            require_once "./api/dbconn.inc.php";
                            $sql = "SELECT DISTINCT m.machine_name FROM machines m ";
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value=\"" . $row["machine_name"] . "\">" . $row["machine_name"] . "</option>";
                                }
                                mysqli_free_result($result);
                            } else {
                                echo "0 results";
                            }
                            mysqli_close($conn);
                            ?>
                        </select>
                        <input type="datetime-local" name="start" id="start" value="2024-04-13 02:30:00">
                        <input type="datetime-local" name="end" id="end" value="2024-04-13 21:00:00">
                        <button type="submit"><img src="../public/static/images/icons/filter.png" alt="FILTER" id="filter"></button>
                    </form>
                </div>
                <div class="card-content scroll">
                    <table id="logs-table" class="table">
                        <tr class="text-toupper">
                            <th>Timestamp</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Error Code</th>
                            <th>Maintenance</th>
                            <th>Production</th>
                            <th>Vibration</th>
                            <th>Humidity</th>
                            <th>Power</th>
                            <th>Speed</th>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="break"></div>
            <div class="card card-50p">
                <div class="card-header current-task logs-head">
                    <h3>Current Task</h3>
                </div>
                <div class="card-content">

                </div>
            </div>

            <div class="card machine-stats card-50p">
                <div class="card-header logs-head">
                    <h3>Machine Status: MACHINE_NAME_HERE</h3>
                </div>
                <div class="card-content">
                    <div class="card card-50p preview">
                        <div class="card-header card-header-no-border">
                            <h4>Machine Production</h4>
                        </div>
                        <div class="graph-preview" id="m-production"></div>
                    </div>
                    <div class="card card-50p preview">
                        <div class="card-header card-header-no-border">
                            <h4>Machine Power Usage</h4>
                        </div>
                        <div class="graph-preview" id="m-power_consumption"></div>
                    </div>
                    <div class="card card-50p preview">
                        <div class="card-header card-header-no-border">
                            <h4>Machine Speed</h4>
                        </div>
                        <div class="graph-preview" id="m-speed"></div>
                    </div>
                    <div class="card card-50p preview">
                        <div class="card-header card-header-no-border">
                            <h4>Machine Humidity</h4>
                        </div>
                        <div class="graph-preview" id="m-humidity"></div>
                    </div>
                    <div class="card card-50p preview">
                        <div class="card-header card-header-no-border">
                            <h4>Machine Temperature</h4>
                        </div>
                        <div class="graph-preview" id="m-temperature"></div>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.14.0/jquery-ui.min.js" integrity="sha256-Fb0zP4jE3JHqu+IBB9YktLcSjI1Zc6J2b6gTjB0LpoM=" crossorigin="anonymous"></script>
    <script src="../public/static/js/paging/paging.js"></script>
    <script src="../public/static/js/Chart.js"></script>
    <script src="../public/static/js/index.js"></script>
</body>

</html>