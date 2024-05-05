<?php
session_start();

include "../../kas/db_conn.php";


// Check if the user is already logged in and can access home-violation
if (isset($_SESSION['id_violation'])) {
  // Redirect to home-violation page
  header("Location: home-violation");
  exit();
}

// Check if the email and password are posted
if (isset($_POST['email']) && isset($_POST['password'])) {
  // Function to sanitize and validate input data
  function validate($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
  }

  // Validate and sanitize email and password
  $email = validate($_POST['email']);
  $password = validate($_POST['password']);

  if (empty($email)) {
      $_SESSION['admin_error_violation_violation'] = "Email is required";
  } else if (empty($password)) {
      $_SESSION['admin_error_violation'] = "Password is required";
  } else {
      // Perform the login check
      $sql = "SELECT * FROM violation_admin WHERE email='$email' AND password='$password'";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) === 1) {
          $row = mysqli_fetch_assoc($result);
          if ($row['email'] === $email && $row['password'] === $password) {
              // Set session variables
              $_SESSION['email_violation'] = $row['email'];
              $_SESSION['nama_violation'] = $row['nama'];
              $_SESSION['id_violation'] = $row['id'];
              $_SESSION['role_violation'] = $row['role'];
              $_SESSION['special_role'] = $row['special_row'];

              // Log the event in serverLogs table
              $id = $_SESSION['id_violation'];
              $nama = $_SESSION['nama_violation'];
              $id_address = $_SERVER['REMOTE_ADDR']; // Get the user's IP address

              date_default_timezone_set('Asia/Jakarta');
              $date = date('Y-m-d H:i:s'); // Get current date and time
              $logs = "LOGIN - NEW STAFF LOGIN!, id: $id, nama: $nama, date: $date; id_address: $id_address";

              // Insert log data into serverLogs table
              $insertSql = "INSERT INTO serverLogs (date, logs) VALUES ('$date', '$logs')";
              mysqli_query($conn, $insertSql);

              // Redirect to home-violation page
              header("Location: home-violation");
              exit();
          } else {
              $_SESSION['admin_error_violation'] = "Incorrect email or/and password";
          }
      } else {
          $_SESSION['admin_error_violation'] = "Incorrect email or/and password";
      }
  }

  // Redirect to the previous page (login page)
  header("Location: .");
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
          width: 500px; /* Adjust the width as per your requirement */
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
    </style>
    <body>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <form method="POST" class="row g-3 needs-validation login-form" novalidate autocomplete="off">
              <div class="logo-container">
                <h1 class="logo-title">VIOLATION</h1>
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
                                  echo "<p class='text-muted'>ADMIN's PAGE <br> $class ($class_name) - <span style='font-size: 16px'>A.Y. $start_ay.$end_ay</span></p> ";
                                  echo "</center>";
                              }
                              ?>
                          <?php } else {
                              echo "<p class='text-muted'>ADMIN's PAGE</p>";
                          }}?>
              </div>
              <br />

              <?php
              if (isset($_SESSION['admin_error_violation'])) {
                echo '
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle px-2"></i>' . $_SESSION['admin_error_violation'] . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                unset($_SESSION['admin_error_violation']); // Clear the admin_error message from the session
              }?>
              

                <div class="mb-3">
                    <label class="form-label">Email or Username</label>
                    <input
                    type="text"
                    class="form-control"
                    id="email"
                    name="email"
                    required
                    autofocus
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
                      <button type="submit" class="w-100 btn btn-outline-light">
                          LOGIN
                      </button>
                    </div>
                </div>
            </form>

            <?include 'theme/script_form.php'?>
          </div>
        </div>
      </div>
    </body>
  </head>
</html>
