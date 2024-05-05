<?

session_start();

include "../../kas/db_conn.php";
date_default_timezone_set('Asia/Jakarta');

// Check if "Save" button is clicked
if (isset($_POST['buttonSave'])) {
    // Validate and sanitize user input
    $nama = htmlspecialchars(trim($_POST["namaLengkap"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $password = $_POST["password"];
    $role = 0;

    // Check if the email already exists in the database
    $check_query = mysqli_query($conn, "SELECT * FROM violation_admin WHERE email = '$email'");
    if (mysqli_num_rows($check_query) > 0) {
        // If the email already exists, display an error
        $_SESSION['error'] = "Email or username already exists in the database.";
        header("Location: buat-account-admin");
        exit();
    } else {
        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO violation_admin (nama, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $nama, $email, $password, $role);
        $simpan = $stmt->execute();

        if ($simpan) {
            // Log the "Add" action in serverLogs
            $date = date('Y-m-d H:i:s');
            $logs = "FORM - ACCOUNT ADMIN - on date $date. New record: Name: $nama, Username: $email, Role: $role";
            mysqli_query($conn, "INSERT INTO serverLogs (date, logs) VALUES ('$date', '$logs')");

            $_SESSION['success'] = "The request for creating an admin account has been recorded in the system. Please wait for confirmation from our staff.";
            header("Location: buat-account-admin");
            exit();
        } else {
            $_SESSION['error'] = "An error occurred while processing the request. " . mysqli_error($conn);
            header("Location: buat-account-admin");
            exit();
        }
    }
}
?>