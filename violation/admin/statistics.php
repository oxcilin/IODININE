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

    <!-- Include SweetAlert2 JS -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

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

                        // Check if the 'group' parameter is set in the URL
                        if (isset($_GET['group']) && !empty($_GET['group'])) {
                          $group = $_GET['group'];
                        }
                    ?>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Group</span>
                        <select class="form-select" id="selectField" onChange="getUserInfo(this.value)">
                            <option disabled selected value="">--- Pilih ---</option>
                            <option value="all">ALL</option>
                            <?php 
                            // Query to retrieve "id_group" from the "violation" table
                            $sql = "SELECT DISTINCT id_group FROM violation";
                            $result = $conn->query($sql);
                            $selectedValue = isset($_GET['group']) ? $_GET['group'] : ''; // Get the value from the URL parameter

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    // Modify the option value based on your requirements
                                    $modifiedValue = str_replace(' ', '_', $row['id_group']); // Replace spaces with underscores
                                    $selected = ($selectedValue == $modifiedValue) ? 'selected' : ''; // Check if the value matches the 'user' parameter in the URL
                                    echo '<option value="' . $modifiedValue . '" ' . $selected . '>' . $row['id_group'] . '</option>';
                                }
                            } else {
                                echo '<option value="No data found">No data found</option>';
                            }
                            ?>
                        </select>
                        <button type="reset" class="btn btn-outline-danger" onclick="getUserInfo('')">Reset</button>
                        <button type="button" class="btn btn-outline-warning" onclick="copyToClipboard()">Copy</button>

                        <script>
                            function getUserInfo(selectedValue) {
                                window.location.href = "<?php include 'theme/nama_page-link.php'; ?>" + '?group=' + selectedValue;
                            }
                        </script>
                    </div>

                    <div class="alert alert-dark" role="alert">
                      Group : <span class="text-uppercase"><?= $group ?></span>
                    </div>

                    <!-- HTML Table Structure -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">ID</th>
                                <th scope="col">Details</th>
                                <th scope="col-3">Total Violations</th>
                                <th scope="col-3">Violation Percentage</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1; // Initialize a counter variable
                            // Query to fetch data from "violation_code"
                            $sql_code = "SELECT * FROM violation_code";
                            $result_code = $conn->query($sql_code);

                            if ($result_code->num_rows > 0) {
                                while ($row_code = $result_code->fetch_assoc()) {
                                    $details = $row_code['arti'];
                                    // Query to count total violations matching the details and group if selected, else count violations with matching details
                                    $sql_violation = "SELECT COUNT(*) AS total FROM violation WHERE details = '$details'";
                                    if ($group !== 'all') {
                                        $sql_violation .= " AND id_group = '$group'";
                                    }
                                    $result_violation = $conn->query($sql_violation);
                                    $row_violation = $result_violation->fetch_assoc();
                                    $total_violations = $row_violation['total'];

                                    // Calculate total rows based on whether "all" is selected or not
                                    $total_rows_query = "SELECT COUNT(*) AS total_rows FROM violation";
                                    if ($group !== 'all') {
                                        $total_rows_query .= " WHERE id_group = '$group'";
                                    }
                                    $result_total_rows = $conn->query($total_rows_query);
                                    $total_rows = $result_total_rows->fetch_assoc()['total_rows'];

                                    // Calculate violation percentage
                                    $violation_percentage = ($total_rows > 0) ? ($total_violations / $total_rows) * 100 : 0;

                                    // Output table rows
                                    echo '<tr>';
                                      echo '<th scope="row">' . $no++ . '</th>';
                                      echo '<td>' . $row_code['id'] . '</td>';
                                      echo '<td id="data1">' . $row_code['arti'] . '</td>';
                                      echo '<td id="data2">' . str_pad($total_violations, 2, '0', STR_PAD_LEFT) . '</td>';
                                      echo '<td id="data3">' . number_format($violation_percentage, 2) . '%</td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr><td colspan="5">No data found</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>

                    <script>
                      function copyToClipboard() {
                          // Initialize an empty array to store row data for sorting
                          var rowDataArray = [];

                          // Get all the rows in the table body
                          var rows = document.querySelectorAll('tbody tr');

                          // Loop through each row to extract data and add it to the array
                          rows.forEach(function(row) {
                              var id = row.cells[1].innerText;
                              var details = row.cells[2].innerText;
                              var totalViolations = row.cells[3].innerText;
                              var violationPercentage = parseFloat(row.cells[4].innerText.replace('%', '')); // Remove '%' and parse as float

                              // Push row data to the array
                              rowDataArray.push({
                                  id: id,
                                  details: details,
                                  totalViolations: totalViolations,
                                  violationPercentage: violationPercentage
                              });
                          });

                          // Sort the rowDataArray based on violationPercentage (highest to lowest)
                          rowDataArray.sort(function(a, b) {
                              return b.violationPercentage - a.violationPercentage;
                          });

                          // Initialize an empty string to store the copied message
                          var copiedMessage = "```VIOLATION```\nhttps://iodinine.oxa.biz.id/violation\n\nGroup: <?= $group ?>\n";

                          // Loop through sorted rowDataArray to construct the copied message
                          rowDataArray.forEach(function(rowData) {
                              copiedMessage += "- " + rowData.details + " " + "(" + rowData.violationPercentage + "%)\n";
                          });

                          // Add current date and time to the copied message
                          copiedMessage += "\n_<?php date_default_timezone_set('Asia/Jakarta'); echo date('Y-m-d H:i:s'); ?>_\n";

                          // Create a temporary textarea element to copy the text to the clipboard
                          var tempTextArea = document.createElement("textarea");
                          tempTextArea.value = copiedMessage;
                          document.body.appendChild(tempTextArea);

                          // Select the text inside the textarea and copy it to the clipboard
                          tempTextArea.select();
                          document.execCommand("copy");

                          // Remove the temporary textarea element
                          document.body.removeChild(tempTextArea);

                          // Show SweetAlert success message
                          swal({
                              title: 'Copied!',
                              text: 'The content has been copied to your clipboard.',
                              icon: 'success',
                          });
                      }
                  </script>


                    <?php

                    mysqli_close($conn);
                    ?>
                </div>
                </div>
            </div>
        </div>
    </body>
  </head>
</html>

<?php } else { header("Location: ."); exit(); } ?>