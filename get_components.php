<?php
$system_id = $_GET['system_id'];
$conn = new mysqli('localhost', 'root', '', 'lab_objects');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$stmt = $conn->prepare("SELECT id, name FROM components WHERE system_id = ?");
$stmt->bind_param("i", $system_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    echo '<option value="">Select Component</option>';
    while($row = $result->fetch_assoc()) {
        echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
    }
} else {
    echo '<option value="">No Components</option>';
}
$stmt->close();
$conn->close();
?>