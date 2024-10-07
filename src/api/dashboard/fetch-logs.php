<?php
require_once "../dbconn.inc.php";

$sql = "SELECT * FROM logs WHERE `timestamp` BETWEEN '{$_GET["startTimestamp"]}' AND '{$_GET["endTimestamp"]}';";
$result = mysqli_query($conn, $sql);

$data = [];

if ($result === false) {
    echo "Error executing query: " . mysqli_error($conn);
} else {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        mysqli_free_result($result);
    } else {
        echo "<p>No records found.</p>"; // No records returned
    }
}
mysqli_close($conn);

header('Content-Type: application/json; charset=utf-8');
echo json_encode($data);
?>
