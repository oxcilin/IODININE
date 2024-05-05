<?php
    $filename = basename($_SERVER['SCRIPT_FILENAME']);
    $filenameWithoutExtension = pathinfo($filename, PATHINFO_FILENAME);

    // Replace hyphens with spaces
    $filenameWithoutHyphen = str_replace("-", " ", $filenameWithoutExtension);

    // Capitalize each word
    $capitalizedFilename = ucwords($filenameWithoutHyphen);

    if ($filenameWithoutExtension == "index") {
        $capitalizedFilename = "Home Page";
    }
    
    echo $capitalizedFilename;
?>
