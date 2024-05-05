<?php
session_start(); include "../kas/db_conn.php";
?>

<html lang="en" data-bs-theme="dark">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta property="og:site_name" content="<?php include '../kas/admin/theme/name_page.php'?>"/>
        <meta property="og:type" content="website"/>
        <meta property="og:image" content="https://booth.oxa.biz.id/ban.png"/>
        <meta property="og:image:type" content="image/png"/>
        <meta property="og:image:width" content="1280"/>
        <meta property="og:image:height" content="800"/>
        <meta property="twitter:card" content="summary_large_image"/>

        <meta name="msapplication-TileColor" content="#ffffff"/>
        <meta
        name="theme-color" content="#ffffff"/>
        <!--=============== FAVICON ===============-->
        <link
        rel="shortcut icon" href="../../IODININE LOGO/TANPA BG PLAIN PUTIH.png" type="image/x-icon"/>

        <!--=============== REMIX ICONS ===============-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" rel="stylesheet"/>

        <!--=============== CSS ===============-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous"/>
        <link
        rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"/>

        <!--=============== TITLE ===============-->
        <title><?php include '../kas/admin/theme/name_page.php'?></title>

        <!--=============== FONT ===============-->
        <link rel="preconnect" href="https://fonts.googleapis.com"/>
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
        <link href="https://fonts.googleapis.com/css2?family=Chivo:wght@300&display=swap" rel="stylesheet"/>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

        <!-- Include SweetAlert2 CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">

        <!-- Include SweetAlert2 JS -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


        <style>
        body {
            font-family: "Chivo";
            scroll-behavior: smooth;
            user-select: none;
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

        <script>
            // Disable keyboard shortcuts
            document.addEventListener("keydown", function (e) {
                e.preventDefault();
            });

            // Disable right-click context menu
            document.addEventListener("contextmenu", function (e) {
                e.preventDefault();
            });
        </script>

        <div class="container-fluid">
            <nav class="navbar bg-body-tertiary fixed-top">
                <div class="container-fluid">
                    <div class="text-center w-100">
                        <b><a class="navbar-brand">IODININE</a></b>
                    </div>
                </div>
            </nav>

            <br /><br /><br>

            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-secondary text-center" role="alert">
                        <?php
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
                                $date = include '../kas/admin/theme/date.php';

                                date_default_timezone_set('Asia/Jakarta');
                                // Get the current date and extract week, month, and year
                                $currentDate = new DateTime();
                                $currentWeek = $currentDate->format('W');
                                $currentYear = $currentDate->format('Y');

                                // Pad the week number with zeros if it's less than 10
                                $paddedWeek = str_pad($currentWeek, 2, '0', STR_PAD_LEFT);

                                // Generate the formatted code
                                $group = "MG{$paddedWeek}-{$currentYear}";

                                // Here, you can use the fetched data in your receipt template
                                echo "<center>";
                                echo "$group<br>";
                                echo "$class ($class_name) - <span style='font-size: 16px'>A.Y. $start_ay.$end_ay</span>";
                                echo "</center>";
                            }
                        ?>
                        <?php } else {
                            echo "undefined";
                        }}?>
                    </div>
                </div>

                <div class="col-md-12">
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
                    // $group = "MG18-2024";

                    // Fetch violation data with total warning per ID group
                    $sql_violation = "SELECT v.id, v.id_group, v.noinduk, u.nama, COUNT(*) AS total_warning
                                        FROM violation v
                                        LEFT JOIN user u ON v.noinduk = u.noinduk
                                        WHERE v.id_group = '$group'  -- Add this condition to filter by id_group
                                        GROUP BY v.noinduk
                                        HAVING v.id_group = '$group'";
                    $result_violation = mysqli_query($conn, $sql_violation);
                    $no = 1; // A variable to keep track of row numbers

                    ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">ID</th>
                                <th scope="col">ID Group</th>
                                <th scope="col">Name</th>
                                <th scope="col">Warning</th>
                                <th scope="col">Details</th>
                            </tr>
                        </thead>
                            <tbody>
                                <?php
                                    if (mysqli_num_rows($result_violation) > 0) {
                                        while ($row_violation = mysqli_fetch_assoc($result_violation)) {
                                            $noinduk = $row_violation['noinduk']; // Extract noinduk from violation table
                                            $totalWarning = $row_violation['total_warning'];
                                    
                                            // Fetch name from the 'user' table based on matching noinduk
                                            $sql_user = "SELECT nama FROM user WHERE noinduk = '$noinduk'";
                                            $result_user = mysqli_query($conn, $sql_user);
                                    
                                            // Check if a matching name is found in the 'user' table
                                            if (mysqli_num_rows($result_user) > 0) {
                                                $row_user = mysqli_fetch_assoc($result_user);
                                                $full_name = $row_user['nama'];
                                    
                                                // Extract the first word (first name) from the full name
                                                $nama = explode(' ', $full_name)[0];
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
                                            <?= $row_violation['id'] ?>
                                        </td>
                                        <td class="col-auto">
                                            <?= $row_violation['id_group'] ?>
                                        </td>
                                        <td class="col-auto">
                                            <?= $nama ?>
                                        </td>
                                        <td class="col-auto">
                                            <span class="badge rounded-pill <?= $totalWarning >= 3 ? 'bg-danger' : 'text-bg-warning' ?>">
                                                <?= str_pad($totalWarning, 2, '0', STR_PAD_LEFT) ?>
                                            </span>
                                        </td>
                                        <td class="col-auto">
                                            <a type="button" class="badge btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#viewData<?= $no ?>"><i class="fa-solid fa-eye"></i></i></a>
                                        </td>
                                    </tr>

                                    <div class="modal fade viewDataModal" id="viewData<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="viewDataLabel<?= $no ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="viewDataLabel<?= $no ?>">View Data</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body" id="clipboardContent">

                                                    <div class="alert alert-warning" role="alert">
                                                        <center><a href="https://wa.me" class="alert-link">Spot a mistake in the violation data? Report it to the staff.</a></center>
                                                    </div>

                                                    <div class="d-flex justify-content-between">
                                                        <p><?= $full_name ?> — <?= $noinduk ?></p>
                                                        <p class="text-end">
                                                            <span span class="badge rounded-pill <?= $totalWarning >= 3 ? 'bg-danger' : 'text-bg-warning' ?>">
                                                                <?= str_pad($totalWarning, 2, '0', STR_PAD_LEFT) ?> warning
                                                            </span>
                                                        </p>
                                                    </div>

                                                    <div class="accordion" id="violationDetails">
                                                        <?php
                                                            // Fetch all violations for this user
                                                            $sql_violations_all = "SELECT * FROM violation WHERE noinduk = '$noinduk' AND id_group = '$group'";
                                                            $result_violations_all = mysqli_query($conn, $sql_violations_all);
                                                            if (mysqli_num_rows($result_violations_all) > 0) {
                                                                while ($row_violation_all = mysqli_fetch_assoc($result_violations_all)) {
                                                                    ?>
                                                                    <div class="accordion-item">
                                                                        <h2 class="accordion-header">
                                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                                            ID: <?= $row_violation_all['id'] ?> — <?= $row_violation_all['nolaporan'] ?>
                                                                        </button>
                                                                        </h2>
                                                                        <div id="flush-collapseOne" class="accordion-collapse collapse show" data-bs-parent="#violationDetails">
                                                                            <div class="accordion-body">
                                                                                <code>
                                                                                    <?= $row_violation_all['date'] ?> — <?= $row_violation_all['staff'] ?>
                                                                                </code>
                                                                                
                                                                                <br> 
                                                                                
                                                                                <i class="fa-solid fa-caret-right"></i> <?= $row_violation_all['details'] ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                }
                                                            } else {
                                                                echo "No violations found.";
                                                            }
                                                        ?>
                                                    </div>
                                                    
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <?php
                                }
                            } else {
                                echo '<td colspan="10">No records found.</td>';
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php

                    mysqli_close($conn);
                    ?>
                </div>
            </div>
        </body>
    </head>
</html>