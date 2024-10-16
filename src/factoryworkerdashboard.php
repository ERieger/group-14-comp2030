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
<body>

        <button class="save">Save</button>
        <button class="publish">Publish</button>
        <button class="new">Add New Employee</button>
    
    </div>
        <button class="new">Add new Employee</button>


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
                                        <button type='submit' onclick= 'return confirmDelete()' name='deleteMachine' class='actions_button'>🗑</button>
                                        </form>


                                        <form id='editForm' method='POST' action='update_machine_Details.php'>
                                        <input type= 'hidden' name= 'machine_id' value='". $row['machine_id']."'>
                                        <button type='submit' class='actions_button'>🔧</button>
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
                            echo "<tr><td colspan='3'>No data available</td></tr>";
                        }
                        
                        ?>

                        </tbody>
                </table>
            </div> 
        </div>
        <?php     //php connection for deleting machine from database
            if(isset($_POST['deleteMachine'])){
            $machineId = $_POST['machine_id'];

            $sql = "DELETE FROM machines WHERE machine_id = '$machineId'";
            if ($conn->query($sql) === TRUE) {
                
            } else {
                
            }
            }
            
            ?>
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
                <button class="drpbutton">Select Jobs</button>
                <div class="dropdown-content">
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
<?php
require_once '../src/api/dbconn.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['machineName'])) {
    $machineName = mysqli_real_escape_string($conn, $_POST['machineName']);

    // Update the 'jobs' table to assign the machine to all employees
    $sql_update = "UPDATE jobs j
                   JOIN machines m ON j.machine_id = m.machine_id
                   SET j.machine_id = (SELECT machine_id FROM machines WHERE machine_name = '$machineName')
                   WHERE m.machine_name != '$machineName'";

    if (mysqli_query($conn, $sql_update)) {
        echo "Machine assigned successfully to all employees.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);

    // Redirect back to the main page or display a message
    header("Location: your_main_page.php"); // Replace 'your_main_page.php' with the appropriate page
    exit();
}
?>
