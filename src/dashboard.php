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
                <div class="card card-50p preview">
                    <div class="card-header card-header-no-border">
                        <h4>Overall Production</h4>
                    </div>
                    <div class="graph-preview" id="overall-production"></div>
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
                    <div class="graph-preview" id="overall-power-usage"></div>
                </div>
                <div class="card card-50p preview">
                    <div class="card-header card-header-no-border">
                        <h4>Average Speed</h4>
                    </div>
                    <div class="graph-preview" id="average-speed"></div>
                </div>
                <div class="card card-50p preview">
                    <div class="card-header card-header-no-border">
                        <h4>Factory Humidity</h4>
                    </div>
                    <div class="graph-preview" id="average-humidity"></div>
                </div>
                <div class="card card-50p preview">
                    <div class="card-header card-header-no-border">
                        <h4>Factory Temperature</h4>
                    </div>
                    <div class="graph-preview" id="factory-temperature"></div>
                </div>
            </div>
            <div class="card card-50p scrolling-logs">
                <div class="card-header logs-head">
                    <h3>Current Log Messages</h3>
                    <div class="spacer"></div>
                    <img src="../public/static/images/icons/filter.png" alt="FILTER" id="filter">
                </div>
                <div class="card-content scroll">
                    <table class="table">
                        <tr>
                            <th class="text-toupper">Timestamp</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Error Code</th>
                            <th>Production</th>
                            <th>Maintenance</th>
                            <th>Vibration</th>
                            <th>Humidity</th>
                            <th>Power</th>
                            <th>Speed</th>
                        </tr>
                        <tr>
                            <td>2024-09-16 10:30:00</td>
                            <td>Machine A</td>
                            <td>Running</td>
                            <td>0</td>
                            <td>95%</td>
                            <td>Scheduled</td>
                            <td>0.02 g</td>
                            <td>50%</td>
                            <td>1200 W</td>
                            <td>1000 RPM</td>
                        </tr>
                        <tr>
                            <td>2024-09-16 10:35:00</td>
                            <td>Machine B</td>
                            <td>Idle</td>
                            <td>102</td>
                            <td>65%</td>
                            <td>None</td>
                            <td>0.03 g</td>
                            <td>40%</td>
                            <td>900 W</td>
                            <td>750 RPM</td>
                        </tr>
                        <tr>
                            <td>2024-09-16 10:40:00</td>
                            <td>Machine C</td>
                            <td>Error</td>
                            <td>208</td>
                            <td>35%</td>
                            <td>Unscheduled</td>
                            <td>0.04 g</td>
                            <td>60%</td>
                            <td>1500 W</td>
                            <td>1200 RPM</td>
                        </tr>
                        <tr>
                            <td>2024-09-16 10:45:00</td>
                            <td>Machine D</td>
                            <td>Running</td>
                            <td>0</td>
                            <td>85%</td>
                            <td>Scheduled</td>
                            <td>0.01 g</td>
                            <td>55%</td>
                            <td>1100 W</td>
                            <td>950 RPM</td>
                        </tr>
                        <tr>
                            <td>2024-09-16 10:50:00</td>
                            <td>Machine E</td>
                            <td>Offline</td>
                            <td>303</td>
                            <td>0%</td>
                            <td>None</td>
                            <td>0.00 g</td>
                            <td>NA</td>
                            <td>0 W</td>
                            <td>0 RPM</td>
                        </tr>
                        <tr>
                            <td>2024-09-16 10:55:00</td>
                            <td>Machine F</td>
                            <td>Running</td>
                            <td>0</td>
                            <td>90%</td>
                            <td>Scheduled</td>
                            <td>0.02 g</td>
                            <td>45%</td>
                            <td>1250 W</td>
                            <td>1050 RPM</td>
                        </tr>

                    </table>
                </div>
            </div>
            <div class="break"></div>
            <div class="card card-50p">
                <div class="card-header logs-head">
                    <h3>Machine Status: 3D Printer 1</h3>
                </div>
                <div class="card-content scroll">
                </div>
            </div>

            <div class="card card-50p">
                <div class="card-header logs-head">
                    <h3>Current Log Messages</h3>
                </div>
                <div class="card-content scroll">

                </div>
            </div>
        </div>

    </main>

    <script src="../public/static/js/Chart.js"></script>
    <script src="../public/static/js/index.js"></script>
</body>

</html>