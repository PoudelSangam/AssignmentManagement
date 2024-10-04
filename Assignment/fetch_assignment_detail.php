<?php
include_once 'db.php';
header("Content-Type: application/json");



$id = $_GET['id'];

$sql = "SELECT * FROM assignmentlist WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

$assignment = $result->fetch_assoc();

$stmt->close();
$conn->close();

echo json_encode($assignment);
?>
