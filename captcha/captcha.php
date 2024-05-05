<?php
// Start a session to store the captcha answer
session_start();

// Generate two random numbers for the math question
$number1 = rand(1, 99);
$number2 = rand(1, 99);

// Calculate the correct answer
$correctAnswer = $number1 + $number2;

// Store the correct answer in the session
$_SESSION['captcha_answer'] = $correctAnswer;

// Create an image with GD
$imageWidth = 200;
$imageHeight = 80;
$image = imagecreatetruecolor($imageWidth, $imageHeight); // Create a truecolor image for transparency

// Create a transparent background
$transparentColor = imagecolorallocatealpha($image, 0, 0, 0, 127); // 127 for partial transparency
imagefill($image, 0, 0, $transparentColor);
imagesavealpha($image, true);

// Define text color (white)
$textColor = imagecolorallocate($image, 255, 255, 255);

// Generate the captcha text
$captchaText = "$number1 + $number2";
$font = __DIR__ . '/KIN668.TTF'; // Replace with the path to a TrueType font file

// Add the captcha text to the image
imagettftext($image, 20, 0, 50, 50, $textColor, $font, $captchaText);

// Output the image as a PNG with transparency
header('Content-type: image/png');
imagepng($image);

// Clean up
imagedestroy($image);
?>
