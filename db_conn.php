<?php

// Database configuration
$servername = "localhost";  // Replace with your server name
$username = "oxabizid_iodinine";         // Replace with your database username
$password = "PJt~w^1FcNho";     // Replace with your database password
$dbname = "oxabizid_xmia9";       // Replace with your database name

// Create a connection to the database
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>