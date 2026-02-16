<?php

session_start();
require __DIR__ . "./../vendor/autoload.php";
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../functions/');
$dotenv->load();
include('../config/dbcon.php');


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

    $delivery_type = $data['delivery_type'];
    $choosen_address = $data['choosen_address'];
    $choosen_card = $data['choosen_card'];
    $choosen_payment = $data['choosen_payment'];
    $delivery = $data['delivery'];
    $payment_id = $data['payment_id'];

    $user_id = $_SESSION['auth_user']['id'];
    $tracking_no = "secondchange".rand(1000, 9999);
    /*-------------------------------------------------------------------------------------*/
    $cart_sql = "SELECT c.product_id, c.product_qty as product_qty, p.price as product_price
    FROM carts c, products p 
    WHERE c.product_id = p.id AND c.user_id = '$user_id' 
    ORDER BY c.id DEsC;";
    $cart_sql_run = mysqli_query($connection, $cart_sql);
    $total_price  = 0;

    if ($cart_sql_run) {
      if (mysqli_num_rows($cart_sql_run) > 0) {
        foreach ($cart_sql_run as $cart_items) {
          $total_price += $cart_items['product_price'] * $cart_items['product_qty'];
        }
        $total_price += $delivery;
      } else{
        $_SESSION['cart_type'] = "error";
        $_SESSION['cart_add_message'] = 'No product foud! ';
        header('Location: ../checkout.php');
      }
    }
    /*-------------------------------------------------------------------------------------*/
    // add card_id as foreihn key (to do later)
    if($delivery_type != 'delivery_type' && $total_price != 0 && $choosen_payment != 'choosen_payment'){
      $sql = "";
      if($delivery_type == 'Delivery' && $choosen_address != 'choosen_address'){
        $sql = "INSERT INTO orders (tracking_no,	userd_id,	delivery_mode,	address_id,	total_price, delivery_fee,	payment_mode,	payment_id, status)
                VALUES('$tracking_no', '$user_id', '$delivery_type', '$choosen_address', '$total_price', '$delivery', '$choosen_payment', '$payment_id', 'In Progress')";
      } else{
        $sql = "INSERT INTO orders (tracking_no,	userd_id,	delivery_mode,total_price, delivery_fee, payment_mode,	payment_id, status)
        VALUES('$tracking_no', '$user_id', '$delivery_type', '$total_price', '$delivery', '$choosen_payment', '$payment_id', 'In Progress')";
      }

      $insert_query_run = mysqli_query($connection, $sql);

      if($insert_query_run){
        $order_id = mysqli_insert_id($connection);
        foreach($cart_sql_run as $cart_items){
          $product_id = $cart_items['product_id'];
          $product_qty = $cart_items['product_qty'];
          $product_price = $cart_items['product_price'];

          $insert_items_query = "INSERT INTO order_items (order_id,	product_id,	qty,	price)
              VALUES('$order_id', '$product_id', '$product_qty', '$product_price')";
          $insert_items_query_run = mysqli_query($connection, $insert_items_query);

          $product_sql = "SELECT * FROM products WHERE id = '$product_id' LIMIT 1";
          $product_sql_run = mysqli_query($connection, $product_sql);

          $product_data = mysqli_fetch_array($product_sql_run);
          $current_qty = $product_data['quantitty'];

          $new_qty = $current_qty - $product_qty;

          $update_qty_query = "UPDATE products SET quantitty = '$new_qty' WHERE id = '$product_id'";
          $update_qty_query_run = mysqli_query($connection, $update_qty_query);
        }
        $selete_cart_query = "DELETE FROM carts WHERE user_id = '$user_id'";
        $selete_cart_query_run = mysqli_query($connection, $selete_cart_query);

         $_SESSION['cart_type'] = "success";
        $_SESSION['cart_add_message'] = 'Order Placed Sucessfully!';
        header('Location: ../customer_info.php#cust_page2');
      }else{
        $_SESSION['cart_type'] = "error";
        $_SESSION['cart_add_message'] = 'Order placement failed: '.$connection->error;
        header('Location: ../checkout.php');
      }
      
    }else{
      $_SESSION['cart_type'] = "info";
      $_SESSION['cart_add_message'] = 'Fill in all the information needed!';
      header('Location: ../checkout.php');
    }
  }else{
    die("Payment not completed.");
  }

}else{
  $_SESSION['cart_type'] = "info";
  $_SESSION['cart_add_message'] = 'Login to continue!';
  header('Location: ../checkout.php');
}

?>