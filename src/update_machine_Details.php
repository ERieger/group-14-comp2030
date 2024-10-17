<?php
require_once '../src/api/dbconn.inc.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['machine_id'])) {
    $machineId = $_POST['machine_id'];

    // Fetching the current machine details (machine_id and machine_name)
    $sql = "SELECT machine_name, machine_id FROM machines WHERE machine_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $machineId); // 'i' for integer
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $machineName = $row['machine_name'];
        $machineId = $row['machine_id'];  // Redundant here, since you already have it
    } else {
        die("Invalid machine ID.");
    }
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['updateMachine'])) {
    $machineName = $_POST['machine_name'];
    $machineId = $_POST['machine_id'];

    // Update machine details (only machine_name based on machine_id)
    $sql = "UPDATE machines SET machine_name = ? WHERE machine_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $machineName, $machineId); // 's' for string, 'i' for integer

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


    <form method="POST" action="update_machine_Details.php">
        <input type="hidden" name="machine_id" value="<?php echo htmlspecialchars($machineId); ?>">
        <label for="machine_name">Machine Name:</label>
        <input type="text" id="machine_name" name="machine_name" value="<?php echo htmlspecialchars($machineName); ?>" required>

        <label for="status">Status:</label>
        <input type="text" id="status" name="status" value="<?php echo htmlspecialchars($status); ?>" required>

        <button type="submit" name="updateMachine">Update Machine</button>
    </form>

