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
    $product_qty = mysqli_real_escape_string($connection, $_POST['update_cart_']);
    $product_id = mysqli_real_escape_string($connection, $_POST['product_id']);
    $user_id = $_SESSION['auth_user']['id'];

    echo "quantity ".$_SESSION['new_qty'];

    /*
    $check_existing_cart = "SELECT * FROM carts WHERE user_id ='$user_id' AND	product_id = ' $product_id'";
    $check_existing_cart_run = mysqli_query($connection, $check_existing_cart);

    if ($check_existing_cart_run && mysqli_num_rows($check_existing_cart_run) > 0) {
      // update
      $sql = "INSERT INTO carts (user_id,	product_id,	product_qty) VALUES('$user_id', '$product_id', '$quantity')";
      $insert_query_run = mysqli_query($connection, $sql);
  
      if($insert_query_run){
        $_SESSION['cart_add_message'] = 'Product Added Sucessfully!';
        header('Location: ../cart_page.php');
      }else{
        $_SESSION['cart_add_message'] = 'Error: '.$connection->error;
        header('Location: ../cart_page.php');
      }

    }else{
      $_SESSION['cart_add_message'] = 'Error: '.$connection->error;
      header('Location: ../cart_page.php');
    }*/
  }else{
    $_SESSION['cart_add_message'] = 'Login to continue!';
    header('Location: ../cart_page.php');
  }
}

