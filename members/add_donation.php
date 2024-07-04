<?php
if (isset($_POST['pay']))

{


   $amount = $_POST['customAmount'];

   $simu = $_POST["trcode"];
   
   $webhookURL = "https://cman.in/digicashcallback";
   
   
   $simu_pay = substr($simu,1);
   
   if(substr($simu, 0, 3) == "065" || substr($simu, 0, 3) == "071" || substr($simu, 0, 3) == "067" || substr($simu, 0, 3) == "077")
   {
   $payment_chanell = "tigo";
   }
   
   else if(substr($simu, 0, 3) == "068" || substr($simu, 0, 3) == "078" || substr($simu, 0, 3) == "069")
   {
   $payment_chanell = "airtel";
   }
   
   else if(substr($simu, 0, 3) == "074" || substr($simu, 0, 3) == "075" || substr($simu, 0, 3) == "076")
   {
   $payment_chanell = "mpesa";
   }
   else
   {
   $payment_chanell = "halopesa";
   }
   
   
   $internal_reference = substr($simu,1).date("mdhis");
   
   
   $curl = curl_init();
   
   $id = "X-DC-CLIENT-ID: kn4awnkiwugmlqxveqaz";
   
   $secret = "X-DC-CLIENT-SECRET: tuIq0rshOSSwXsgqqtXI";
   
   curl_setopt_array($curl, array(
     CURLOPT_URL => 'https://api.digicash.co.tz/api/client/authenticate/',
     CURLOPT_RETURNTRANSFER => true,
     CURLOPT_ENCODING => '',
     CURLOPT_MAXREDIRS => 10,
     CURLOPT_TIMEOUT => 0,
     CURLOPT_SSL_VERIFYPEER=> 0,
     CURLOPT_FOLLOWLOCATION => true,
     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
     CURLOPT_CUSTOMREQUEST => 'POST',
     CURLOPT_HTTPHEADER => array(
       $id,
   $secret
       ),
   ));
   
   $response = curl_exec($curl);
   
   curl_close($curl);
   //echo $response;
   
   $arrr = json_decode($response,true);
   
   foreach($arrr as $key => $arrays)
   {
   $token = $arrr['data']["id_token"];
   }
   
   //echo $response;
   
   $authorization = "Authorization: Bearer $token";
   
   $curl = curl_init();
   
   curl_setopt_array($curl, array(
     CURLOPT_URL => 'https://api.digicash.co.tz/api/client/payments/services',
     CURLOPT_RETURNTRANSFER => true,
     CURLOPT_ENCODING => '',
     CURLOPT_MAXREDIRS => 10,
     CURLOPT_TIMEOUT => 0,
     CURLOPT_SSL_VERIFYPEER=> 0,
     CURLOPT_FOLLOWLOCATION => true,
     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
     CURLOPT_CUSTOMREQUEST => 'GET',
     CURLOPT_HTTPHEADER => array($authorization),
   ));
   
   $response = curl_exec($curl);
   
   curl_close($curl);
   
   $chanell = json_decode($response,true);
   
   //echo $response;
   
   
   if($chanell['data']['0']['serviceName']== $payment_chanell )
   
   {
   $storeServiceId = $chanell['data']['0']['storeServiceId'];
   }
   
   else if($chanell['data']['1']['serviceName']== $payment_chanell )
   
   {
   $storeServiceId = $chanell['data']['1']['storeServiceId'];
   }
   
   else if($chanell['data']['2']['serviceName']== $payment_chanell )
   
   {
   $storeServiceId = $chanell['data']['2']['storeServiceId'];
   }
   
   else
   {
   $storeServiceId = $chanell['data']['3']['storeServiceId'];
   }
   
   $curl = curl_init();
   
   $request = json_encode([
   'amount' => $amount,
   'serviceId' => $storeServiceId,
   'phone' => $simu_pay,
   'referenceId' => $internal_reference,
   'webhookURL' => $webhookURL ],true);
   
   curl_setopt_array($curl, array(
     CURLOPT_URL => 'https://api.digicash.co.tz/api/client/payments/init',
     CURLOPT_RETURNTRANSFER => true,
     CURLOPT_ENCODING => '',
     CURLOPT_MAXREDIRS => 10,
     CURLOPT_TIMEOUT => 0,
     CURLOPT_SSL_VERIFYPEER=> 0,
     CURLOPT_FOLLOWLOCATION => true,
     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
     CURLOPT_CUSTOMREQUEST => 'POST',
     CURLOPT_POSTFIELDS => $request,
     CURLOPT_HTTPHEADER => array($authorization,'Content-Type: application/json'),
   ));
   
   $response = curl_exec($curl);
   
   $decoded = json_decode($response,true);
   
   $external_reference = $decoded['data']['id'];
   
  // echo $response;
   
   curl_close($curl);
   
   if($decoded['responseCode']==="PAY0001" || $decoded['responseCode']==="PAY002")
   {
   echo "Transaction initiated successfully";
   
   }
   else
   {
   echo "Failed";
   }


}

else{
    //echo "noooo";
}

?>


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
                                <option value="M-Pesa">Halopesa</option>
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
                    <!--<div class="control-group">
                        <label for="presetAmount">Select Amount</label>
                        <div class="controls">
                            <select class="input focused" name="presetAmount" id="presetAmount">
                                <option value="">Select an amount</option>
                                <option value="5000">5000 TSH</option>
                                <option value="10000">10000 TSH</option>
                                <option value="20000">20000 TSH</option>
                            </select>
                        </div>
                    </div>-->
                    
                    <!-- Custom Amount Input -->
                    <div class="control-group">
                        <label for="customAmount">Enter Custom Amount</label>
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
                    
                    <!-- Pay Button -->
                    <div class="control-group">
                        <div class="controls">
                            <button type="submit" name="pay" class="button">pay</button>
                            <!--<a href="" class="btn btn-info" id="pay" data-placement="right" title="Click to Pay"><i class="icon-plus-sign icon-large"> Pay</i></a>-->
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
                <?php

if (isset($_POST['pay'])){
$firstname = $_POST['customAmount'];
$lastname = $_POST['trcode'];





mysqli_query($conn,"insert into tithe (Amount,Trcode,na) values('$firstname','$lastname','$session_id')")or die(mysqli_error());

?>
<script>
window.location = "Tithes.php";
$.jGrowl("Donation Successfully added", { header: 'Donation added' });
</script>
<?php
}

?>
                <script type="text/javascript">
                    $(document).ready(function(){
                        $('#pay').tooltip('show');
                        $('#pay').tooltip('hide');
                        
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
