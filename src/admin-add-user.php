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
    <div class="grid-container">
        <div class="grid-item-header"></div>
    <div class="grid-item1">
        <div class="card-header1">
            <h3 class="card-header1-item1">Users</h3>
            <div class="spacer"></div>
            <a href="add-user.php"><h3 class="add-user">+</h3></a>
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
                    require_once "dbconn.inc.php"; 
                    $sql = "SELECT * FROM users;";

                    if($result = mysqli_query($conn, $sql)) {
                        if(mysqli_num_rows($result) >= 1) {
                            while($row = mysqli_fetch_assoc($result)) {
                                echo 
                                '<tr>
                                    <td>' . $row['id'] . '</td>
                                    <td>' . $row['fName'] . '</td>
                                    <td>' . $row['lName'] . '</td>
                                    <td>' . $row['role'] . '</td>
                                    <td> <a class="details-btn" href=admin-details.php?id=' . $row['id'] . '>details</a> </td>
                                    <td> <a class="delete-btn" href=delete.php?id=' . $row['id'] . '>delete</a> </td>';
                            }
                        }
                    }

                ?>
            </tbody>

        </table>

    </div>
<!-- grid-item2 - I want to act as a dynamic card interface, that allows me to add and edit users -->
    <div class="grid-item2">
        <div class="card-header1">
        <h3 class="card-header1-item1">Add New User</h3>   
        </div>
    <div class="grid-item2-content">
    
    <form action="includes/formhandler.php" method="post">
            <div class="input-box">
                <span class="details">First Name</span> 
                <input type="text" name="fname" placeholder="" required>
            </div>
            <div class="input-box">
                <span class="details">Last Name</span> 
                <input type="text" name="lname" placeholder="" required>
            </div>
            <div class="input-box">
                <span class="details">Role</span> 
                <select name="role" id="role">
                    <option value="Admin">Admin</option>
                    <option value="Factory Manager">Factory Manager</option>
                    <option value="Factory Worker">Factory Worker</option>
                    <option value="Auditor">Auditor</option>
                </select>
            </div>
            <div class="input-box">
                <span class="details">Phone Number</span> 
                <input type="text" name="phno" placeholder="" required>
            </div>
            <div class="gender-details">
                <span class="gender-title">Gender</span>
                <select name="gender" id="gender">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>

                <!-- <div class="category">
                    <label for=""> -->
                        <!-- <span class="dot one"></span>
                        <span class="gender">Male</span>
                    </label>
                    <label for="">
                        <span class="dot one"></span>
                        <span class="gender">Female</span>
                    </label>
                    <label for="">
                        <span class="dot one"></span>
                        <span class="gender">Other</span>
                    </label>
                </div>
            </div> -->
           <div class="button">
                <input type="submit" name="submit" value="Create User">
           </div>
        </form>

    </div>

    </div>
    <div class="grid-item3"></div>
    </div>

    
</body>
</html>