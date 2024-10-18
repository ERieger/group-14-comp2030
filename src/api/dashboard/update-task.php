<?php
require_once "../dbconn.inc.php";

$jobId = mysqli_real_escape_string($conn, $_GET["job"]);

$sql1 = "UPDATE parts
SET progress = progress + 1
WHERE part_id = " . $_POST["method"] . "
AND progress < qty;";


if ($conn->query($sql1) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

// $data = [];
// $sql2 = "SELECT progress FROM parts WHERE part_id = " . $_POST["method"] . ";";
// $result = mysqli_query($conn, $sql1);

// if ($result === false) {
//     echo "Error executing query: " . mysqli_error($conn);
// } else {
//     if (mysqli_num_rows($result) > 0) {
//         while ($row = mysqli_fetch_assoc($result)) {
//             $data[] = $row;
//         }
//         mysqli_free_result($result);
//     } else {
//         echo "No Records.";
//     }
// }


mysqli_close($conn);

// header('Content-Type: application/json; charset=utf-8');
// echo json_encode($data);
