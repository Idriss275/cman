<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <span class="brand" href="#">Members Panel</span>
            </div>
            <!-- .nav-collapse -->
            <div class="nav-collapse collapse">
                <ul class="nav pull-right">
                    <?php 
                    // Check if the session ID is set and not null
                    if(isset($session_id) && $session_id !== null) {
                        // Fetch user details using the session ID
                        $query= mysqli_query($conn, "SELECT * FROM members WHERE id = '$session_id'")or die(mysqli_error());
                        $row = mysqli_fetch_array($query);
                        // Check if user details are fetched successfully
                        if($row) {
                            // Display user information in the navbar dropdown
                            echo '<li class="dropdown">
                                    <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">
                                        <img id="avatar1" class="img-responsive" src="' . $row['thumbnail'] . '">
                                        &nbsp;' . $row['fname'] . ' ' . $row['lname'] . '
                                        <i class="caret"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a tabindex="-1" href="change_password_admin.php"><i class="icon-cog"></i>&nbsp;Change Password</a></li>
                                        <li><a tabindex="-1" href="#mymodal3" data-toggle="modal"><i class="icon-picture"></i>&nbsp;Change Picture</a></li>
                                        <li class="divider"></li>
                                        <li><a tabindex="-1" href="logout.php"><i class="icon-signout"></i>&nbsp;Logout</a></li>
                                    </ul>
                                  </li>';
                        } else {
                            // Handle the case when user details cannot be fetched
                            // For example, redirect the user to the login page
                            header("Location: login.php");
                            exit();
                        }
                    } else {
                        // Handle the case when the session ID is not set or null
                        // For example, redirect the user to the login page
                        header("Location: login.php");
                        exit();
                    }
                    ?>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
</div>
<?php include('admin_change_picture.php'); ?>
