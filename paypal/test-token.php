<?php
// test-token.php
// Katiana: Test PayPal REST API credentials
session_start();
require __DIR__ . "./../vendor/autoload.php";
 

// Show all PHP errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

// ---- CONFIG ----
$clientId = getenv('PAYPAL_CLIENT_ID');
$secret   = getenv('PAYPAL_SECRET');
$baseUrl  = "https://api-m.sandbox.paypal.com"; // ✅ Correct REST API URL
// ----------------

// Initialize cURL
$ch = curl_init();

// Set up request to get OAuth 2.0 token
curl_setopt($ch, CURLOPT_URL, "$baseUrl/v1/oauth2/token");
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Accept: application/json",
    "Accept-Language: en_US"
]);
curl_setopt($ch, CURLOPT_USERPWD, "$clientId:$secret");
curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// For testing only: ignore SSL certificate verification
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

// Execute request
$response = curl_exec($ch);

// Check for cURL errors
if ($response === false) {
    die("Curl error: " . curl_error($ch));
}

// Close cURL session
curl_close($ch);

// Display the response
echo "<pre>";
print_r(json_decode($response, true));
echo "</pre>";
?>