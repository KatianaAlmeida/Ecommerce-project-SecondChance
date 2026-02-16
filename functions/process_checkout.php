<?php

session_start();
require __DIR__ . "./../vendor/autoload.php"; // loads the necessary file automatically
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../functions/');
$dotenv->load();

include('../config/dbcon.php');

if(isset($_POST['make_checkout_btn'])){
  if(isset($_SESSION['auth'])){
    $delivery_type = mysqli_real_escape_string($connection, $_POST['delivery_type_h']);
    $choosen_address = mysqli_real_escape_string($connection, $_POST['choosen_address_h']);
    //$choosen_card = mysqli_real_escape_string($connection, $_POST['choosen_card_h']);
    $choosen_payment = mysqli_real_escape_string($connection, $_POST['choosen_payment_h']);
    $delivery = mysqli_real_escape_string($connection, $_POST['delivery']);
    $total_price = mysqli_real_escape_string($connection, $_POST['total_price']);
    $payment_id = mysqli_real_escape_string($connection, $_POST['payment_id']);
    
    // STORE DATA IN SESSION
    $_SESSION['checkout_data'] = [
        'delivery_type' => $delivery_type,
        'choosen_address' => $choosen_address,
        //'choosen_card' => $choosen_card,
        'choosen_payment' => $choosen_payment,
        'delivery' => $delivery,
        'payment_id' => $payment_id
    ];

    \Stripe\Stripe::setApiKey($_ENV['STRIPE_SECRET']);
    $checkout_session = \Stripe\Checkout\Session::create([
        "mode" => "payment",
        "success_url" => "http://localhost:3000/functions/save_order.php?session_id={CHECKOUT_SESSION_ID}",
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

  }else{
    $_SESSION['cart_type'] = "info";
    $_SESSION['cart_add_message'] = 'Login to continue!';
    header('Location: ../checkout.php');
  }
}
?>