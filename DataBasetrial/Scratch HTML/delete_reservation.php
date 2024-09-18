<?php
include 'connect.php';

$reservation_id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM reservations WHERE reservation_id=?");
$stmt->bind_param("s", $reservation_id);

if ($stmt->execute()) {
    header("Location: fetch_reservations.php");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
