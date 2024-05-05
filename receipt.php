<?php session_start(); if (isset($_SESSION['noinduk']) && isset($_SESSION['tanggallahir'])) { ?>

<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    <title><?php echo $_SESSION['noinduk']; ?> — <?php include 'admin/theme/name_page.php'?></title>

    <!--=============== FONT ===============-->
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Chivo:wght@300&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


    <style>
        html,
        body {
            font-family: "IBM PLEX MONO";
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

        ::-webkit-scrollbar {
            display: none;
        }

        .center-align {
            text-align: center;
            vertical-align: middle;
        }

        .ttl {
            font-weight: bold;
        }
        
        .ttl .nominal {
            font-weight: bold;
            font-size: 24px;
        }

        .table {
        }
    </style>
    <body>
        <div class="container">
            <div class="row">
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
                            echo "<center> <img style='margin-top: 20px;' src='logo/BIRU TANPA BG.png' width='100px'>";
                            echo "<h5 style='font-family: IBM PLEX MONO; font-size: 25px; letter-spacing: 3; margin-top: 10px;'>" . $class_name . "</br>";
                            echo "<h6 style='font-family: IBM PLEX MONO; font-size: 17px;'>A.Y. " . $start_ay . " / " . $end_ay . "</h6></h5>";
                            echo "</center>";
                        }
                        $_SESSION['start_ay'] = $start_ay;
                    } else {
                        echo "error!";
                    }
                    $conn->close();
                ?>
                <div style="text-align: center; font-size: 18px; font-weight: 300; letter-spacing: 3; margin-top: 7px; font-family: 'Helvetica Neue', Helvetica, 'Segoe UI', Arial, sans-serif;"> 
                    TRANSACTION RECEIPT 
                </div>
                <hr class="dashed-line"></hr>

                <center>
                    <p><?php include "theme/date.php" ?></p>
                </center>

                <hr class="dashed-line"></hr>

                <div class="container">
                    <div class="title-section" style="font-size: 16px; letter-spacing: 1; border-bottom: 2px #666666 solid; padding-bottom: 10px;"> RECEPIENT DETAILS </div>
                    <table style="width: 100%; margin-top: 15px;">
                        <thead style="letter-spacing: 1; font-weight: 300;">
                            <tr>
                                <td style="padding: 10px 0;"> NAME </td> 
                                <td style="text-align: right;"> ACCOUNT NUMBER </td>
                            </tr>
                        </thead>
                        <tbody style="font-size: 20px;">
                            <tr> 
                                <td> 
                                    <?php
                                        function formatNama($nama)
                                        {
                                            $namaArray = explode(' ', $nama);

                                            if (count($namaArray) == 1) {
                                                return $nama;
                                            } elseif (count($namaArray) == 2) {
                                                return $namaArray[1] . ', ' . $namaArray[0];
                                            } else {
                                                $lastName = array_pop($namaArray);
                                                $firstName = implode(' ', $namaArray);
                                                return $lastName . ', ' . $firstName;
                                            }
                                        }

                                        $nama = $_SESSION['nama'];
                                        $namaFormatted = formatNama($nama);
                                        echo $namaFormatted . ".";
                                    ?>

                                </td> 
                                <td style="text-align: right;"> <?php echo $_SESSION['nokelas']; ?>.<?php echo $_SESSION['noinduk']; ?> </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="container" style="margin-top: 20px; ">
                    <div class="title-section" style="font-size: 16px; letter-spacing: 1; border-bottom: 2px #666666 solid; padding-bottom: 10px; margin-bottom: 10px;"> TRANSACTION DETAILS </div>

                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                    <center>
                                        PRESS TO VIEW ALL TRANSACTION LIST.
                                    </center>
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
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
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php 
                        // Fetch data from the database
                        $sql = "SELECT * FROM pembayaran WHERE noinduk = '$noinduk' ORDER BY code_transaksi";
                        $result = $conn->query($sql);
                        $transactions = [];

                        // Check if there are any transactions
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $transactions[$row['code_transaksi']][] = $row;
                            }

                            // Check if there are any unpaid transactions
                            $hasUnpaidTransactions = false;
                            foreach ($transactions as $code => $transactionGroup) {
                                foreach ($transactionGroup as $transaction) {
                                    if ($transaction['ket'] !== 'LUNAS') {
                                        $hasUnpaidTransactions = true;
                                        break 2; // Break both foreach loops
                                    }
                                }
                            }

                            if ($hasUnpaidTransactions) {
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
                                            // Check if there are unpaid transactions for this code
                                            $unpaidTransactions = array_filter($transactionGroup, function ($t) {
                                                return $t['ket'] !== 'LUNAS';
                                            });

                                            if (!empty($unpaidTransactions)) {
                                                $codeResult = mysqli_query($conn, "SELECT * FROM code_transaksi WHERE code = '$code'");
                                                $arti = 'Unknown'; // Default 'arti' value if not found
                                                if ($codeResult && mysqli_num_rows($codeResult) > 0) {
                                                    $codeRow = mysqli_fetch_assoc($codeResult);
                                                    $arti = $codeRow['arti'];
                                                }

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
                                                $total = array_sum(array_column($unpaidTransactions, 'nominal'));
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
                                // Calculate subtotal, additional fee, and total
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
                                    <table width="100%">
                                        <tbody>
                                            <tr>
                                                <td width="35%"></td>

                                                <td style="padding: 5px; text-align: right;"> Sub Total </td>
                                                <td style="padding: 5px;" class="center-align"> &nbsp; : &nbsp; </td>
                                                <td style="padding: 5px;"><?= ($result = $conn->query("SELECT currency FROM class_info")->fetch_assoc()["currency"] ?? "??") . ' ' . number_format($subtotal, 0, ',', '.') ?> </td>
                                            </tr>
                                            <tr>
                                                <td width="35%"></td>

                                                <td style="padding: 5px; text-align: right;"> Additional Fee</td>
                                                <td style="padding: 5px;" class="center-align"> &nbsp; : &nbsp; </td>
                                                <td style="padding: 5px;"> <?= ($result = $conn->query("SELECT currency FROM class_info")->fetch_assoc()["currency"] ?? "??") . ' ' . number_format($additionalFee, 0, ',', '.') ?> [<?= $additionalFeeIdString ?>]</td>
                                            </tr> 
                                            <tr>
                                                <td width="35%"></td>

                                                <td style="padding: 5px; text-align: right;"> Total </td>
                                                <td style="padding: 5px;" class="center-align"> &nbsp; : &nbsp; </td>
                                                <td style="padding: 5px;"> <span class="stretched"> <?= ($result = $conn->query("SELECT currency FROM class_info")->fetch_assoc()["currency"] ?? "??") . ' ' . number_format($total, 0, ',', '.') ?></span> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class="alert alert-success shadow-lg p-3 bg-body-tertiary rounded font-monospace" role="alert">
                                    <center>所有付款已结清！<br> ALL PAYMENTS HAVE BEEN SETTLED! <br>  (SUDAH LUNAS SEMUANYA)</center>
                                </div>
                                <?php
                            }
                        }
                    ?>

                </div>
                
                <div class="container" >
                    <div class="title-section" style="font-size: 16px; letter-spacing: 1; border-bottom: 2px #666666 solid; padding-bottom: 10px; margin-bottom: 10px;"> NOTE </div>
                    <span style="font-size: 14px; font-style: justify;">
                        <style>
                            .custom-list {
                                list-style-type: none; /* Menghilangkan simbol bawaan dari <ul> */
                            }

                            .custom-list li:before {
                                content: "*"; /* Menambahkan simbol "*" sebelum setiap item <li> */
                                margin-right: 20px; /* Spasi antara simbol "*" dan teks */
                            }
                        </style>
                        <?php 
                            if ($total == 0) {
                                echo    'Your timely payment for all transactions is greatly appreciated. Thank you for your promptness!';
                            } else {
                                echo    'Kindly settle all outstanding transactions at your earliest convenience. Your cooperation in this matter is highly valued. Thank you! ^3^';
                            }
                        ?>
                    </span>
            
                    <br>

                    <center style="margin-top: 25px">
                        <div style='text-align: center;'>
                            <!-- insert your custom barcode setting your data in the GET parameter "data" -->
                            <?php
                            $barcodeData = "0000" . $_SESSION['start_ay'] . ($_SESSION['start_ay'] + 42) . $_SESSION['noinduk'];
                            ?>
                            <img width="300px" style="display: inline-block; transform: skewX(-10deg); border-radius: 10px; margin-bottom: 5px"
                                src='https://barcode.tec-it.com/barcode.ashx?data=<?php echo $barcodeData; ?>&code=JapanesePostal&unit=Fit&showhrt=no&qunit=Mm&quiet=3&modulewidth=0.265'/>
                        </div>

                        <h6>0000<?php echo $_SESSION['start_ay']; ?><?php echo $_SESSION['start_ay'] + 42 ?><?php echo $_SESSION['noinduk']; ?></h6>
                    </center>

                    <div class="d-flex gap-3" style="margin-top: 20px; margin-bottom: 10px;">
                        <button id="printBtn" onclick="printPage()" class="w-100 btn btn-outline-success btn-sm">PRINT</button>
                        <button id="signoutBtn" onclick="window.location.href='signout';" class="w-100 btn btn-outline-danger btn-sm">SIGNOUT</button>

                        <script>
                            function printPage() {
                                // Hide the buttons
                                document.getElementById('signoutBtn').style.display = 'none';
                                document.getElementById('printBtn').style.display = 'none';

                                // Trigger the print functionality
                                window.print();

                                // After printing (when the print dialog closes or cancels), show the buttons again
                                setTimeout(function() {
                                    document.getElementById('signoutBtn').style.display = 'inline-block';
                                    document.getElementById('printBtn').style.display = 'inline-block';
                                }, 2000); // Adjust the delay as needed
                            }
                        </script>
                    </div>
                </div>
                
            </div>
        </div>
    </body>
</head>
</html>

<?php } else { header("Location: ."); exit(); } ?>
