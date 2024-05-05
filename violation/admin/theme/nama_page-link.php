<?php
    $filename = basename($_SERVER['SCRIPT_FILENAME']);
    $filenameWithoutExtension = pathinfo($filename, PATHINFO_FILENAME);
    echo $filenameWithoutExtension;
?>