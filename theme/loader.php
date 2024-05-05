    <div id="loader-wrapper">
      <div class="loader" style="text-align: center">
        <div class="spinner-border" role="status"></div>
        <p>Please Wait</p>
      </div>
    </div>

    <script>
      $(document).ready(function () {
        // Hide the main content initially
        $("#main-content").hide();

        // Simulate a delay for the loader (adjust the delay time as needed)
        setTimeout(function () {
          // Hide the loader
          $("#loader-wrapper").hide();

          // Show the main content
          $("#main-content").show();
          
          $("#exampleModal").modal("show");
        }, 1000); // 3000 milliseconds (3 seconds) delay as an example
      });
    </script>