if(isset($_POST['update-btn'])){
  $product_name = mysqli_real_escape_string($connection, $_POST['product_name']);
  $category_id = mysqli_real_escape_string($connection, $_POST['category_id']);
  $name = mysqli_real_escape_string($connection, $_POST['name']);
  $description = mysqli_real_escape_string($connection, $_POST['description']);
  $price = mysqli_real_escape_string($connection, $_POST['price']);
  $quantity = mysqli_real_escape_string($connection, $_POST['quantity']);

  //$status = isset($_POST['status']) ? 'Visible':'Hidden';

  $path = "../uploads";

  $image1 = $_FILES['image1']['name'];
  $image2 = $_FILES['image2']['name'];
  $image3 = $_FILES['image3']['name'];
  
  // SQL to retrieve id based on username
  $sql = "SELECT id FROM products WHERE product_name = '$product_name'";
  $result =  mysqli_query($connection, $sql);

  if ($result) {
    if ($result->num_rows > 0) {
      // Fetch the product ID
      $row = $result->fetch_assoc();
      $product_id = $row['id'];

      if(($category_id == null || $category_id == '') && ($name == null || $name == '') && ($description == null || $description == '') && ($price == null || $price == '')&& ($quantity == null || $quantity == '')&& ($image1 == null || $image1 == '')&& ($image2 == null || $image2 == '')&& ($image3 == null || $image3 == '')){
        $_SESSION['update_message'] = 'Field is empty!';
        header('Location: ../update_products.php');
      }

      // category id
      if($category_id != null || $category_id != ''){
        $sql_category_id = "UPDATE products SET category_id = '$category_id' WHERE id = $product_id";
        $update_category_id_run = mysqli_query($connection, $sql_category_id);
        if($update_category_id_run){
          $_SESSION['update_message'] = 'Updated Successfully!';
          header('Location: ../update_products.php');
        }else{
          $_SESSION['update_message'] = "Error updating user's detail".$connection->error;
          header('Location: ../update_products.php');
        }
      }

      // name
      if($name != null || $name != ''){
        $sql_name = "UPDATE products SET product_name = '$name' WHERE id = $product_id";
        $update_name_run = mysqli_query($connection, $sql_name);
        if($update_name_run){
          $_SESSION['update_message'] = 'Updated Successfully!';
          header('Location: ../update_products.php');
        }else{
          $_SESSION['update_message'] = "Error updating user's detail".$connection->error;
          header('Location: ../update_products.php');
        }
      }

      // description
      if($description != null || $description != ''){
        $sql_description = "UPDATE products SET product_description = '$description' WHERE id = $product_id";
        $update_description_run = mysqli_query($connection, $sql_description);
        if($update_description_run){
          $_SESSION['update_message'] = 'Updated Successfully!';
          header('Location: ../update_products.php');
        }else{
          $_SESSION['update_message'] = "Error updating user's detail".$connection->error;
          header('Location: ../update_products.php');
        }
      }

      // price
      if($price != null || $price != ''){
        $sql_price = "UPDATE products SET price = '$price' WHERE id = $product_id";
        $update_price_run = mysqli_query($connection, $sql_price);
        if($update_price_run){
          $_SESSION['update_message'] = 'Updated Successfully!';
          header('Location: ../update_products.php');
        }else{
          $_SESSION['update_message'] = "Error updating user's detail".$connection->error;
          header('Location: ../update_products.php');
        }
      }

      // quantity
      if($quantity != null || $quantity != ''){
        $sql_quantity = "UPDATE products SET quantitty = '$quantity' WHERE id = $product_id";
        $update_quantity_run = mysqli_query($connection, $sql_quantity);
        if($update_quantity_run){
          $_SESSION['update_message'] = 'Updated Successfully!';
          header('Location: ../update_products.php');
        }else{
          $_SESSION['update_message'] = "Error updating user's detail".$connection->error;
          header('Location: ../update_products.php');
        }
      }

      // image 1
      if($image1 != ""){
        $image_extention1 = pathinfo($image1, PATHINFO_EXTENSION);
        $filename1 = time().'.'.$image_extention1;

        $sql_image1 = "UPDATE products SET image_1 = '$filename1' WHERE id = $product_id";
        $update_image1_run = mysqli_query($connection, $sql_image1);
        if($update_image1_run){
          move_uploaded_file($_FILES['image1']['tmp_name'], $path.'/'.$filename1);
          $_SESSION['update_message'] = 'Updated Successfully!';
          header('Location: ../update_products.php');
        }else{
          $_SESSION['update_message'] = "Error updating user's detail".$connection->error;
          header('Location: ../update_products.php');
        }
      }

      // image 2
      if($image2 != ""){
        $image_extention2 = pathinfo($image2, PATHINFO_EXTENSION);
        $filename2 = time().'.'.$image_extention2;
        
        $sql_image2 = "UPDATE products SET image_2 = '$filename2' WHERE id = $product_id";
        $update_image2_run = mysqli_query($connection, $sql_image2);
        if($update_image2_run){
          move_uploaded_file($_FILES['image2']['tmp_name'], $path.'/'.$filename2);
          $_SESSION['update_message'] = 'Updated Successfully!';
          header('Location: ../update_products.php');
        }else{
          $_SESSION['update_message'] = "Error updating user's detail".$connection->error;
          header('Location: ../update_products.php');
        }        
      }

      // image 3
      if($image3 != ""){
        $image_extention3 = pathinfo($image3, PATHINFO_EXTENSION);
        $filename3 = time().'.'.$image_extention3;
        
        $sql_image3 = "UPDATE products SET image_3 = '$filename3' WHERE id = $product_id";
        $update_image3_run = mysqli_query($connection, $sql_image3);
        if($update_image3_run){
          move_uploaded_file($_FILES['image3']['tmp_name'], $path.'/'.$filename3);
          $_SESSION['update_message'] = 'Updated Successfully!';
          header('Location: ../update_products.php');
        }else{
          $_SESSION['update_message'] = "Error updating user's detail".$connection->error;
          header('Location: ../update_products.php');
        }        
      }

    } else {
      $_SESSION['update_message'] = "Product not found". $connection->error;;
      header('Location: ../update_products.php');
    }
    // Free result set
    $result->free();
  } else {
    $_SESSION['update_message'] = 'No Product found with that name!';
    header('Location: ../update_products.php');
  }
}

if(isset($_POST['delete_products-btn'])){
  $product_id = mysqli_real_escape_string($connection, $_POST['product_id']);

  $sql = "DELETE FROM products WHERE id='$product_id'";
  $result =  mysqli_query($connection, $sql);

  if ($result) {
    $_SESSION['delete_message'] = 'Product Deleted Sucessfully';
    header('Location: ../add_products.php');
  }else{
    $_SESSION['delete_message'] = 'Someting Went Wrong'.$connection->error;
    header('Location: ../add_products.php');
  }
}

if(isset($_POST['product_id-btn'])){
  $product_id = mysqli_real_escape_string($connection, $_POST['product_id']);
  $product_name = mysqli_real_escape_string($connection, $_POST['product_name']);

  $_SESSION['getID_message'] = 'You are updating product number '.$product_id.' {'.$product_name.'}';
  $_SESSION['name'] = $product_name;
  header('Location: ../update_products.php');
}

?>