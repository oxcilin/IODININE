<?php
// Set the timezone to Jakarta
date_default_timezone_set('Asia/Jakarta');

// Get the current timestamp
$current_timestamp = time();

// Format the date
$date_full = strftime("%d %B %Y, %H:%M:%S", $current_timestamp);

// Output the formatted date
echo $date_full;
?>
