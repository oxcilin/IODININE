<?php
session_start();
include "../../kas/db_conn.php";

// Function to log events into serverLogs
function logEvent($conn, $logMessage, $date) {
    // Escape special characters to prevent SQL injection
    $logMessage = mysqli_real_escape_string($conn, $logMessage);

    // Insert the log message into serverLogs
    $insertLog = "INSERT INTO serverLogs (date, logs) VALUES ('$date', '$logMessage')";
    mysqli_query($conn, $insertLog);
}

// Get user data before destroying session (assuming it's stored in session variables)
$id = isset($_SESSION['id_violation']) ? $_SESSION['id_violation'] : '';
$nama = isset($_SESSION['nama_violation']) ? $_SESSION['nama_violation'] : '';
$id_address = $_SERVER['REMOTE_ADDR'];

// Get the current date and time in Asia/Jakarta timezone
date_default_timezone_set('Asia/Jakarta');
$date = date('Y-m-d H:i:s');

// Log logout event
$logMessage = "LOGOUT - id: $id, nama: $nama, date: $date; id_address: $id_address";
logEvent($conn, $logMessage, $date);

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page
header("Location: .");
exit;
?>
