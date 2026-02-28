<?php
session_start();
require __DIR__ . "./../vendor/autoload.php";
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../functions/');
$dotenv->load();
include('../config/dbcon.php');
include('../functions/place_order.php');

// Make sure user is logged in
if(!isset($_SESSION['auth'])){
    $_SESSION['cart_type'] = "info";
    $_SESSION['cart_add_message'] = 'Login to continue!';
    header('Location: ../checkout.php');
    exit;
}

// Check if PayPal sent order ID
if(!isset($_GET['token'])){
    die("No PayPal order ID provided.");
}

$orderId = $_GET['token']; // PayPal sends this as 'token'

// ---- PAYPAL CONFIG ----
$clientId = $_ENV['PAYPAL_CLIENT_ID'];
$secret   = $_ENV['PAYPAL_SECRET'];
$baseUrl  = "https://api-m.sandbox.paypal.com"; // use live URL in production

// Step 1: Get OAuth token
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "$baseUrl/v1/oauth2/token");
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Accept: application/json",
    "Accept-Language: en_US"
]);
curl_setopt($ch, CURLOPT_USERPWD, "$clientId:$secret");
curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

$response = curl_exec($ch);
if($response === false){
    die("Curl error (token request): " . curl_error($ch));
}
curl_close($ch);

$tokenData = json_decode($response, true);
if(isset($tokenData['error'])){
    die("PayPal API error: " . $tokenData['error_description']);
}

$accessToken = $tokenData['access_token'];

// Step 2: Capture the PayPal order
$ch = curl_init("$baseUrl/v2/checkout/orders/$orderId/capture");
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: Bearer $accessToken"
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);

$captureResponse = curl_exec($ch);
if($captureResponse === false){
    die("Curl error (capture order): " . curl_error($ch));
}
curl_close($ch);

$captureData = json_decode($captureResponse, true);

// Step 3: Check payment status
if(isset($captureData['status']) && $captureData['status'] === 'COMPLETED'){
    if(!isset($_SESSION['checkout_data'])){
        die("Checkout session data missing.");
    }
    
    $data = $_SESSION['checkout_data']; // Save order 
    unset($_SESSION['checkout_data']); // Clear checkout session
    save_order_to_db($data, $connection);

}else{
    echo "<pre>";
    print_r($captureData);
    echo "</pre>";
    die("PayPal payment was not completed.");
}
?>