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

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture POST data and sanitize
    $reservation_id = $_POST['reservation_id'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $surname = $_POST['surname'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $flight = $_POST['flight'];

    // Prepare an SQL statement with placeholders
    $stmt = $conn->prepare("INSERT INTO reservation (reservation_id, first_name, middle_name, surname, gender, email, flight) VALUES (?, ?, ?, ?, ?, ?, ?)");
    
    // Bind parameters to the placeholders
    $stmt->bind_param("issssss",$reservation_id, $first_name, $middle_name, $surname, $gender, $email, $flight);

    // Execute the statement
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>

