<?php session_start(); 
  include "../../kas/db_conn.php"; 
  if (isset($_SESSION['id_violation']) && isset($_SESSION['email_violation'])) {
    if (!isset($_SESSION['role_violation']) || $_SESSION['role_violation'] != 1) {
        // User is not an admin; redirect them to another page
        $_SESSION['admin_error_violation'] = "You are not allowed to access this page!";
        header("Location: .");
        exit;
    }

    // add
    if (isset($_POST['buttonSave'])) {
        // Validate and sanitize user input
        $arti = $_POST["arti"];

        // Insert the data into the database
        $simpan = mysqli_query($conn, "INSERT INTO violation_code (code, arti) VALUES ('$arti', '$arti')"); 
        
        if ($simpan) {
            $_SESSION['success_admin_violation'] = "Data has been added successfully.";
            header("Location: list-details");
            exit();
        } else {
            $_SESSION['error_admin_violation'] = "An error occurred while processing the request. " . mysqli_error($conn);
            header("Location: list-details");
            exit();
        }
    }

    if (isset($_POST['buttonEdit'])) {
        $id = $_POST["editId"];
        $newarti = $_POST["editarti"];
    
        // Update the violation_code table with the new code and arti values
        $updateQuery = "UPDATE violation_code SET code = ?, arti = ? WHERE id = ?";
        $stmtUpdate = mysqli_prepare($conn, $updateQuery);
        mysqli_stmt_bind_param($stmtUpdate, "ssi", $newarti, $newarti, $id); // Changed "sii" to "ssi"
        mysqli_stmt_execute($stmtUpdate);
    
        // Check if the update was successful
        if (mysqli_stmt_affected_rows($stmtUpdate) > 0) {
            $_SESSION['success_admin_violation'] = "Data has been updated successfully.";
            header("Location: list-details");
            exit();
        } else {
            $_SESSION['error_admin_violation'] = "An error occurred while processing the request. " . mysqli_error($conn);
            header("Location: list-details");
            exit();
        }
    }

    // Delete
    if (isset($_POST['buttonDelete'])) {
        $hapus = mysqli_query($conn, "DELETE FROM violation_code WHERE id = '" . $_POST['deleteId'] . "'");
        
        if ($hapus) {
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
    </style>
    <body>
      <?php include 'theme/navbar.php'?>

        <div class="container-fluid">
            <div class="row">
                <div class="row">
                    <br>
                <div class="col-md-12">
                    <div class="d-flex justify-content-between">
                        <p>
                        </p>
                        <p class="text-end">
                            <button type="button" class="btn btn-outline-light btn-sm" data-bs-toggle="modal" data-bs-target="#addData">
                                <i class="fas fa-plus"></i> Tambah Data
                            </button>
                        </p>
                    </div>
                    <!-- Add Data Modal -->
                    <div class="modal fade" id="addData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addDataLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="addDataLabel">Record a New Data</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form  method="POST" enctype="multipart/form-data" class="row g-3 login-form" novalidate autocomplete="off">
                                        <div class="form-floating">
                                            <textarea class="form-control" id="arti" name="arti" oninput="this.value = this.value.toUpperCase();" required></textarea>
                                            <label for="arti" class="form-label">Details</label>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-outline-primary" name="buttonSave">Add Data</button>
                                </div>
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
                        // Fetch data from the 'violation_code' table
                        $sql = "SELECT * FROM violation_code";
                        $result = mysqli_query($conn, $sql);
                        $no = 1; // A variable to keep track of row numbers

                        ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">ID</th>
                                    <th scope="col">Details</th>
                                    <th scope="col-3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <th class="col-auto" scope="row">
                                            <?= $no++ ?>
                                        </th>
                                        <td class="col-auto">
                                            <?= $row['id'] ?>
                                        </td>
                                        <td class="col-auto">
                                            <?= $row['arti'] ?>
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
                                                    <form method="POST" class="row g-3 needs-validation edit-form" novalidate autocomplete="off">
                                                        <input type="hidden" name="editId" value="<?= $row['id'] ?>">
                                                        <div class="form-floating">
                                                            <textarea class="form-control" class="form-control" style="height: 100px" id="editarti" name="editarti" oninput="this.value = this.value.toUpperCase();" required><?= $row['arti']?></textarea>
                                                            <label for="arti" class="form-label">Details</label>
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
                                                    <form method="POST" class="row g-3 needs-validation edit-form" novalidate autocomplete="off">
                                                        <p>Are you sure to delete this data?</p>

                                                        <div class="accordion" id="accordionExample">
                                                            <div class="accordion-item">
                                                                <h2 class="accordion-header">
                                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                    ID: <?= $row['id'] ?>
                                                                </button>
                                                                </h2>
                                                                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                                                    <div class="accordion-body">
                                                                        <i class="fa-solid fa-caret-right"></i> <?= $row['arti'] ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
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
    </body>
  </head>
</html>

<?php
} else {
    header("Location: ");
    exit();
}?>