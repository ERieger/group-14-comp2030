<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks</title>
    <link rel="stylesheet" href="../public/static/css/normalize.css">
    <link rel="stylesheet" href="../public/static/css/colours.css">
    <link rel="stylesheet" href="../public/static/css/utility.css">
    <link rel="stylesheet" href="../public/static/css/index.css">
</head>

<body>
    <header>
        <div class="navbar">
            <img src="../public/static/images/logo.png" alt="COMPANY LOGO" class="logo">
            <p>Tasks</p>
            <div class="spacer"></div>
            <div class="nav-item">
                <a href="login.php">
                    <img src="../public/static/images/icons/logout.png" alt="LOGOUT ICON">
                    <p>Logout</p>
                </a>
            </div>
            <div class="nav-item">
                <a href="dashboard.php">
                    <img src="../public/static/images/icons/dashboard.png" alt="DASHBOARD ICON">
                    <p>Dashboard</p>
                </a>
            </div>
            <div class="nav-item">
                <a href="tasks.php">
                    <img src="../public/static/images/icons/tasks.png" alt="TASKS ICON">
                    <p>Tasks</p>
                </a>
            </div>
            <div class="nav-item">
                <img src="../public/static/images/icons/menu.png" alt="MENU ICON">
                <p>Menu</p>
            </div>
        </div>
    </header>
    <main class="dashboard-container">
        <div class="dashboard-content">
            <button onclick="addNote()" style="margin: 1rem 0 0 1rem;">Add New Note</button>
            <div id="edit-note-form-container" class="quick-stats card-main card card-100p hidden">
                <form id="edit-note-form" action="api/dashboard/create-note.php" method="post">
                    <div class="card-header">
                        <h3>Update/Create Notes</h3>
                        <div class="spacer"></div>
                        <button type="submit">Save</button>
                    </div>
                    <div class="card-content" style="display:flex;flex-direction:column;">
                        <h4>Target Job</h4>
                        <select name="target-job" id="target-job" style="margin-bottom: 10px">
                            <option default disabled value="-999">Please select a job to reference.</option>
                            <?php
                            require_once "./api/dbconn.inc.php";
                            $sql1 = "SELECT j.job_id, j.job_name FROM jobs j;";
                            $result1 = mysqli_query($conn, $sql1);

                            if (mysqli_num_rows($result1) > 0) {
                                while ($row = mysqli_fetch_assoc($result1)) {
                                    echo '<option value="' . $row["job_id"] . '">' . $row["job_name"] . '</option>';
                                }
                                mysqli_free_result($result1);
                            } else {
                                echo "0 results";
                            }
                            ?>
                        </select>
                        <h4>Target Name</h4>
                        <select name="target-select" id="target-select" style="margin-bottom: 10px">
                            <option default disabled value="-999">Please select an employee to reference.</option>
                            <?php
                            require_once "./api/dbconn.inc.php";
                            $sql1 = "SELECT e.employee_id, e.f_name, e.l_name FROM employees e;";
                            $result1 = mysqli_query($conn, $sql1);

                            if (mysqli_num_rows($result1) > 0) {
                                while ($row = mysqli_fetch_assoc($result1)) {
                                    echo '<option value="' . $row["employee_id"] . '">' . $row["f_name"] . ' ' . $row["l_name"] . '</option>';
                                }
                                mysqli_free_result($result1);
                            } else {
                                echo "0 results";
                            }
                            ?>
                        </select>
                        <h4>Note Content</h4>
                        <textarea name="note-content" id="note-content" cols="30" rows="10"></textarea>
                        <input type="number" name="note-id" id="note-id" class="hidden">
                    </div>
                </form>
            </div>

            <?php
            require_once "./api/dbconn.inc.php";
            $sql2 = "SELECT n.note_id,e.employee_id, e.f_name, e.l_name, n.note_content, j.job_name, j.job_id
            FROM notes n 
            INNER JOIN employees e ON e.employee_id = n.target_id
            INNER JOIN jobs j ON j.job_id  = n.job_id;";
            $result2 = mysqli_query($conn, $sql2);

            if (mysqli_num_rows($result2) > 0) {
                while ($row = mysqli_fetch_assoc($result2)) {
                    echo '
                        <div class="quick-stats card-main card card-100p">
                        <div class="card-header">
                            <h3 id="' . $row["note_id"] . '-job" data-attr="' . $row["job_id"] . '">Work Order For: ' . $row["job_name"] . '</h3>
                            <div class="spacer"></div>
                            <button type="button" onclick="deleteNote(' . $row["note_id"] . ')">Delete Note</button>
                            <button type="button" onclick="editNote(' . $row["note_id"] . ')">Edit Note</button>
                        </div>
                        <div class="card-content card-content-block">
                            <p id="' . $row["note_id"] . '-employee" data-attr="' . $row["employee_id"] . '">Target Employee: <strong>' . $row["f_name"] . ' ' . $row["l_name"] . '</strong></p>

                            <h3>Note Content:</h3>
                            <p id="' . $row["note_id"] . '-note-content"data-attr="' . $row["note_content"] . '">' . $row["note_content"] . '</p>
                        </div></div>';
                }
                mysqli_free_result($result2);
            } else {
                echo "0 results";
            }
            ?>
    </main>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.14.0/jquery-ui.min.js" integrity="sha256-Fb0zP4jE3JHqu+IBB9YktLcSjI1Zc6J2b6gTjB0LpoM=" crossorigin="anonymous"></script>
    <script src="../public/static/js/paging/paging.js"></script>
    <script src="../public/static/js/Chart.js"></script>
    <script src="../public/static/js/notes.js"></script>
</body>

</html>

<?php
mysqli_close($conn);
?>