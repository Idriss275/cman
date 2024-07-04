<?php
// Retrieve data sent by the callback
$data = file_get_contents('php://input');

// Process the data as needed
// Example: Log the received data
file_put_contents('callback.log', $data . PHP_EOL, FILE_APPEND);

// Respond with a success message
http_response_code(200);
echo "Callback received successfully.";
?>
