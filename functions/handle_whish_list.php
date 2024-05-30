<?php

session_start();
include('../config/dbcon.php');

if(isset($_POST['add_whish_btn'])){
  $SKU = mysqli_real_escape_string($connection, $_POST['SKU']);
  if(isset($_SESSION['auth'])){
    $product_id = mysqli_real_escape_string($connection, $_POST['product_id']);
    $user_id = $_SESSION['auth_user']['id'];

    $product_query =  "SELECT * FROM wishlist WHERE product_id = '$product_id' AND user_id = '$user_id'";
    $result = mysqli_query($connection, $product_query);

    if($result && mysqli_num_rows($result) > 0){
      $_SESSION['cart_add_message'] = 'Product is alredy in the whish list!';
      header('Location: ../each_product_view.php?product='.$SKU.'');
    }else{
      $sql = "INSERT INTO wishlist (user_id,	product_id) VALUES ('$user_id', '$product_id')";
      $insert_query_run = mysqli_query($connection, $sql);
  
      if($insert_query_run){
        $_SESSION['cart_add_message'] = 'Product added to the Which List Sucessfully!';
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

if(isset($_POST['delete_btn'])){
  $SKU = mysqli_real_escape_string($connection, $_POST['SKU']);
  if(isset($_SESSION['auth'])){
    $product_id = mysqli_real_escape_string($connection, $_POST['product_id']);
    $user_id = $_SESSION['auth_user']['id'];

    
    $check_existing_cart = "SELECT * FROM reviews WHERE user_id = '$user_id' AND product_id = '$product_id'";
    $check_existing_cart_run = mysqli_query($connection, $check_existing_cart);

    if ($check_existing_cart_run && mysqli_num_rows($check_existing_cart_run) > 0) {
      // Delete
      $sql = "DELETE FROM reviews WHERE user_id = '$user_id' AND product_id = '$product_id'";;
      $delete_query_run = mysqli_query($connection, $sql);

      if($delete_query_run){
        $_SESSION['cart_add_message'] = 'Review Deleted!';
        header('Location: ../each_product_view.php?product='.$SKU.'');
      }else{
        $_SESSION['cart_add_message'] = 'Error: '.$connection->error;
        header('Location: ../each_product_view.php?product='.$SKU.'');
      }
    }else{
      $_SESSION['cart_add_message'] = 'Error: '.$connection->error;
      header('Location: ../each_product_view.php?product='.$SKU.'');
    }
  }else{
    $_SESSION['cart_add_message'] = 'Login to continue!';
    header('Location: ../each_product_view.php?product='.$SKU.'');
  }
}
?>