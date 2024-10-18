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
                                    <td> <a class="delete-btn" href=api/admin/admin-delete.php?id=' . $row['employee_id'] . '><img class="delete-img" src="../public\static/images/icons/delete-user.png"></a> </td>'
                                    ;
                            }
                        }
                    }

                ?>
            </tbody>

        </table>

    </div>

    <div class="grid-item2">

    </div>
    <div class="grid-item3"></div>
    </div>

    
</body>
</html>