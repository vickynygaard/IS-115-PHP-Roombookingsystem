<?php

// Database connection parameters
$hname = 'localhost';
$uname = 'root';
$pass = '';
$db = 'mywebsite';

// Establish connection to the database
$con = mysqli_connect($hname, $uname, $pass, $db);

// Terminate execution and display an error message if the connection fails
if (!$con) {
    die("Cannot connect to database: " . mysqli_connect_error());
}

// Automatically create the `carousel` table if it does not exist
$table_query = "CREATE TABLE IF NOT EXISTS `carousel` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `image` VARCHAR(255) NOT NULL,
    `title` VARCHAR(255),
    `description` TEXT,
    `status` TINYINT(1) DEFAULT 0,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
)";
if (!mysqli_query($con, $table_query)) {
    die("Error creating `carousel` table: " . mysqli_error($con));
}

// Sanitize input data to prevent common vulnerabilities
function filteration($data) {
    foreach ($data as $key => $value) {
        $value = trim($value); // Removes whitespace
        $value = stripslashes($value); // Removes backslashes
        $value = strip_tags($value); // Strips HTML and PHP tags
        $value = htmlspecialchars($value); // Converts special characters to HTML entities
        $data[$key] = $value; // Update array with sanitized value
    }
    return $data;
}

// Retrieve all rows from the specified table
function selectAll($table) {
    $con = $GLOBALS['con'];
    
    // Check if the table exists
    $checkTable = mysqli_query($con, "SHOW TABLES LIKE '$table'");
    if (mysqli_num_rows($checkTable) == 0) {
        die("Table '$table' does not exist.");
    }

    // Fetch all rows from the table
    $res = mysqli_query($con, "SELECT * FROM $table");
    if (!$res) {
        die("Query failed: " . mysqli_error($con));
    }

    return $res;
}

// Prepared SELECT query
function select($sql, $values, $datatypes) {
    $con = $GLOBALS['con'];
    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
        if (mysqli_stmt_execute($stmt)) {
            $res = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        } else {
            mysqli_stmt_close($stmt);
            die("Query execution failed - Select");
        }
    } else {
        die("Query preparation failed - Select");
    }
}

// Prepared UPDATE query
function update($sql, $values, $datatypes) {
    $con = $GLOBALS['con'];
    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
        if (mysqli_stmt_execute($stmt)) {
            $res = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        } else {
            mysqli_stmt_close($stmt);
            die("Query execution failed - Update");
        }
    } else {
        die("Query preparation failed - Update");
    }
}

// Prepared INSERT query
function insert($sql, $values, $datatypes) {
    $con = $GLOBALS['con'];
    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
        if (mysqli_stmt_execute($stmt)) {
            $res = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        } else {
            mysqli_stmt_close($stmt);
            die("Query execution failed - Insert");
        }
    } else {
        die("Query preparation failed - Insert");
    }
}

// Prepared DELETE query
function delete($sql, $values, $datatypes) {
    $con = $GLOBALS['con'];
    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
        if (mysqli_stmt_execute($stmt)) {
            $res = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        } else {
            mysqli_stmt_close($stmt);
            die("Query execution failed - Delete");
        }
    } else {
        die("Query preparation failed - Delete");
    }
}

?>
