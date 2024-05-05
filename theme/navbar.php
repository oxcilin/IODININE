<nav class="navbar bg-body-tertiary fixed-top">
  <div class="container-fluid">
    <div class="text-center w-100">
      <b><a class="navbar-brand" href="">IODININE</a></b>
    </div>
  </div>
</nav>

<br /><br />

<!-- <div class="container">
    <div class="row">
        <?php
            $timezone = new DateTimeZone('Asia/Jakarta');
            $date = new DateTime('now', $timezone);
            $currentHour = (int) $date->format('G'); 
            // Define the greeting based on the current hour 
            if ($currentHour >= 0 && $currentHour < 12) {
                $greeting = "Good Morning";
            } elseif ($currentHour >= 12 && $currentHour < 18) {
                $greeting = "Good Afternoon";
            } else {
                $greeting = "Good Evening";
            }
        ?>

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
                <marquee onMouseOver="this.stop()" onMouseOut="this.start()">
                    <?php echo $greeting; ?>, <b><?php echo $_SESSION['nama']; ?></b>. | Birthday's News:  
                </marquee>
            </div>
            </div>
        </div>
        </div> -->
        <br />
        <p></p>
