<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factory Manager View</title>
    <link rel="stylesheet" href="../public/static/css/normalize.css">
    <link rel="stylesheet" href="../public/static/css/colours.css">
    <link rel="stylesheet" href="../public/static/css/style.css">
    <script src="../public/static/js/factorymanager.js" defer></script>
</head>
<body>
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
   <main>
    <div class='dropdown'>
        <button class="button">Select Jobs</button>
    <div class="dropdown-content">
            <a rel="noopener" target="_blank"  >Machine A</a>
            <a rel="noopener" target="_blank" >Machine B</a>
            <a rel="noopener" target="_blank" >Machine C</a>
            <a rel="noopener" target="_blank" >Machine C</a>
            <a rel="noopener" target="_blank" >Machine D</a>
            <a rel="noopener" target="_blank" >Machine E</a>
            <a rel="noopener" target="_blank" >Machine F</a>
    </div>
   </div>
   
   <!--<button class="button3">People</button>
   <button class="button4">Machine</button>-->
   
    <div class="div-1">
        <button class="button2">+</button>

        <details class="R1">
        <summary>Richard</summary>
        <p>Current- Machine A</p>
        <p>Assigned- Machine B</p>
        </details>
   
        <details class="M1">
        <summary>Maria</summary>
        <p>Current- Machine F</p>
        <p>Assiged- Machine C</p>
        </details>
    
        <details class="D1">
        <summary>Damon</summary>
        <p>Current- Machine D</p>
        <p>Assiged- Machine E</p>
        </details>

        <!--<button class="save">Save</button>
        <button class="publish">Publish</button>-->
    
    </div>

    
    <div class="time-role-container">
        <button class="role">Role</button>
        <button id="time"></button>
    </div>

    <div class="table-container">
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
                    require '../src/api/dbconn.inc.php';


                    $sql = "SELECT DISTINCT machine_name, status, error_code FROM logs";
                    $result = mysqli_query($conn, $sql);



                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            
                            echo "<tr>
                                    <td>" . htmlspecialchars($row['machine_name']) . "</td>
                                    <td>" . htmlspecialchars($row['status']) . "</td>
                                    <td id='Error-Code'>" . htmlspecialchars($row['error_code']) . "</td>
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

