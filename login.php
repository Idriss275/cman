<?php
$host = "localhost";
$uname = "root";
$pas = "";
$db_name = "cman";
$tbl_name = "members";

$conn = mysqli_connect("$host", "$uname", "$pas") or die("cannot connect");
mysqli_select_db($conn, "$db_name") or die("cannot select db");

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $login_query = mysqli_query($conn, "SELECT * FROM members WHERE mobile='$username' AND password='$password'");
    $count = mysqli_num_rows($login_query);
    $row = mysqli_fetch_array($login_query);

    if ($count > 0) {
        session_start();
        $_SESSION['id'] = $row['id'];
        header('location: members/welcome.php'); // Redirect to welcome.php after successful login
        exit(); // Ensure no further output is sent after header redirection
    } else {
        header('location: index.php'); // Redirect back to index.php if login fails
        exit(); // Ensure no further output is sent after header redirection
    }
}
?>
