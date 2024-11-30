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
$rom_1_etasje = array_filter($rom, fn($r) => intval($r['Romnummer']) < 200);
$rom_2_etasje = array_filter($rom, fn($r) => intval($r['Romnummer']) >= 200 && intval($r['Romnummer']) < 300);
$rom_3_etasje = array_filter($rom, fn($r) => intval($r['Romnummer']) >= 300);

// Function to display a table for a specific floor
function skrivUtTabell($romEtasje, $kan_redigere, $etasjenavn) {
    echo "<div>";
    echo "<h3>$etasjenavn</h3>";
    echo "<table border='1'>";

    if (!empty($romEtasje)) {
        echo "<tr>";
        foreach (array_keys(reset($romEtasje)) as $header) {
            echo "<th style='padding: 10px;'>" . htmlspecialchars($header) . "</th>";
        }
        echo "</tr>";

        foreach ($romEtasje as $index => $r) {
            echo "<tr>";
            echo "<td style='padding: 10px;'>" . htmlspecialchars($r['Romnummer']) . "</td>";
            echo "<td style='padding: 10px;'>" . htmlspecialchars($r['Type']) . "</td>";
            if ($kan_redigere) {
                echo "<td style='padding: 10px;'>
                        <select name='status[$index]'>
                            <option value='Ledig'" . ($r['Status'] == 'Ledig' ? ' selected' : '') . ">Ledig</option>
                            <option value='Opptatt'" . ($r['Status'] == 'Opptatt' ? ' selected' : '') . ">Opptatt</option>
                        </select>
                      </td>";
            } else {
                echo "<td style='padding: 10px;'>" . htmlspecialchars($r['Status']) . "</td>";
            }
            echo "</tr>";
        }
    } else {
        echo "<p>Ingen romdata tilgjengelig.</p>";
    }
    echo "</table>";
    echo "</div>";
}

// Display the password prompt and tables
echo "<form method='post' action=''>";
echo "<p>$prompt</p>";
echo "<p><input type='password' name='passord' placeholder='Passord'></p>";
if (isset($_SESSION['password_verified'])) {
    echo "<input type='hidden' name='confirm_password' value='1'>"; // Hidden field to confirm
}
echo "<div style='display: flex; gap: 20px;'>";

// Display tables
skrivUtTabell($rom_1_etasje, $kan_redigere, "Første Etasje");
skrivUtTabell($rom_2_etasje, $kan_redigere, "Andre Etasje");
skrivUtTabell($rom_3_etasje, $kan_redigere, "Tredje Etasje");

if ($kan_redigere) {
    echo "<input type='submit' value='Oppdater'>";
    echo "<input type='submit' value='Logg ut' name='logout'>";
}
echo "</form>";
echo "</div>";
?>
        </div>
    </div>
</div>

<?php require('inc/scripts.php'); ?>

</body>
</html>
