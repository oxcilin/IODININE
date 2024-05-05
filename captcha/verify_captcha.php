<?php
// Start the session to access the stored captcha answer
session_start();

// Check if the captcha form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the user's input from the form
    $userAnswer = isset($_POST['captcha']) ? intval($_POST['captcha']) : 0;

    // Get the stored correct answer from the session
    $correctAnswer = isset($_SESSION['captcha_answer']) ? $_SESSION['captcha_answer'] : 0;

    // Verify if the user's answer is correct
    if ($userAnswer === $correctAnswer) {
        // Captcha is correct
        echo "Captcha is correct!";
        // You can add your further logic here, like processing the form.
    } else {
        // Captcha is incorrect
        echo "Captcha is incorrect!";
        // You may want to redirect the user back to the form or take other actions.
    }

    // Clear the stored captcha answer from the session
    unset($_SESSION['captcha_answer']);
} else {
    // Handle the case where the form was not submitted properly
    echo "Form submission error!";
}
?>
