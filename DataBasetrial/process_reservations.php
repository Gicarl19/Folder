<html>
    <head>
    <style>
        body{
            padding-top: 100px;
            margin: 0;
            background: radial-gradient(592px at 48.2% 50%, rgba(255, 255, 249, 0.6) 0%, rgb(160, 199, 254) 74.6%);
            
        }
        .button {
            display: flex;
            float: inline-end;
            border: none;
            color: skyblue;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
  }
  table{
    
    margin-left: auto;
    margin-right: auto;
  }
    </style>
    </head>
    <body>
        <div class="button">
            <button><a href="ticketreservation.php">Back</a></button>
        </div>
    </body>
</html>

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

// Function to sanitize input
function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Insert data if POST request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'insert') {
    // Capture POST data and sanitize
    $reservation_id = sanitize_input($_POST['reservation_id']);
    $first_name = sanitize_input($_POST['first_name']);
    $middle_name = sanitize_input($_POST['middle_name']);
    $surname = sanitize_input($_POST['surname']);
    $gender = sanitize_input($_POST['gender']);
    $email = sanitize_input($_POST['email']);
    $flight = sanitize_input($_POST['flight']);

    // Prepare an SQL statement with placeholders
    $stmt = $conn->prepare("INSERT INTO reservation (reservation_id, first_name, middle_name, surname, gender, email, flight) VALUES (?, ?, ?, ?, ?, ?, ?)");
    
    // Bind parameters to the placeholders
    $stmt->bind_param("issssss", $reservation_id, $first_name, $middle_name, $surname, $gender, $email, $flight);

    // Execute the statement
    if ($stmt->execute()) {
        echo "";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Update data if POST request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'update') {
    // Capture POST data and sanitize
    $reservation_id = sanitize_input($_POST['reservation_id']);
    $first_name = sanitize_input($_POST['first_name']);
    $middle_name = sanitize_input($_POST['middle_name']);
    $surname = sanitize_input($_POST['surname']);
    $gender = sanitize_input($_POST['gender']);
    $email = sanitize_input($_POST['email']);
    $flight = sanitize_input($_POST['flight']);

    // Prepare an SQL statement with placeholders
    $stmt = $conn->prepare("UPDATE reservation SET first_name=?, middle_name=?, surname=?, gender=?, email=?, flight=? WHERE reservation_id=?");

    // Bind parameters to the placeholders
    $stmt->bind_param("ssssssi", $first_name, $middle_name, $surname, $gender, $email, $flight, $reservation_id);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Record updated successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Delete data if POST request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'delete') {
    // Capture POST data and sanitize
    $reservation_id = sanitize_input($_POST['reservation_id']);

    // Prepare an SQL statement with placeholders
    $stmt = $conn->prepare("DELETE FROM reservation WHERE reservation_id=?");

    // Bind parameters to the placeholders
    $stmt->bind_param("i", $reservation_id);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Record deleted successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Fetching data from the reservation table
$sql = "SELECT reservation_id, first_name, middle_name, surname, gender, email, flight FROM reservation";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    echo "<table border='1px solid black'><tr><th>Reservation ID</th><th>First Name</th><th>Middle Name</th><th>Surname</th><th>Gender</th><th>Email</th><th>Flight</th><th>Actions</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["reservation_id"]. "</td><td>" . $row["first_name"]. "</td><td>" . $row["middle_name"]. "</td><td>" . $row["surname"]. "</td><td>" . $row["gender"]. "</td><td>" . $row["email"]. "</td><td>" . $row["flight"]. "</td>";
        echo "<td>
                <form method='POST' style='display:inline-block;'>
                    <input type='hidden' name='reservation_id' value='" . $row["reservation_id"] . "'>
                    <input type='hidden' name='action' value='delete'>
                    <input type='submit' value='Delete'>
                </form>
                <form method='POST' action='update_form.php' style='display:inline-block;'>
                    <input type='hidden' name='reservation_id' value='" . $row["reservation_id"] . "'>
                    <input type='submit' value='Update'>
                </form>
              </td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

// Close the connection
$conn->close();
?>
