<?php
session_start();

// Include the database connection file (db_conn.php)
include "db_conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate the submitted NoInduk and tanggallahir
    $noinduk = mysqli_real_escape_string($conn, $_POST['noinduk']);
    $tanggallahir = $_POST['tanggallahir']; // Assuming tanggallahir is submitted through POST

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
            header("Location: home"); // Redirect to the protected page
            exit;
        } else {
            $_SESSION['error'] = "Invalid No Induk or Date of Birth combination.";
        }
    } else {
        $_SESSION['error'] = "Invalid No Induk or other validation error.";
    }

    header("Location: ."); // Redirect back to the login page with an error message
    exit;
} else {
    // Handle invalid requests to this page (GET requests)
    header("Location: .");
    exit;
}
?>
