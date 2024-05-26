<?php

session_start();
include('../config/dbcon.php');

if(isset($_POST['publish_review_btn'])){
  $SKU = mysqli_real_escape_string($connection, $_POST['SKU']);
  if(isset($_SESSION['auth'])){
    $review_title = mysqli_real_escape_string($connection, $_POST['review_title']);
    $review_content = mysqli_real_escape_string($connection, $_POST['review_content']);
    $review_rating = mysqli_real_escape_string($connection, $_POST['review_rating']);
    $product_id = mysqli_real_escape_string($connection, $_POST['product_id']);
    $user_id = $_SESSION['auth_user']['id'];

    $image = $_FILES['image']['name'];
    $path = "../uploads";
    $image_extention = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time().'.'.$image_extention;

    if($review_title == '' && $review_content == ''){
      $_SESSION['cart_add_message'] = 'Cant Submit Empty Review!';
      header('Location: ../each_product_view.php?product='.$SKU.'');
    } else{
      $product_query =  "SELECT * FROM reviews WHERE product_id = '$product_id' AND user_id = '$user_id'";
      $result = mysqli_query($connection, $product_query);
  
      if($result && mysqli_num_rows($result) > 0){
        $_SESSION['cart_add_message'] = 'There is a review on this product alredy, just update the existing one!';
        header('Location: ../each_product_view.php?product='.$SKU.'');
      }else{
        $sql = "INSERT INTO reviews (title, content, rating, image, user_id, product_id) VALUES ('$review_title', '$review_content', '$review_rating', '$filename', '$user_id', '$product_id')";
        $insert_query_run = mysqli_query($connection, $sql);
    
        if($insert_query_run){
          move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);
          $_SESSION['cart_add_message'] = 'Review Submited Sucessfully!';
          header('Location: ../each_product_view.php?product='.$SKU.'');
        }else{
          $_SESSION['cart_add_message'] = 'Error: '.$connection->error;
          header('Location: ../each_product_view.php?product='.$SKU.'');
        }
      }
    }
    
  }else{
    $_SESSION['cart_add_message'] = 'Login to continue!';
    header('Location: ../each_product_view.php?product='.$SKU.'');
  }
}

if(isset($_POST['update_review_btn'])){
  $SKU = mysqli_real_escape_string($connection, $_POST['SKU']);
  if(isset($_SESSION['auth'])){
    $review_title = mysqli_real_escape_string($connection, $_POST['review_title']);
    $review_content = mysqli_real_escape_string($connection, $_POST['review_content']);
    $review_rating = mysqli_real_escape_string($connection, $_POST['review_rating']);
    $product_id = mysqli_real_escape_string($connection, $_POST['product_id']);
    $user_id = $_SESSION['auth_user']['id'];

    $image = $_FILES['image']['name'];
    $path = "../uploads";
    $image_extention = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time().'.'.$image_extention;

    if($review_title == '' && $review_content == ''){
      $_SESSION['cart_add_message'] = 'Cant Submit Empty Review!';
      header('Location: ../each_product_view.php?product='.$SKU.'');
    } else{
      $product_query =  "SELECT * FROM reviews WHERE product_id = '$product_id' AND user_id = '$user_id'";
      $result = mysqli_query($connection, $product_query);
  
      if($result && mysqli_num_rows($result) > 0){
        $sql =  "UPDATE reviews SET title = '$review_title', content = '$review_content', rating = '$review_rating', image = '$filename'
          WHERE user_id = '$user_id' AND product_id = '$product_id'";
        $update_query_run = mysqli_query($connection, $sql);
        
        if($update_query_run){
          move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);
          $_SESSION['cart_add_message'] = 'Review Updated Sucessfully!';
          header('Location: ../each_product_view.php?product='.$SKU.'');
        }else{
          $_SESSION['cart_add_message'] = 'Error: '.$connection->error;
          header('Location: ../each_product_view.php?product='.$SKU.'');
        }
      }else{
        $_SESSION['cart_add_message'] = 'There is no review on this product, add one!';
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