<?php
session_start(); // Start the session

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['feedbackName'];
    $email = $_POST['feedbackEmail'];
    $message = $_POST['feedbackMessage'];

    // You can perform further validation and sanitization here

    // Example: Save feedback to a file (you might want to store it in a database)
    $feedbackData = "Name: $name\nEmail: $email\nMessage: $message\n\n";
    $file = 'feedback.txt';
    file_put_contents($file, $feedbackData, FILE_APPEND | LOCK_EX);

    // Optionally, redirect to a thank you page or back to the same page
    header("Location: welcome.php?feedback=success");
    exit();
} else {
    // Handle cases where form wasn't submitted properly
    header("Location: welcome.php?feedback=error");
    exit();
}
?>
