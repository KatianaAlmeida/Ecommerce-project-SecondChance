<?php

session_start();
include('../config/dbcon.php');

/* =========================================== */
function move_to($page) {
  if($page == 'checkout_page'){
    header('Location: ../checkout.php');
  } else if($page == 'customer_info'){
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
function move_to1($page) {
  if($page == 'checkout_page'){
    header('Location: ../checkout.php');
  } else if($page == 'customer_info'){
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