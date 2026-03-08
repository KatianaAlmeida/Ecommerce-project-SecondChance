<?php

session_start();
require __DIR__ . "./../vendor/autoload.php"; // loads the necessary file automatically - Stripe
 

include('../config/dbcon.php');
include('../functions/place_order.php');

if(isset($_POST['make_checkout_btn'])){
  if(isset($_SESSION['auth'])){
    $delivery_type = pg_escape_string($connection, $_POST['delivery_type_h']);
    $choosen_address = pg_escape_string($connection, $_POST['choosen_address_h']);
    $choosen_payment = pg_escape_string($connection, $_POST['choosen_payment_h']);
    $delivery = pg_escape_string($connection, $_POST['delivery']);
    $total_price = pg_escape_string($connection, $_POST['total_price']);
    $payment_id = pg_escape_string($connection, $_POST['payment_id']);
    
    // STORE DATA IN SESSION
    $_SESSION['checkout_data'] = [
        'delivery_type' => $delivery_type,
        'choosen_address' => $choosen_address,
        'choosen_payment' => $choosen_payment,
        'delivery' => $delivery,
        'payment_id' => $payment_id
    ];

    if($delivery_type === 'delivery_type' && $choosen_address === 'choosen_address' || $delivery_type === 'Delivery' && $choosen_address === 'choosen_address'){
        $_SESSION['cart_type'] = "info";
        $_SESSION['cart_add_message'] = 'Please select an address before continuing!';
        header('Location: ../checkout.php');
    }else{
        if($_POST['payment_option'] === 'card'){
            \Stripe\Stripe::setApiKey(getenv('STRIPE_SECRET'));
            $checkout_session = \Stripe\Checkout\Session::create([
                "mode" => "payment",
                "success_url" => "http://localhost:3000/functions/save_card_order.php?session_id={CHECKOUT_SESSION_ID}",
                "cancel_url" => "http://localhost:3000/checkout.php",
                "locale" => "auto",
                "line_items" => [
                    [
                        "quantity" => 1,
                        "price_data" => [
                            "currency" => "zar",
                            "unit_amount" => (int) ($total_price * 100),
                            "product_data" => [
                                "name" => "Order's Total"
                            ]
                        ]
                    ]       
                ]
            ]);
            http_response_code(303);
            header("Location: " . $checkout_session->url);

        } else if($_POST['payment_option'] === 'paypal'){
            // ---- PAYPAL CONFIG ----
            $accessToken = get_paypal_access_token();
            $baseUrl = "https://api-m.sandbox.paypal.com";

            // ---- CREATE PAYPAL ORDER ----
            $orderData = [
                "intent" => "CAPTURE",
                "purchase_units" => [
                    [
                        "amount" => [
                        "currency_code" => "USD", // change from ZAR
                        "value" => number_format((float)$total_price, 2, '.', '')
                        ]
                    ]
                ],
                "application_context" => [
                    "return_url" => "http://localhost:3000/functions/save_paypal_order.php",
                    "cancel_url" => "http://localhost:3000/checkout.php"
                ]
            ];

            $ch = curl_init("$baseUrl/v2/checkout/orders");
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "Content-Type: application/json",
                "Authorization: Bearer $accessToken"
            ]);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($orderData));
            $orderResponse = curl_exec($ch);

            if($orderResponse === false){
                die("Curl error (order creation): " . curl_error($ch));
            }
            curl_close($ch);

            $order = json_decode($orderResponse, true);
            if(isset($order['id'])){
                // Redirect user to PayPal approval URL
                foreach($order['links'] as $link){
                    if($link['rel'] === 'approve'){
                        header("Location: " . $link['href']);
                        exit;
                    }
                }
                die("Approval URL not found in PayPal response.");
            } else {
                die("Error creating PayPal order: " . print_r($order, true));
            }
        }else{
            $_SESSION['cart_type'] = "info";
            $_SESSION['cart_add_message'] = 'No payment option selected!';
            header('Location: ../checkout.php');
        }
    }
    
  }else{
    $_SESSION['cart_type'] = "info";
    $_SESSION['cart_add_message'] = 'Login to continue!';
    header('Location: ../checkout.php');
  }
}
?>