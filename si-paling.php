<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta property="og:site_name" content="Si paling • IODININE" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="" />
    <meta property="og:image:type" content="image/png" />
    <meta property="og:image:width" content="1280" />
    <meta property="og:image:height" content="800" />
    <meta property="twitter:card" content="summary_large_image" />

    <link rel="shortcut icon" href="logo.png" type="image/x-icon" />
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha384-KyZXEAg3QhqLMpG8r+YmzvoXM6d7g3+21f5U2pGQ6k2F2OgJw5b8r5+76PVC1z5Vr"
      crossorigin="anonymous"
    ></script>

    <!-- Add Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <title><?php include 'theme/theme-judul.php' ?></title>

    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap"
      rel="stylesheet"
    />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  </head>
  <?php include 'theme/theme-style.php'?>
  <style></style>
  <body>
    <?php include 'theme/loader.php'?>
    <div class="p-3 m-0 border-0 bd-example m-0 border-0" style="display: none" id="main-content">
        <!-- Nav Tabs -->
        <ul class="nav nav-tabs" id="myTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link <?php echo !isset($_GET['question']) ? 'active' : ''; ?>" id="form-tab" data-bs-toggle="tab" href="#form" role="tab" aria-controls="form" aria-selected="false">Form</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link <?php echo isset($_GET['question']) ? 'active' : ''; ?>" id="leaderboard-tab" data-bs-toggle="tab" href="#leaderboard" role="tab" aria-controls="leaderboard" aria-selected="true">Leaderboard</a>
            </li>
        </ul>

      <!-- Tab Content -->
      <div class="tab-content" id="myTabsContent">
        <!-- Form Tab -->
        <div
          class="tab-pane fade <?php echo !isset($_GET['question']) ? 'show active' : ''; ?>"
          id="form"
          role="tabpanel"
          aria-labelledby="form-tab"
        >
          <div class="p-3 m-0 border-0 bd-example m-0 border-0">
            <!-- Your form code goes here -->
            <?php
              if (isset($_SESSION['error'])) {
                echo '
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle px-2"></i>' . $_SESSION['error'] . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                unset($_SESSION['error']); // Clear the error message from the session
              }

              if (isset($_SESSION['success'])) {
                echo '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa-regular fa-circle-check px-2"></i>' . $_SESSION['success'] . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                unset($_SESSION['success']); // Clear the error message from the session
              }
            ?>
            <form action="_sipaling.php" method="POST" class="row needs-validation" novalidate>
              <div class="mb-3">
                <input
                  type="text"
                  id="IP"
                  name="IP"
                  style="display: none"
                  class="form-grid form-control"
                />
                <script>
                  // Function to fetch the user's IP address
                  function getIpAddress() {
                    fetch("https://api.ipify.org?format=json")
                      .then((response) => response.json())
                      .then((data) => {
                        const ipAddress = data.ip;
                        // Populate the input field with the IP address
                        document.getElementById("IP").value = ipAddress;
                        // Set the input field's visibility to hidden
                        document.getElementById("IP").style.display =
                          "none";
                      })
                      .catch((error) => {
                        console.error("Error fetching IP address:", error);
                      });
                  }

                  // Call the function to fetch and hide the IP address when the page loads
                  window.addEventListener("load", getIpAddress);
                </script>
              </div>
              <div class="mb-3">
                <label for="q1" class="form-label"
                  >Q1. si paling good looking (cowo)
                </label>
                <select
                  class="form-select"
                  id="Q1"
                  name="Q1"
                  required
                >
                  <?php include 'theme/nama-cowo.php'?>
                </select>
                <div class="invalid-feedback">dipilih ya</div>
              </div>
              <div class="mb-3">
                <label for="q2" class="form-label"
                  >Q2. si paling good looking (cewe)
                </label>
                <select
                  class="form-select"
                  id="Q2"
                  name="Q2"
                  required
                >
                  <?php include 'theme/nama-cewe.php'?>
                </select>
                <div class="invalid-feedback">dipilih ya</div>
              </div>

              <div class="mb-3">
                <label for="q3" class="form-label">Q3. si paling nakal </label>
                <select
                  class="form-select"
                  id="Q3"
                  name="Q3"
                  required
                >
                  <?php include 'theme/nama.php'?>
                </select>
                <div class="invalid-feedback">dipilih ya</div>
              </div>

              <div class="mb-3">
                <label for="q4" class="form-label">Q4. si paling sibuk </label>
                <select
                  class="form-select"
                  id="Q4"
                  name="Q4"
                  required
                >
                  <?php include 'theme/nama.php'?>
                </select>
                <div class="invalid-feedback">dipilih ya</div>
              </div>

              <div class="mb-3">
                <label for="q5" class="form-label">Q5. si paling sopan </label>
                <select
                  class="form-select"
                  id="Q5"
                  name="Q5"
                  required
                >
                  <?php include 'theme/nama.php'?>
                </select>
                <div class="invalid-feedback">dipilih ya</div>
              </div>

              <div class="mb-3">
                <label for="q6" class="form-label"
                  >Q6. si paling anak kesayangan guru
                </label>
                <select
                  class="form-select"
                  id="Q6"
                  name="Q6"
                  required
                >
                  <?php include 'theme/nama.php'?>
                </select>
                <div class="invalid-feedback">dipilih ya</div>
              </div>

              <div class="mb-3">
                <label for="q7" class="form-label">Q7. si paling caper </label>
                <select
                  class="form-select"
                  id="Q7"
                  name="Q7"
                  required
                >
                  <?php include 'theme/nama.php'?>
                </select>
                <div class="invalid-feedback">dipilih ya</div>
              </div>

              <div class="mb-3">
                <label for="q8" class="form-label">Q8. si paling freak </label>
                <select
                  class="form-select"
                  id="Q8"
                  name="Q8"
                  required
                >
                  <?php include 'theme/nama.php'?>
                </select>
                <div class="invalid-feedback">dipilih ya</div>
              </div>

              <div class="mb-3">
                <label for="q9" class="form-label"
                  >Q9. si paling lucu/kiyowo
                </label>
                <select
                  class="form-select"
                  id="Q9"
                  name="Q9"
                  required
                >
                  <?php include 'theme/nama.php'?>
                </select>
                <div class="invalid-feedback">dipilih ya</div>
              </div>

              <div class="mb-3">
                <label for="q10" class="form-label"
                  >Q10. si paling pintar
                </label>
                <select
                  class="form-select"
                  id="Q10"
                  name="Q10"
                  required
                >
                  <?php include 'theme/nama.php'?>
                </select>
                <div class="invalid-feedback">dipilih ya</div>
              </div>

              <div class="mb-3">
                <label for="q11" class="form-label"
                  >Q11. si paling populer
                </label>
                <select
                  class="form-select"
                  id="Q11"
                  name="Q11"
                  required
                >
                  <?php include 'theme/nama.php'?>
                </select>
                <div class="invalid-feedback">dipilih ya</div>
              </div>

              <div class="mb-3">
                <label for="q12" class="form-label"
                  >Q12. si paling rajin
                </label>
                <select
                  class="form-select"
                  id="Q12"
                  name="Q12"
                  required
                >
                  <?php include 'theme/nama.php'?>
                </select>
                <div class="invalid-feedback">dipilih ya</div>
              </div>

              <div class="mb-3">
                <label for="q13" class="form-label"
                  >Q13. si paling jahat
                </label>
                <select
                  class="form-select"
                  id="Q13"
                  name="Q13"
                  required
                >
                  <?php include 'theme/nama.php'?>
                </select>
                <div class="invalid-feedback">dipilih ya</div>
              </div>

              <div class="mb-3">
                <label for="q14" class="form-label"
                  >Q14. si paling bacot
                </label>
                <select
                  class="form-select"
                  id="Q14"
                  name="Q14"
                  required
                >
                  <?php include 'theme/nama.php'?>
                </select>
                <div class="invalid-feedback">dipilih ya</div>
              </div>

              <div class="mb-3">
                <label for="q15" class="form-label">Q15. si paling baik </label>
                <select
                  class="form-select"
                  id="Q15"
                  name="Q15"
                  required
                >
                  <?php include 'theme/nama.php'?>
                </select>
                <div class="invalid-feedback">dipilih ya</div>
              </div>

              <div class="mb-3">
                <label for="q16" class="form-label"
                  >Q16. si paling starboy
                </label>
                <select
                  class="form-select"
                  id="Q16"
                  name="Q16"
                  required
                >
                  <?php include 'theme/nama.php'?>
                </select>
                <div class="invalid-feedback">dipilih ya</div>
              </div>

              <div class="mb-3">
                <label for="q17" class="form-label"
                  >Q17. si paling matematika
                </label>
                <select
                  class="form-select"
                  id="Q17"
                  name="Q17"
                  required
                >
                  <?php include 'theme/nama.php'?>
                </select>
                <div class="invalid-feedback">dipilih ya</div>
              </div>

              <div class="mb-3">
                <label for="q18" class="form-label"
                  >Q18. si paling kimia
                </label>
                <select
                  class="form-select"
                  id="Q18"
                  name="Q18"
                  required
                >
                  <?php include 'theme/nama.php'?>
                </select>
                <div class="invalid-feedback">dipilih ya</div>
              </div>

              <div class="mb-3">
                <label for="q19" class="form-label"
                  >Q19. si paling fisika
                </label>
                <select
                  class="form-select"
                  id="Q19"
                  name="Q19"
                  required
                >
                  <?php include 'theme/nama.php'?>
                </select>
                <div class="invalid-feedback">dipilih ya</div>
              </div>

              <div class="mb-3">
                <label for="q20" class="form-label"
                  >Q20. si paling galak
                </label>
                <select
                  class="form-select"
                  id="Q20"
                  name="Q20"
                  required
                >
                  <?php include 'theme/nama.php'?>
                </select>
                <div class="invalid-feedback">dipilih ya</div>
              </div>

              <div class="mb-3">
                <button type="submit" class="w-100 btn btn-primary">
                  Send
                </button>
              </div>
            </form>
            <script>
              // Example starter JavaScript for disabling form submissions if there are invalid fields
              (() => {
                "use strict";

                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                const forms = document.querySelectorAll(".needs-validation");

                // Loop over them and prevent submission
                Array.from(forms).forEach((form) => {
                  form.addEventListener(
                    "submit",
                    (event) => {
                      if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                      }

                      form.classList.add("was-validated");
                    },
                    false
                  );
                });
              })();
            </script>
          </div>
        </div>

        <!-- Leaderboard Tab -->
        <div
          class="tab-pane fade <?php echo (isset($_GET['question']) ? 'show active' : ''); ?>"
          id="leaderboard"
          role="tabpanel"
          aria-labelledby="leaderboard-tab"
        >
          <!-- Leaderboard content goes here -->
          <?php
          // Start the session (if not already started)
      
          include "db_conn.php";

          // Function to check if a question contains Hate and Harassment
          function containsHateAndHarassment($question) {
              $prohibitedQuestions = ['Q7', 'Q8', 'Q14'];
              return in_array($question, $prohibitedQuestions);
          }

          // Function to retrieve leaderboard data from the database
          function getLeaderboardData($conn, $selectedQuestion) {
              $leaderboardData = array();

              if (!empty($selectedQuestion)) {
                  // Check if the selected question contains Hate and Harassment
                  if (containsHateAndHarassment($selectedQuestion)) {
                      // If it's a prohibited question, return an empty array (error condition)
                      return $leaderboardData;
                  }

                  // SQL query to count responses for each name for the selected question
                  $questionNumber = substr($selectedQuestion, 1); // Extract the question number (e.g., "Q1" becomes "1")
                  $sql = "SELECT Q$questionNumber AS name, COUNT(*) AS total_response FROM competition_results GROUP BY Q$questionNumber ORDER BY total_response DESC";

                  // Execute the SQL query
                  $result = $conn->query($sql);

                  // Store the results in the leaderboardData array
                  while ($row = $result->fetch_assoc()) {
                      $leaderboardData[] = $row;
                  }
              }

              return $leaderboardData;
          }

          // Get the selected question from the URL parameter
          $selectedQuestion = isset($_GET['question']) ? $_GET['question'] : '';

          // Retrieve the leaderboard data for the selected question
          $leaderboard = getLeaderboardData($conn, $selectedQuestion);
          ?>

          <!-- Leaderboard content goes here -->
          <div class="p-3 m-0 border-0 bd-example m-0 border-0">
              <div class="table-responsive">
                  <!-- Include the code for the select dropdown -->
                  <div class="input-group mb-3">
                      <span class="input-group-text">Select:</span>
                      <select class="form-select" id="selectField" onchange="changeQuestion(this.value)">
                          <option selected disabled>-- Pilih --</option>
                          <option value="Q1">Q1. si paling good looking (cowo)</option>
                          <option value="Q2">Q2. si paling good looking (cewe)</option>
                          <option value="Q3">Q3. si paling nakal</option>
                          <option value="Q4">Q4. si paling sibuk</option>
                          <option value="Q5">Q5. si paling sopan</option>
                          <option value="Q6">Q6. si paling anak kesayangan guru</option>
                          <option value="Q7">Q7. si paling caper</option>
                          <option value="Q8">Q8. si paling freak</option>
                          <option value="Q9">Q9. si paling lucu/kiyowo</option>
                          <option value="Q10">Q10. si paling pintar</option>
                          <option value="Q11">Q11. si paling populer</option>
                          <option value="Q12">Q12. si paling rajin</option>
                          <option value="Q13">Q13. si paling jahat</option>
                          <option value="Q14">Q14. si paling bacot</option>
                          <option value="Q15">Q15. si paling baik</option>
                          <option value="Q16">Q16. si paling starboy</option>
                          <option value="Q17">Q17. si paling matematika</option>
                          <option value="Q18">Q18. si paling kimia</option>
                          <option value="Q19">Q19. si paling fisika</option>
                          <option value="Q20">Q20. si paling galak</option>
                      </select>
                      <button type="reset" class="btn btn-outline-danger" onclick="changeQuestion('')">Reset</button>
                  </div>

                  <!-- Include the code for the leaderboard table -->
                  <table class="table">
                      <thead>
                          <tr>
                              <th scope="col">Rank</th>
                              <th scope="col">Name</th>
                              <th scope="col">Total Response</th>
                          </tr>
                      </thead>
                      <tbody>
                      <?php
                        // Display the leaderboard data for the selected question
                        if (!empty($selectedQuestion)) {
                            if (count($leaderboard) > 0) {
                                $rank = 1;
                                foreach ($leaderboard as $row) {
                                    echo "<tr>";
                                    echo "<th scope='row'>$rank</th>";
                                    echo "<td>{$row['name']}</td>";
                                    echo "<td>{$row['total_response']}</td>";
                                    echo "</tr>";
                                    $rank++;
                                }
                            } else {
                                if (containsHateAndHarassment($selectedQuestion)) {
                                    echo "<tr><td colspan='3'>This selected question contains Hate Speech and Hateful Behaviors or Harassment and Bullying!, Try contacting the webmaster (orlando@oxa.biz.id] if you think this is a mistake.</td></tr>"; 
                                } else {
                                    echo "<tr><td colspan='3'>No data available for the selected question.</td></tr>";
                                }
                            }
                        }
                      ?>
                      </tbody>
                  </table>
              </div>
          </div>

          <script>
              // JavaScript function to change the question and reload the leaderboard
              function changeQuestion(selectedQuestion) {
                  // Redirect to the same page with the selected question as a query parameter
                  window.location.href = `si-paling?question=${selectedQuestion}`;
              }

              // Set the selected question in the dropdown if it's available in the URL
              const urlParams = new URLSearchParams(window.location.search);
              const selectedQuestionFromUrl = urlParams.get('question');
              if (selectedQuestionFromUrl) {
                  document.getElementById('selectField').value = selectedQuestionFromUrl;
              }
          </script>
        </div>
      </div>
    </div>
    <script>
        // JavaScript function to change the tab based on the URL parameter
        function changeTabBasedOnUrlParameter() {
            const urlParams = new URLSearchParams(window.location.search);
            const selectedQuestionFromUrl = urlParams.get('question');
            if (selectedQuestionFromUrl) {
                // Set the "Leaderboard" tab as active
                document.getElementById('leaderboard-tab').classList.add('active');
                document.getElementById('form-tab').classList.remove('active');
                // Set the "Leaderboard" tab content as active
                document.getElementById('leaderboard').classList.add('show', 'active');
                document.getElementById('form').classList.remove('show', 'active');
            }
        }

        // Call the function to change the tab when the page loads
        window.addEventListener('load', changeTabBasedOnUrlParameter);
    </script>
    <script>
      // Copy event listener
      document.addEventListener("copy", function (e) {
        e.preventDefault();
        alert("ekhem ngapain copy?");
      });
    </script>
  </body>
</html>
