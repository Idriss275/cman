<?php include('header.php'); ?>
<?php include('session.php'); ?>
<body>
    <?php include('navbar.php'); ?>
    <div class="container-fluid">
        <div class="row-fluid">
            <?php include('sidebar.php'); ?>
            <div class="span9" id="content">
                <div class="row-fluid">
                    <div class="empty">
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="icon-info-sign"></i>  <strong>Note!:</strong> Below are the upcoming events.
                        </div>
                    </div>

                    <?php    
                    $count_events = mysqli_query($conn, "SELECT * FROM event");
                    $count = mysqli_num_rows($count_events);
                    ?>     
                    <div id="block_bg" class="block">
                        <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><i class="icon-calendar"></i> Upcoming Events</div>
                            <div class="muted pull-right">
                                Number of Events: <span class="badge badge-info"><?php echo $count; ?></span>
                            </div>
                        </div>
                        <div class="block-content collapse in">
                            <div class="span12">
                                <table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
                                    <thead>
                                        <tr>
                                            <th>Event Name</th>
                                            <th>Description</th>
                                            <th>Date</th>
                                            <th>Control Number</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $event_query = mysqli_query($conn, "SELECT * FROM event") or die(mysqli_error($conn));
                                        while ($row = mysqli_fetch_array($event_query)) {
                                            $id = $row['id'];
                                        ?>
                                            <tr>
                                                <td><?php echo $row['Title']; ?></td>
                                                <td><?php echo $row['content']; ?></td>
                                                <td><?php echo $row['Date']; ?></td>
                                                <td><?php echo $row['control_number']; ?></td>
                                                <td>
                                                    <?php if ($row['image_url']) { ?>
                                                        <img src="<?php echo $row['image_url']; ?>" alt="Event Image" style="max-width: 100px; height: auto;">
                                                    <?php } else { ?>
                                                        No image
                                                    <?php } ?>
                                                </td>
                                                <td><a href="view_event.php?id=<?php echo $id; ?>" class="btn btn-info"><i class="icon-eye-open icon-large"></i> View</a></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /block -->
                </div>
            </div>
        </div>

        <?php include('footer.php'); ?>
    </div>
    <?php include('script.php'); ?>
</body>

</html>
