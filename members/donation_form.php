<?php include('header.php'); ?>
<?php include('session.php'); ?>
<body>
    <?php include('navbar.php'); ?>
    <div class="container-fluid">
        <div class="row-fluid">
            <?php include('sidebar.php'); ?>
            <div class="span3" id="adduser">
                <?php include('add_donation.php'); ?>                  
            </div>
            <div class="span6" id="">
                <div class="row-fluid">
                    <!-- block -->
                    <div class="empty">
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="icon-info-sign"></i>  <strong>Note!:</strong> Select the checkbox if you want to delete?
                        </div>
                    </div>    
                    
                    <?php    
                     $count_user=mysqli_query($conn,"select * from tithe Where na= '$session_id'");
                     $count = mysqli_num_rows($count_user);
                     ?>     
                    <div id="block_bg" class="block">
                        <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><i class="icon-user"></i> Donations List</div>
                            <div class="muted pull-right">
                                Number of Donations: <span class="badge badge-info"><?php  echo $count; ?></span>
                            </div>
                        </div>
                        <div class="block-content collapse in">
                            <div class="span12">
                                <form action="donate.php" method="post">
                                    <div class="control-group">
                                        <label class="control-label" for="amount">Amount</label>
                                        <div class="controls">
                                            <input type="number" id="amount" name="amount" placeholder="Enter donation amount" required>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="payment_method">Payment Method</label>
                                        <div class="controls">
                                            <select id="payment_method" name="payment_method" required>
                                                <option value="airtel">Airtel Money</option>
                                                <option value="tigo">Tigo Pesa</option>
                                                <option value="mpesa">M-Pesa</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <div class="controls">
                                            <button type="submit" class="btn btn-primary">Donate</button>
                                        </div>
                                    </div>
                                </form>
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
