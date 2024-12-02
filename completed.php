<?php
session_start();

// Check if booking exists in session
if (!isset($_SESSION['booking'])) {
    header("Location: simple.php");
    exit;
}

$booking = $_SESSION['booking'];

// Define path to rom_data.json
$rom_data_file = __DIR__ . '/admin/rom_data.json';

if (!file_exists($rom_data_file)) {
    die('Error: Room data file not found.');
}

// Load room data from JSON file
$rom_data = json_decode(file_get_contents($rom_data_file), true);

// Check for JSON decoding errors
if ($rom_data === null) {
    die('Error: Failed to decode room data.');
}

// Find the room details using Rom-ID from the booking
$room_details = null;
foreach ($rom_data as $room) {
    // Compare room ID with booking room number
    if ((int)$room['Rom-ID'] === (int)$booking['room_number']) {
        $room_details = $room;
        break; 
    }
}

// If room details are not found, show a fallback message
if ($room_details === null) {
    $room_number = 'Unknown';
    $room_type = 'Unknown';
    $room_status = 'Unknown';
} else {
    $room_number = $rom_data_file['Rom-ID'];
    $room_type = $rom_data_file['Type'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Complete</title>
    <?php require('./inc/links.php'); ?> 
</head>
<body class="bg-light">

<?php require('./inc/header.php'); ?> 

<div class="container my-5">
    <div class="card text-center border-0 shadow">
        <div class="card-body">
            <h1 class="fw-bold text-success">Booking Confirmed!</h1>
            <p class="lead">Thank you for booking with us.</p>
            <!-- Display the room details -->
            <p>Room Number: <strong><?= htmlspecialchars($room_number); ?></strong></p>
            <p>Room Type: <strong><?= htmlspecialchars($room_type); ?></strong></p>
            <p>Start Date: <strong><?= htmlspecialchars($booking['start_date']); ?></strong></p>
            <p>End Date: <strong><?= htmlspecialchars($booking['end_date']); ?></strong></p>
            <a href="./index.php" class="btn btn-outline-dark mt-3">Back to Home</a>
        </div>
    </div>
</div>

<?php require('./inc/footer.php'); ?>
</body>
</html>
