<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reservation_id = $_POST['reservation_id'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $surname = $_POST['surname'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $flight = $_POST['flight'];

    $stmt = $conn->prepare("UPDATE reservations SET first_name=?, middle_name=?, surname=?, gender=?, email=?, flight=? WHERE reservation_id=?");
    $stmt->bind_param("sssssss", $first_name, $middle_name, $surname, $gender, $email, $flight, $reservation_id);

    if ($stmt->execute()) {
        header("Location: fetch_reservations.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    $reservation_id = $_GET['id'];
    $result = $conn->query("SELECT * FROM reservations WHERE reservation_id='$reservation_id'");
    $reservation = $result->fetch_assoc();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Reservation</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Edit Reservation</h1>
    <form action="edit_reservation.php" method="POST">
        <input type="hidden" name="reservation_id" value="<?php echo htmlspecialchars($reservation['reservation_id']); ?>">
        <label for="first_name">First name:</label>
        <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($reservation['first_name']); ?>" required>
        <label for="middle_name">Middle name:</label>
        <input type="text" id="middle_name" name="middle_name" value="<?php echo htmlspecialchars($reservation['middle_name']); ?>" required>
        <label for="surname">Surname:</label>
        <input type="text" id="surname" name="surname" value="<?php echo htmlspecialchars($reservation['surname']); ?>" required>
        <label for="gender">Gender:</label>
        <input type="text" id="gender" name="gender" value="<?php echo htmlspecialchars($reservation['gender']); ?>" required>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($reservation['email']); ?>" required>
        <label for="flight">Flight:</label>
        <input type="text" id="flight" name="flight" value="<?php echo htmlspecialchars($reservation['flight']); ?>" required>
        <button type="submit">Update Reservation</button>
    </form>
</body>
</html>
