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
            <p>Users</p>
            <div class="spacer"></div>

            <a  href="login.php"><div class="nav-item">
                <img src="../public/static/images/icons/logout.png" alt="LOGOUT ICON">
                <p>Logout</p>
            </div></a>

            <a  href="dashboard.managers.php">
            <div class="nav-item">
                <img src="../public/static/images/icons/dashboard.png" alt="DASHBOARD ICON">
                <p>Dashboard</p>
            </div></a>

        </div>
    </header>
    <div class="grid-container">
        <div class="grid-item-header"></div>
    <div class="card">
        <div class="card-header1">
            <h3 class="card-header1-item1">Users</h3>
            <div class="spacer"></div>
            <a href="admin-add-user.php"><img class="add-img" src="../public\static/images/icons/add-user.png"></a>
        </div>
        <table class="f2-table" id="DisplayTable">
            <thead>
                <tr>
                    <th>id</th>
                    <th>fName</th>
                    <th>lName</th>
                    <th>role</th>
                    <th>details</th>
                    <th>delete</th>
                </tr>
            </thead>
            <tbody>
            <?php
                    require_once "./api/dbconn.inc.php"; 
                    $sql = "SELECT * FROM employees;";

                    if($result = mysqli_query($conn, $sql)) {
                        if(mysqli_num_rows($result) >= 1) {
                            while($row = mysqli_fetch_assoc($result)) {
                                echo 
                                '<tr class="row-hover">
                                    <td>' . $row['employee_id'] . '</td>
                                    <td>' . $row['f_name'] . '</td>
                                    <td>' . $row['l_name'] . '</td>
                                    <td>' . $row['role'] . '</td>
                                    <td> <a class="details-btn" href=admin-view-details.php?id=' . $row['employee_id'] . '>details</a> </td>
                                    <td> <a class="delete-btn" href=api/admin/admin-delete.php?id=' . $row['employee_id'] . ' onclick="return confirm(\'Are you sure you want to delete this employee?\');"><img class="delete-img" src="../public\static/images/icons/delete-user.png"></a> </td>'
                                    ;
                            }
                        }
                    }

                ?>
            </tbody>

        </table>

    </div>
<!-- grid-item2 - I want to act as a dynamic card interface, that allows me to add and edit users -->
    <div class="card">
        <div class="card-header1">
        <h3 class="card-header1-item1">User Details</h3> 
        
        <?php 
        require_once "./api/dbconn.inc.php";
        $id = $_GET["id"];
        echo
        '<div><a class="edit-btn" href=admin-edit.php?id='. $id . '><img class="add-img" src="../public\static/images/icons/edit-user.png"></a></div>';
        ?>
        
    
    </div>
    <div class="grid-item2-content">
        <p>Input values into the fields that you would like to edit</p>
        <?php 
        require_once "./api/dbconn.inc.php";
        $id = $_GET["id"];
        $sql = "SELECT * FROM employees WHERE employee_id = $id;";

        if($result = mysqli_query($conn, $sql)) {
            $row = mysqli_fetch_assoc($result);
            echo 
            '<form action="api/admin/admin-edit-handler.php" method="post">
            <input type="hidden" name="id" value="' . $row["employee_id"] . '">
            <div class="input-box">
                <span class="details">First Name</span> 
                <input type="text" name="fname">
            </div>
            <div class="input-box">
                <span class="details">Last Name</span> 
                <input type="text" name="lname">
            </div>
            <div class="input-box">
                <span class="details">Role</span> 
                <select name="role" id="role">
                    <option value="unchanged">unchanged</option>
                    <option value="Admin">Admin</option>
                    <option value="Factory Manager">Factory Manager</option>
                    <option value="Factory Worker">Factory Worker</option>
                    <option value="Auditor">Auditor</option>
                </select>
            </div>
            <div class="input-box">
                <span class="details">Phone Number</span> 
                <input type="text" name="phno">
            </div>
            <div class="input-box">
                <span class="email-title">Email</span>
                <input type="text" name="email">
            </div>

        
           <div class="button">
                <input class="submit-btn" type="submit" name="submit" value="Update User">
           </div>
        </form>'
            
            ;
        }

        ?>
        

        



    <!-- write in html outide, then put inside -->
        <!-- <p>First Name: </p>
        <p>Last Name: </p>
        <p>Role: </p>
        <p>Phone Number: </p>
        <p>Gender: </p> -->


    </div>

    </div>
    <div class="grid-item3"></div>
    </div>

    
</body>
</html>