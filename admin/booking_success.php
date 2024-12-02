<?php
session_start();  // Start the session to access booking details

// Check if booking information is available in session
if (!isset($_SESSION['booking'])) {
    // If not, redirect the user back to the booking page (or show an error)
    header("Location: simple.php");
    exit;
}

$booking = $_SESSION['booking'];
$roomNumber = $booking['room_number'];
$bookingDate = $booking['booking_date'];
$checkInTime = $booking['check_in_time'];
$checkOutTime = $booking['check_out_time'];

// Calculate time until check-in and check-out
$currentTime = time();
$checkInTimestamp = strtotime($checkInTime);
$checkOutTimestamp = strtotime($checkOutTime);
$timeUntilCheckIn = max(0, $checkInTimestamp - $currentTime);
$timeUntilCheckOut = max(0, $checkOutTimestamp - $currentTime);

// Convert seconds to readable format (HH:MM:SS)
function formatTime($seconds) {
    return gmdate("H:i:s", $seconds);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Successful</title>
    <script>
        // Function to update the countdown timers
        function updateCountdown() {
            var checkInTime = <?php echo $timeUntilCheckIn; ?>;
            var checkOutTime = <?php echo $timeUntilCheckOut; ?>;
            
            // Update check-in countdown
            if (checkInTime > 0) {
                checkInTime -= 1;
                document.getElementById('checkInCountdown').innerText = formatTime(checkInTime);
            }
            
            // Update check-out countdown
            if (checkOutTime > 0) {
                checkOutTime -= 1;
                document.getElementById('checkOutCountdown').innerText = formatTime(checkOutTime);
            }

            // Refresh the countdown every second
            setTimeout(updateCountdown, 1000);
        }

        // Format seconds into HH:MM:SS
        function formatTime(seconds) {
            var hours = Math.floor(seconds / 3600);
            var minutes = Math.floor((seconds % 3600) / 60);
            var seconds = seconds % 60;
            return hours + ":" + minutes + ":" + seconds;
        }

        // Start the countdown
        window.onload = function() {
            updateCountdown();
        };
    </script>
</head>
<body>
    <h1>Congratulations! Your booking is successful.</h1>
    <p>Room Number: <?php echo $roomNumber; ?></p>
    <p>Booking Date: <?php echo $bookingDate; ?></p>
    <p>Check-in Time: <?php echo $checkInTime; ?></p>

    <h3>Countdown to Check-in:</h3>
    <p id="checkInCountdown"><?php echo formatTime($timeUntilCheckIn); ?></p>

    <h3>Countdown to Check-out:</h3>
    <p id="checkOutCountdown"><?php echo formatTime($timeUntilCheckOut); ?></p>
</body>
</html>
