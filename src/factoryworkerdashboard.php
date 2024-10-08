!DOCTYPE html>
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
   <button class="button2">+</button>
   <button class="button3">People</button>
   <button class="button4">Machine</button>
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
   <div CLass="row">
    <div class="column" style="background-color:#aaa;">
      <h2 class="h">Machine A</h2>
      <p class="p">Not Working</p>
      <p1 class="p1">CODE-4088</p1>
    </div>

    <div class="column" style="background-color:#aaa;">
        <h2 class="h">Machine B</h2>
        <p class="p">Not Working</p>
        <p1 class="p1">CODE-9078</p1>
      </div>

      <div class="column" style="background-color:#aaa;">
        <h2 class="h">Machine C</h2>
        <p class="p">Working</p>
        <p1 class="p11">CODE-5423</p1>
      </div>

      <div class="column" style="background-color:#aaa;">
        <h2 class="h">Machine D</h2>
        <p class="p">Moderately Working</p>
        <p1 class="p12">CODE-8765</p1>
      </div>

      <div class="column" style="background-color:#aaa;">
        <h2 class="h">Machine E</h2>
        <p class="p">Working</p>
        <p1 class="p11">CODE-6125</p1>
      </div>

      <div class="column" style="background-color:#aaa;">
        <h2 class="h">Machine F</h2>
        <p class="p">Moderately Working</p>
        <p1 class="p12">CODE-3153</p1>
      </div>
      
      
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

