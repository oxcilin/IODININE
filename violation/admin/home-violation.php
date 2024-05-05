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
    </style>
    <body>
      <?php include 'theme/navbar.php'?>

        <div class="container-fluid">
            <div class="row">
                <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between">
                        <p>
                            <?php
                                // Set the default timezone (optional, assuming it's already set)
                                date_default_timezone_set('Asia/Jakarta');

                                // Get the current date and extract week, month, and year
                                $currentDate = new DateTime();
                                $currentWeek = $currentDate->format('W');
                                $currentYear = $currentDate->format('Y');

                                // Pad the week number with zeros if it's less than 10
                                $paddedWeek = str_pad($currentWeek, 2, '0', STR_PAD_LEFT);

                                // Generate the formatted ID group (MGWW-YYYY format)
                                $group = "MG{$paddedWeek}-{$currentYear}";

                                // $group = "MG17-2024";
                            ?>
                            <button type="button" class="btn btn-outline-light btn-sm">
                                <? echo $group; ?>
                            </button>
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
                                    <form action="_proses" method="POST" enctype="multipart/form-data" class="row g-3 login-form" novalidate autocomplete="off">
                                        <div class="mb-3">
                                            <div class="row g-3">
                                                <div class="col">
                                                    <input type="text" id="idGroup" name="idGroup" class="form-control text-center" value="<? echo $group; ?>" readonly required>
                                                </div>
                                                <div class="col">
                                                    <input type="text" id="date" name="date" class="form-control text-center" value="<?php date_default_timezone_set('Asia/Jakarta'); echo date('Y-m-d H:i:s'); ?>" readonly required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="nama" class="form-label">User</label>
                                            <select class="form-select" id="user" name="user">
                                                <option selected disabled value="">--- Pilih ---</option>
                                                <?php 
                                                    $sql = "SELECT * FROM user";
                                                    $result = $conn->query($sql);

                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            // Modify the option value based on your requirements
                                                            $noinduk = $row['noinduk']; // Check if the missing semicolon caused the issue
                                                            echo '<option value="' . $noinduk . '">' . $row['nama'] . '</option>';
                                                        }
                                                    } else {
                                                        echo '<option value="No data found">No data found</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Details</label>
                                            <select class="form-select" id="details" name="details">
                                                <option selected disabled value="">--- Pilih ---</option>
                                                <?php 
                                                    $sql = "SELECT * FROM violation_code";
                                                    $result = $conn->query($sql);

                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            // Modify the option value based on your requirements
                                                            $code = $row['code']; // Check if the missing semicolon caused the issue
                                                            echo '<option value="' . $code . '">' . $row['arti'] . '</option>';
                                                        }
                                                    } else {
                                                        echo '<option value="No data found">No data found</option>';
                                                    }
                                                ?>
                                            </select>
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
                        $group = mysqli_real_escape_string($conn, $group); // Escape the group variable for security

                        // Fetch data from the 'violation' table
                        $sql = "SELECT *, v.id, v.id_group, v.noinduk, u.nama, COUNT(*) AS total_warning
                                FROM violation v
                                LEFT JOIN user u ON v.noinduk = u.noinduk
                                WHERE v.id_group = '$group'
                                GROUP BY v.id, v.id_group, v.noinduk, u.nama
                                ORDER BY date DESC";
                        $result = mysqli_query($conn, $sql);
                        $no = 1; // A variable to keep track of row numbers

                        ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">ID</th>
                                    <th scope="col">ID Group</th>
                                    <th scope="col">No Laporan</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Details</th>
                                    <th scope="col-3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php
                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                
                                                $noinduk = $row['noinduk']; // Extract noinduk from violation table
                                                $totalWarning = $row['total_warning'];

                                                // Fetch name from the 'user' table based on matching noinduk
                                                $sql_user = "SELECT nama FROM user WHERE noinduk = '$noinduk'";
                                                $result_user = mysqli_query($conn, $sql_user);

                                                // Check if a matching name is found in the 'user' table
                                                if (mysqli_num_rows($result_user) > 0) {
                                                    $row_user = mysqli_fetch_assoc($result_user);
                                                    $nama_full = $row_user['nama'];
                                                    
                                                    // Extract first name and ignore last name if present
                                                    $nama_parts = explode(' ', $nama_full);
                                                    $nama = $nama_parts[0]; // Extract first word
                                                } else {
                                                    // Handle the case where no matching name is found (e.g., display 'No Name Found')
                                                    $nama = $noinduk;
                                                }
                                    ?>

                                    <tr>
                                        <th class="col-auto" scope="row">
                                            <?= $no++ ?>
                                        </th>
                                        <td class="col-auto">
                                            <?= $row['id'] ?>
                                        </td>
                                        <td class="col-auto text-break">
                                            <?= $row['id_group'] ?>
                                        </td>
                                        <td class="col-auto text-break">
                                            <?= $row['nolaporan'] ?>
                                        </td>
                                        <td class="col-auto">
                                            <?= $nama ?>
                                        </td>
                                        <td class="col-auto text-break">
                                            <?php 
                                                $details = $row['details']; // Ambil teks dari $row['details']
                                                $words = preg_split("/\s+/", $details); // Pisahkan kata-kata menggunakan ekspresi reguler
                                                $firstTwoWords = implode(' ', array_slice($words, 0, 2)); // Gabungkan dua kata pertama menjadi satu string
                                                echo $firstTwoWords; // Tampilkan dua kata pertama                             
                                            ?>
                                        </td>
                                        <td class="col-auto">
                                            <a type="button" class="badge btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#editData<?= $no ?>"><i class="fa-solid fa-pen-nib"></i></a>
                                            <a type="button" class="badge btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#deleteData<?= $no ?>"><i class="fa-solid fa-trash-can"></i></a>
                                        </td>
                                    </tr>

                                    <!-- Delete Data Modal -->
                                    <div class="modal fade" id="deleteData<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteDataLabel<?= $no ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="deleteDataLabel<?= $no ?>">Delete Data</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="_proses" method="POST" enctype="multipart/form-data" class="row g-3 edit-form" novalidate autocomplete="off">
                                                        <p>Are you sure to delete this data?</p>

                                                        <div class="d-flex justify-content-between">
                                                            <p><?= $nama_full ?> — <?= $noinduk ?></p>
                                                            <p class="text-end">
                                                                <span span class="badge rounded-pill <?= $totalWarning >= 3 ? 'bg-danger' : 'text-bg-warning' ?>">
                                                                    <?= str_pad($totalWarning, 2, '0', STR_PAD_LEFT) ?> warning
                                                                </span>
                                                            </p>
                                                        </div>
                                                        <div class="accordion" id="accordionExample">
                                                            <div class="accordion-item">
                                                                <h2 class="accordion-header">
                                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                    ID: <?= $row['id'] ?> — <?= $row['nolaporan'] ?>
                                                                </button>
                                                                </h2>
                                                                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                                                    <div class="accordion-body">
                                                                        <code>
                                                                            <?= $row['date'] ?> — <?= $row['staff'] ?>
                                                                        </code>
                                                                        
                                                                        <br> 
                                                                        
                                                                        <i class="fa-solid fa-caret-right"></i> <?= $row['details'] ?>
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

                                    <!-- Edit Data Modal -->
                                    <div class="modal fade" id="editData<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editDataLabel<?= $no ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="editDataLabel<?= $no ?>">Edit Data</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="_proses" method="POST" enctype="multipart/form-data" class="row g-3 edit-form" novalidate autocomplete="off">
                                                        <input type="hidden" name="editId" value="<?= $row['id'] ?>">

                                                        <div class="mb-3">
                                                            <div class="row g-3">
                                                                <div class="col">
                                                                    <input type="text" id="editidGroup" name="editidGroup" class="form-control text-center" value="<? echo $group; ?>" readonly required>
                                                                </div>
                                                                <div class="col">
                                                                    <input type="text" id="editdate" name="editdate" class="form-control text-center" value="<?php date_default_timezone_set('Asia/Jakarta'); echo date('Y-m-d H:i:s'); ?>" readonly required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="nama" class="form-label">User</label>
                                                            <select class="form-select" id="edituser<?= $no ?>" name="edituser">
                                                                <option selected disabled value="">--- Pilih ---</option>
                                                                <?php 
                                                                    // Query to retrieve options from the database
                                                                    $sqlModalEdit = "SELECT * FROM user";
                                                                    $resultModalEdit = $conn->query($sqlModalEdit);

                                                                    if ($resultModalEdit->num_rows > 0) {
                                                                        while ($rowModalEdit = $resultModalEdit->fetch_assoc()) {
                                                                            $noinduk = $rowModalEdit['noinduk'];
                                                                            $nama = $rowModalEdit['nama'];

                                                                            // Check if the fetched code matches the one from the server
                                                                            $selected = ($noinduk === $row['noinduk']) ? 'selected' : '';

                                                                            echo '<option value="' . $noinduk . '" ' . $selected . '>' . $nama . '</option>';
                                                                        }
                                                                    } else {
                                                                        echo '<option value="No data found">No data found</option>';
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="nama" class="form-label">Details</label>
                                                            <select class="form-select" id="editdetails<?= $no ?>" name="editdetails">
                                                                <option selected disabled value="">--- Pilih ---</option>
                                                                <?php 
                                                                    // Query to retrieve options from the database
                                                                    $sqlModalEdit = "SELECT * FROM violation_code";
                                                                    $resultModalEdit = $conn->query($sqlModalEdit);

                                                                    if ($resultModalEdit->num_rows > 0) {
                                                                        while ($rowModalEdit = $resultModalEdit->fetch_assoc()) {
                                                                            $code = $rowModalEdit['code'];
                                                                            $arti = $rowModalEdit['arti'];

                                                                            // Check if the fetched code matches the one from the server
                                                                            $selected = ($code === $row['details']) ? 'selected' : '';

                                                                            echo '<option value="' . $code . '" ' . $selected . '>' . $arti . '</option>';
                                                                        }
                                                                    } else {
                                                                        echo '<option value="No data found">No data found</option>';
                                                                    }
                                                                ?>
                                                            </select>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" name="buttonEdit" class="btn btn-outline-primary">Save Changes</button>
                                                </div>
                                                </form>
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

<?php } else { header("Location: ."); exit(); } ?>