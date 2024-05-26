<?php

session_start();
include('../config/dbcon.php');

if(isset($_POST['add_to_cart-btn'])){
  $SKU = mysqli_real_escape_string($connection, $_POST['SKU']);
  if(isset($_SESSION['auth'])){
    $quantity = mysqli_real_escape_string($connection, $_POST['quantity']);
    $product_id = mysqli_real_escape_string($connection, $_POST['product_id']);
    $user_id = $_SESSION['auth_user']['id'];

    //echo "quantity ".$quantity." product_id ".$product_id." user_id ".$user_id;

    $check_existing_cart = "SELECT * FROM carts WHERE user_id ='$user_id' AND	product_id = ' $product_id'";
    $check_existing_cart_run = mysqli_query($connection, $check_existing_cart);

    if ($check_existing_cart_run && mysqli_num_rows($check_existing_cart_run) > 0) {
      $_SESSION['cart_add_message'] = 'Product alredy in Cart!';
      header('Location: ../each_product_view.php?product='.$SKU.'');

    }else{
      $sql = "INSERT INTO carts (user_id,	product_id,	product_qty) VALUES('$user_id', '$product_id', '$quantity')";
      $insert_query_run = mysqli_query($connection, $sql);
  
      if($insert_query_run){
        $_SESSION['cart_add_message'] = 'Product Added Sucessfully!';
        header('Location: ../each_product_view.php?product='.$SKU.'');
      }else{
        $_SESSION['cart_add_message'] = 'Error: '.$connection->error;
        header('Location: ../each_product_view.php?product='.$SKU.'');
      }
    }
  }else{
    $_SESSION['cart_add_message'] = 'Login to continue!';
    header('Location: ../each_product_view.php?product='.$SKU.'');
  }
}

if(isset($_POST['update_cart_btn'])){
  if(isset($_SESSION['auth'])){
    $product_qty = mysqli_real_escape_string($connection, $_POST['product_qty']);
    $product_id = mysqli_real_escape_string($connection, $_POST['product_id']);
    $user_id = $_SESSION['auth_user']['id'];

    
    $check_existing_cart = "SELECT * FROM carts WHERE user_id = '$user_id' AND product_id = '$product_id'";
    $check_existing_cart_run = mysqli_query($connection, $check_existing_cart);

    if ($check_existing_cart_run && mysqli_num_rows($check_existing_cart_run) > 0) {
      if($product_qty != 0){
        // Update
        $sql = "UPDATE carts SET product_qty = '$product_qty' WHERE product_id = '$product_id' AND user_id = '$user_id'";;
        $update_query_run = mysqli_query($connection, $sql);

        if($update_query_run){
          $_SESSION['cart_add_message'] = 'Product Updated Sucessfully!';
          header('Location: ../cart_page.php');
        }else{
          $_SESSION['cart_add_message'] = 'Error: '.$connection->error;
          header('Location: ../cart_page.php');
        }
      }else{
        // Delete
        $sql = "DELETE FROM carts WHERE user_id = '$user_id' AND product_id = '$product_id'";;
        $delete_query_run = mysqli_query($connection, $sql);

        if($delete_query_run){
          $_SESSION['cart_add_message'] = 'Product Deleted!';
          header('Location: ../cart_page.php');
        }else{
          $_SESSION['cart_add_message'] = 'Error: '.$connection->error;
          header('Location: ../cart_page.php');
        }
      }
      
    }else{
      $_SESSION['cart_add_message'] = 'Error: '.$connection->error;
      header('Location: ../cart_page.php');
    }
  }else{
    $_SESSION['cart_add_message'] = 'Login to continue!';
    header('Location: ../cart_page.php');
  }
}

if(isset($_POST['delete_prod_btn'])){
  if(isset($_SESSION['auth'])){
    $product_id = mysqli_real_escape_string($connection, $_POST['product_id']);
    $user_id = $_SESSION['auth_user']['id'];

    
    $check_existing_cart = "SELECT * FROM carts WHERE user_id = '$user_id' AND product_id = '$product_id'";
    $check_existing_cart_run = mysqli_query($connection, $check_existing_cart);

    if ($check_existing_cart_run && mysqli_num_rows($check_existing_cart_run) > 0) {
      // Delete
      $sql = "DELETE FROM carts WHERE user_id = '$user_id' AND product_id = '$product_id'";;
      $delete_query_run = mysqli_query($connection, $sql);

      if($delete_query_run){
        $_SESSION['cart_add_message'] = 'Product Deleted!';
        header('Location: ../cart_page.php');
      }else{
        $_SESSION['cart_add_message'] = 'Error: '.$connection->error;
        header('Location: ../cart_page.php');
      }
    }else{
      $_SESSION['cart_add_message'] = 'Error: '.$connection->error;
      header('Location: ../cart_page.php');
    }
  }else{
    $_SESSION['cart_add_message'] = 'Login to continue!';
    header('Location: ../cart_page.php');
  }
}
?>