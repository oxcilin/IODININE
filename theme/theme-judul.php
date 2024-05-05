<?php
    $filename = basename($_SERVER['SCRIPT_FILENAME']);
    $filenameWithoutExtension = pathinfo($filename, PATHINFO_FILENAME);

    // Replace hyphens with spaces
    $filenameWithoutHyphen = str_replace("-", " ", $filenameWithoutExtension);

    // Capitalize each word
    $capitalizedFilename = ucwords($filenameWithoutHyphen);

    // • Oxa
    $site = " • IODININE";

    // Check if the page is "Index" and change the title to "Login"
    if ($filenameWithoutExtension == "index") {
        $capitalizedFilename = "Home Page";
    }

    // Concatenate the modified filename with the site name
    $title = $capitalizedFilename . $site;

    echo $title;
?>
