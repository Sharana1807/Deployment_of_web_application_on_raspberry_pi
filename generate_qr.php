<?php
$component_id = $_GET['component_id'];

$conn = new mysqli('localhost', 'root', '', 'lab_objects');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("
    SELECT 
        components.name AS component_name, 
        systems.name AS system_name, 
        labs.name AS lab_name, 
        departments.name AS department_name 
    FROM components 
    JOIN systems ON components.system_id = systems.id 
    JOIN labs ON systems.lab_id = labs.id 
    JOIN departments ON labs.department_id = departments.id 
    WHERE components.id = ?
");
$stmt->bind_param("i", $component_id);
$stmt->execute();
$result = $stmt->get_result();
$details = $result->fetch_assoc();
$stmt->close();
if ($details) {
    $info = "Department: " . $details['department_name'] . "\n" .
            "Lab: " . $details['lab_name'] . "\n" .
            "System: " . $details['system_name'] . "\n" .
            "Component: " . $details['component_name'];
    
    $encoded_info = urlencode($info);
    $qr_code_url = "https://api.qrserver.com/v1/create-qr-code/?data={$encoded_info}&size=150x150";
    
    // Save the QR code image locally
    $image_path = "qrcode_{$component_id}.png";
    file_put_contents($image_path, file_get_contents($qr_code_url));

    // Update the component's QR code path in the database
    $update_stmt = $conn->prepare("UPDATE components SET qr_code_path = ? WHERE id = ?");
    $update_stmt->bind_param("si", $image_path, $component_id);
    $update_stmt->execute();
    $update_stmt->close();
    echo "<img src='$image_path' />";
    echo "<br><h2><a href='$image_path' download>Download QR Code</a></h2>";
} else {
    echo "Component not found.";
}
$conn->close();
?>
