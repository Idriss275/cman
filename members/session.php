<?php
// Start session
session_start();

// Check if the session variable is present
if (!isset($_SESSION['id']) || trim($_SESSION['id']) == '') {
    header("Location: ../index.php");
    exit();
}

// Securely fetch the session ID
$session_id = mysqli_real_escape_string($conn, $_SESSION['id']);

// Fetch user information from the database
$user_query = mysqli_query($conn, "SELECT * FROM members WHERE id = '$session_id'") or die(mysqli_error($conn));
$user_row = mysqli_fetch_array($user_query);
$admin_username = htmlspecialchars($user_row['mobile']);
?>
