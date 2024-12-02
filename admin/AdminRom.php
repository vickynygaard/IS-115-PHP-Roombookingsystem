<<<<<<< main
<?php
require('inc/essentials.php');
adminLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Dashboard</title>
    <?php require('inc/links.php'); ?>
    <style>
        /* Ensure all tables have the same height and consistent width */
        .table-container {
            height: 400px; /* Set a fixed height for uniformity */
            overflow-y: auto; /* Allow scrolling for content overflow */
            margin-bottom: 20px;
        }

        .table-container table {
            height: 100%;
            table-layout: fixed;
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            height: 50px; /* Adjust row height for consistency */
            text-align: left;
            padding: 10px;
            word-wrap: break-word;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Responsive adjustments for smaller screens */
        @media (max-width: 768px) {
            th, td {
                font-size: 12px;
                padding: 8px;
            }

            .table-container {
                overflow-x: auto;
            }
        }

        /* Adjustments for forms inside the table */
        input[type="date"], input[type="time"], select {
            width: 100%;
            max-width: 200px;
            font-size: 12px;
        }

        /* Add some margin for spacing between form elements */
        label {
            font-size: 12px;
        }

        /* Style for the buttons near the password input */
        .form-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-actions input[type="submit"] {
            font-size: 14px;
            padding: 5px 15px;
        }
    </style>
</head>
<body class="bg-light">

<?php require('inc/header.php'); ?>

<div class="container-fluid" id="main-content">
    <div class="row">
        <div class="col-lg-10 ms-auto p-4 overflow-hidden">

<?php
// JSON file path
$filbane = 'rom_data.json';

// Function to read data from JSON file
function lesRomData($filbane) {
    if (file_exists($filbane)) {
        $data = file_get_contents($filbane);
        return json_decode($data, true); // Return as associative array
    } else {
        return []; // Return empty array if file doesn't exist
    }
}

// Function to write data to JSON file
function skrivRomData($filbane, $romdata) {
    $data = json_encode($romdata, JSON_PRETTY_PRINT);
    file_put_contents($filbane, $data);
}

// Read JSON file
$rom = lesRomData($filbane);

// Default settings
$korrrekt_passord = '12345'; // Correct password
$kan_redigere = false;       // Can edit or not
$prompt = "Skriv inn passord for å redigere rommene."; // Default prompt

// Handling password and updates
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['passord'])) {
        if ($_POST['passord'] === $korrrekt_passord) {
            if (isset($_POST['confirm_password'])) {
                // User confirmed password; allow updates
                $kan_redigere = true;

                // Handle updates
                if (isset($_POST['status'])) {
                    foreach ($rom as $index => $r) {
                        if (isset($_POST['status'][$index])) {
                            $rom[$index]['Status'] = $_POST['status'][$index];

                            // Clear BookingInfo if the status is set to 'Ledig'
                            if ($_POST['status'][$index] === 'Ledig') {
                                $rom[$index]['BookingInfo'] = 'N/A';
                            }
                        }

                        // Update the booking info if there's a change and the status is not 'Ledig'
                        if ($_POST['status'][$index] !== 'Ledig' && isset($_POST['checkin_date'][$index]) && isset($_POST['checkout_date'][$index])) {
                            $rom[$index]['BookingInfo'] = [
                                'Start_Date' => $_POST['checkin_date'][$index],
                                'End_Date' => $_POST['checkout_date'][$index],
                                'Booking_Time' => $_POST['booking_time'][$index] ?? 'N/A' // Optional time
                            ];
                        }
                    }
                    skrivRomData($filbane, $rom);
                    $prompt = "Skriv inn passord for å redigere rommene."; // Reset to default prompt
                    $kan_redigere = false; // Disable edit mode
                    echo "<p style='color:green;'>Oppdateringer er lagret!</p>";
                }
            } else {
                // Prompt user to confirm password
                $prompt = "Skriv passord igjen før du oppdaterer.";
                $_SESSION['password_verified'] = true; // Temporarily store verified state
                $kan_redigere = true; // Enable edit mode
            }
        } else {
            $prompt = "Feil passord. Du kan kun se rommene."; // Wrong password
            $kan_redigere = false; // Ensure no edit access
        }
    }

    // Reset after logout
    if (isset($_POST['logout'])) {
        $kan_redigere = false;
        $prompt = "Skriv inn passord for å redigere rommene."; // Reset to default prompt
        unset($_SESSION['password_verified']);
    }
}


