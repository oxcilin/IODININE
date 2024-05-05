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
        user-select: none;
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

        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
    <body>
      <?php include 'theme/navbar.php'?>

      <?php
        // Check if the user has logged in and has the necessary session variables set
        if (isset($_SESSION['id_violation']) && isset($_SESSION['email_violation'])) {
            // Fetch user details from the 'violation_admin' table based on session ID
            $idViolation = $_SESSION['id_violation'];
            $sqlCheckSpecial = "SELECT * FROM violation_admin WHERE id = '$idViolation' AND special_id = '1'";
            $resultCheckSpecial = mysqli_query($conn, $sqlCheckSpecial);

            if (mysqli_num_rows($resultCheckSpecial) > 0) {
                // User has a special_id, continue with the page logic
        ?>
        <div class="container-fluid">
            <div class="row">
            <div class="col-md-12">
                    <center style="text-align: right;">
                        <button type="button" class="btn btn-outline-light btn-sm" data-bs-toggle="modal" data-bs-target="#addData">
                            <i class="fas fa-plus"></i> Add New Account
                        </button>
                    </center>

                    <!-- Add Data Modal -->
                    <div class="modal fade" id="addData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addDataLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="addDataLabel">Record a New Data</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="_account" method="POST" class="row g-3 needs-validation login-form" novalidate autocomplete="off">
                                        <div class="mb-3">
                                            <label for="Nama" class="form-label">Nama</label>
                                            <input type="text" class="form-control" id="nama" name="nama" oninput="this.value = this.value.toUpperCase();" required>
                                            <div class="invalid-feedback">
                                                Please enter a valid name.
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email/Username</label>
                                            <input type="text" class="form-control" id="email" name="email" required>
                                            <div class="invalid-feedback">
                                                Please enter a valid email or username.
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="password" name="password" required>
                                            <div class="invalid-feedback">
                                                Please enter a valid password.
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="role" class="form-label">Role</label>
                                            <input type="number" class="form-control" id="role" name="role" value="1" readonly required>
                                            <div class="invalid-feedback">
                                                Please enter a valid role.
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="role" class="form-label">Privileges</label>
                                            <input type="number" class="form-control" id="privileges" name="privileges" value="0" readonly>
                                            <div class="invalid-feedback">
                                                Please enter a valid privileges.
                                            </div>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-outline-primary" name="buttonSave">Add Data</button>
                                </div>
                                <?php include 'theme/script_form.php'?>
                                </form>
                            </div>
                        </div>
                    </div>
                    
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
            
                        if (isset($_SESSION['success_admin_violation'])) {
                            echo '
                            <br>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle px-2"></i>' . $_SESSION['success_admin_violation'] . '
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                            unset($_SESSION['success_admin_violation']); // Clear the error message from the session
                        } 
                    ?>

                    <?php
                        // Fetch data from the 'violation_admin' table
                        $sql = "SELECT * FROM violation_admin";
                        $result = mysqli_query($conn, $sql);
                        $no = 1; // A variable to keep track of row numbers

                        ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">ID</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">PVL</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Username</th>
                                    <th scope="col-3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <th class="col-auto col-sm-1" scope="row">
                                            <?= $no++ ?>
                                        </th>
                                        <td class="col-auto">
                                            <?= $row['id'] ?>
                                        </td>
                                        <td class="col-auto">
                                            <?= $row['role'] ?>
                                        </td>
                                        <td class="col-auto">
                                            <?= $row['special_id'] ?>
                                        </td>
                                        <td class="col-auto">
                                            <?= $row['nama'] ?>
                                        </td>
                                        <td class="col-auto">
                                            <?= $row['email'] ?>
                                        </td>
                                        <td class="col-auto">
                                            <a type="button" class="badge btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#editData<?= $no ?>"><i class="fa-solid fa-pen-nib"></i></a>
                                            <a type="button" class="badge btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#deleteData<?= $no ?>"><i class="fa-solid fa-trash-can"></i></a>
                                        </td>
                                    </tr>

                                    <!-- Edit Data Modal -->
                                    <div class="modal fade" id="editData<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editDataLabel<?= $no ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="editDataLabel<?= $no ?>">Edit Data</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="_account" method="POST" class="row g-3 needs-validation edit-form" novalidate autocomplete="off">
                                                        <input type="hidden" name="editId" value="<?= $row['id'] ?>">
                                                        <div class="mb-3">
                                                            <label for="editNama<?= $no ?>" class="form-label">Nama</label>
                                                            <input type="text" class="form-control" id="editNama<?= $no ?>" name="editNama" value="<?= $row['nama'] ?>" oninput="this.value = this.value.toUpperCase();" required>
                                                            <div class="invalid-feedback">
                                                                Please enter a valid name.
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="editEmail<?= $no ?>" class="form-label">Email/Username</label>
                                                            <input type="text" class="form-control" id="editEmail<?= $no ?>" name="editEmail" value="<?= $row['email'] ?>" required>
                                                            <div class="invalid-feedback">
                                                                Please enter a valid email or username.
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="editPassword<?= $no ?>" class="form-label">Password</label>
                                                            <input type="password" class="form-control" id="editPassword<?= $no ?>" value="<?= $row['password'] ?>" name="editPassword">
                                                            <div class="invalid-feedback">editPassword
                                                                Please enter a valid password.
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="editRole<?= $no ?>" class="form-label">Role</label>
                                                            <input type="number" class="form-control" id="editRole<?= $no ?>" name="editRole" value="<?= $row['role'] ?>" required>
                                                            <div class="invalid-feedback">
                                                                Please enter a valid role.
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="editprivileges<?= $no ?>" class="form-label">Privileges</label>
                                                            <input type="number" class="form-control" id="editprivileges<?= $no ?>" name="editprivileges" value="<?= $row['special_id'] ?>">
                                                            <div class="invalid-feedback">
                                                                Please enter a valid privileges.
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" name="buttonEdit" class="btn btn-outline-primary">Save Changes</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Delete Data Modal -->
                                    <div class="modal fade" id="deleteData<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteDataLabel<?= $no ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="deleteDataLabel<?= $no ?>">Delete Data</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="_account" method="POST" class="row g-3 needs-validation edit-form" novalidate autocomplete="off">
                                                        <p>Are you sure to delete this data?</p>

                                                        <ul>
                                                            <li>ID: <b><?= $row['id'] ?></b></li>
                                                            <li>Nama: <b><?= $row['nama'] ?></b></li>
                                                            <li>Email/Username: <b><?= $row['email'] ?></b></li>
                                                            <li>Role: <b><?= $row['role'] ?></b></li>
                                                            <li>Privileges: <b><?= $row['special_id'] ?></b></li>
                                                        </ul>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <input type="hidden" name="deleteId" value="<?= $row['id'] ?>">
                                                        <button type="submit" name="buttonDelete" class="btn btn-outline-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } else {
                                echo '<td colspan="6">No records found.</td>';
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
        <?php
            } else {
                // User does not have a special_id, display a warning message
                $name = $_SESSION['nama_violation']; // Assuming 'nama_violation' is the session key for the user's name
        ?>
            <div class="container" style="padding-top: 10px">
                <div class="alert alert-warning" role="alert">
                    <i class="fas fa-exclamation-triangle px-2"></i>
                    Sorry, <?= $name ?>. It appears you don't have administrator privileges. This page refer to <code><?php include 'theme/name_page-crud.php'; ?></code> is restricted to authorized personnel only. To add or edit staff accounts, please contact a system administrator. They'll be happy to assist you further.
                </div>
            </div>
        <?php
            }
        }
        ?>
    </body>
  </head>
</html>

<?php } else { header("Location: "); exit(); } ?>