<?php
require_once "../dbconn.inc.php";

$sql;
if ($_POST["action"] == "inc") {
    $sql = "UPDATE parts
            SET progress = progress + 1
            WHERE part_id = " . $_POST["part"] . ";";
} else if ($_POST["action"] == "dec") {
    $sql = "UPDATE parts
            SET progress = progress - 1
            WHERE part_id = " . $_POST["part"] . ";";
}

$statement =  mysqli_stmt_init($conn);

mysqli_stmt_prepare($statement, $sql);

$result = $statement->execute();

if ($result) {
    // header("location: tasks.php");
    return;
}

mysqli_close($conn);