// Group rooms by floor
$rom_1_etasje = array_filter($rom, fn($r) => intval($r['Rom-ID']) < 200);
$rom_2_etasje = array_filter($rom, fn($r) => intval($r['Rom-ID']) >= 200 && intval($r['Rom-ID']) < 300);
$rom_3_etasje = array_filter($rom, fn($r) => intval($r['Rom-ID']) >= 300);

// Function to display a table for a specific floor
function skrivUtTabell($romEtasje, $kan_redigere, $etasjenavn) {
    echo "<div>";
    echo "<h3>$etasjenavn</h3>";
    echo "<div class='table-container'>";
    echo "<table border='1'>";

    if (!empty($romEtasje)) {
        echo "<tr>";
        foreach (array_keys(reset($romEtasje)) as $header) {
            echo "<th>" . htmlspecialchars($header) . "</th>";
        }
        echo "</tr>";

        foreach ($romEtasje as $index => $r) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($r['Rom-ID']) . "</td>";
            echo "<td>" . htmlspecialchars($r['Type']) . "</td>";

            if ($kan_redigere) {
                echo "<td>
                        <select name='status[$index]'>
                            <option value='Ledig'" . ($r['Status'] == 'Ledig' ? ' selected' : '') . ">Ledig</option>
                            <option value='Opptatt'" . ($r['Status'] == 'Opptatt' ? ' selected' : '') . ">Opptatt</option>
                        </select>
                      </td>";
                echo "<td>
                        <label for='checkin_date[$index]'>Check-in</label>
                        <input type='date' name='checkin_date[$index]' value='" . 
                            (isset($r['BookingInfo']['Start_Date']) ? $r['BookingInfo']['Start_Date'] : '') . "'>
                      </td>";
                echo "<td>
                        <label for='checkout_date[$index]'>Check-out</label>
                        <input type='date' name='checkout_date[$index]' value='" . 
                            (isset($r['BookingInfo']['End_Date']) ? $r['BookingInfo']['End_Date'] : '') . "'>
                      </td>";
                echo "<td>
                        <input type='time' name='booking_time[$index]' value='" . 
                            (isset($r['BookingInfo']['Booking_Time']) ? $r['BookingInfo']['Booking_Time'] : '') . "'>
                      </td>";
            } else {
                $booking_info = 'N/A <br><Strong>to</strong><br> N/A';
                if (isset($r['BookingInfo']) && $r['BookingInfo'] !== 'N/A') {
                    $booking_info = isset($r['BookingInfo']['Start_Date']) && isset($r['BookingInfo']['End_Date']) 
                    ? $r['BookingInfo']['Start_Date'] . " <br><strong>To</strong><br> " . $r['BookingInfo']['End_Date'] 
                    : 'N/A to N/A';
                }
                echo "<td>" . htmlspecialchars($r['Status']) . "</td>";
                echo "<td>" . $booking_info . "</td>";
            }
            echo "</tr>";
        }
    } else {
        echo "<p>Ingen romdata tilgjengelig.</p>";
    }
    echo "</table>";
    echo "</div>";
    echo "</div>";
}
?>

            <form method="post" action="">
                <p><?php echo $prompt; ?></p>
                <div class="form-actions">
                    <input type="password" name="passord" placeholder="Passord">
                    <?php if (isset($_SESSION['password_verified'])): ?>
                        <input type="hidden" name="confirm_password" value="1">
                    <?php endif; ?>
                    <?php if ($kan_redigere): ?>
                        <input type="submit" value="Oppdater">
                    <?php endif; ?>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <?php skrivUtTabell($rom_1_etasje, $kan_redigere, "Første Etasje"); ?>
                    </div>
                    <div class="col-md-4">
                        <?php skrivUtTabell($rom_2_etasje, $kan_redigere, "Andre Etasje"); ?>
                    </div>
                    <div class="col-md-4">
                        <?php skrivUtTabell($rom_3_etasje, $kan_redigere, "Tredje Etasje"); ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require('inc/scripts.php'); ?>
