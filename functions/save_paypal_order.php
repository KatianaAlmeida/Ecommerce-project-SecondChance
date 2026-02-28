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
$accessToken = get_paypal_access_token();
$baseUrl = "https://api-m.sandbox.paypal.com";

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