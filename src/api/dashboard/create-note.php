<?php
require_once "../dbconn.inc.php";

$sql = "INSERT INTO notes (target_id , note_content, job_id) VALUES(?, ?, ?);";
$statement =  mysqli_stmt_init($conn);

mysqli_stmt_prepare($statement, $sql);
mysqli_stmt_bind_param($statement, 'isi', htmlspecialchars($_POST["target-select"]), htmlspecialchars($_POST["note-content"]), htmlspecialchars($_POST["target-job"]));

$result = $statement->execute();

if ($result) {
    header("location: ../../notes.php");
}

mysqli_close($conn);
