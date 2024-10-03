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
    <!-- <div class="nav-container">
        <ul>
            <li><a>View</a></li>
            <li><a>Roles</a></li>
            <li><a>Create</a></li>
            <li><a>Delete</a></li>
        </ul>
    </div> -->
    <div class="grid-container">
        <div class="grid-item-header"></div>
    <div class="grid-item1">
        <table class="f2-table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>fName</th>
                    <th>lName</th>
                    <th>role</th>
                    <th></th>
                    <th></th>
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
                                    <td>Details</td>
                                    <td>Delete</td>'
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