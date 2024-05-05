<?php session_start(); 
  include "../../kas/db_conn.php"; 
  if (isset($_SESSION['id_violation']) && isset($_SESSION['email_violation'])) {
    if (!isset($_SESSION['role_violation']) || $_SESSION['role_violation'] != 1) {
      // User is not an admin; redirect them to another page
      $_SESSION['admin_error_violation'] = "You are not allowed to access this page!";
      header("Location: .");
      exit;
  } 
?>

<html lang="en" data-bs-theme="dark">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta property="og:site_name" content`="<?php include 'theme/name_page.php'?>" />
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
      body {
        font-family: "Chivo";
      }

      #greeting {
        font-size: 24px;
      }

      #datetime {
        font-size: 18px;
      }

      ::-webkit-scrollbar {
        display: none;
      }
    </style>
    <body>
      <?php include 'theme/navbar.php'?>

        <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                    <?php
                        if (isset($_SESSION['error_admin_violation'])) {
                            echo '
                            <br>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle px-2"></i>' . $_SESSION['error_admin_violation'] . '
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                            unset($_SESSION['error_admin_violation']); // Clear the error message from the session
                        };

                        if (isset($_SESSION['success'])) {
                            echo '
                            <br>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle px-2"></i>' . $_SESSION['success_admin_violation'] . '
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                            unset($_SESSION['success']); // Clear the error message from the session
                        } 
                    ?>

                    <?php
                        // Fetch data from the 'serverLogs' table
                        $sql = "SELECT * FROM serverLogs ORDER BY id DESC";
                        $result = mysqli_query($conn, $sql);
                        $no = 1; // A variable to keep track of row numbers

                        ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Logs</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <td class="col-auto">
                                            <?= $row['id'] ?>
                                        </td>
                                        <td class="col-auto text-break">
                                            <?= $row['date'] ?>
                                        </td>
                                        <td class="col-auto text-break">
                                            <?= $row['logs'] ?>
                                        </td>
                                    </tr>

                                    </div>
                                    <?php
                                }
                                } else {
                                echo '<td colspan="7">No records found.</td>';
                            }
                        ?>
                        </tbody>
                    </table>
                    <?php

                    mysqli_close($conn);
                    ?>
            
                </div>
              </div>
            </div>
        </div>
    </body>
  </head>
</html>

<?php } else { header("Location: ."); exit(); } ?>