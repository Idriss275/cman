<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="St.Lukes Boys School management System">
    <meta name="author" content="Kithinji Godfrey">
    <link href="bootstrap/css/index_background.css" rel="stylesheet" media="screen" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<?php include('header.php'); ?>
<?php include('session.php'); ?>

<body>
    <?php include('navbar.php') ?>
    <div class="container-fluid">
        <div class="row-fluid">
            <?php include('sidebar.php'); ?>
            <div class="span9" id="content">
                <div class="row-fluid">
                    <?php
                    $query = mysqli_query($conn, "select * from members where id = '$session_id'") or die(mysqli_error());
                    $row = mysqli_fetch_array($query);
                    ?>
                    <div class="col-lg-12">
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <img id="avatar1" class="img-responsive" src="<?php echo $row['thumbnail']; ?>"><strong> Welcome! <?php echo $user_row['fname'] . " " . $user_row['lname'];  ?></strong>
                        </div>
                    </div>

                    <!-- block -->
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
                                        $result = mysqli_query($conn, "select *, SUM(Amount) AS value_sum from tithe where na='$session_id' ");
                                        $row = mysqli_fetch_assoc($result);
                                        $sum = $row['value_sum'];
                                        ?>
                                        <div class="row-fluid">
                                            <div class="span6">
                                                <div class="panel panel-primary">
                                                    <div class="panel-heading">
                                                        <div class="container-fluid">
                                                            <div class="row-fluid">
                                                                <div class="span3"><br />
                                                                    <i class="fa fa-money fa-5x"></i><br />
                                                                </div>
                                                                <div class="span8 text-right"><br />
                                                                    <div class="huge"><?php echo $sum; ?></div>
                                                                    <div>my Total donations</div><br />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="trackdonations.php">
                                                        <div class="modal-footer">
                                                            <span class="pull-left">Track your donations</span>
                                                            <span class="pull-right"><i class="icon-chevron-right"></i></span>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <?php
                                            $result1 = mysqli_query($conn, "select *, SUM(Amount) AS value_sum from tithe where na='$session_id' ");
                                            $row = mysqli_fetch_assoc($result1);
                                            $sum1 = $row['value_sum'];
                                            ?>
                                     <?php
                                        $result2 = mysqli_query($conn, "select *, SUM(Amount) AS value_sum from giving where na='$session_id' ");
                                        $row = mysqli_fetch_assoc($result2);
                                        $sum2 = $row['value_sum'];
                                        ?>
                                        <div class="row-fluid">
                                            <div class="span6">
                                                <div class="panel panel-yellow">
                                                    <div class="panel-heading">
                                                        <div class="container-fluid">
                                                            <div class="row-fluid">
                                                                <div class="span3"><br />
                                                                    <i class="fa fa-money fa-5x"></i><br />
                                                                </div>
                                                                <div class="span8 text-right"><br />
                                                                    <div class="huge"><?php echo $sum2; ?></div>
                                                                    <div>My Total Pledge</div><br />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="Pledge.php">
                                                        <div class="modal-footer">
                                                            <span class="pull-left">Pledge Now</span>
                                                            <span class="pull-right"><i class="icon-chevron-right"></i></span>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    <div id="page-wrapper">
                                        
                                    </div>

                                    <!-- Canvas Elements for Charts -->
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
                                            <div class="panel panel-green">
                                                <div class="panel-heading">
                                                    Fundraising Chart
                                                </div>
                                                <div class="panel-body">
                                                    <canvas id="fundraisingChart"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Pie Chart for Event Performance -->
                                    <div class="row-fluid">
                                        <div class="span6">
                                            <div class="panel panel-orange">
                                                <div class="panel-heading">
                                                    Event Performance
                                                </div>
                                                <div class="panel-body">
                                                    <canvas id="eventPerformanceChart"></canvas>
                                                </div>
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
        <?php include('footer.php'); ?>
    </div>
    <?php include('script.php'); ?>
    <script>
        // Donations Chart
        var ctx = document.getElementById('donationsChart').getContext('2d');
        var donationsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [{
                    label: 'Donations',
                    data: [<?php echo $sum; ?>, 12, 19, 3, 5, 2, 3],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
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

        // Fundraising Chart
        var ctx = document.getElementById('fundraisingChart').getContext('2d');
        var fundraisingChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [{
                    label: 'Fundraising',
                    data: [<?php echo $sum1; ?>, 15, 10, 6, 9, 7, 4],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
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
        var ctx = document.getElementById('eventPerformanceChart').getContext('2d');
        var eventPerformanceChart = new Chart(ctx, {
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
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                let label = context.label || '';

                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed !== null) {
                                    label += context.parsed;
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>

</html>
