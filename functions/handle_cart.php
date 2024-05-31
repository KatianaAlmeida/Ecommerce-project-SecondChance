<?php

session_start();
include('../config/dbcon.php');

/* ====================== Cart ======================= */
function move_to($page, $SKU, $connection) {
  if($page == 'shop_all'){
    header('Location: ../shop_all.php');
  } else if($page == 'category_search'){
    $category_name = mysqli_real_escape_string($connection, $_POST['category_name']);
    header('Location: ../prodcuts.php?category='.$category_name.'');
  }else{
    header('Location: ../each_product_view.php?product='.$SKU.'');
  }
}

if(isset($_POST['add_to_cart-btn'])){
  $SKU = mysqli_real_escape_string($connection, $_POST['SKU']);
  $page = mysqli_real_escape_string($connection, $_POST['page']);
  if(isset($_SESSION['auth'])){
    $quantity = mysqli_real_escape_string($connection, $_POST['quantity']);
    $product_id = mysqli_real_escape_string($connection, $_POST['product_id']);
    $user_id = $_SESSION['auth_user']['id'];

    //echo "quantity ".$quantity." product_id ".$product_id." user_id ".$user_id;

    $check_existing_cart = "SELECT * FROM carts WHERE user_id ='$user_id' AND	product_id = ' $product_id'";
    $check_existing_cart_run = mysqli_query($connection, $check_existing_cart);

    if ($check_existing_cart_run && mysqli_num_rows($check_existing_cart_run) > 0) {
      $_SESSION['cart_add_message'] = 'Product alredy in Cart!';
      move_to($page, $SKU, $connection);

    }else{
      $sql = "INSERT INTO carts (user_id,	product_id,	product_qty) VALUES('$user_id', '$product_id', '$quantity')";
      $insert_query_run = mysqli_query($connection, $sql);
  
      if($insert_query_run){
        $_SESSION['cart_add_message'] = 'Product Added Sucessfully!';
        move_to($page, $SKU, $connection);
      }else{
        $_SESSION['cart_add_message'] = 'Error: '.$connection->error;
        move_to($page, $SKU, $connection);
      }
    }
  }else{
    $_SESSION['cart_add_message'] = 'Login to continue!';
    move_to($page, $SKU, $connection);
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

/* ====================== wishlist ======================= */

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

if(isset($_POST['delete_wishlist_btn'])){
  if(isset($_SESSION['auth'])){
    $wishlist_id = mysqli_real_escape_string($connection, $_POST['wishlist_id']);
    $user_id = $_SESSION['auth_user']['id'];

    
    $check_existing_wishlist = "SELECT * FROM wishlist WHERE id = '$wishlist_id' AND user_id = '$user_id'";
    $wishlist_query_run = mysqli_query($connection, $check_existing_wishlist);

    if ($wishlist_query_run && mysqli_num_rows($wishlist_query_run) > 0) {
      // Delete
      $sql = "DELETE FROM wishlist WHERE user_id = '$user_id' AND id = '$wishlist_id'";;
      $delete_query_run = mysqli_query($connection, $sql);

      if($delete_query_run){
        $_SESSION['cart_add_message'] = 'Product Deleted from Wishlist!';
        header('Location: ../customer_info.php#cust_page5');
      }else{
        $_SESSION['cart_add_message'] = 'Error: '.$connection->error;
        header('Location: ../customer_info.php#cust_page5');
      }
    }else{
      $_SESSION['cart_add_message'] = 'Product was never in the Wishlist';
      header('Location: ../customer_info.php#cust_page5');
    }
  }else{
    $_SESSION['cart_add_message'] = 'Login to continue!';
    header('Location: ../customer_info.php#cust_page5');
  }
}
?>