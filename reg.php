<?php
error_reporting(0);
$conn = mysqli_connect('localhost', 'root', '');
$db = mysqli_select_db($conn, 'cman');

if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $sname = $_POST['sname'];
    $lname = $_POST['lname'];
    $Gender = $_POST['gender'];
    $birthday = $_POST['birthday'];
    $residence = $_POST['residence'];
    $pob = $_POST['pob'];
    $ministry = $_POST['ministry'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prevent SQL Injection
    $fname = mysqli_real_escape_string($conn, $fname);
    $sname = mysqli_real_escape_string($conn, $sname);
    $lname = mysqli_real_escape_string($conn, $lname);
    $Gender = mysqli_real_escape_string($conn, $Gender);
    $birthday = mysqli_real_escape_string($conn, $birthday);
    $residence = mysqli_real_escape_string($conn, $residence);
    $pob = mysqli_real_escape_string($conn, $pob);
    $ministry = mysqli_real_escape_string($conn, $ministry);
    $mobile = mysqli_real_escape_string($conn, $mobile);
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    $query = mysqli_query($conn, "SELECT * FROM members WHERE mobile = '$mobile'");
    $count = mysqli_num_rows($query);

    if ($count > 0) {
        ?>
        <script>
            alert('This Member Already Exists');
            window.location = "index.php";
        </script>
        <?php
    } else {
        $insert_query = "INSERT INTO members (fname, sname, lname, Gender, birthday, residence, pob, ministry, mobile, email, thumbnail, password, id) 
                        VALUES ('$fname', '$sname', '$lname', '$Gender', '$birthday', '$residence', '$pob', '$ministry', '$mobile', '$email', 'uploads/none.png', '$password', '$mobile')";

        if (mysqli_query($conn, $insert_query)) {
            mysqli_query($conn, "INSERT INTO activity_log (date, username, action) VALUES (NOW(), '$admin_username', 'Added member $mobile')");

            ?>
            <script>
                window.location = "index.php";
                $.jGrowl("Member Successfully added", { header: 'Member add' });
            </script>
            <?php
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>
