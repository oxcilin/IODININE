<?php
session_start();

include "../../kas/db_conn.php";
date_default_timezone_set('Asia/Jakarta');

// Check if "Save" button is clicked
// if (isset($_POST['buttonSave'])) {
//     // Validate and sanitize user input
//     $nama = htmlspecialchars(trim($_POST["namaLengkap"]));
//     $email = htmlspecialchars(trim($_POST["email"]));
//     $password = $_POST["password"];
//     $role = 0;

//     // Check if the email already exists in the database
//     $check_query = mysqli_query($conn, "SELECT * FROM violation_admin WHERE email = '$email'");
//     if (mysqli_num_rows($check_query) > 0) {
//         // If the email already exists, display an error
//         $_SESSION['error'] = "Email or username already exists in the database.";
//         header("Location: buat-account-admin");
//         exit();
//     } else {
//         // Use prepared statements to prevent SQL injection
//         $stmt = $conn->prepare("INSERT INTO violation_admin (nama, email, password, role) VALUES (?, ?, ?, ?)");
//         $stmt->bind_param("sssi", $nama, $email, $password, $role);
//         $simpan = $stmt->execute();

//         if ($simpan) {
//             // Log the "Add" action in serverLogs
//             $date = date('Y-m-d H:i:s');
//             $logs = "FORM - ACCOUNT ADMIN - on date $date. New record: Name: $nama, Username: $email, Role: $role";
//             mysqli_query($conn, "INSERT INTO serverLogs (date, logs) VALUES ('$date', '$logs')");

//             $_SESSION['success'] = "The request for creating an admin account has been recorded in the system. Please wait for confirmation from our staff.";
//             header("Location: buat-account-admin");
//             exit();
//         } else {
//             $_SESSION['error'] = "An error occurred while processing the request. " . mysqli_error($conn);
//             header("Location: buat-account-admin");
//             exit();
//         }
//     }
// }

// Check if the form should be disabled
if (isset($_POST['buttonSave'])) {
    $nama = isset($_POST["namaLengkap"]) ? htmlspecialchars(trim($_POST["namaLengkap"])) : ''; // Get nama if submitted
    $email = isset($_POST["email"]) ? htmlspecialchars(trim($_POST["email"])) : ''; // Get email if submitted
    $date = date('d/m/Y H:i:s'); // Capture current date
  
    // Display error message with captured details (if available)
    $_SESSION['error'] = "Sorry, $nama with the email address/username <code>" . htmlspecialchars($email) . "</code>, your request for creating an admin account cannot be processed at this moment because the form is currently disabled. We received your request on $date. Please contact the administrator for assistance.";

    header("Location: buat-account-admin");
    exit();
}

?>

<html lang="en" data-bs-theme="dark">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta property="og:site_name" content="<?php include 'theme/name_page.php'?>" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="https://booth.oxa.biz.id/ban.png" />
    <meta property="og:image:type" content="image/png" />
    <meta property="og:image:width" content="1280" />
    <meta property="og:image:height" content="800" />
    <meta property="twitter:card" content="summary_large_image" />

    <meta name="msapplication-TileColor" content="#ffffff" />
    <meta name="theme-color" content="#ffffff" />
    <!--=============== FAVICON ===============-->
    <link rel="shortcut icon" href="../../IODININE LOGO/TANPA BG PLAIN PUTIH.png" type="image/x-icon" />

    <!--=============== REMIX ICONS ===============-->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
      rel="stylesheet"
    />

    <!--=============== CSS ===============-->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
    />

    <!--=============== TITLE ===============-->
    <title><?php include 'theme/name_page.php'?></title>

    <!--=============== FONT ===============-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Chivo:wght@300&display=swap"
      rel="stylesheet"
    />

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>

    <style>
      html,
      body {
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: "Chivo";
        user-select: none;
      }

      .login-form {
        width: 400px;
      }

      .login-form .btn {
        width: 100%;
      }

      .form-group input {
        width: 100%;
      }

      /* Media query for screens larger than 768px (laptop screens) */
      @media (min-width: 768px) {
        .login-form {
          width: 450px; /* Adjust the width as per your requirement */
        }

        .login-form .btn {
          width: 100%; /* Set the button width to 100% within the larger screens */
        }
      }

      .logo-container {
        display: flex;
        flex-direction: column; /* Change flex-direction to column */
        align-items: center;
        justify-content: center;
        margin: 0; /* Remove margin for the text-muted class */
      }

      .logo-title {
        filter: drop-shadow(0px 0px 10px rgba(255, 255, 255, 0.5))
          brightness(1.1);
      }

      .form-control:focus,
      .form-control:active {
        outline: none;
        box-shadow: none;
      }

      .form-control:focus {
        border-color: #fff;
        box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.25);
      }

      select.form-select:focus,
      select.form-select:active {
        outline: none;
        box-shadow: none;
      }

      select.form-select:focus {
        border-color: #fff;
        box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.25);
      }

      input[type="number"]::-webkit-outer-spin-button,
      input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
      }

      ::-webkit-scrollbar {
            display: none;
        }
    </style>
    <body>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <form method="POST" class="row g-3 needs-validation login-form" novalidate autocomplete="off">
              <div class="logo-container">
                <h1 class="logo-title">Buat Account Admin</h1>
                <?php
                  include "../../kas/db_conn.php";
                  // Query to fetch data from the class_info table
                  $sql = "SELECT * FROM class_info";
                  $result = $conn->query($sql);

                  if ($result->num_rows > 0) {
                      ?>
                          <?php if ($result->num_rows > 0) {
                              // Output data of each row
                              while($row = $result->fetch_assoc()) {
                                  // Process fetched data
                                  $class = $row["class"];
                                  $class_name = $row["class_name"];
                                  $start_ay = $row["start_ay"];
                                  $end_ay = $row["end_ay"];

                                  // Here, you can use the fetched data in your receipt template
                                  echo "<center>";
                                  echo "<p class='text-muted'>$class ($class_name) - <span style='font-size: 16px'>A.Y. $start_ay.$end_ay</span></p> ";
                                  echo "</center>";
                              }
                              ?>
                          <?php } else {
                              echo "<p class='text-muted'>ADMIN's PAGE</p>";
                          }}?>
              </div>
              <br />

              <?php
              if (isset($_SESSION['error'])) {
                echo '
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle px-2"></i>' . $_SESSION['error'] . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                unset($_SESSION['error']); // Clear the admin_error message from the session
              }
              
              if (isset($_SESSION['success'])) {
                echo '
                <br>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle px-2"></i>' . $_SESSION['success'] . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                unset($_SESSION['success']); // Clear the error message from the session
                } 
              ?>
              

                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input
                    type="text"
                    class="form-control"
                    id="namaLengkap"
                    name="namaLengkap"
                    required
                    autofocus
                    oninput="this.value = this.value.toUpperCase();"
                    />
                    <div class="invalid-feedback">
                        Please enter your valid Nama Lengkap.
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email or Username</label>
                    <input
                    type="text"
                    class="form-control"
                    id="email"
                    name="email"
                    required
                    />
                    <div class="invalid-feedback">
                        Please enter your valid email or your username.
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <br/>
                    <input
                    type="password"
                    class="form-control"
                    id="password"
                    name="password"
                    required
                    />
                    <div class="invalid-feedback">Please enter correct password.</div>
                </div>

                <div class="mb-3">
                    <div>
                      <button name="buttonSave" type="submit" class="w-100 btn btn-outline-light">
                          Request
                      </button>
                    </div>
                </div>
            </form>

            <? include 'theme/script_form.php'?>
          </div>
        </div>
      </div>
    </body>
  </head>
</html>
