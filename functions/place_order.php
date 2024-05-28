<?php

session_start();
include('../config/dbcon.php');

if(isset($_POST['save_address_btn'])){
  if(isset($_SESSION['auth'])){
    $address_type = mysqli_real_escape_string($connection, $_POST['address_type']);
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $phone_number = mysqli_real_escape_string($connection, $_POST['phone_number']);
    $complex_name = mysqli_real_escape_string($connection, $_POST['complex_name']);
    $address_street = mysqli_real_escape_string($connection, $_POST['address_street']);
    $suburb = mysqli_real_escape_string($connection, $_POST['suburb']);
    $town = mysqli_real_escape_string($connection, $_POST['town']);
    $province = mysqli_real_escape_string($connection, $_POST['province']);
    $postal_code = mysqli_real_escape_string($connection, $_POST['postal_code']);
    $user_id = $_SESSION['auth_user']['id'];

    $sql = "INSERT INTO address_book (recipient_name, address_type,	complex_name, address_street,	phone_number, suburb, town, province, postal_code, user_id) 
            VALUES('$name', '$address_type', '$complex_name', '$address_street', '$phone_number', '$suburb', '$town', '$province', '$postal_code', '$user_id')";
    $insert_query_run = mysqli_query($connection, $sql);

    if($insert_query_run){
      $_SESSION['adress_added'] = 'Address Added Sucessfully!';
      header('Location: ../checkout.php');
    }else{
      $_SESSION['adress_added'] = 'Error: '.$connection->error;
      header('Location: ../checkout.php');
    }
    
  }else{
    $_SESSION['adress_added'] = 'Login to continue!';
    header('Location: ../checkout.php');
  }
}

if(isset($_POST['delete_address_btn'])){
  if(isset($_SESSION['auth'])){
    $address_id = mysqli_real_escape_string($connection, $_POST['address_id']);
    $user_id = $_SESSION['auth_user']['id'];

    
    $check_existing_address = "SELECT * FROM address_book WHERE id = '$address_id' AND user_id = '$user_id'";
    $check_existing_address_run = mysqli_query($connection, $check_existing_address);

    if ($check_existing_address_run && mysqli_num_rows($check_existing_address_run) > 0) {
      // Delete
      $sql = "DELETE FROM address_book WHERE user_id = '$user_id' AND id = '$address_id'";;
      $delete_query_run = mysqli_query($connection, $sql);

      if($delete_query_run){
        $_SESSION['cart_add_message'] = 'Address Deleted!';
        header('Location: ../checkout.php');
      }else{
        $_SESSION['cart_add_message'] = 'Error: '.$connection->error;
        header('Location: ../checkout.php');
      }
    }else{
      $_SESSION['cart_add_message'] = 'Error: '.$connection->error;
      header('Location: ../checkout.php');
    }
  }else{
    $_SESSION['cart_add_message'] = 'Login to continue!';
    header('Location: ../checkout.php');
  }
}

if(isset($_POST['make_checkout_btn'])){
  if(isset($_SESSION['auth'])){
    $delivery_type = mysqli_real_escape_string($connection, $_POST['delivery_type_h']);
    $choosen_address = mysqli_real_escape_string($connection, $_POST['choosen_address_h']);
    $choosen_payment = mysqli_real_escape_string($connection, $_POST['choosen_payment_h']);

    $payment_id = mysqli_real_escape_string($connection, $_POST['payment_id']);
    $user_id = $_SESSION['auth_user']['id'];
    $tracking_no = "secondchange".rand(1111, 9999).substr($phone, 2);
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
      } else{
        $_SESSION['cart_add_message'] = 'No product foud! ';
        header('Location: ../checkout.php');
      }
    }else{
      $_SESSION['cart_add_message'] = 'Order placement failed: '.$connection->error;
      header('Location: ../checkout.php');
    }
    /*-------------------------------------------------------------------------------------*/
    
    if($delivery_type == "" || $choosen_address == "" || $total_price == "" || $choosen_payment == ""){
      $_SESSION['cart_add_message'] = 'Fill in all the '.$delivery_type.'  '.$choosen_address.'  '.$total_price.'  '.$choosen_payment;
      header('Location: ../checkout.php');
    }else{
      $sql = "INSERT INTO orders (tracking_no,	userd_id,	delivery_mode,	address_id,	total_price,	payment_mode,	payment_id)
              VALUES('$tracking_no', '$user_id', '$delivery_type', '$choosen_address', '$total_price', '$choosen_payment', '$payment_id')";
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
        }
        $selete_cart_query = "DELETE FROM carts WHERE user_id = '$user_id'";
        $selete_cart_query_run = mysqli_query($connection, $selete_cart_query);

        $_SESSION['cart_add_message'] = 'Order Placed Sucessfully!';
        header('Location: ../cart_page.php');
      }else{
        $_SESSION['cart_add_message'] = 'Order placement failed: '.$connection->error;
        header('Location: ../checkout.php');
      }
    }
  }else{
    $_SESSION['cart_add_message'] = 'Login to continue!';
    header('Location: ../checkout.php');
  }
}
?>