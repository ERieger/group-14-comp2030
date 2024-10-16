<?php
require_once '../src/api/dbconn.inc.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['machine_id'])) {
    $machineId = $_POST['machine_id'];

    // Fetching the curent machine details
    $sql = "SELECT machine_name, status FROM machines WHERE machine_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $machineId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $machineName = $row['machine_name'];
        $status = $row['status'];
    } else {
        die("Invalid machine ID.");
    }
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['updateMachine'])) {
    $machineName = $_POST['machine_name'];
    $status = $_POST['status'];
    $machineId = $_POST['machine_id'];

    // Update machine details
    $sql = "UPDATE machines SET machine_name = ?, status = ? WHERE machine_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $machineName, $status, $machineId);

    if ($stmt->execute()) {
        echo "Machine updated successfully.";
    } else {
        echo "Error updating machine: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
    header("Location: factoryworkerdashboard.php"); 
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Machine</title>
</head>
<body>
    <form method="POST" action="update_machine_Details.php">
        <input type="hidden" name="machine_id" value="<?php echo htmlspecialchars($machineId); ?>">
        <label for="machine_name">Machine Name:</label>
        <input type="text" id="machine_name" name="machine_name" value="<?php echo htmlspecialchars($machineName); ?>" required>

        <label for="status">Status:</label>
        <input type="text" id="status" name="status" value="<?php echo htmlspecialchars($status); ?>" required>

        <button type="submit" name="updateMachine">Update Machine</button>
    </form>
</body>
</html>