</body>
</html>
=======
<?php
require('inc/essentials.php');
adminLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Dashboard</title>
    <?php require('inc/links.php'); ?>
    <style>
        /* General table styles */
        table {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            word-wrap: break-word;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Add a container to handle horizontal scrolling if the content is wide */
        .table-container {
            overflow-x: auto;
            max-width: 100%;
        }

        /* Responsive adjustments for smaller screens */
        @media (max-width: 768px) {
            th, td {
                font-size: 12px;
                padding: 8px;
            }

            .table-container {
                overflow-x: auto;
            }
        }

        /* Adjustments for forms inside the table */
        input[type="date"], input[type="time"], select {
            width: 100%;
            max-width: 200px;
            font-size: 12px;
        }

        /* Add some margin for spacing between form elements */
        label {
            font-size: 12px;
        }

        /* Style for the buttons near the password input */
        .form-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-actions input[type="submit"] {
            font-size: 14px;
            padding: 5px 15px;
        }
    </style>
</head>
<body class="bg-light">

<?php require('inc/header.php'); ?>

<div class="container-fluid" id="main-content">
    <div class="row">
        <div class="col-lg-10 ms-auto p-4 overflow-hidden">

<?php
// JSON file path
$filbane = 'rom_data.json';

// Function to read data from JSON file
function lesRomData($filbane) {
    if (file_exists($filbane)) {
        $data = file_get_contents($filbane);
        return json_decode($data, true); // Return as associative array
    } else {
        return []; // Return empty array if file doesn't exist
    }
}

// Function to write data to JSON file
function skrivRomData($filbane, $romdata) {
    $data = json_encode($romdata, JSON_PRETTY_PRINT);
    file_put_contents($filbane, $data);
}

// Read JSON file
$rom = lesRomData($filbane);

// Default settings
$korrrekt_passord = '12345'; // Correct password
$kan_redigere = false;       // Can edit or not
$prompt = "Skriv inn passord for å redigere rommene."; // Default prompt

// Handling password and updates
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['passord'])) {
        if ($_POST['passord'] === $korrrekt_passord) {
            if (isset($_POST['confirm_password'])) {
                // User confirmed password; allow updates
                $kan_redigere = true;

                // Handle updates
                if (isset($_POST['status'])) {
                    foreach ($rom as $index => $r) {
                        if (isset($_POST['status'][$index])) {
                            $rom[$index]['Status'] = $_POST['status'][$index];
                        }
                        // Update the booking info if there's a change
                        if (isset($_POST['checkin_date'][$index]) && isset($_POST['checkout_date'][$index])) {
                            // If the room is being booked, store the Start and End Dates
                            $rom[$index]['BookingInfo'] = [
                                'Start_Date' => $_POST['checkin_date'][$index],
                                'End_Date' => $_POST['checkout_date'][$index],
                                'Booking_Time' => $_POST['booking_time'][$index] ?? 'N/A' // Optional time
                            ];
                        } else {
                            // If the room is available, clear the booking info
                            $rom[$index]['BookingInfo'] = 'N/A';
                        }
                    }
                    skrivRomData($filbane, $rom);
                    $prompt = "Skriv inn passord for å redigere rommene."; // Reset to default prompt
                    $kan_redigere = false; // Disable edit mode
                    echo "<p style='color:green;'>Oppdateringer er lagret!</p>";
                }
            } else {
                // Prompt user to confirm password
                $prompt = "Skriv passord igjen før du oppdaterer.";
                $_SESSION['password_verified'] = true; // Temporarily store verified state
                $kan_redigere = true; // Enable edit mode
            }
        } else {
            $prompt = "Feil passord. Du kan kun se rommene."; // Wrong password
            $kan_redigere = false; // Ensure no edit access
        }
    }

    // Reset after logout
    if (isset($_POST['logout'])) {
        $kan_redigere = false;
        $prompt = "Skriv inn passord for å redigere rommene."; // Reset to default prompt
        unset($_SESSION['password_verified']);
    }
}

// Group rooms by floor
$rom_1_etasje = array_filter($rom, fn($r) => intval($r['Rom-ID']) < 200);
$rom_2_etasje = array_filter($rom, fn($r) => intval($r['Rom-ID']) >= 200 && intval($r['Rom-ID']) < 300);
$rom_3_etasje = array_filter($rom, fn($r) => intval($r['Rom-ID']) >= 300);

