<?php
session_start();
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
            @media(min-width: 768px) {
                .login-form {
                    width: 500px; /* Adjust the width as per your requirement */
                }

                .login-form .btn {
                    width: 100%; /* Set the button width to 100% within the larger screens */
                }

                .alert {
                    widht: 500px;
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
                filter: drop-shadow(0px 0px 10px rgba(255, 255, 255, 0.5)) brightness(1.1);
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

            .dob-input {
                width: 35px;
                text-align: center;
                margin: 0 5px;
            }

            #dob-input-container {
                display: flex;
                justify-content: center;
                align-items: center; /* Menengahkan elemen secara vertikal */
            }
            
        </style>
        <body>
            <div class="container">
                <div class="row">
                    <div class="login">
                        <!-- Display the login form -->
                        <div class="col-md-12">
                            <form action="_login" method="POST" class="row g-3 needs-validation login-form" novalidate autocomplete="off">
                                <div class="logo-container">
                                    <b>
                                        <h2 class="logo-title">PAYMENT INFO</h2>
                                    </b>

                                    <?php
                                    include "db_conn.php";
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
                                                    echo "<p class='text-muted'>USER's PAGE <br> $class ($class_name) - <span style='font-size: 16px'>A.Y. $start_ay.$end_ay</span></p> ";
                                                    echo "</center>";
                                                }
                                                ?>
                                            <?php } else {
                                                echo "<p class='text-muted'>USER's PAGE</p>";
                                            }}?>
                                </div>
                                <br/>

                                    <div id="running-text">
                                        <div class="container pt-1 small font-weight-bold">
                                            <div class="row align-items-center">
                                                <div class="col-md-2">
                                                    <h6 class="text-right font-weight-bold">
                                                        <u>NEWS</u>
                                                        : 
                                                    </h6>
                                                </div>
                                                <div class="col-md-10">
                                                    <?php
                                                        // Include your database connection file
                                                        include "db_conn.php";

                                                        // Initialize variables for news and birthday message
                                                        $newsContent = ''; // Variable to store news items
                                                        $birthdayMessage = ''; // Variable to store birthday message

                                                        // Fetch news items with 'show' = 1 from the news table
                                                        $queryNews = "SELECT news FROM news WHERE `show` = 1";
                                                        $resultNews = mysqli_query($conn, $queryNews);

                                                        // Check if there are any news items
                                                        if (mysqli_num_rows($resultNews) > 0) {
                                                            $first = true;
                                                            while ($row = mysqli_fetch_assoc($resultNews)) {
                                                                if (!$first) {
                                                                    $newsContent .= '  |  '; // Add separator between news items
                                                                }
                                                                $newsContent .= $row['news'];
                                                                $first = false;
                                                            }
                                                        } else {
                                                            $newsContent = "No news available.";
                                                        }

                                                        // Get the current date
                                                        $currentDate = date('d/m');

                                                        // Fetch users whose birthday is today
                                                        $queryBirthdays = "SELECT id, nama, tanggallahir FROM user WHERE SUBSTRING(tanggallahir, 1, 5) = ?";
                                                        $stmt = mysqli_prepare($conn, $queryBirthdays);
                                                        mysqli_stmt_bind_param($stmt, "s", $currentDate);
                                                        mysqli_stmt_execute($stmt);
                                                        mysqli_stmt_bind_result($stmt, $id, $name, $birthdateFormatted);

                                                        // Check if there are any users with a birthday today
                                                        $birthdayMessageArr = []; // Array to store birthday messages
                                                        while (mysqli_stmt_fetch($stmt)) {
                                                            $birthdate = date_create_from_format('d/m/Y', $birthdateFormatted);
                                                            $age = date('Y') - substr($birthdateFormatted, -4); // Calculate age based on year of birth

                                                            // Generate the birthday message
                                                            $birthdayMessageArr[] = "Happy Birthday, $name. Today you are $age years old! WUATB!";
                                                        }

                                                        // Combine news and birthday message with separator
                                                        $birthdayMessage = implode('  |  ', $birthdayMessageArr);

                                                        // Trim the trailing '|' from the end of the birthday message
                                                        $birthdayMessage = rtrim($birthdayMessage, ' | ');

                                                        // Combine news and birthday message with separator
                                                        $content = $newsContent;
                                                        if (!empty($newsContent) && !empty($birthdayMessage)) {
                                                            $content .= '  |  ';
                                                        }
                                                        $content .= $birthdayMessage;

                                                        // Close the prepared statement and database connection
                                                        mysqli_stmt_close($stmt);
                                                        mysqli_close($conn);
                                                    ?>

                                                    <marquee onMouseOver="this.stop()" onMouseOut="this.start()">
                                                        <?php echo $content; ?>
                                                    </marquee>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php
                                    if (isset($_SESSION['error'])) {
                                        echo '
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <i class="fas fa-exclamation-triangle px-2"></i>' . $_SESSION['error'] . '
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>';
                                        unset($_SESSION['error']); // Clear the error message from the session
                                    };
                                ?>

                                <div class="mb-3">
                                    <label class="form-label">Nomor Induk</label>
                                    <input type="number" class="form-control" id="noinduk" name="noinduk" required autofocus/>
                                    <div class="invalid-feedback">
                                        Please enter your valid nomor induk.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Lahir</label>
                                    
                                    <div id="dob-input-container" style="display: flex;">
                                        <input type="number" class="form-control dob-input" id="day1" name="day1" maxlength="1" required/>
                                        <input type="number" class="form-control dob-input" id="day2" name="day2" maxlength="1" required/>
                                        <span>/</span>
                                        <input type="number" class="form-control dob-input" id="month1" name="month1" maxlength="1" required/>
                                        <input type="number" class="form-control dob-input" id="month2" name="month2" maxlength="1" required/>
                                        <span>/</span>
                                        <input type="number" class="form-control dob-input" id="year1" name="year1" maxlength="1" required/>
                                        <input type="number" class="form-control dob-input" id="year2" name="year2" maxlength="1" required/>
                                        <input type="number" class="form-control dob-input" id="year3" name="year3" maxlength="1" required/>
                                        <input type="number" class="form-control dob-input" id="year4" name="year4" maxlength="1" required/>
                                    </div>
                                    
                                    <div id="tanggallahirhelp" class="form-text">DD/MM/YYYY date of birth format.</div>
                                    <div class="invalid-feedback">
                                        Please enter your valid date of birth.
                                    </div>

                                    <script>
                                        document.addEventListener('DOMContentLoaded', () => {
                                        const noIndukInput = document.getElementById('noinduk');
                                        const dobInputs = document.querySelectorAll('.dob-input');

                                        noIndukInput.addEventListener('input', () => {
                                            const value = noIndukInput.value.trim();
                                            if (value.length >= 5) {
                                            dobInputs[0].focus();
                                            }
                                        });

                                        dobInputs.forEach((input, index) => {
                                            input.addEventListener('input', e => {
                                            const maxLength = parseInt(e.target.getAttribute('maxlength'));
                                            const currentLength = e.target.value.length;

                                            if (currentLength >= maxLength && index < dobInputs.length - 1) {
                                                dobInputs[index + 1].focus();
                                            }
                                            });

                                            input.addEventListener('keydown', e => {
                                            if (e.key === 'Backspace' && e.target.value.length === 0 && index > 0) {
                                                dobInputs[index - 1].focus();
                                            }
                                            });
                                        });
                                        });
                                    </script>
                                </div>

                                <div class="mb-3">
                                    <div class="mb-3">
                                        <button type="submit" class="w-100 btn btn-outline-light">
                                            LOGIN
                                        </button>
                                    </div>
                                    <div style="display: flex; justify-content: space-between;">
                                        <a href="list-transaksi" class="admin-login" style="color: white; font-size: 13px; text-decoration: none;">List Transaksi</a>
                                        <a href="admin" class="admin-login" style="color: white; font-size: 13px; text-decoration: none;">Admin Login</a>
                                    </div>
                                    <form>
                                        <div id="emailHelp" class="form-text">
                                            <i>* By logging into your account, you implicitly agree to the following <a href="terms-and-conditions" target="_blank">terms and conditions</a>.</i>
                                        </div>
                                </form>
                                <?php include 'admin/theme/script_form.php'?>
                            </div>
                    </div>
                </div>
            </div>
        </body>
    </head>
</html>

