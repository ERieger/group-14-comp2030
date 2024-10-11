<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factory Manager View</title>
    <link rel="stylesheet" href="../public/static/css/normalize.css">
    <link rel="stylesheet" href="../public/static/css/colours.css">
    <link rel="stylesheet" href="../public/static/css/fstyle.css">
    <link rel="stylesheet" href="../public/static/css/utility.css">
    <link rel="stylesheet" href="../public/static/css/index.css">
    <script src="../public/static/js/factorymanager.js" defer></script>
</head>

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
<body>
   <main>
    <div class='dropdown'>
        <button class="drpbutton">Select Jobs</button>
    <div class="dropdown-content">
            
            <a rel="noopener" target="_blank" >Machine A</a>
            <a rel="noopener" target="_blank" >Machine B</a>
            <a rel="noopener" target="_blank" >Machine C</a>
            <a rel="noopener" target="_blank" >Machine D</a>
            <a rel="noopener" target="_blank" >Machine E</a>
            <a rel="noopener" target="_blank" >Machine F</a>
    </div>
   </div>
    <div class="div-1">
        <button class="button2">+</button>

        <details class="D1">
        <summary>Richard</summary>
        <p>Current- Machine A</p>
        <p>Assigned- Machine B</p>
        </details>
   
        <details class="D1">
        <summary>Maria</summary>
        <p>Current- Machine F</p>
        <p>Assigned- Machine C</p>
        </details>
    
        <details class="D1">
        <summary>Damon</summary>
        <p>Current- Machine D</p>
        <p>Assigned- Machine E</p>
        </details>

        <!--<button class="save">Save</button>
        <button class="publish">Publish</button>-->
    
    </div>

    

    <div class="machines-table-container">
        <table class="machine_details">
            <thead>
                <tr>
                    <th>Machine Name</th>
                    <th>Status</th>
                    <th id="Error-Code">Error Code</th>
                </tr>
            </thead>
             <tbody>

                    <?php
                    require_once '../src/api/dbconn.inc.php';


                    $sql_machines = "SELECT DISTINCT machine_name, status, error_code FROM logs";
                    $result_machines = mysqli_query($conn, $sql_machines);



                    if (mysqli_num_rows($result_machines) > 0) {
                        while ($row = mysqli_fetch_assoc($result_machines)) {
                            
                            echo "<tr>
                                    <td>" . htmlspecialchars($row['machine_name']) . "</td>
                                    <td>" . htmlspecialchars($row['status']) . "</td>
                                    <td id='Error-Code'>" . htmlspecialchars($row['error_code']) . "</td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No data available</td></tr>";
                    }

                    
                    ?>
            </tbody>
        </table>
    </div>

    <div class="employees-table-container">
        <table class="employees_details">
             <tbody>

                    <?php
                    
                    $sql_workers = "SELECT DISTINCT name FROM employees";
                    $result_workers = mysqli_query($conn, $sql_workers);



                    if (mysqli_num_rows($result_workers) > 0) {
                        while ($row = mysqli_fetch_assoc($result_workers)) {
                            
                            echo "<tr>
                                    <td class='D1'>" . htmlspecialchars($row['name']) . "</td>
                                    
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No data available</td></tr>";
                    }

                    mysqli_close($conn);
                    ?>
                    </tbody>
            </table>
        </div>
   </main>
 </body>
</html>

