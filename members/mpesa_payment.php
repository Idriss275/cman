<?php
require_once 'C:/xampp/htdocs/cman/vendor/autoload.php';

use GuzzleHttp\Client;

require 'mpesa_token.php';

function makeMpesaPayment($accessToken, $phoneNumber, $amount, $shortCode, $callbackUrl) {
    $client = getClient();
    $response = $client->request('POST', 'mpesa/c2b/v1/simulate', [
        'headers' => [
            'Authorization' => 'Bearer ' . $accessToken,
            'Content-Type' => 'application/json',
        ],
        'json' => [
            'ShortCode' => $shortCode,
            'CommandID' => 'CustomerPayBillOnline',
            'Amount' => $amount,
            'Msisdn' => $phoneNumber,
            'BillRefNumber' => 'TestPayment',
        ],
    ]);

    return json_decode($response->getBody(), true);
}

$apiKey = 'YOUR_API_KEY';
$apiSecret = 'YOUR_API_SECRET';
$shortCode = 'YOUR_SHORTCODE';
$callbackUrl = 'YOUR_CALLBACK_URL';

$phoneNumber = $_POST['phone'];
$amount = $_POST['amount'];

$accessToken = getAccessToken($apiKey, $apiSecret);
$response = makeMpesaPayment($accessToken, $phoneNumber, $amount, $shortCode, $callbackUrl);

if (isset($response['errorCode'])) {
    echo "Payment failed: " . $response['errorMessage'];
} else {
    echo "Payment successful. Transaction details: " . json_encode($response);
}
?>
