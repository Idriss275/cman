<?php
// Function to make payment API request
function makePaymentApi($url, $data) {
    $ch = curl_init($url); // Initialize cURL session
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); // Set POST data
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Set return transfer to true
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); // Set request header
    $response = curl_exec($ch); // Execute cURL request
    curl_close($ch); // Close cURL session
    return $response; // Return API response
}

// Handle API response
function handleApiResponse($response) {
    if ($response) {
        $responseData = json_decode($response, true); // Decode JSON response
        if ($responseData && isset($responseData['data'], $responseData['status'])) {
            // Extract relevant data from response
            $transactionMessage = $responseData['data']['message'];
            $transactionStatus = $responseData['data']['status'];
            $transactionId = $responseData['data']['transaction']['id'];
            // Handle data as needed (e.g., display messages, update database)
            echo "Transaction Message: $transactionMessage<br>";
            echo "Transaction Status: $transactionStatus<br>";
            echo "Transaction ID: $transactionId<br>";
        } else {
            echo "Invalid response format";
        }
    } else {
        echo "Error making API request";
    }
}

// Example usage:
$url = 'https://example.com/api/payment'; // Replace with your API endpoint
$data = array(/* Your payment data */); // Replace with your request data
$response = makePaymentApi($url, $data); // Make payment API request
handleApiResponse($response); // Handle API response
?>
