<?php
session_start();
include "../../kas/db_conn.php";

// Function to retrieve staff name from violation_admin
function getStaffName($staffId) {
    global $conn;
    $staffName = "Unknown";
    $query = "SELECT nama FROM violation_admin WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $staffId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $nama);
    if (mysqli_stmt_fetch($stmt)) {
        $staffName = $nama;
    }
    mysqli_stmt_close($stmt);
    return $staffName;
}

// Function to log events
function logEvent($logMessage) {
    global $conn;
    include "../../kas/db_conn.php";
    $logDate = date('Y-m-d H:i:s');
    $query = "INSERT INTO serverLogs (id, date, logs) VALUES (NULL, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ss", $logDate, $logMessage);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

// add
if (isset($_POST['buttonSave'])) {
    // Validate and sanitize user input
    $idGroup = $_POST["idGroup"];
    date_default_timezone_set('Asia/Jakarta');
    $prefix = "MG" . date('W') . "_";
    $datefirst = date('dHis');
    $nolaporan = $prefix . $datefirst;

    include "../../kas/db_conn.php";
    $date = date('Y-m-d H:i:s');
    $user = $_POST["user"];
    $details = $_POST["details"];
    $staff = $_SESSION['id_violation'];

    // Insert the data into the database
    $simpan = mysqli_query($conn, "INSERT INTO violation (id_group, nolaporan, noinduk, date, details, staff) VALUES ('$idGroup', '$nolaporan', '$user', '$date', '$details', '$staff')"); 
    
    if ($simpan) {
        $_SESSION['success_admin_violation'] = "Data has been added successfully.";
        
        // Log the add event
        $staffName = getStaffName($staff); // Get the name of the staff from violation_admin
        $logMessage = "The new record with ID $nolaporan for user $user has been added by $staffName with these details: $details";
        logEvent($logMessage);

        header("Location: home-violation");
        exit();
    } else {
        $_SESSION['error_admin_violation'] = "An error occurred while processing the request. " . mysqli_error($conn);
        header("Location: home-violation");
        exit();
    }
}

// Edit
if (isset($_POST['buttonEdit'])) {
    $id = $_POST["editId"];
    $newidGroup = $_POST["editidGroup"];

    $newdate = $_POST["editdate"];
    $newuser = $_POST["edituser"];
    $newdetails = $_POST["editdetails"];
    $newstaff = $_SESSION['id_violation'];

    $sql_oldDetails = "SELECT * FROM violation WHERE id = $id";
    $result_oldDetails = mysqli_query($conn, $sql_oldDetails);
    $oldViolation = mysqli_fetch_assoc($result_oldDetails);
  
    // Convert existing violation details to JSON
    $oldDetailsJSON = json_encode($oldViolation);
  
    // Sanitize and Validate new details (replace with your specific validation logic)
    $newDetails = [];
    if (isset($_POST['editdetails']) && is_array($_POST['editdetails'])) {
      foreach ($_POST['editdetails'] as $key => $value) {
        $newDetails[$key] = filter_var($value, FILTER_SANITIZE_STRING); // Basic sanitization
      }
    } else {
      // Handle invalid details (e.g., set error message)
    }
  
    // Convert sanitized new details to JSON
    $newDetailsJSON = json_encode($newDetails);
  
    // Update violation with new data and log changes
    $updateQuery = "UPDATE violation SET id_group = ?, noinduk = ?, editdate = ?, details = ?, staff = ? WHERE id = ?";
    $stmtUpdate = mysqli_prepare($conn, $updateQuery);
    mysqli_stmt_bind_param($stmtUpdate, "ssissi", $newidGroup, $newuser, $newdate, $newdetails, $newstaff, $id);
    mysqli_stmt_execute($stmtUpdate);

    // Check if the update was successful
    if (mysqli_stmt_affected_rows($stmtUpdate) > 0) {
      $_SESSION['success_admin_violation'] = "Data has been updated successfully.";
  
      // Log the edit event
      $staffName = getStaffName($newstaff);
      $logMessage = "Data with ID $id and user $newuser has been edited by $staffName. Old details: $oldDetailsJSON, New details: $newDetailsJSON";
      logEvent($logMessage);
  
      header("Location: home-violation");
      exit();
    } else {
      $_SESSION['error_admin_violation'] = "An error occurred while processing the request. " . mysqli_error($conn);
      header("Location: home-violation");
      exit();
    }
  }

// Delete
if (isset($_POST['buttonDelete'])) {
  // Fetch the data for logging purposes
  $id = $_POST["deleteId"];

  // Adjust the number of bind variables based on your table structure
  $sqlGetViolationData = "SELECT id, id_group, nolaporan, noinduk, date, details, staff FROM violation WHERE id = ?";
  $stmtGetData = mysqli_prepare($conn, $sqlGetViolationData);

  date_default_timezone_set('Asia/Jakarta');
  mysqli_stmt_bind_param($stmtGetData, "i", $id);
  mysqli_stmt_execute($stmtGetData);

  // Assuming `id`, `id_group`, `nolaporan`, `noinduk`, `date`, `details`, and `staff` are columns in your table
  mysqli_stmt_bind_result($stmtGetData, $id, $id_group, $nolaporan, $noinduk, $date, $details, $staff);
  mysqli_stmt_fetch($stmtGetData);
  $deletedData = json_encode(compact('id', 'id_group', 'nolaporan', 'noinduk', 'date', 'details', 'staff'));
  mysqli_stmt_close($stmtGetData);

  // Use prepared statement for deletion
  $sqlDelete = "DELETE FROM violation WHERE id = ?";
  $stmtDelete = mysqli_prepare($conn, $sqlDelete);
  mysqli_stmt_bind_param($stmtDelete, "i", $id);
  mysqli_stmt_execute($stmtDelete);

  if (mysqli_stmt_affected_rows($stmtDelete) > 0) {
    // Record deleted successfully
    $_SESSION['success_admin_violation'] = "Data has been deleted successfully.";

    // Log the delete event
    $staffName = getStaffName($_SESSION['id_violation']); // Get the name of the staff from violation_admin
    $logMessage = "Data with ID $id for user $noinduk has been deleted by $staffName with this previous details: $deletedData";
    logEvent($logMessage);

    header("Location: home-violation");
    exit();
  } else {
    // No rows affected (might be an error or no data matched)
    $_SESSION['error_admin_violation'] = "No data found or an error occurred while processing the request. " . mysqli_error($conn);
    header("Location: home-violation");
    exit();
  }

}
?>
