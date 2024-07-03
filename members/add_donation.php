<div class="row-fluid">
    <div class="block">
        <div class="navbar navbar-inner block-header">
            <div class="muted pull-left"><i class="icon-plus-sign icon-large"> Enter your donation</i></div>
        </div>
        <div class="block-content collapse in">
            <div class="span12">
                <form method="post" id="donationForm">
                    <!-- Payment Method Selection -->
                    <div class="control-group">
                        <label for="paymentMethod">Payment Method</label>
                        <div class="controls">
                            <select class="input focused" name="paymentMethod" id="paymentMethod" required>
                                <option value="">Select Payment Method</option>
                                <option value="M-Pesa">M-Pesa</option>
                                <option value="Tigo Pesa">Tigo Pesa</option>
                                <option value="Airtel Money">Airtel Money</option>
                            </select>
                            <div>
                                <img src="images/mpesa.png" alt="M-Pesa Icon" id="mpesaIcon" style="display:none; height: 20px;">
                                <img src="images/tigo_pesa.png" alt="Tigo Pesa Icon" id="tigoPesaIcon" style="display:none; height: 20px;">
                                <img src="images/airtel_money.png" alt="Airtel Money Icon" id="airtelMoneyIcon" style="display:none; height: 20px;">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Preset Amount Selection -->
                    <div class="control-group">
                        <label for="presetAmount">Select Amount</label>
                        <div class="controls">
                            <select class="input focused" name="presetAmount" id="presetAmount">
                                <option value="">Select an amount</option>
                                <option value="5000">5000 TSH</option>
                                <option value="10000">10000 TSH</option>
                                <option value="20000">20000 TSH</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Custom Amount Input -->
                    <div class="control-group">
                        <label for="customAmount">Or Enter Custom Amount</label>
                        <div class="controls">
                            <input class="input focused" name="customAmount" id="customAmount" type="text" placeholder="Custom Amount">
                        </div>
                    </div>
                    
                    <!-- Transaction Code Input -->
                    <div class="control-group">
                        <label for="trcode">Phone Number</label>
                        <div class="controls">
                            <input class="input focused" name="trcode" id="trcode" type="text" placeholder="Transaction Code" required>
                        </div>
                    </div>
                    
                    <!-- Save/Proceed Button -->
                    <div class="control-group">
                        <div class="controls">
                            <button name="proceed" class="btn btn-info" id="proceed" data-placement="right" title="Click to Proceed"><i class="icon-plus-sign icon-large"> Proceed</i></button>
                        </div>
                    </div>
                    
                    <!-- PIN Entry Section -->
                    <div id="pinSection" style="display:none;">
                        <div class="control-group">
                            <label for="pin">Enter 4-digit PIN</label>
                            <div class="controls">
                                <input class="input focused" name="pin" id="pin" type="password" placeholder="PIN" required>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <button type="button" name="pay" class="btn btn-success" id="pay" data-placement="right" title="Click to Pay"><i class="icon-plus-sign icon-large"> Pay</i></button>
                            </div>
                        </div>
                    </div>
                </form>
                
                <!-- Confirmation Modal -->
                <div id="confirmationModal" class="modal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color:rgba(0,0,0,0.5); z-index:9999;">
                    <div class="modal-content" style="position:relative; top:50%; left:50%; transform:translate(-50%, -50%); background-color:#fff; padding:20px; border-radius:10px; text-align:center; font-size:16px; width: 300px; height: 300px; display: flex; flex-direction: column; justify-content: center;">
                        <p id="confirmationText"></p>
                        <button id="acceptButton" class="btn btn-success" style="margin-top: 20px;">Accept</button>
                    </div>
                </div>

                <!-- Success/Failure Modal -->
                <div id="messageModal" class="modal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color:rgba(0,0,0,0.5); z-index:9999;">
                    <div class="modal-content" id="messageContent" style="position:relative; top:50%; left:50%; transform:translate(-50%, -50%); background-color:#fff; padding:20px; border-radius:10px; text-align:center; font-size:16px; width: 300px; height: 300px; display: flex; flex-direction: column; justify-content: center;">
                        <p id="messageText"></p>
                    </div>
                </div>

                <script type="text/javascript">
                    $(document).ready(function(){
                        $('#proceed').tooltip('show');
                        $('#proceed').tooltip('hide');
                        
                        $('#proceed').click(function(event) {
                            event.preventDefault();
                            $('#pinSection').show();
                            $('#proceed').hide();
                        });
                        
                        $('#pay').click(function(event) {
                            event.preventDefault();
                            var selectedPaymentMethod = $('#paymentMethod').val();
                            var presetAmount = $('#presetAmount').val();
                            var customAmount = $('#customAmount').val();
                            var amount = presetAmount ? presetAmount : customAmount;
                            if (!selectedPaymentMethod) {
                                alert('Please select a payment method.');
                            } else if (!amount) {
                                alert('Please select or enter an amount.');
                            } else {
                                $('#confirmationText').text(`You are about to send ${amount} TSH to 4111 1111 1111 1111 from ${selectedPaymentMethod}`);
                                $('#confirmationModal').show();
                            }
                        });

                        $('#acceptButton').click(function(event) {
                            event.preventDefault();
                            var pin = $('#pin').val();
                            $('#confirmationModal').hide();
                            if (pin.length === 4) {
                                if (pin === "1234") {
                                    $.ajax({
                                        type: 'POST',
                                        url: 'process_donation.php',
                                        data: $('#donationForm').serialize(),
                                        success: function(response) {
                                            $('#messageText').text("Transaction Successful");
                                            $('#messageText').css('color', 'green');
                                            $('#messageModal').show();
                                            setTimeout(function() {
                                                window.location = "tithes.php";
                                            }, 3000); // Adjust time as needed
                                            $.jGrowl("The Giving Successfully added", { header: 'Giving added' });
                                        },
                                        error: function(xhr, status, error) {
                                            $.jGrowl("Error: " + error, { header: 'Error' });
                                        }
                                    });
                                } else {
                                    $('#messageText').text("Transaction Denied");
                                    $('#messageText').css('color', 'red');
                                    $('#messageModal').show();
                                    setTimeout(function() {
                                        $('#messageModal').hide();
                                    }, 3000); // Adjust time as needed
                                }
                            } else {
                                alert('Please enter a valid 4-digit PIN.');
                            }
                        });

                        $('#paymentMethod').change(function() {
                            $('#mpesaIcon').hide();
                            $('#tigoPesaIcon').hide();
                            $('#airtelMoneyIcon').hide();
                            var selectedMethod = $(this).val();
                            if (selectedMethod === 'M-Pesa') {
                                $('#mpesaIcon').show();
                            } else if (selectedMethod === 'Tigo Pesa') {
                                $('#tigoPesaIcon').show();
                            } else if (selectedMethod === 'Airtel Money') {
                                $('#airtelMoneyIcon').show();
                            }
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>
