<?php include('header.php'); ?>
<?php include('session.php'); ?>

<?php
if (isset($_GET['id'])) {
    $event_id = $_GET['id'];
    $event_query = mysqli_query($conn, "SELECT * FROM event WHERE id = '$event_id'") or die(mysqli_error($conn));
    $event = mysqli_fetch_array($event_query);
}
?>

<body>
    <?php include('navbar.php'); ?>
    <div class="container-fluid">
        <div class="row-fluid">
            <?php include('sidebar.php'); ?>
            <div class="span9" id="content">
                <div class="row-fluid">
                    <div class="block">
                        <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><i class="icon-calendar"></i> Event Details</div>
                        </div>
                        <div class="block-content collapse in">
                            <div class="span12">
                                <h2><?php echo $event['Title']; ?></h2>
                                <p><?php echo $event['content']; ?></p>
                                <p><strong>Date:</strong> <?php echo $event['Date']; ?></p>
                                <p><strong>Control Number:</strong> <?php echo $event['control_number']; ?></p>
                                <?php if ($event['image_url']) { ?>
                                    <img src="<?php echo $event['image_url']; ?>" alt="Event Image" style="width: 100%; height: auto; margin-top: 20px;">
                                    <!-- Debugging: Print the image URL -->
                                    <p>Image URL: <?php echo $event['image_url']; ?></p>
                                <?php } else { ?>
                                    <p>No image available for this event.</p>
                                <?php } ?>
                                <a href="events.php" class="btn btn-info" style="margin-top: 20px;"><i class="icon-arrow-left icon-large"></i> Back to Events</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include('footer.php'); ?>
    </div>
    <?php include('script.php'); ?>
</body>

</html>
