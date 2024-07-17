<?php
$conn = new mysqli('localhost', 'root', '', 'lab_objects');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT id, name FROM departments";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo '<option value="">Select Department</option>';
    while($row = $result->fetch_assoc()) {
        echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
    }
} else {
    echo '<option value="">No Departments</option>';
}
$conn->close();
?>