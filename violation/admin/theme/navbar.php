<style>
    a:hover {
        background-color: transparent !important; /* Menghapus latar belakang saat dihover */
    }
    .blockquote-footer {
        margin-bottom: 0em;
    }

    .nav-item {
        margin-left: 10px;
        margin-top: 0.1em;
    }

    .nav-link {
        transition: margin-left 0.3s ease;
        /* Mengatur waktu dan jenis transisi */
    }

    .nav-link:hover {
        color: #fff;
        margin-left: 13px;
        /* Nilai yang ingin Anda atur saat hover aktif */
        filter: drop-shadow(0px 0px 5px rgba(255, 255, 255, 0.5));
    }

    .nav-link.active {
        transition: margin-left 0.3s ease;
        margin-left: 11px;
        filter: drop-shadow(0px 0px 5px rgba(255, 255, 255, 0.5));
    }

    ::selection {
        background-color: white;
        color: #000;
        border-radius: 50%;
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

    button.btn-close:focus {
        outline: none;
        box-shadow: none;
    }

    .no-outline:focus {
        outline: none !important;
        box-shadow: none !important;
    }
</style>

<nav class="navbar bg-body-tertiary fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="
    <?php
      $filename = basename($_SERVER['SCRIPT_FILENAME']);
      $filenameWithoutExtension = pathinfo($filename, PATHINFO_FILENAME);
      echo $filenameWithoutExtension;
    ?>">
            <?php $domain = parse_url('https://' . $_SERVER['HTTP_HOST'], PHP_URL_HOST); ?>
            <img src="https://<?php echo $domain; ?>/IODININE%20LOGO/Latar%20Biru.png" alt="" width="40" height="40"
                class="d-inline-block align-text-top"
                style="border-radius:50%; display: block;  margin-left: auto; margin-right: auto;" />
        </a>

        <a class="navbar-brand" href="
                <?php
                  $filename = basename($_SERVER['SCRIPT_FILENAME']);
                  $filenameWithoutExtension = pathinfo($filename, PATHINFO_FILENAME);
                  echo $filenameWithoutExtension;
                ?>">
            <b>
                <?php
            $filename = basename($_SERVER['SCRIPT_FILENAME']);
            $filenameWithoutExtension = pathinfo($filename, PATHINFO_FILENAME);
            
            // Replace hyphens with spaces
            $filenameWithoutHyphen = str_replace("-", " ", $filenameWithoutExtension);
            
            // Capitalize each word
            $capitalizedFilename = ucwords($filenameWithoutHyphen);
            
            echo $capitalizedFilename;
        ?>
            </b>
        </a>

        <button class="badge navbar-toggler no-outline" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#staticBackdrop" aria-controls="staticBackdrop">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="staticBackdrop">
            <div class="offcanvas-header">
                <script>
                    function displayTime() {
                        var date = new Date();
                        var hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                        var hari_ini = hari[date.getDay()];
                        var tanggal = date.getDate();
                        var bulan = date.getMonth() + 1; // Perhatikan penambahan +1 untuk indeks bulan
                        var tahun = date.getFullYear();
                        var jam = date.getHours();
                        var menit = date.getMinutes();
                        var detik = date.getSeconds();

                        var jamDisplay = hari_ini + ', ' + tanggal + '/' + bulan + '/' + tahun + ', ' + padZero(jam) + ':' + padZero(menit) + ':' + padZero(detik);

                        document.getElementById("jam").innerHTML = jamDisplay;
                    }

                    function padZero(number) {
                        return (number < 10) ? '0' + number : number;
                    }

                    setInterval(displayTime, 1000); // Pembaruan setiap detik (1000ms)
                </script>

                <h5 class="offcanvas-title" id="staticBackdrop">
                    <span id="jam"></span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <?php
          $current_page = basename($_SERVER['REQUEST_URI']); // Mendapatkan nama halaman saat ini

          function isCurrentPage($page)
          {
              global $current_page;
              if ($current_page == $page) {
                  return 'nav-link active';
              } else {
                  return 'nav-link';
              }
          }

          function isCurrentDropdownPage($dropmenu_page) // Renamed the function
          {
              global $current_page;
              if ($current_page == $dropmenu_page) {
                  return 'dropdown-item active';
              } else {
                  return 'dropdown-item';
              }
          }
        ?>

                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <figcaption class="blockquote-footer">
                        <cite title="Source Title" class="text-uppercase"><?php echo $_SESSION['nama_violation']; ?></cite>
                    </figcaption>
                    <li class="nav-item">
                        <a class="<?php echo isCurrentPage('home-violation'); ?>" aria-current="page" href="home-violation">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="<?php echo isCurrentPage('account-admin'); ?>" aria-current="page" href="account-admin">Account Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="<?php echo isCurrentPage('statistics'); ?>" aria-current="page" href="statistics">Statistics</a>
                    </li>
                    <li class="nav-item">
                        <a class="<?php echo isCurrentPage('list-details'); ?>" aria-current="page" href="list-details">List Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="<?php echo isCurrentPage('server-logs'); ?>" aria-current="page" href="server-logs">Server Logs</a>
                    </li>

            </div>
            <footer class="footer mt-auto py-3 bg-body-tertiary">
                <div class="container">
                    <?php $randomToken = bin2hex(random_bytes(8)); ?>
                    <a aria-current="page" href="javascript:void(0);" onclick="location.reload();" type="button"
                        class="w-100 btn btn-outline-secondary"><i class="bi bi-arrow-clockwise"></i></i> Refresh</a>
                    <p></p>
                    <a aria-current="page" href="signout?uhead=<?php echo $randomToken; ?>" type="button"
                        class="w-100 btn btn-outline-danger"><i class="bi bi-box-arrow-right"></i> Sign out</a>
                </div>
            </footer>
        </div>
    </div>
</nav>
<br /><br /><br />