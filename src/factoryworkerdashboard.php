<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factory Manager View</title>
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
                <img src="../public/static/images/icons/tasks.png" alt="TASKS ICON" onclick="window.location.href='factoryworkerdashboard.php'">
                <p>Tasks</p>
            </div>
           
        </div>
</header>
<body>

       
        <form action="add_new_employee.php" method="POST">
        <button class="new">Add New Employee</button>
    

    <div class="tables-section">
    <div class="machines-table-container"> <!-- table for machines-->
        <table class="machine_details">
            <thead>
                <tr>
                    <th>Machine Name</th>
                    <th id="Machine_Id">Machine ID</th>
                    <th id="Actions_header"> Actions </th>
                </tr>
            </thead>
             <tbody>
             
                    <?php //php connection fetching machines for machine details table
                    require_once '../src/api/dbconn.inc.php';
                    $imagePath = '../public/static/images/icons/delete-machine.png';

                    $sql_machines = "SELECT DISTINCT machine_name, machine_id FROM machines";
                    $result_machines = mysqli_query($conn, $sql_machines);



                    if (mysqli_num_rows($result_machines) > 0) {
                        while ($row = mysqli_fetch_assoc($result_machines)) {
                            
                            echo "<tr>
                                    <td>" . htmlspecialchars($row['machine_name']) . "</td>
                                    <td id='Machine_Id'>" . htmlspecialchars($row['machine_id']) . "</td>
                                    <td class='actions_data'>
                                        <form id='deleteForm' method= 'POST' action='delete_machine.php'> 
                                        <input type= 'hidden' name= 'machine_id' value='". $row['machine_id']."'>
                                        <button type='submit' onclick= 'return confirmDelete()' name='deleteMachine' class='actions_button'>
                                        </button>
                                        </form>
                                    </td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No data available</td></tr>";
                    }

                    ?>
            </tbody>
        </table>
    </div>

    <form action="add_machine.php" method="POST">
    <button id="add_button" type="submit">Add Machine</button>
    </form>

    <form id='editForm' method='POST' action='update_machine_Details.php'>
    <input type='hidden' name='machine_id' value='<?php echo htmlspecialchars($row['machine_id']); ?>'>
    <button type='submit' id='edit_button'>Edit Machine</button>
    </form>


        
        <div class="employees-table-container"> <!-- table for job assignment-->
        <table class="employees_details">
             <tbody>

        <?php //php connection fetching current jobs from database
                        
                        $sql_jobs = "SELECT DISTINCT e.f_name, e.l_name, j.job_name FROM employees e JOIN jobs j ON e.employee_id = j.employee_id";
                        $result_jobs = mysqli_query($conn, $sql_jobs);
                        

                        if (mysqli_num_rows($result_jobs) > 0) {
                                while ($row = mysqli_fetch_assoc($result_jobs)) {
                                    $full_name = htmlspecialchars($row['f_name']) . ' ' . htmlspecialchars($row['l_name']);
                                    $job_name= htmlspecialchars(($row['job_name']));
                            
                                echo "<tr>
                                        <td>
                                            <details class='details'>
                                            <summary class='employee_name'>$full_name</summary>
                                            <p class='current'>Current- $job_name</p>
                                            </details>
                                        </td>
                                      </tr>";
                            } 
                        } else {
                            echo "<tr><td colspan='1'>No data available</td></tr>";
                        }
                        
                        ?>

                        </tbody>
                </table>
            </div> 
        </div>
        
   </main>
 </body>
</html>
<?php // PHP connection for fetching machines from the database
require_once '../src/api/dbconn.inc.php';

$sql_machines = "SELECT DISTINCT machine_name FROM machines";
$result_machines = mysqli_query($conn, $sql_machines);

?> 

<div class="dropdown-section"> 
    <div class='dropdown'>
            <form action="assign_machine.php" method="post">
                <button  class="drpbutton">Select Jobs</button>
                <div id="selectjobsDrop" class="dropdown-content">
                    <?php
                    if (mysqli_num_rows($result_machines) > 0) {
                        while ($row = mysqli_fetch_assoc($result_machines)) {
                            $machineName = htmlspecialchars($row['machine_name']);
                            echo "<button type='submit' name='machineName' value='$machineName'>" . $machineName . "</button>";
                        }
                    } else {
                        echo "<p>No Machines Available</p>";
                    }
                    mysqli_close($conn);
                    ?>
                </div>
            </form>
        </div>
    </div>

