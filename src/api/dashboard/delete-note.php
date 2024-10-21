<?php
require_once "../dbconn.inc.php";

$sql = 'DELETE FROM notes WHERE note_id = ' . $_POST["note_id"];
$statement =  mysqli_stmt_init($conn);

mysqli_stmt_prepare($statement, $sql);

$result = $statement->execute();

if ($result) {
    // header("location: ../../src/notes.php")
    return;
}

mysqli_close($conn);
