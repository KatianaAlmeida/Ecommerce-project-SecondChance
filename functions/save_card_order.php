<?php

session_start();
require __DIR__ . "./../vendor/autoload.php";
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../functions/');
$dotenv->load();
include('../config/dbcon.php');
include('../functions/place_order.php');

if(isset($_SESSION['auth'])){
  \Stripe\Stripe::setApiKey($_ENV['STRIPE_SECRET']);

  if (!isset($_GET['session_id'])) {
      die("No session ID provided.");
  }
  $session_id = $_GET['session_id'];
  $session = \Stripe\Checkout\Session::retrieve($session_id);

  if ($session->payment_status === 'paid') {
    if (!isset($_SESSION['checkout_data'])) {
        die("Checkout session data missing.");
    }
    $data = $_SESSION['checkout_data'];
    save_order_to_db($data, $connection); // functions/place_order.php

  }else{
    die("Payment not completed.");
  }

}else{
  $_SESSION['cart_type'] = "info";
  $_SESSION['cart_add_message'] = 'Login to continue!';
  header('Location: ../checkout.php');
}
?>