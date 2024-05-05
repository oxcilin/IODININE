<?php
session_start();

// Include the database connection file (db_conn.php)
include "db_conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate the submitted NoInduk and tanggallahir components
    $noinduk = mysqli_real_escape_string($conn, $_POST['noinduk']);
    $day1 = mysqli_real_escape_string($conn, $_POST['day1']);
    $day2 = mysqli_real_escape_string($conn, $_POST['day2']);
    $month1 = mysqli_real_escape_string($conn, $_POST['month1']);
    $month2 = mysqli_real_escape_string($conn, $_POST['month2']);
    $year1 = mysqli_real_escape_string($conn, $_POST['year1']);
    $year2 = mysqli_real_escape_string($conn, $_POST['year2']);
    $year3 = mysqli_real_escape_string($conn, $_POST['year3']);
    $year4 = mysqli_real_escape_string($conn, $_POST['year4']);

    // Concatenate the tanggallahir components into the correct date format (DD/MM/YYYY)
    $tanggallahir = $day1 . $day2 . '/' . $month1 . $month2 . '/' . $year1 . $year2 . $year3 . $year4;

    date_default_timezone_set('Asia/Jakarta');
    $lastjoin = date("Y-m-d H:i:s");
    
    // Prepare a parameterized query to prevent SQL injection
    $query = "SELECT id, nokelas, noinduk, nama, email, tanggallahir FROM user WHERE noinduk = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $noinduk);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id, $nokelas, $noinduk, $nama, $email, $tanggallahirDB);

    if (mysqli_stmt_fetch($stmt)) {
        // Check if the submitted tanggallahir matches the one in the database
        if ($tanggallahir === $tanggallahirDB) {
            $_SESSION['id'] = $id;
            $_SESSION['nokelas'] = $nokelas;
            $_SESSION['noinduk'] = $noinduk;
            $_SESSION['nama'] = $nama;
            $_SESSION['email'] = $email;
            $_SESSION['tanggallahir'] = $tanggallahir;

            // Close the statement
            mysqli_stmt_close($stmt);

            // Update last_login in the database
            $updateQuery = "UPDATE user SET last_login = ? WHERE id = ?";
            $stmtUpdate = mysqli_prepare($conn, $updateQuery);
            mysqli_stmt_bind_param($stmtUpdate, "si", $lastjoin, $id);
            mysqli_stmt_execute($stmtUpdate);
            mysqli_stmt_close($stmtUpdate);

            header("Location: receipt"); // Redirect to the protected page
            exit;
        } else {
            $_SESSION['error'] = "Invalid No Induk or Date of Birth combination.";
        }
    } else {
        $_SESSION['error'] = "Invalid No Induk or other validation error.";
    }

    // Close the statement
    mysqli_stmt_close($stmt);

    header("Location: ."); // Redirect back to the login page with an error message
    exit;
}
?>
