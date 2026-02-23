<?php

// Product details (example) 
define('PRODUCT_NAME', 'Example Product'); 
define('PRODUCT_PRICE', '9.99'); 
define('PRODUCT_CURRENCY', 'USD'); 
 
// Database settings 
define('DB_HOST', 'localhost'); 
define('DB_USER', 'root'); 
define('DB_PASS', ''); 
define('DB_NAME', 'paypal_checkout_db'); 
 
// PayPal REST API credentials 
// For testing use sandbox credentials and set sandbox true 
define('PAYPAL_CLIENT_ID', 'YOUR_PAYPAL_CLIENT_ID'); 
define('PAYPAL_SECRET', 'YOUR_PAYPAL_SECRET'); 
define('PAYPAL_SANDBOX', TRUE); //TRUE=Sandbox | FALSE=Production 
 
// Utility: create mysqli connection 
function get_db_connection() { 
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME); 
    if ($mysqli->connect_errno) { 
        http_response_code(500); 
        echo json_encode(['error' => 'Database connection failed: ' . $mysqli->connect_error]); 
        exit; 
    } 
    $mysqli->set_charset('utf8mb4'); 
    return $mysqli; 
} 
?>