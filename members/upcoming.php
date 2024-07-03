<?php include('header.php'); ?>
<?php include('session.php'); ?>
<body>
    <?php include('navbar.php'); ?>
    <div class="container-fluid">
        <div class="row-fluid">
            <?php include('sidebar.php'); ?>
            <div class="span9" id="content">
                <div class="row-fluid">
                    <script type="text/javascript">
                    $(document).ready(function(){
                        $('#add').tooltip('show');
                        $('#add').tooltip('hide');
                    });
                    </script> 
                    <div id="sc" align="center"><image src="images/sclogo.png" width="45%" height="45%"/></div>
                    <?php  
                    $count_members=mysqli_query($conn,"SELECT * 
                        FROM event
                        WHERE DATE_ADD(STR_TO_DATE(Date, '%Y-%m-%d'), INTERVAL YEAR(CURDATE())-YEAR(STR_TO_DATE(Date, '%Y-%m-%d')) YEAR) 
                        BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)");
                    $count = mysqli_num_rows($count_members);
                    ?>     
                    <div id="block_bg" class="block">
                        <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><i class="icon-reorder icon-large"></i> Upcoming Events</div>
                            <div class="muted pull-right">
                                Upcoming Events <span class="badge badge-info"><?php echo $count; ?></span>
                            </div>
                        </div>
                        <h4 id="sc">Members List 
                            <div align="right" id="sc">Date:
                                <?php
                                $date = new DateTime();
                                echo $date->format('l, F jS, Y');
                               
