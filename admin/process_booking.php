<?php
// Ensure sessions are started
session_start();

// Define the relative path to the JSON file
$rom_data_file = __DIR__ . '/rom_data.json'; // Adjust as needed if the file is not in the same directory

// Debugging: Uncomment this line if needed to check the resolved file path
// echo "Resolved Path: " . realpath($rom_data_file) . "<br>";

// Check if the JSON file exists
if (!file_exists($rom_data_file)) {
    die('Error: Room data file not found at ' . realpath($rom_data_file));
}

// Load JSON data
$rom_data = json_decode(file_get_contents($rom_data_file), true);

// Check for JSON decoding errors
if ($rom_data === null) {
    die('Error: Failed to decode JSON data. Please check the file format of rom_data.json.');
}

// Retrieve booking form data from POST
$start_date = $_POST['start_date'] ?? null;
$end_date = $_POST['end_date'] ?? null;
$booking_time = $_POST['booking_time'] ?? null;

// Validate form inputs
if (empty($start_date) || empty($end_date) || empty($booking_time)) {
    die('Error: All fields are required for booking.');
}

// Initialize room booking logic
$room_found = false; // Flag to indicate if a room is found

// Iterate through the room data to find an available room
foreach ($rom_data as $index => $room) {
    if ($room['Type'] === 'simple' && $room['Status'] === 'Ledig') { // Check for "simple" type and available status
        // Mark the room as booked
        $rom_data[$index]['Status'] = 'Opptatt'; // Set status to "Opptatt" (Booked)
        $rom_data[$index]['BookingInfo'] = [
            'Start_Date' => $start_date,
            'End_Date' => $end_date,
            'Booking_Time' => $booking_time,
        ];

        // Store booking information in session
        $_SESSION['booking'] = [
            'room_number' => $room['Romnummer'],
            'start_date' => $start_date,
            'end_date' => $end_date,
            'booking_time' => $booking_time,
        ];

        $room_found = true; // Room found and booked
        break;
    }
}

// Handle case where no available rooms are found
if (!$room_found) {
    die('Error: No available rooms found for your selected dates.');
}

// Save the updated room data back to the JSON file
if (file_put_contents($rom_data_file, json_encode($rom_data, JSON_PRETTY_PRINT)) === false) {
    die('Error: Unable to save updated room data.');
}

// Redirect to the booking confirmation page
header('Location: /mywebsite/admin/completed.php'); // Adjust this path to match your project structure
exit();
?>
