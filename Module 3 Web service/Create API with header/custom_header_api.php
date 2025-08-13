<?php
// Enable CORS and set content type for JSON response
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Get all request headers
$headers = getallheaders();

// Define the custom header name you expect, for example: "X-Custom-Header"
$customHeaderName = 'X-Custom-Header';

// Check if the custom header exists
if (isset($headers[$customHeaderName])) {
    $headerValue = $headers[$customHeaderName];

    // Send JSON response with the header value
    echo json_encode([
        'status' => 'success',
        'header_name' => $customHeaderName,
        'header_value' => $headerValue,
    ]);
} else {
    // Header not found - respond with error message
    http_response_code(400);
    echo json_encode([
        'status' => 'error',
        'message' => "Custom header '$customHeaderName' not found.",
    ]);
}
