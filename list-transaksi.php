<?php
session_start(); include "db_conn.php";
?>

<html lang="en" data-bs-theme="dark">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta property="og:site_name" content="<?php include 'admin/theme/name_page.php'?>"/>
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
        <title><?php include 'admin/theme/name_page.php'?></title>

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
                <br></br>
                <div class="col-md-12">
                    <div class="alert alert-secondary text-center" role="alert">
                        <?php
                        $sql = "SELECT * FROM transaksi";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            $totalTransactions = 0;
                            $totalLunasForAllTransactions = 0;

                            while ($row = mysqli_fetch_assoc($result)) {
                                // Get total assign for the current transaction
                                $queryAssign = "SELECT COUNT(DISTINCT noinduk) AS total_assign FROM pembayaran WHERE idtransaksi = {$row['id']}";
                                $resultAssign = mysqli_query($conn, $queryAssign);
                                $totalAssignRow = mysqli_fetch_assoc($resultAssign);
                                $totalAssign = $totalAssignRow['total_assign'];

                                // Get total lunas for the current transaction
                                $queryLunas = "SELECT COUNT(DISTINCT noinduk) AS total_lunas FROM pembayaran WHERE idtransaksi = {$row['id']} AND nobayar != 0";
                                $resultLunas = mysqli_query($conn, $queryLunas);
                                $totalLunasRow = mysqli_fetch_assoc($resultLunas);
                                $totalLunas = $totalLunasRow['total_lunas'];

                                // Calculate total belum lunas
                                $totalBelumLunas = $totalAssign - $totalLunas;

                                // Calculate percentage lunas for the current transaction
                                $percentageLunas = ($totalAssign == 0) ? 0 : ($totalLunas / $totalAssign) * 100;

                                // Accumulate totals for all transactions
                                $totalTransactions++;
                                $totalLunasForAllTransactions += $percentageLunas;
                            }

                            // Calculate average percentage lunas after processing all transactions
                            $averagePercentage = ($totalTransactions == 0) ? 0 : $totalLunasForAllTransactions / $totalTransactions;
                            $feedback = ($averagePercentage >= 90) ? 'Sangat Baik' :
                                        (($averagePercentage >= 80) ? 'Baik' :
                                        (($averagePercentage >= 70) ? 'Cukup' :
                                        (($averagePercentage >= 60) ? 'Kurang Memuaskan' :
                                        'Tidak Memuaskan')));
                            echo "Persentase Ketepatan Lunas: " . number_format($averagePercentage, 2) . '% - ' . $feedback;
                        } else {
                            echo "No transactions found.";
                        }
                        ?>
                    </div>

                <div class="col-md-12">
                    <?php
                        // Fetch data from the 'transaksi' table
                        $sql = "SELECT * FROM transaksi";
                        $result = mysqli_query($conn, $sql);
                        $no = 1; // A variable to keep track of row numbers

                        // Initialize variables for totals
                        $totalAssign = 0;
                        $totalLunas = 0;
                        $totalBelumLunas = 0;

                        ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">ID</th>
                                    <th scope="col">Code</th>
                                    <th scope="col">Nama Transaksi</th>
                                    <th scope="col">Tanggal Transaksi</th>
                                    <th scope="col">Nominal</th>
                                    <th scope="col">Total Assign</th>
                                    <th scope="col">Total Lunas</th>
                                    <th scope="col">Total Belum Lunas</th>
                                    <th scope="col">%</th>
                                    <th scope="col">-</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    // Get total assign for the current transaction
                                    $queryAssign = "SELECT COUNT(DISTINCT noinduk) AS total_assign FROM pembayaran WHERE idtransaksi = {$row['id']}";
                                    $resultAssign = mysqli_query($conn, $queryAssign);
                                    $totalAssignRow = mysqli_fetch_assoc($resultAssign);
                                    $totalAssign = $totalAssignRow['total_assign'];

                                    // Get total lunas for the current transaction
                                    $queryLunas = "SELECT COUNT(DISTINCT noinduk) AS total_lunas FROM pembayaran WHERE idtransaksi = {$row['id']} AND nobayar != 0";
                                    $resultLunas = mysqli_query($conn, $queryLunas);
                                    $totalLunasRow = mysqli_fetch_assoc($resultLunas);
                                    $totalLunas = $totalLunasRow['total_lunas'];

                                    // Calculate total belum lunas
                                    $totalBelumLunas = $totalAssign - $totalLunas;

                                    // Calculate percentage lunas
                                    $percentageLunas = ($totalLunas / $totalAssign) * 100;

                                    $currency = $conn->query("SELECT currency FROM class_info")->fetch_assoc()["currency"] ?? "??";
                                    ?>
                                    <tr>
                                        <th class="col-auto" scope="row">
                                            <?= $no++ ?>
                                        </th>
                                        <td class="col-auto">
                                            <?= $row['id'] ?>
                                        </td>
                                        <td class="col-auto">
                                            <?= $row['code_transaksi'] ?>
                                        </td>
                                        <td class="col-auto">
                                            <?= $row['nama_transaksi'] ?>
                                        </td>
                                        <td class="col-auto">
                                            <?= $row['tanggal_transaksi'] ?>
                                        </td>
                                        <td class="col-auto">
                                            <?= $currency . ' ' . number_format($row['nominal_transaksi']) ?>
                                        </td>
                                        <td class="col-auto">
                                            <?= str_pad($totalAssign, 2, '0', STR_PAD_LEFT) ?>
                                        </td>
                                        <td class="col-auto">
                                            <?= str_pad($totalLunas, 2, '0', STR_PAD_LEFT) ?>
                                        </td>
                                        <td class="col-auto">
                                            <?= str_pad($totalBelumLunas, 2, '0', STR_PAD_LEFT) ?>
                                        </td>
                                        <td class="col-auto">
                                            <?= number_format($percentageLunas, 2) . '%' ?>
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
                                                        <center><a href="admin/count" class="alert-link">Log onto the admin page to view the uncensored list.</a></center>
                                                    </div>

                                                    <p>
                                                        - ID : <?= $row['id'] ?><br>
                                                        - Code Transaksi : <?= $row['code_transaksi'] ?><br>
                                                        - Nama Transaksi : <i><?= $row['nama_transaksi'] ?></i><br>
                                                        - Tanggal Transaksi : <?= $row['tanggal_transaksi'] ?><br>
                                                        - Nominal : <?= 'IDR. ' . number_format($row['nominal_transaksi']) ?><br>
                                                        - Total Assign : <?= str_pad($totalAssign, 2, '0', STR_PAD_LEFT) ?><br>
                                                        - Total Lunas : <?= str_pad($totalLunas, 2, '0', STR_PAD_LEFT) ?><br>
                                                        - Total Belum Lunas : <?= str_pad($totalBelumLunas, 2, '0', STR_PAD_LEFT) ?><br>
                                                        - Persentase Lunas : <?= number_format($percentageLunas, 2) . '%' ?><br>
                                                    </p>

                                                    <?php
                                                        echo "berikut list yang belum lunas <i>{$row['nama_transaksi']} [{$row['id']}]</i> : <br>";

                                                        $queryNoindukBelumLunas = "SELECT DISTINCT u.noinduk, u.nama 
                                                                                    FROM user u 
                                                                                    LEFT JOIN pembayaran p ON u.noinduk = p.noinduk 
                                                                                    WHERE p.idtransaksi = {$row['id']} AND p.nobayar = 0";
                                                        $resultNoindukBelumLunas = mysqli_query($conn, $queryNoindukBelumLunas);

                                                        if ($resultNoindukBelumLunas && mysqli_num_rows($resultNoindukBelumLunas) > 0) {
                                                            $counter = 1;
                                                            while ($rowNoindukBelumLunas = mysqli_fetch_assoc($resultNoindukBelumLunas)) {
                                                                // Format the counter with leading zeros
                                                                $formattedCounter = str_pad($counter, 2, '0', STR_PAD_LEFT);
                                                                
                                                                // Censor the output while preserving spaces
                                                                $censoredNoinduk = preg_replace('/./', '*', $rowNoindukBelumLunas['noinduk']);
                                                                $censoredNama = preg_replace('/./', '*', $rowNoindukBelumLunas['nama']);
                                                                
                                                                echo "{$formattedCounter}. {$censoredNoinduk} - {$censoredNama} <br>";
                                                                $counter++;
                                                            }
                                                        } else {
                                                            echo '00. None';
                                                        }
                                                    ?>
                                                    <br>
                                                    <p>> _<?php date_default_timezone_set('Asia/Jakarta'); echo date("Y-m-d H:i:s"); ?>_</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-outline-success" onclick="copyToClipboard()">Copy</button>
                                                    <script>
                                                        function copyToClipboard() {
                                                            var clipboardContent = document.getElementById('clipboardContent').innerText;
                                                            navigator.clipboard.writeText(clipboardContent);
                                                            Swal.fire({
                                                                title: 'Copied!',
                                                                text: 'The content has been copied to your clipboard.',
                                                                icon: 'success',
                                                                confirmButtonText: 'Close'
                                                            });
                                                        }
                                                    </script>
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

