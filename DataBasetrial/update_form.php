<?php
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "mySb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reservation_id'])) {
    $reservation_id = $_POST['reservation_id'];

    // Fetch the existing data for the given reservation ID
    $sql = "SELECT reservation_id, first_name, middle_name, surname, gender, email, flight FROM reservation WHERE reservation_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $reservation_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Close the statement
    $stmt->close();
}
?>

<form method="POST" action="process_reservations.php">
    <input type="hidden" name="reservation_id" value="<?php echo $row['reservation_id']; ?>">
    <input type="hidden" name="action" value="update">
    First Name: <input type="text" name="first_name" value="<?php echo $row['first_name']; ?>"><br>
    Middle Name: <input type="text" name="middle_name" value="<?php echo $row['middle_name']; ?>"><br>
    Surname: <input type="text" name="surname" value="<?php echo $row['surname']; ?>"><br>
    Gender: <input type="text" name="gender" value="<?php echo $row['gender']; ?>"><br>
    Email: <input type="text" name="email" value="<?php echo $row['email']; ?>"><br>
    <label for="flight">Select Flight:</label>
    <select id="flight" name="flight" required>
      <option value="flight1">Flight 1</option>
      <option value="flight2">Flight 2</option>
      <option value="flight3">Flight 3</option>
      <option value="flight4">Flight 4</option>
      <option value="flight5">Flight 5</option>
      <option value="flight6">Flight 6</option>
      <!-- Add more flight options -->
    </select><br>
    <input type="submit" value="Update">
</form>

<?php
// Close the connection
$conn->close();
?>
 <link rel="stylesheet" href="styeles.css">
