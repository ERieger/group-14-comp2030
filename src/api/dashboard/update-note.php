<?php
require_once "../dbconn.inc.php";

$sql = 'UPDATE notes SET target_id=?, note_content=?, job_id=? WHERE note_id=?';
$statement =  mysqli_stmt_init($conn);

error_log("update");

mysqli_stmt_prepare($statement, $sql);
mysqli_stmt_bind_param($statement, 'issi', $_POST['target-select'], $_POST['note-content'], $_POST['target-job'], $_POST['note-id']);

$result = $statement->execute();

if ($result) {
    header("location: /factory-dashboard/src/notes.php");
}

mysqli_close($conn);
