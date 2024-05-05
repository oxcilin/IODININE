<?php session_start(); if (isset($_SESSION['noinduk']) && isset($_SESSION['tanggallahir'])) { ?>

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

        ::-webkit-scrollbar {
            display: none;
        }

        /* CSS to adjust the layout for desktop view */
        @media (min-width: 992px) {
            .carousel-item img {
                height: auto;
                max-height: calc(100vh - 200px); /* Adjust the value accordingly */
                width: auto;
                max-width: 100%;
            }
        }
    </style>
    <body>
        <?php include 'theme/navbar.php'?>

        <div class="container">
            <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="2000">
                        <img src="https://sutomo-mdn.sch.id/absensismp/images/s1.jpg" class="d-block w-100">
                    </div>
                    <div class="carousel-item" data-bs-interval="2000">
                        <img src="https://sutomo-mdn.sch.id/absensismp/images/s2.jpg" class="d-block w-100">
                    </div>
                    <div class="carousel-item" data-bs-interval="2000">
                        <img src="https://sutomo-mdn.sch.id/absensismp/images/s1.jpg" class="d-block w-100">
                    </div>
                    <div class="carousel-item" data-bs-interval="2000">
                        <img src="https://sutomo-mdn.sch.id/absensismp/images/s1.jpg" class="d-block w-100">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <br></br>
        <center><h5>Hoowdy, <b><?php echo $_SESSION['nama']; ?></b>!</h5></center>
        <center><?php echo $_SESSION['noinduk']; ?></center>

        <?php include 'theme/footer.php'?>
    </body>
  </head>
</html>

<?php } else { header("Location: ."); exit(); } ?>