<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="St.Lukes Boys School Management System">
    <meta name="author" content="Kithinji Godfrey">
    <link href="bootstrap/css/index_background.css" rel="stylesheet" media="screen" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<?php include('header.php'); ?>
<?php include('session.php'); ?>

<body>
    <?php include('navbar.php'); ?>
    <div class="container-fluid">
        <div class="row-fluid">
            <?php include('sidebar.php'); ?>
            <div class="span9" id="content">
                <div class="row-fluid">
                    <?php
                    $query = mysqli_query($conn, "select * from admin where admin_id = '$session_id'") or die(mysqli_error());
                    $row = mysqli_fetch_array($query);
                    ?>
                    <div class="col-lg-12">
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <img id="avatar1" class="img-responsive" src="<?php echo $row['adminthumbnails']; ?>"><strong> Welcome! <?php echo $user_row['firstname'] . " " . $user_row['lastname'];  ?></strong>
                        </div>
                    </div>

                    <!-- Block for Members -->
                    <div class="block">
                        <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><i class="icon-dashboard">&nbsp;</i>Dashboard </div>
                            <div class="muted pull-right"><i class="icon-time"></i>&nbsp;<?php include('time.php'); ?></div>
                        </div>
                        <div class="block-content collapse in">
                            <div class="span12">
                                <div class="block-content collapse in">
                                    <div id="page-wrapper">
                                        <?php
                                        $student_count = mysqli_query($conn, "select * from members") or die(mysqli_error());
                                        $student_count = mysqli_num_rows($student_count);
                                        ?>
                                        <div class="row-fluid">
                                            <div class="span6">
                                                <div class="panel panel-primary">
                                                    <div class="panel-heading">
                                                        <div class="container-fluid">
                                                            <div class="row-fluid">
                                                                <div class="span3"><br />
                                                                    <i class="fa fa-users fa-5x"></i><br />
                                                                </div>
                                                                <div class="span8 text-right"><br />
                                                                    <div class="huge"><?php echo $student_count; ?></div>
                                                                    <div>All members</div><br />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="membersDetail.php">
                                                        <div class="modal-footer">
                                                            <span class="pull-left">View Details</span>
                                                            <span class="pull-right"><i class="icon-chevron-right"></i></span>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <?php
                                            $new_members_count = mysqli_query($conn, "SELECT * 
                                                FROM members
                                                WHERE DATE_SUB(STR_TO_DATE(date, '%Y-%m-%d'), INTERVAL YEAR(CURDATE())-YEAR(STR_TO_DATE(date, '%Y-%m-%d')) YEAR) 
                                                    BETWEEN CURDATE() AND DATE_SUB(CURDATE(), INTERVAL -2 DAY)") or die(mysqli_error());
                                            $new_members_count = mysqli_num_rows($new_members_count);
                                            ?>
                                            <div class="span6">
                                                <div class="panel panel-green">
                                                    <div class="panel-heading">
                                                        <div class="container-fluid">
                                                            <div class="row-fluid">
                                                                <div class="span3"><br />
                                                                    <i class="fa fa-plus-circle fa-5x" aria-hidden="true"></i><br />
                                                                </div>
                                                                <div class="span8 text-right"><br />
                                                                    <div class="huge"><?php echo $new_members_count; ?></div>
                                                                    <div>New members</div><br />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="add_members.php">
                                                        <div class="modal-footer">
                                                            <span class="pull-left">Add member</span>
                                                            <span class="pull-right"><i class="icon-chevron-right"></i></span>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Block for Donations -->
                                <div class="block-content collapse in">
                                    <div id="page-wrapper">
                                        <?php
                                        $donations_count = mysqli_query($conn, "select SUM(Amount) AS total_donations from giving") or die(mysqli_error());
                                        $row_donations = mysqli_fetch_assoc($donations_count);
                                        $total_donations = $row_donations['total_donations'];
                                        ?>
                                        <div class="row-fluid">
                                            <div class="span6">
                                                <div class="panel panel-yellow">
                                                    <div class="panel-heading">
                                                        <div class="container-fluid">
                                                            <div class="row-fluid">
                                                                <div class="span3"><br />
                                                                    <i class="fa fa-money fa-5x" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="span8 text-right"><br />
                                                                    <div class="huge"><?php echo $total_donations; ?></div>
                                                                    <div>Total Donations</div><br />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="donation.php">
                                                        <div class="modal-footer">
                                                            <span class="pull-left">View Donations</span>
                                                            <span class="pull-right"><i class="icon-chevron-right"></i></span>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <?php
                                            $total_fundsraised = mysqli_query($conn, "select SUM(Amount) AS total_fundsraised from tithe") or die(mysqli_error());
                                            $row_fundsraised = mysqli_fetch_assoc($total_fundsraised);
                                            $total_funds = $row_fundsraised['total_fundsraised'];
                                            ?>
                                            <div class="span6">
                                                <div class="panel panel-green">
                                                    <div class="panel-heading">
                                                        <div class="container-fluid">
                                                            <div class="row-fluid">
                                                                <div class="span3"><br />
                                                                    <i class="fa fa-money fa-5x"></i><br />
                                                                </div>
                                                                <div class="span8 text-right"><br />
                                                                    <div class="huge"><?php echo $total_funds; ?></div>
                                                                    <div>Total Fundsraised</div><br />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="#">
                                                        <div class="modal-footer">
                                                            <span class="pull-left"></span>
                                                            <span class="pull-right"><i class="icon-chevron-right"></i></span>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Charts -->
                                <div class="row-fluid">
                                    <div class="span6">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">
                                                Donations Chart
                                            </div>
                                            <div class="panel-body">
                                                <canvas id="donationsChart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="span6">
                                        <div class="panel panel-orange">
                                            <div class="panel-heading">
                                                Event Performance Chart
                                            </div>
                                            <div class="panel-body">
                                                <canvas id="eventPerformanceChart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row-fluid">
                                    <div class="span12">
                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                Members Chart (Line Graph)
                                            </div>
                                            <div class="panel-body">
                                                <canvas id="membersChart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>
    <?php include('script.php'); ?>
    <script>
        // Donations Chart
        var ctx1 = document.getElementById('donationsChart').getContext('2d');
        var donationsChart = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                datasets: [{
                    label: 'Donations',
                    data: [1200, 1500, 900, 1800, 1200, 1600],
                    backgroundColor: '#36A2EB',
                    borderColor: '#36A2EB',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Event Performance Chart
        var ctx2 = document.getElementById('eventPerformanceChart').getContext('2d');
        var eventPerformanceChart = new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: ['Health', 'School', 'Families', 'Orphanages', 'Religion'],
                datasets: [{
                    label: 'Event Performance',
                    data: [12, 19, 3, 5, 2],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            }
        });

        // Members Chart (Line Graph)
        var ctx3 = document.getElementById('membersChart').getContext('2d');
        var membersChart = new Chart(ctx3, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                datasets: [{
                    label: 'Members',
                    data: [50, 60, 55, 70, 65, 80],
                    fill: false,
                    borderColor: '#FF6384',
                    tension: 0.1
                }]
            }
        });
    </script>
</body>

</html>

