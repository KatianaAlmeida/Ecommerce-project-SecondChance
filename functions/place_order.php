<?php

session_start();
include('../config/dbcon.php');

/* =========================================== */
function move_to($page) {
  if($page == 'checkout_page'){
    header('Location: ../checkout.php');
  }else{
    header('Location: ../customer_info.php#cust_page3');
  }
}

if(isset($_POST['save_address_btn'])){
  $page = mysqli_real_escape_string($connection, $_POST['page']);
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
      move_to($page);
    }else{
      $_SESSION['adress_added'] = 'Error: '.$connection->error;
      move_to($page);
    }
    
  }else{
    $_SESSION['adress_added'] = 'Login to continue!';
    move_to($page);
  }
}

if(isset($_POST['delete_address_btn'])){
  $page = mysqli_real_escape_string($connection, $_POST['page']);
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
        $_SESSION['adress_added'] = 'Address Deleted!';
        move_to($page);
      }else{
        $_SESSION['adress_added'] = 'Error: '.$connection->error;
        move_to($page);
      }
    }else{
      $_SESSION['adress_added'] = 'Error: '.$connection->error;
      move_to($page);
    }
  }else{
    $_SESSION['adress_added'] = 'Login to continue!';
    move_to($page);
  }
}
/* =========================================== */

if(isset($_POST['make_checkout_btn'])){
  if(isset($_SESSION['auth'])){
    $delivery_type = mysqli_real_escape_string($connection, $_POST['delivery_type_h']);
    $choosen_address = mysqli_real_escape_string($connection, $_POST['choosen_address_h']);
    $choosen_payment = mysqli_real_escape_string($connection, $_POST['choosen_payment_h']);
    $delivery = mysqli_real_escape_string($connection, $_POST['delivery']);

    $payment_id = mysqli_real_escape_string($connection, $_POST['payment_id']);
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
        $_SESSION['cart_add_message'] = 'No product foud! ';
        header('Location: ../checkout.php');
      }
    }
    /*-------------------------------------------------------------------------------------*/

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

          $product_sql = "SELECT * FROM products WHERE id = '$product_id ' LIMIT 1";
          $product_sql_run = mysqli_query($connection, $product_sql);

          $product_data = mysqli_fetch_array($product_sql_run);
          $current_qty = $product_data['quantitty'];

          $new_qty = $current_qty - $product_qty;

          $update_qty_query = "UPDATE products SET quantitty = '$new_qty' WHERE id = '$product_id'";
          $update_qty_query_run = mysqli_query($connection, $update_qty_query);
        }
        $selete_cart_query = "DELETE FROM carts WHERE user_id = '$user_id'";
        $selete_cart_query_run = mysqli_query($connection, $selete_cart_query);

        $_SESSION['cart_add_message'] = 'Order Placed Sucessfully!';
        header('Location: ../customer_info.php#cust_page2');
      }else{
        $_SESSION['cart_add_message'] = 'Order placement failed: '.$connection->error;
        header('Location: ../checkout.php');
      }
      
    }else{
      $_SESSION['cart_add_message'] = 'Fill in all the information needed!';
      header('Location: ../checkout.php');
    }
  }else{
    $_SESSION['cart_add_message'] = 'Login to continue!';
    header('Location: ../checkout.php');
  }
}

/* =========================================== */
function move_to1($page) {
  if($page == 'checkout_page'){
    header('Location: ../checkout.php');
  }else{
    header('Location: ../customer_info.php#cust_page4');
  }
}

if(isset($_POST['save_card_btn'])){
  $page = mysqli_real_escape_string($connection, $_POST['page']);
  if(isset($_SESSION['auth'])){
    $name_on_card = mysqli_real_escape_string($connection, $_POST['name_on_card']);
    $card_number = mysqli_real_escape_string($connection, $_POST['card_number']);
    $expiry_month = mysqli_real_escape_string($connection, $_POST['expiry_month']);
    $expiry_year = mysqli_real_escape_string($connection, $_POST['expiry_year']);
    $cvv = mysqli_real_escape_string($connection, $_POST['cvv']);
    $user_id = $_SESSION['auth_user']['id'];

    $sql = "INSERT INTO card_details (name_on_card,	card_number,	expiry_month,	expiry_year,	cvv,	user_id) 
            VALUES('$name_on_card', '$card_number', '$expiry_month', '$expiry_year', '$cvv', '$user_id')";
    $insert_query_run = mysqli_query($connection, $sql);

    if($insert_query_run){
      $_SESSION['card_added'] = 'Cart Added Sucessfully!';
      move_to1($page);
    }else{
      $_SESSION['card_added'] = 'Error: '.$connection->error;
      move_to1($page);
    }
    
  }else{
    $_SESSION['card_added'] = 'Login to continue!';
    move_to1($page);
  }
}

if(isset($_POST['delete_card_btn'])){
  $page = mysqli_real_escape_string($connection, $_POST['page']);
  if(isset($_SESSION['auth'])){
    $card_id = mysqli_real_escape_string($connection, $_POST['card_id']);
    $user_id = $_SESSION['auth_user']['id'];

    
    $check_existing_card = "SELECT * FROM card_details WHERE id = '$card_id' AND user_id = '$user_id'";
    $check_existing_card_run = mysqli_query($connection, $check_existing_card);

    if ($check_existing_card_run && mysqli_num_rows($check_existing_card_run) > 0) {
      // Delete
      $sql = "DELETE FROM card_details WHERE user_id = '$user_id' AND id = '$card_id'";;
      $delete_query_run = mysqli_query($connection, $sql);

      if($delete_query_run){
        $_SESSION['card_added'] = 'Card Deleted!';
        move_to1($page);
      }else{
        $_SESSION['card_added'] = 'Error: '.$connection->error;
        move_to1($page);
      }
    }else{
      $_SESSION['card_added'] = 'Error: '.$connection->error;
      move_to1($page);
    }
  }else{
    $_SESSION['card_added'] = 'Login to continue!';
    move_to1($page);
  }
}
?>