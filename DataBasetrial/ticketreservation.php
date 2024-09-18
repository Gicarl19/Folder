<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Airline Reservation System</title>
  <link rel="stylesheet" href="styeles.css">
</head>
<body>
  <div class="button">
    <button><a href="homepage.php">Home</a></button>
  </div>
  <h1>Make a Reservation</h1>
  <form action="process_reservations.php" method="POST">
  <input type="hidden" name="action" value="insert">
    Reservation ID: <input type="text" name="reservation_id"><br>
    First Name: <input type="text" name="first_name"><br>
    Middle Name: <input type="text" name="middle_name"><br>
    Surname: <input type="text" name="surname"><br>
    Gender: <input type="text" name="gender"><br>
    Email: <input type="text" name="email"><br>

    <label for="flight">Select Flight:</label>
    <select id="flight" name="flight" required>
      <option value="">Select Flight No.</option>
      <option value="flight 1">Flight 1</option>
      <option value="flight 2">Flight 2</option>
      <option value="flight 3">Flight 3</option>
      <option value="flight 4">Flight 4</option>
      <option value="flight 5">Flight 5</option>
      <option value="flight 6">Flight 6</option>
      <!-- Add more flight options -->
    </select>
    <button type="submit">Add Reservation</button>
  </form>

  <h2>Available Flights</h2>
  <ul>
    <li>Flight 1 /June 18, 2022/ 10:40 AM / JAPAN</li>
    <li>Flight 2 /June 18, 2022/ 15:30 PM / SEOUL SOUTH KOREA</li>
    <li>Flight 3 /June 18, 2022/ 20:40 PM / RUSSIA</li>
    <li>Flight 4 /June 18, 2022/ 04:40 AM / GERMANY</li>
    <li>Flight 5 /June 19, 2022/ 12:40 PM / THAILAND</li>
    <li>Flight 6 /June 19, 2022/ 17:40 PM / CHINA</li>
    <!-- Add more flights dynamically -->
  </ul>
</body>
</html>
