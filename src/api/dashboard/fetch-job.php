<?php
require_once "../dbconn.inc.php";

$jobId = mysqli_real_escape_string($conn, $_GET["job"]);

$sql1 = "SELECT j.job_id, j.job_name, e.f_name, e.l_name 
FROM jobs j 
INNER JOIN employees e ON j.employee_id = e.employee_id
WHERE j.job_id = '{$jobId}';";

$sql2 = "SELECT p.part_id, p.item, p.qty, m.machine_name, p.progress, p.image
FROM parts p
INNER JOIN machines m ON p.machine_id=m.machine_id
WHERE p.job_id = '{$jobId}';";
$result = mysqli_query($conn, $sql1);
$result2 = mysqli_query($conn, $sql2);


$data = [
    "job" => [],
    "parts" => [],
];

if ($result === false) {
    echo "Error executing query: " . mysqli_error($conn);
} else {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data["job"][] = $row;
        }
        mysqli_free_result($result);
    } else {
        echo "No Records.";
    }
}

if ($result2 === false) {
    echo "Error executing query: " . mysqli_error($conn);
} else {
    if (mysqli_num_rows($result2) > 0) {
        while ($row2 = mysqli_fetch_assoc($result2)) {
            $data["parts"][] = $row2;
        }
        mysqli_free_result($result2);
    } else {
        echo "No Records.";
    }
}
mysqli_close($conn);

header('Content-Type: application/json; charset=utf-8');
echo json_encode($data);
