<?php
$host = "localhost";
$uname = "root";
$pas = "";
$db_name = "cman";

$conn = mysqli_connect($host, $uname, $pas, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
