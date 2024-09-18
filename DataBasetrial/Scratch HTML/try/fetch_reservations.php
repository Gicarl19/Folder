<?php
include 'connect.php';

$sql = "SELECT * FROM reservations";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservations</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Reservations List</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Reservation ID</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Surname</th>
                <th>Gender</th>
                <th>Email</th>
                <th>Flight</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['reservation_id'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($row['first_name'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($row['middle_name'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($row['surname'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($row['gender'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($row['email'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($row['flight'] ?? ''); ?></td>
                        <td>
                            <a href="edit_reservation.php?id=<?php echo htmlspecialchars($row['reservation_id'] ?? ''); ?>">Edit</a>
                            <a href="delete_reservation.php?id=<?php echo htmlspecialchars($row['reservation_id'] ?? ''); ?>">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8">No reservations found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>

<?php
$conn->close();
?>
