<?php
session_start();
include "../../kas/db_conn.php";
date_default_timezone_set('Asia/Jakarta');

// Function to sanitize and validate user input
function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if "Save" button is clicked
if (isset($_POST['buttonSave'])) {
    // Validate and sanitize user input
    $nama = validate($_POST["nama"]);
    $email = validate($_POST["email"]);
    $password = validate($_POST["password"]);
    $role = validate($_POST["role"]);
    $privileges = validate($_POST["privileges"]);

    // Check if the email already exists in the database
    $check_query = mysqli_query($conn, "SELECT * FROM violation_admin WHERE email = '$email'");
    if (mysqli_num_rows($check_query) > 0) {
        // If the email already exists, display an error
        $_SESSION['error_admin_violation'] = "Email or username already exists in the database.";
        header("Location: account-admin");
        exit();
    } else {
        // Insert the data into the database
        $simpan = mysqli_query($conn, "INSERT INTO violation_admin (nama, email, special_id, password, role) 
        VALUES ('$nama', '$email', '$privileges', '$password', '$role')");

        if ($simpan) {
            // Log the "Add" action in serverLogs
            $date = date('Y-m-d H:i:s');
            $id_admin = $_SESSION['id_violation']; // Assuming this is the ID of the admin performing the action
            $nama_admin = $_SESSION['nama_violation']; // Assuming this is the name of the admin performing the action
            $logs = "ACCOUNT ADMIN - Added by $nama_admin (ID: $id_admin) on $date. New record: Name: $nama, Username: $email, Role: $role, Privileges: $privileges";
            mysqli_query($conn, "INSERT INTO serverLogs (date, logs) VALUES ('$date', '$logs')");

            $_SESSION['success_admin_violation'] = "Data has been added successfully.";
            header("Location: account-admin");
            exit();
        } else {
            $_SESSION['error_admin_violation'] = "An error occurred while processing the request. " . mysqli_error($conn);
            header("Location: account-admin");
            exit();
        }
    }
}

// Check if "Edit" button is clicked
if (isset($_POST['buttonEdit'])) {
    $id = $_POST["editId"];
    $nama = validate($_POST["editNama"]);
    $email = validate($_POST["editEmail"]);
    $password = validate($_POST["editPassword"]);
    $role = validate($_POST["editRole"]);
    $privileges = validate($_POST["editprivileges"]);

    // Check if the email already exists in the database for other records except the current one being edited
    $check_query = mysqli_query($conn, "SELECT * FROM violation_admin WHERE email = '$email' AND id != $id");
    if (mysqli_num_rows($check_query) > 0) {
        // If the email already exists for another record, display an error
        $_SESSION['error_admin_violation'] = "Email or username already exists for another record.";
        header("Location: account-admin");
        exit();
    } else {
        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("UPDATE violation_admin SET nama = ?, email = ?, special_id = ?, password = ?, role = ? WHERE id = ?");
        $stmt->bind_param("ssisii", $nama, $email, $privileges, $password, $role, $id);

        if ($stmt->execute()) {
            // Fetch the previous data before updating
            $fetchPrevious = mysqli_query($conn, "SELECT * FROM violation_admin WHERE id = '$id'");
            $previousData = mysqli_fetch_assoc($fetchPrevious);

            // Log the "Edit" action in serverLogs
            $date = date('Y-m-d H:i:s');
            $id_admin = $_SESSION['id_violation'];
            $nama_admin = $_SESSION['nama_violation'];
            $logs = "ACCOUNT ADMIN - Edited by $nama_admin (ID: $id_admin) on $date. Details changed from: Name: {$previousData['nama']}, Username: {$previousData['email']}, Role: {$previousData['role']}, Privileges: {$previousData['privileges']} to Name: $nama, Username: $email, Role: $role, Privileges: $privileges";
            mysqli_query($conn, "INSERT INTO serverLogs (date, logs) VALUES ('$date', '$logs')");

            $_SESSION['success_admin_violation'] = "Data has been updated successfully.";
            header("Location: account-admin");
            exit();
        } else {
            $_SESSION['error_admin_violation'] = "An error occurred while processing the request: " . $stmt->error;
            header("Location: account-admin");
            exit();
        }
    }
}

// Check if "Delete" button is clicked
if (isset($_POST['buttonDelete'])) {
    $id = $_POST['deleteId'];

    // Fetch the data to be deleted
    $fetchDataToDelete = mysqli_query($conn, "SELECT * FROM violation_admin WHERE id = '$id'");
    $dataToDelete = mysqli_fetch_assoc($fetchDataToDelete);

    // Delete the data from the admin table
    $hapus = mysqli_query($conn, "DELETE FROM violation_admin WHERE id = '" . $_POST['deleteId'] . "'");

    if ($hapus) {
        // Log the "Delete" action in serverLogs
        $date = date('Y-m-d H:i:s');
        $id_admin = $_SESSION['id_violation'];
        $nama_admin = $_SESSION['nama_violation'];
        $logs = "ACCOUNT ADMIN - Deleted by $nama_admin (ID: $id_admin) on $date. Deleted record: Name: {$dataToDelete['nama']}, Username: {$dataToDelete['email']}, Role: {$dataToDelete['role']}, Privileges: {$dataToDelete['privileges']}";
        mysqli_query($conn, "INSERT INTO serverLogs (date, logs) VALUES ('$date', '$logs')");

        $_SESSION['success_admin_violation'] = "Data has been deleted successfully.";
        header("Location: account-admin");
        exit();
    } else {
        $_SESSION['error_admin_violation'] = "An error occurred while processing the request. " . mysqli_error($conn);
        header("Location: account-admin");
        exit();
    }
}
?>
