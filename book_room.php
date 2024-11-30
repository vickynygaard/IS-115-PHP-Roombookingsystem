<?php
// Define the path to the JSON file
$rom_data_file = 'Admin/rom_data.json';

// Load JSON data
$rom_data = json_decode(file_get_contents($rom_data_file), true);

// Check if booking action is triggered
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book_now']) && isset($_POST['room_type'])) {
    $room_type = $_POST['room_type']; // Get the room type (simple, double, suite)

    // Find the first available room of the specified type
    foreach ($rom_data as &$room) {
        if ($room['Type'] === $room_type && $room['Status'] === 'Ledig') {
            $room['Status'] = 'Opptatt'; // Mark as booked
            file_put_contents($rom_data_file, json_encode($rom_data, JSON_PRETTY_PRINT));
            break;
        }
    }

    // Redirect back to the appropriate page based on room type
    if ($room_type === 'suite') {
        header("Location: suite.php"); // Redirect to suite.php after booking
    } else if ($room_type === 'simple') {
        header("Location: simple.php"); // Redirect to simple.php if room type is simple
    } else if ($room_type === 'double') {
        header("Location: double.php"); // Redirect to double.php if room type is double
    }
    exit();
}
?>