// Function to display a table for a specific floor
function skrivUtTabell($romEtasje, $kan_redigere, $etasjenavn) {
    echo "<div>";
    echo "<h3>$etasjenavn</h3>";
    echo "<div class='table-container'>";  // Add table container for scrolling
    echo "<table border='1'>";

    if (!empty($romEtasje)) {
        echo "<tr>";
        foreach (array_keys(reset($romEtasje)) as $header) {
            echo "<th style='padding: 10px;'>" . htmlspecialchars($header) . "</th>";
        }
        echo "</tr>";

        foreach ($romEtasje as $index => $r) {
            echo "<tr>";
            echo "<td style='padding: 10px;'>" . htmlspecialchars($r['Rom-ID']) . "</td>";
            echo "<td style='padding: 10px;'>" . htmlspecialchars($r['Type']) . "</td>";

            if ($kan_redigere) {
                // Status dropdown for editing
                echo "<td style='padding: 10px;'>
                        <select name='status[$index]'>
                            <option value='Ledig'" . ($r['Status'] == 'Ledig' ? ' selected' : '') . ">Ledig</option>
                            <option value='Opptatt'" . ($r['Status'] == 'Opptatt' ? ' selected' : '') . ">Opptatt</option>
                        </select>
                      </td>";
                // Check-in and Check-out date inputs
                echo "<td style='padding: 10px;'>
                        <label for='checkin_date[$index]'>Check-in</label>
                        <input type='date' name='checkin_date[$index]' value='" . 
                            (isset($r['BookingInfo']['Start_Date']) ? $r['BookingInfo']['Start_Date'] : '') . "'>
                      </td>";
                echo "<td style='padding: 10px;'>
                        <label for='checkout_date[$index]'>Check-out</label>
                        <input type='date' name='checkout_date[$index]' value='" . 
                            (isset($r['BookingInfo']['End_Date']) ? $r['BookingInfo']['End_Date'] : '') . "'>
                      </td>";
                // Optional booking time field
                echo "<td style='padding: 10px;'>
                        <input type='time' name='booking_time[$index]' value='" . 
                            (isset($r['BookingInfo']['Booking_Time']) ? $r['BookingInfo']['Booking_Time'] : '') . "'>
                      </td>";
            } else {
                // If room is not editable, show status and booking info
                $booking_info = 'N/A to N/A';
                if (isset($r['BookingInfo']) && $r['BookingInfo'] !== 'N/A') {
                    $booking_info = isset($r['BookingInfo']['Start_Date']) && isset($r['BookingInfo']['End_Date']) 
                    ? $r['BookingInfo']['Start_Date'] . " <br><strong>To</strong><br> " . $r['BookingInfo']['End_Date'] 
                    : 'N/A to N/A';
                }
                echo "<td style='padding: 10px;'>" . htmlspecialchars($r['Status']) . "</td>";
                echo "<td style='padding: 10px;'>" . $booking_info . "</td>";
            }
            echo "</tr>";
        }
    } else {
        echo "<p>Ingen romdata tilgjengelig.</p>";
    }
    echo "</table>";
    echo "</div>"; // Close table-container
    echo "</div>";
}

// Display the password prompt and tables
echo "<form method='post' action=''>";
echo "<p>$prompt</p>";
echo "<div class='form-actions'>";
echo "<p><input type='password' name='passord' placeholder='Passord'></p>";
if (isset($_SESSION['password_verified'])) {
    echo "<input type='hidden' name='confirm_password' value='1'>"; // Hidden field to confirm
}
if ($kan_redigere) {
    echo "<input type='submit' value='Oppdater'>";
}
echo "</div>"; // Close form-actions

echo "<div style='display: flex; gap: 20px;'>";

// Display tables
skrivUtTabell($rom_1_etasje, $kan_redigere, "Første Etasje");
skrivUtTabell($rom_2_etasje, $kan_redigere, "Andre Etasje");
skrivUtTabell($rom_3_etasje, $kan_redigere, "Tredje Etasje");

echo "</div>";
echo "</form>";
?>

</div>
</div>
</div>

</body>
</html>
>>>>>>> Sworn
