<?php

// Get the text parameter from the URL
$text = isset($_GET['text']) ? $_GET['text'] : '';

// API endpoint with text parameter
$api_url = "https://api.amshop.cloud/GF-Ai/?text=" . urlencode($text);

// Initialize cURL session
$curl = curl_init();

// Set cURL options
curl_setopt($curl, CURLOPT_URL, $api_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// Execute the cURL request
$response = curl_exec($curl);

// Check if there was an error with the request
if (curl_errno($curl)) {
    echo 'Request Error: ' . curl_error($curl);
    exit;
}

// Close the cURL session
curl_close($curl);

// Decode the JSON response
$data = json_decode($response, true);

// Extract the message from the JSON response
if (isset($data['message'])) {
    $message = $data['message'];

    // Ensure correct Unicode handling for emojis
    $message = mb_convert_encoding($message, 'UTF-8', 'UTF-8');

    // Output the message
    echo $message;
} else {
    echo 'No message found in the response';
}
?>
