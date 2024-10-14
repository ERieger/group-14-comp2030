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
        <img src="../public/static/images/icons/notes icon.png" alt="NOTES ICON ICON">
        <p>Notes</p>
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

        <button class="save">Save</button>
        <button class="publish">Publish</button>
        <button class="new">Add new Employee</button>
    
    </div>

    
    <div class="machines-table-container"> <!-- table for machines-->
        <table class="machine_details">
            <thead>
                <tr>
                    <th>Machine Name</th>
                    <th>Status</th>
                    <th id="Machine_Id">Machine ID</th>
                </tr>
            </thead>
             <tbody>

                    <?php //php connection for fetching machines from database
                    require_once '../src/api/dbconn.inc.php';


                    $sql_machines = "SELECT DISTINCT machine_name, status, machine_id FROM logs";
                    $result_machines = mysqli_query($conn, $sql_machines);



                    if (mysqli_num_rows($result_machines) > 0) {
                        while ($row = mysqli_fetch_assoc($result_machines)) {
                            
                            echo "<tr>
                                    <td>" . htmlspecialchars($row['machine_name']) . "</td>
                                    <td>" . htmlspecialchars($row['status']) . "</td>
                                    <td id='Machine_Id'>" . htmlspecialchars($row['machine_id']) . "</td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No data available</td></tr>";
                    }

                    ?>
            </tbody>
        </table>
    </div>

        
        <div class="employees-table-container"> <!-- table for job assignment-->
        <table class="employees_details">
             <tbody>

        <?php //php connection for fetching current jobs from database
                        
                        $sql_jobs = "SELECT e.f_name, e.l_name, m.machine_name
                        FROM employees e
                        JOIN jobs j ON e.employee_id = j.employee_id
                        JOIN machines m ON j.machine_id = m.machine_id";
                        $result_jobs = mysqli_query($conn, $sql_jobs);


                        if (mysqli_num_rows($result_jobs) > 0) {
                            while ($row = mysqli_fetch_assoc($result_jobs)) {
                                $full_name = htmlspecialchars($row['f_name']) . ' ' . htmlspecialchars($row['l_name']);
                                $machine_name = htmlspecialchars($row['machine_name']);
                        
                                echo "<tr>
                                        <td>
                                            <details class='details'>
                                            <summary class='employee_name'>$full_name</summary>
                                            <p class='current'>Current- $machine_name</p>
                                            </details>
                                        </td>
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

