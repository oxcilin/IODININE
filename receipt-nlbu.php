<?php session_start(); if (isset($_SESSION['noinduk']) && isset($_SESSION['tanggallahir'])) { ?>

    <html lang="en" data-bs-theme="dark">
    <head>
        <meta charset="UTF-8"/>
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
        <title><?php echo $_SESSION['noinduk']; ?>.<?php include 'admin/theme/name_page.php'?></title>

        <!--=============== FONT ===============-->
        <link rel="preconnect" href="https://fonts.googleapis.com"/>
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
        <link href="https://fonts.googleapis.com/css2?family=Chivo:wght@300&display=swap" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono&display=swap" rel="stylesheet">

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


        <style>
            html,
            body {
                font-family: 'IBM Plex Mono', monospace;
                user-select: none;
                
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

            .dashed-line {
                border: none;
                border-top: 1.3px dashed #808080; /* Adjust color and width as needed */
            }

            .stretched {
                font-weight: bold;
                font-size: 24px; /* Adjust the font size as needed */
                line-height: 1.5; /* Adjust the line height as needed */
                margin: 0; /* Remove any default margins */
                padding: 0; /* Remove any default padding */
            }

            .right-align {
                float: right; /* Align the container to the right */
                margin-right: 30px; /* Add some margin for spacing */
                text-align: right; /* Align the content within the container to the right */
            }

            ::-webkit-scrollbar {
                display: none;
            }

            .ttl {
                font-weight: bold;
            }
            
            .ttl .nominal {
                font-weight: bold;
                font-size: 24px;
            }

            table {
                table-layout: fixed;
            }
        </style>
        <body>
            <div class="container-xl">
                <br></br>
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <?php
                                include "db_conn.php";

                                // Query to fetch data from the class_info table
                                $sql = "SELECT class_name, start_ay, end_ay FROM class_info";

                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    // Output data of each row
                                    while($row = $result->fetch_assoc()) {
                                        // Process fetched data
                                        $class_name = $row["class_name"];
                                        $start_ay = $row["start_ay"];
                                        $end_ay = $row["end_ay"];

                                        // Here, you can use the fetched data in your receipt template
                                        echo "<center>";
                                        echo "<h4>RECEIPT</h4>";
                                        echo "<h5>" . $class_name . "</h5>";
                                        echo "A.Y. " . $start_ay . "." . $end_ay . "<br>";
                                        echo "</center>";
                                    }
                                    $_SESSION['start_ay'] = $start_ay;
                                } else {
                                    echo "error!";
                                }
                                $conn->close();
                            ?>
                            <hr class="dashed-line"></hr>
                            <center><p><?php include 'admin/theme/date.php'?></p></center>
                            <hr class="dashed-line"></hr>
                            <center>
                                <h5>** CUSTOMER COPY **</h5>
                                <h6>0000<?php echo $_SESSION['start_ay']; ?><?php echo $_SESSION['start_ay'] + 42 ?><?php echo $_SESSION['noinduk']; ?></h6>
                            </center>
                            <table>
                                <tbody><tr>
                                    <td style="padding: 5px;"> Guest </td>
                                    <td style="padding: 5px;"> &nbsp; : &nbsp; </td>
                                    <td style="padding: 5px;"> <?php echo $_SESSION['nama']; ?> [<?php echo $_SESSION['nokelas']; ?>.<?php echo $_SESSION['noinduk']; ?>]</td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px;"> Server </td>
                                    <td style="padding: 5px;"> &nbsp; : &nbsp; </td>
                                    <td style="padding: 5px;"> idc3d-jkt48</td>
                                </tr>
                            </table>
                            <center>
                                <a id="hide-text" href="#anda">CLICK HERE TO JUMP TO "YOUR TRANSACTIONS"</a>
                            </center>

                            <hr class="dashed-line"></hr>

                            <div class="list-transaksi" id="list-transaksi">
                            <center><p>List Transaksi</p></center>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">ID</th>
                                        <th scope="col">Code</th>
                                        <th scope="col">Nama Transaksi</th>
                                        <th scope="col">Tanggal Transaksi</th>
                                        <th scope="col">Nominal Transaksi</th>
                                        <th scope="col">Status Transaksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include "db_conn.php";

                                    $noinduk = $_SESSION['noinduk']; // Fetch the 'noinduk' from the session
                                    $idtransaksi = $row['idtransaksi'];
                                    $currency = $conn->query("SELECT currency FROM class_info")->fetch_assoc()["currency"] ?? "??";
                                    // Fetch data from the database
                                    $sql = "SELECT p.*, t.tanggal_transaksi 
                                            FROM pembayaran p
                                            INNER JOIN transaksi t ON p.idtransaksi = t.id
                                            WHERE p.noinduk = '$noinduk'";
                                    $result = $conn->query($sql);
                                    $no = 1; // A variable to keep track of row numbers

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
                                                    <?= $row['code_transaksi'] ?>
                                                </td>
                                                <td class="col-auto">
                                                    <?= $row['pembayaran'] ?>
                                                </td>
                                                <td class="col">
                                                    <?= $row['tanggal_transaksi'] ?>
                                                </td>
                                                <td class="col-auto">
                                                    <?= $currency . ' ' . number_format($row['nominal'], 0, ',', '.') ?>
                                                </td>
                                                <td class="col-auto">
                                                    <?= $row['ket'] ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='6'>No data found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>

                            <hr class="dashed-line"></hr>

                            </div>
                            <center><p>Transaksi Anda</p></center>
     
                            <div id="anda">
                            <?php 
                                // Fetch data from the database
                                $sql = "SELECT * FROM pembayaran WHERE noinduk = '$noinduk' ORDER BY code_transaksi";
                                $result = $conn->query($sql);
                                $transactions = [];

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $transactions[$row['code_transaksi']][] = $row;
                                    }
                                    ?>
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Code Transaksi</th>
                                                <th scope="col">Nama Transaksi</th>
                                                <th scope="col">Nominal Transaksi</th>
                                            </tr>
                                            <?php
                                            foreach ($transactions as $code => $transactionGroup) {
                                                $codeResult = mysqli_query($conn, "SELECT * FROM code_transaksi WHERE code = '$code'");
                                                $arti = 'Unknown'; // Default 'arti' value if not found
                                                if ($codeResult && mysqli_num_rows($codeResult) > 0) {
                                                    $codeRow = mysqli_fetch_assoc($codeResult);
                                                    $arti = $codeRow['arti'];
                                                }

                                                $showTable = false;
                                                foreach ($transactionGroup as $transaction) {
                                                    if ($transaction['ket'] !== 'LUNAS') {
                                                        $showTable = true;
                                                        break;
                                                    }
                                                }

                                                if ($showTable) {
                                                    $index = 0;
                                                    foreach ($transactionGroup as $transaction) {
                                                        if ($transaction['ket'] !== 'LUNAS') {
                                                            ?>
                                                            <tr>
                                                                <td><?= ++$index ?></td>
                                                                <td><?= $transaction['code_transaksi'] ?></td>
                                                                <td><?= $transaction['pembayaran'] ?></td>
                                                                <td style="text-align: right;"><?= ($result = $conn->query("SELECT currency FROM class_info")->fetch_assoc()["currency"] ?? "??") . ' ' . number_format($transaction['nominal'], 0, ',', '.') ?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                    $total = array_sum(array_column(array_filter($transactionGroup, function ($t) {
                                                        return $t['ket'] !== 'LUNAS';
                                                    }), 'nominal'));
                                                    ?>
                                                    <tr>
                                                        <td></td>
                                                        <td class="ttl">TOTAL <?= $code ?> [<?= $arti ?>]</td>
                                                        <td></td>
                                                        <td style="text-align: center;" class="ttl nominal"><?= ($result = $conn->query("SELECT currency FROM class_info")->fetch_assoc()["currency"] ?? "??") . ' ' . number_format($total, 0, ',', '.') ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <?php
                                } else {
                                    echo '<td colspan="4">No records found.</td>';
                                }
                            ?>
                            </div>

                            <hr class="dashed-line"></hr>

                            <button id="signoutBtn" type="button" class="btn btn-outline-danger btn-sm" onclick="window.location.href='signout';">SIGNOUT</button>
                            <button id="printBtn" type="button" class="btn btn-outline-success btn-sm" onclick="printPage()">PRINT</button>

                            <script>
                                function printPage() {
                                    // Hide the buttons
                                    document.getElementById('signoutBtn').style.display = 'none';
                                    document.getElementById('printBtn').style.display = 'none';
                                    document.getElementById('list-transaksi').style.display = 'none';
                                    document.getElementById('hide-text').style.display = 'none';

                                    // Trigger the print functionality
                                    window.print();

                                    // After printing (when the print dialog closes or cancels), show the buttons again
                                    setTimeout(function() {
                                        document.getElementById('list-transaksi').style.display = 'inline-block';
                                        document.getElementById('signoutBtn').style.display = 'inline-block';
                                        document.getElementById('printBtn').style.display = 'inline-block';
                                        document.getElementById('hide-text').style.display = 'inline-block';
                                    }, 2000); // Adjust the delay as needed
                                }
                            </script>
                            <div class="right-align"> 
                            <?php 
                                $subtotal = 0;

                                foreach ($transactions as $transactionGroup) {
                                    foreach ($transactionGroup as $transaction) {
                                        if ($transaction['ket'] !== 'LUNAS') {
                                            $subtotal += $transaction['nominal'];
                                        }
                                    }
                                }

                                $additionalFee = 0;
                                $additionalFeeIds = []; // Array untuk menyimpan ID dari additional fee
                                $noinduk = $_SESSION['noinduk']; // Ambil noinduk dari session

                                // Mengambil additional fee dari tabel `additional_fee` berdasarkan noinduk (user_oleh)
                                $sqlAdditionalFee = "SELECT id, SUM(nominal) AS total_fee FROM additional_fee WHERE status = 'BELUM DIBAYAR' AND user_oleh = '$noinduk' GROUP BY id";
                                $resultAdditionalFee = $conn->query($sqlAdditionalFee);

                                if ($resultAdditionalFee && $resultAdditionalFee->num_rows > 0) {
                                    while ($rowAdditionalFee = $resultAdditionalFee->fetch_assoc()) {
                                        $additionalFee += $rowAdditionalFee['total_fee'];
                                        $additionalFeeIds[] = $rowAdditionalFee['id']; // Menyimpan ID ke dalam array
                                    }
                                }

                                // Membuat string ID dengan tanda koma jika lebih dari 1 ID
                                $additionalFeeIdString = implode(', ', $additionalFeeIds);

                                // Calculate total
                                $total = $subtotal + $additionalFee;
                            ?>
                                <center style="text-align: right;">   
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td style="padding: 5px; text-align: right;"> Sub Total </td>
                                                <td style="padding: 5px;"> &nbsp; : &nbsp; </td>
                                                <td style="padding: 5px;"><?= ($result = $conn->query("SELECT currency FROM class_info")->fetch_assoc()["currency"] ?? "??") . ' ' . number_format($subtotal, 0, ',', '.') ?> </td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 5px; text-align: right;"> Additional Fee</td>
                                                <td style="padding: 5px;"> &nbsp; : &nbsp; </td>
                                                <td style="padding: 5px;"> <?= ($result = $conn->query("SELECT currency FROM class_info")->fetch_assoc()["currency"] ?? "??") . ' ' . number_format($additionalFee, 0, ',', '.') ?> [<?= $additionalFeeIdString ?>]</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 5px; text-align: right;"> Total </td>
                                                <td style="padding: 5px;"> &nbsp; : &nbsp; </td>
                                                <td style="padding: 5px;"> <span class="stretched"> <?= ($result = $conn->query("SELECT currency FROM class_info")->fetch_assoc()["currency"] ?? "??") . ' ' . number_format($total, 0, ',', '.') ?></span> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </center>
                            </div>
                            <br>
                            <hr class="dashed-line"></hr>
                            <h7>Note: 
                                <span style="font-size: 17px;">
                                <?php 
                                    if ($total == 0) {
                                        echo "Thank Youu!! ^3^";
                                    } else {
                                        echo "Please Pay All Your Transaction, Thank You!! ^3^";
                                    }
                                ?>
                                </span>
                            </h7>
                        </div>
                    </div>
                </div>
                <br></br>
            </div>
        </body>
    </head>
</html>

<?php } else { header("Location: ."); exit(); } ?>
