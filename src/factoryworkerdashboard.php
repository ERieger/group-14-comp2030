<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="../public/static/css/normalize.css">
    <link rel="stylesheet" href="../public/static/css/colours.css">
    <link rel="stylesheet" href="../public/static/css/utility.css">
    <link rel="stylesheet" href="../public/static/css/index.css">
    <link rel="stylesheet" href="../public/static/css/admin.css">
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
   <main>
   <div class="dropdown">
  <button class="dropbtn">Select Jobs</button>
  <div class="dropdown-content">
    <a >Machine A</a>
    <a >Mahcine B</a>
    <a >Machine C</a>
    <a >Machine D</a>
    <a >Machine E</a>
    <a >Machine F</a>
  </div>
</div>
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
   
   
   <button class="save">Save</button>
   <button class="publish">Publish</button>

   <button class="time">Time</button>
   <button class="role">Role</button>
      
      
    </div>
  </div>
   </main>


            <?php
            
            require_once "dbconn.inc.php"; 

            
            $sql = "SELECT machine_name, status, code FROM machines"; 
            $result = mysqli_query($conn, $sql); 

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>" . $row['machine_name'] . "</td>
                            <td>" . $row['status'] . "</td>
                            <td>" . $row['error_code'] . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No data available</td></tr>";
            }

            
            mysqli_close($conn); 
            ?>

</body>
</html>

