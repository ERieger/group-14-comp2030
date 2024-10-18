<?php
require_once "../dbconn.inc.php";

$sql;

$machines = ["CNC Machine", "3D Printer", "Industrial Robot", "Automated Guided Vehicle (AGV)", "Smart Conveyor System", "IoT Sensor Hub", "Predictive Maintenance System", "Automated Assembly Line", "Quality Control Scanner", "Energy Management System"];

if ($_GET["machine"] == "*") {
    $sql = "SELECT * FROM logs WHERE `timestamp` BETWEEN '{$_GET["startTimestamp"]}' AND '{$_GET["endTimestamp"]}';";
} else {
    error_log("GET machine: " . $_GET["machine"]);
    foreach ($machines as $machine) {
        error_log("Current machine: " . $machine);
        error_log("Compare: " . strcasecmp(trim($_GET["machine"]), trim($machine)));

        if (strcasecmp(trim($_GET["machine"]), trim($machine)) == 0) {
            $sql = "SELECT * FROM logs WHERE `timestamp` BETWEEN '{$_GET['startTimestamp']}' AND '{$_GET['endTimestamp']}' AND `machine_name` LIKE '{$machine}'";
            error_log($sql);
            break;
        } else {
            $sql = "SELECT * FROM logs WHERE `timestamp` BETWEEN '{$_GET["startTimestamp"]}' AND '{$_GET["endTimestamp"]}';";
            error_log("NO MATCH " . $sql);
        }
    }
}

error_log($sql);
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
        echo "No Records."; // No records returned
    }
}
mysqli_close($conn);

header('Content-Type: application/json; charset=utf-8');
echo json_encode($data);
