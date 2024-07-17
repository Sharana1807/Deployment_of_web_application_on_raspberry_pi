<?php
$department_id = $_GET['department_id'];
$conn = new mysqli('localhost', 'root', '', 'lab_objects');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$stmt = $conn->prepare("SELECT id, name FROM labs WHERE department_id = ?");
$stmt->bind_param("i", $department_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    echo '<option value="">Select Lab</option>';
    while($row = $result->fetch_assoc()) {
        echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
    }
} else {
    echo '<option value="">No Labs</option>';
}
$stmt->close();
$conn->close();
?>