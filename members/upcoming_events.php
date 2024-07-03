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
                $count_members = mysqli_query($conn, "SELECT * FROM event WHERE DATE_ADD(STR_TO_DATE(Date, '%Y-%m-%d'), INTERVAL YEAR(CURDATE())-YEAR(STR_TO_DATE(Date, '%Y-%m-%d')) YEAR) BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)");
                $count = mysqli_num_rows($count_members);
                ?>
                <div id="block_bg" class="block">
                    <div class="navbar navbar-inner block-header">
                        <div class="muted pull-left"><i class="icon-reorder icon-large"></i> Upcoming Events</div>
                        <div class="muted pull-right">
                            Upcoming Events <span class="badge badge-info"><?php echo $count; ?></span>
                        </div>
                    </div>
                    <div class="block-content collapse in">
                        <div class="span12">
                            <form action="" method="post">
                                <table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
                                    <thead>
                                        <tr>
                                            <th>TITLE</th>
                                            <th>DATE</th>
                                            <th>DESCRIPTION</th>
                                            <th>IMAGE</th>
                                            <th>CONTROL NUMBER</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $members_query = mysqli_query($conn, "SELECT * FROM event WHERE DATE_ADD(STR_TO_DATE(Date, '%Y-%m-%d'), INTERVAL YEAR(CURDATE())-YEAR(STR_TO_DATE(Date, '%Y-%m-%d')) YEAR) BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)") or die(mysqli_error($conn));
                                        while ($row = mysqli_fetch_array($members_query)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $row['Title']; ?></td>
                                                <td><?php echo $row['Date']; ?></td>
                                                <td><?php echo $row['content']; ?></td>
                                                <td><img src="<?php echo $row['image_url']; ?>" alt="Event Image" style="max-width: 100px;"></td>
                                                <td><?php echo $row['control_number']; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </form>
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
</body>
</html>
