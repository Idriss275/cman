<?php
require_once 'C:/xampp/htdocs/cman/vendor/autoload.php';
use GuzzleHttp\Client;

function getClient() {
    return new Client([
        'base_uri' => 'https://api.safaricom.co.tz/',
        'timeout'  => 30.0,
    ]);
}

function getAccessToken($apiKey, $apiSecret) {
    $client = getClient();
    $response = $client->request('GET', 'oauth/v1/generate?grant_type=client_credentials', [
        'auth' => [$apiKey, $apiSecret]
    ]);
    $body = json_decode($response->getBody(), true);
    return $body['access_token'];
}
?>
