<?php
session_start();
// Include the database connection file
include "db_conn.php";

// Display a message and prevent further execution if accessed directly
echo "
<!DOCTYPE html>
<html>
<head>
  <style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
        font-family: sans-serif;
    }

    body {
        flex-direction: column;
    }

    h1, h2 {
        text-align: center;
    }
  </style>
</head>
<body>
  <h1>jgn masuk ke sini, balek kembali yaa ;3</h1>
</body>
</html>
";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $ip = $_POST["IP"];
    $q1 = $_POST["Q1"];
    $q2 = $_POST["Q2"];
    $q3 = $_POST["Q3"];
    $q4 = $_POST["Q4"];
    $q5 = $_POST["Q5"];
    $q6 = $_POST["Q6"];
    $q7 = $_POST["Q7"];
    $q8 = $_POST["Q8"];
    $q9 = $_POST["Q9"];
    $q10 = $_POST["Q10"];
    $q11 = $_POST["Q11"];
    $q12 = $_POST["Q12"];
    $q13 = $_POST["Q13"];
    $q14 = $_POST["Q14"];
    $q15 = $_POST["Q15"];
    $q16 = $_POST["Q16"];
    $q17 = $_POST["Q17"];
    $q18 = $_POST["Q18"];
    $q19 = $_POST["Q19"];
    $q20 = $_POST["Q20"];

    // SQL query to insert data into the database
    $sql = "INSERT INTO competition_results (IP, Q1, Q2, Q3, Q4, Q5, Q6, Q7, Q8, Q9, Q10, Q11, Q12, Q13, Q14, Q15, Q16, Q17, Q18, Q19, Q20)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare and execute the SQL query with error handling
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sssssssssssssssssss", $ip, $q1, $q2, $q3, $q4, $q5, $q6, $q7, $q8, $q9, $q10, $q11, $q12, $q13, $q14, $q15, $q16, $q17, $q18, $q19, $q20);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Data inserted successfully!";
            header("Location: si-paling");
            exit();
        } else {
            $_SESSION['error'] = "An error occurred while executing the query: " . $stmt->error;
            header("Location: si-paling");
            exit();
        }
    } else {
        $_SESSION['error'] = "Error preparing the SQL query: " . $conn->error;
        header("Location: si-paling");
        exit();
    }

    // Close the statement and database connection
    $stmt->close();
} else {
    $_SESSION['error'] = "An error occurred while processing the request. ";
    header("Location: si-paling");
    exit();
}

// Close the database connection
$conn->close();
?>
