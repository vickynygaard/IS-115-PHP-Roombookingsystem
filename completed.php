<?php
session_start();

// Check if booking exists in session
if (!isset($_SESSION['booking'])) {
    header("Location: simple.php");
    exit;
}

$booking = $_SESSION['booking'];

// Define path to rom_data.json
$rom_data_file = __DIR__ . '/admin/rom_data.json'; // Adjusted path

// Check if rom_data.json exists
if (!file_exists($rom_data_file)) {
    die('Error: Room data file not found.');
}

// Load room data from JSON file
$rom_data = json_decode(file_get_contents($rom_data_file), true);

// Check for JSON decoding errors
if ($rom_data === null) {
    die('Error: Failed to decode room data.');
}

// Get the room number from the booking session
$room_number_from_booking = $booking['room_number']; // This will be the room number the user booked

// Initialize room details as null in case the room is not found
$room_details = null;

// Loop through each room in rom_data and try to find the room that matches the booked room number
foreach ($rom_data as $room) {
    // Ensure that both the booking room number and the room's Rom-ID are integers for correct comparison
    if ((int)$room['Rom-ID'] === (int)$room_number_from_booking) {
        $room_details = $room; // Found the matching room
        break; // Stop the loop once we have the room details
    }
}

// If room details are not found, use fallback values
if ($room_details === null) {
    $room_number = 'Unknown';
    $room_type = 'Unknown';
} else {
    // If room is found, extract room details
    $room_number = $room_details['Rom-ID'];
    $room_type = $room_details['Type']; // Fetch the type of the room (this is the room type from JSON)
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Complete</title>
    <?php require('./inc/links.php'); ?> <!-- Corrected path -->
</head>
<body class="bg-light">

<?php require('./inc/header.php'); ?> <!-- Corrected path -->

<div class="container my-5">
    <div class="card text-center border-0 shadow">
        <div class="card-body">
            <h1 class="fw-bold text-success">Booking Confirmed!</h1>
            <p class="lead">Thank you for booking with us.</p>

            <!-- Display Room Details -->
            <p>Room Number: <strong><?= htmlspecialchars($room_number); ?></strong></p>
            <p>Room Type: <strong><?= htmlspecialchars($room_type); ?></strong></p>
            <p>Start Date: <strong><?= htmlspecialchars($booking['start_date']); ?></strong></p>
            <p>End Date: <strong><?= htmlspecialchars($booking['end_date']); ?></strong></p>
            
            <a href="./index.php" class="btn btn-outline-dark mt-3">Back to Home</a>
        </div>
    </div>
</div>

<?php require('./inc/footer.php'); ?> <!-- Corrected path -->

</body>
</html>
