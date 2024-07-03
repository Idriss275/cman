<?php
// Function to make an API request
function makeApiRequest($url, $data) {
    $ch = curl_init($url); // Initialize cURL session
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); // Set POST data
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Set return transfer to true
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); // Set request header
    $response = curl_exec($ch); // Execute cURL request
    curl_close($ch); // Close cURL session
    return $response; // Return API response
}

// Example usage:
$url = 'https://example.com/api/endpoint'; // Replace with your API endpoint
$data = array(/* Your request data */); // Replace with your request data
$response = makeApiRequest($url, $data); // Make API request
?>
