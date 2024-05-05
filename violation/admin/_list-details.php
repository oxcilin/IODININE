<?php
session_start();
include "../../kas/db_conn.php";

// Function to sanitize and validate user input
function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if "Save" button is clicked
if (isset($_POST['buttonSave'])) {
    $arti = validate($_POST["arti"]);

    // Insert the data into the violation_code table using prepared statement
    $sql = "INSERT INTO violation_code (code, arti) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $arti, $arti);
    $simpan = mysqli_stmt_execute($stmt);

    if ($simpan) {
        // Log the "Add" action in serverLogs
        $date = date('Y-m-d H:i:s');
        $id_admin = $_SESSION['id_violation']; // Assuming this is the ID of the admin performing the action
        $nama_admin = $_SESSION['nama_violation']; // Assuming this is the name of the admin performing the action
        $logs = "New data added by Staff ID $id_admin $nama_admin, Date: $date, Arti: $arti";
        mysqli_query($conn, "INSERT INTO serverLogs (date, logs) VALUES ('$date', '$logs')");

        $_SESSION['success_admin_violation'] = "Data has been added successfully.";
        header("Location: list-details");
        exit();
    } else {
        $_SESSION['error_admin_violation'] = "An error occurred while processing the request. " . mysqli_error($conn);
        header("Location: list-details");
        exit();
    }
}


// Check if "Edit" button is clicked
if (isset($_POST['buttonEdit'])) {
    $id = $_POST["editId"];
    $newarti = validate($_POST["editarti"]);

    // Fetch the previous data before updating
    $fetchPrevious = mysqli_query($conn, "SELECT code, arti FROM violation_code WHERE id = '$id'");
    $previousData = mysqli_fetch_assoc($fetchPrevious);
    $old_arti = $previousData['arti'];

    // Update the violation_code table with the new arti value
    $updateQuery = "UPDATE violation_code SET arti = ? WHERE id = ?";
    $stmtUpdate = mysqli_prepare($conn, $updateQuery);
    mysqli_stmt_bind_param($stmtUpdate, "si", $newarti, $id);
    mysqli_stmt_execute($stmtUpdate);

    // Check if the update was successful
    if (mysqli_stmt_affected_rows($stmtUpdate) > 0) {
        // Log the "Edit" action in serverLogs
        $date = date('Y-m-d H:i:s');
        $id_admin = $_SESSION['id_violation'];
        $nama_admin = $_SESSION['nama_violation'];
        $logs = "Data edited by Staff ID $id_admin $nama_admin, Date: $date, Details changed from '$old_arti' to '$newarti'";
        mysqli_query($conn, "INSERT INTO serverLogs (date, logs) VALUES ('$date', '$logs')");

        $_SESSION['success_admin_violation'] = "Data has been updated successfully.";
        header("Location: list-details");
        exit();
    } else {
        $_SESSION['error_admin_violation'] = "An error occurred while processing the request. " . mysqli_error($conn);
        header("Location: list-details");
        exit();
    }
}

// Check if "Delete" button is clicked
if (isset($_POST['buttonDelete'])) {
    $id = $_POST['deleteId'];

    // Fetch the data to be deleted
    $fetchDataToDelete = mysqli_query($conn, "SELECT code, arti FROM violation_code WHERE id = '$id'");
    $dataToDelete = mysqli_fetch_assoc($fetchDataToDelete);
    $deleted_arti = $dataToDelete['arti'];

    // Delete the data from the violation_code table
    $hapus = mysqli_query($conn, "DELETE FROM violation_code WHERE id = '$id'");

    if ($hapus) {
        // Log the "Delete" action in serverLogs
        $date = date('Y-m-d H:i:s');
        $id_admin = $_SESSION['id_violation'];
        $nama_admin = $_SESSION['nama_violation'];
        $logs = "Data deleted by Staff ID $id_admin $nama_admin, Date: $date, Details deleted: $deleted_arti";
        mysqli_query($conn, "INSERT INTO serverLogs (date, logs) VALUES ('$date', '$logs')");

        $_SESSION['success_admin_violation'] = "Data has been deleted successfully.";
        header("Location: list-details");
        exit();
    } else {
        $_SESSION['error_admin_violation'] = "An error occurred while processing the request. " . mysqli_error($conn);
        header("Location: list-details");
        exit();
    }
}
?>
