<?php
include('dbconn.php');
?>

<form id="login_form1" class="form-signin" method="post">
    <h3 class="form-signin-heading">
        <i class="icon-lock"></i> Member Login
    </h3>
    <input type="text" class="input-block-level" id="username" name="username" placeholder="Username" required>
    <input type="password" class="input-block-level" id="password" name="password" placeholder="Password" required>
    
    <button data-placement="right" title="Click Here to Sign In" id="signin" name="login" class="btn btn-info" type="submit">
        <i class="icon-signin icon-large"></i> Sign in
    </button>
    <script type="text/javascript">
    $(document).ready(function(){
        $('#signin').tooltip('show');
        $('#signin').tooltip('hide');
    });
    </script>        
</form>
</br>
<div class="error">
<?php
if (isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $login_query = mysqli_query($conn, "SELECT * FROM members WHERE mobile='$username' AND password='$password'");
    $count = mysqli_num_rows($login_query);
    $row = mysqli_fetch_array($login_query);

    if ($count > 0){
        session_start();
        $_SESSION['id'] = $row['id'];
        $_SESSION['user_row'] = $row; // Save user data in session

        ?>
        <script>
        $.jGrowl("Welcome to Church Manager", { header: 'Welcome Note' });
        window.location.href = "welcome.php";
        </script>
        <?php
    } else {
        ?>
        <script>
        $.jGrowl("Check Your Username and Password and Try Again", { header: 'Login Failed' });
        window.location.href = "index.php";
        </script>
        <?php
    }
}
?>
</div>
