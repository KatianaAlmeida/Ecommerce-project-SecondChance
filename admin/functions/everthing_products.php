<?php

session_start();
include('../../config/dbcon.php');

if (isset($_POST['add_product-btn'])) {
  $category_id = mysqli_real_escape_string($connection, $_POST['category_id']);
  $name = mysqli_real_escape_string($connection, $_POST['name']);
  $description = mysqli_real_escape_string($connection, $_POST['description']);
  $price = mysqli_real_escape_string($connection, $_POST['price']);
  $quantity = mysqli_real_escape_string($connection, $_POST['quantity']);

  //$status = isset($_POST['status']) ? 'Visible':'Hidden';

  $path = "../uploads";

  $image1 = $_FILES['image1']['name'];
  $image_extention1 = pathinfo($image1, PATHINFO_EXTENSION);
  $filename1 = time() . '.' . $image_extention1;

  $image2 = $_FILES['image2']['name'];
  $image_extention2 = pathinfo($image2, PATHINFO_EXTENSION);
  $filename2 = time() . '.' . $image_extention2;

  $image3 = $_FILES['image3']['name'];
  $image_extention3 = pathinfo($image3, PATHINFO_EXTENSION);
  $filename3 = time() . '.' . $image_extention3;

  $sql = "INSERT INTO products (product_name	, product_description, price, quantitty, image_1, image_2, image_3, category_id) 
  VALUES('$name', '$description', '$price', '$quantity', '$filename1', '$filename1', '$filename3', '$category_id')";
  $check_query_run = mysqli_query($connection, $sql);

  if ($check_query_run) {
    move_uploaded_file($_FILES['image1']['tmp_name'], $path . '/' . $filename1);
    move_uploaded_file($_FILES['image2']['tmp_name'], $path . '/' . $filename2);
    move_uploaded_file($_FILES['image3']['tmp_name'], $path . '/' . $filename3);
    $_SESSION['message'] = 'Product Added Sucessfully!';
    header('Location: ../add_products.php');
  } else {
    $_SESSION['message'] = 'Someting Went Wrong: ' . $connection->error . $category_id;
    header('Location: ../add_products.php');
  }
}

if (isset($_POST['delete_products-btn'])) {
  $product_id = mysqli_real_escape_string($connection, $_POST['product_id']);

  $sql = "DELETE FROM products WHERE id='$product_id'";
  $result =  mysqli_query($connection, $sql);

  if ($result) {
    $_SESSION['delete_message'] = 'Product Deleted Sucessfully';
    header('Location: ../add_products.php');
  } else {
    $_SESSION['delete_message'] = 'Someting Went Wrong' . $connection->error;
    header('Location: ../add_products.php');
  }
}

if (isset($_POST['product_id-btn'])) {
  $product_id = mysqli_real_escape_string($connection, $_POST['product_id']);
  $product_name = mysqli_real_escape_string($connection, $_POST['product_name']);

  $_SESSION['getID_message'] = 'You are updating product number ' . $product_id . ' {' . $product_name . '}';
  $_SESSION['product_id'] = $product_id;
  header('Location: ../update_products.php');
}

if (isset($_POST['update-btn'])) {
  $product_id = mysqli_real_escape_string($connection, $_POST['product_id']);
  $name = mysqli_real_escape_string($connection, $_POST['name']);
  $description = mysqli_real_escape_string($connection, $_POST['description']);
  $price = mysqli_real_escape_string($connection, $_POST['price']);
  $quantity = mysqli_real_escape_string($connection, $_POST['quantity']);

  // Check if category_id is set in the POST data
  $category_id = '';
  if (isset($_POST['category_id']) && !empty($_POST['category_id'])) {
    $category_id = mysqli_real_escape_string($connection, $_POST['category_id']);
  }

  //$status = isset($_POST['status']) ? 'Visible':'Hidden';

  $path = "../uploads";

  $image1 = $_FILES['image1']['name'];
  $image2 = $_FILES['image2']['name'];
  $image3 = $_FILES['image3']['name'];

  // SQL to retrieve id based on username
  $sql = "SELECT * FROM products WHERE id = '$product_id'";
  $result =  mysqli_query($connection, $sql);

  if ($result) {
    if ($result->num_rows > 0) {
      if (($category_id == null || $category_id == '') && ($name == null || $name == '') && ($description == null || $description == '') && ($price == null || $price == '') && ($quantity == null || $quantity == '') && ($image1 == null || $image1 == '') && ($image2 == null || $image2 == '') && ($image3 == null || $image3 == '')) {
        $_SESSION['update_message'] = 'Field is empty!';
        header('Location: ../update_products.php');
      }

      // category id
      if ($category_id != null || $category_id != '') {
        $sql_category_id = "UPDATE products SET category_id = '$category_id' WHERE id = $product_id";
        $update_category_id_run = mysqli_query($connection, $sql_category_id);
        if ($update_category_id_run) {
          $_SESSION['update_message'] = 'Updated Successfully!';
          header('Location: ../update_products.php');
        } else {
          $_SESSION['update_message'] = "Error updating user's detail" . $connection->error;
          header('Location: ../update_products.php');
        }
      }

      // name
      if ($name != null || $name != '') {
        $sql_name = "UPDATE products SET product_name = '$name' WHERE id = $product_id";
        $update_name_run = mysqli_query($connection, $sql_name);
        if ($update_name_run) {
          $_SESSION['update_message'] = 'Updated Successfully!';
          header('Location: ../update_products.php');
        } else {
          $_SESSION['update_message'] = "Error updating user's detail" . $connection->error;
          header('Location: ../update_products.php');
        }
      }

      // description
      if ($description != null || $description != '') {
        $sql_description = "UPDATE products SET product_description = '$description' WHERE id = $product_id";
        $update_description_run = mysqli_query($connection, $sql_description);
        if ($update_description_run) {
          $_SESSION['update_message'] = 'Updated Successfully!';
          header('Location: ../update_products.php');
        } else {
          $_SESSION['update_message'] = "Error updating user's detail" . $connection->error;
          header('Location: ../update_products.php');
        }
      }

      // price
      if ($price != null || $price != '') {
        $sql_price = "UPDATE products SET price = '$price' WHERE id = $product_id";
        $update_price_run = mysqli_query($connection, $sql_price);
        if ($update_price_run) {
          $_SESSION['update_message'] = 'Updated Successfully!';
          header('Location: ../update_products.php');
        } else {
          $_SESSION['update_message'] = "Error updating user's detail" . $connection->error;
          header('Location: ../update_products.php');
        }
      }

      // quantity
      if ($quantity != null || $quantity != '') {
        $sql_quantity = "UPDATE products SET quantitty = '$quantity' WHERE id = $product_id";
        $update_quantity_run = mysqli_query($connection, $sql_quantity);
        if ($update_quantity_run) {
          $_SESSION['update_message'] = 'Updated Successfully!';
          header('Location: ../update_products.php');
        } else {
          $_SESSION['update_message'] = "Error updating user's detail" . $connection->error;
          header('Location: ../update_products.php');
        }
      }

      // image 1
      if ($image1 != "") {
        $image_extention1 = pathinfo($image1, PATHINFO_EXTENSION);
        $filename1 = time() . '.' . $image_extention1;

        $sql_image1 = "UPDATE products SET image_1 = '$filename1' WHERE id = $product_id";
        $update_image1_run = mysqli_query($connection, $sql_image1);
        if ($update_image1_run) {
          move_uploaded_file($_FILES['image1']['tmp_name'], $path . '/' . $filename1);
          $_SESSION['update_message'] = 'Updated Successfully!';
          header('Location: ../update_products.php');
        } else {
          $_SESSION['update_message'] = "Error updating user's detail" . $connection->error;
          header('Location: ../update_products.php');
        }
      }

      // image 2
      if ($image2 != "") {
        $image_extention2 = pathinfo($image2, PATHINFO_EXTENSION);
        $filename2 = time() . '.' . $image_extention2;

        $sql_image2 = "UPDATE products SET image_2 = '$filename2' WHERE id = $product_id";
        $update_image2_run = mysqli_query($connection, $sql_image2);
        if ($update_image2_run) {
          move_uploaded_file($_FILES['image2']['tmp_name'], $path . '/' . $filename2);
          $_SESSION['update_message'] = 'Updated Successfully!';
          header('Location: ../update_products.php');
        } else {
          $_SESSION['update_message'] = "Error updating user's detail" . $connection->error;
          header('Location: ../update_products.php');
        }
      }

      // image 3
      if ($image3 != "") {
        $image_extention3 = pathinfo($image3, PATHINFO_EXTENSION);
        $filename3 = time() . '.' . $image_extention3;

        $sql_image3 = "UPDATE products SET image_3 = '$filename3' WHERE id = $product_id";
        $update_image3_run = mysqli_query($connection, $sql_image3);
        if ($update_image3_run) {
          move_uploaded_file($_FILES['image3']['tmp_name'], $path . '/' . $filename3);
          $_SESSION['update_message'] = 'Updated Successfully!';
          header('Location: ../update_products.php');
        } else {
          $_SESSION['update_message'] = "Error updating user's detail" . $connection->error;
          header('Location: ../update_products.php');
        }
      }
    } else {
      $_SESSION['update_message'] = "Product not found" . $connection->error;;
      header('Location: ../update_products.php');
    }
    // Free result set
    $result->free();
  } else {
    $_SESSION['update_message'] = 'No Product found with that name!';
    header('Location: ../update_products.php');
  }
}

if (isset($_POST['delete_products_review_btn'])) {
  $review_id = mysqli_real_escape_string($connection, $_POST['review_id']);

  $sql = "DELETE FROM reviews WHERE id='$review_id'";
  $result =  mysqli_query($connection, $sql);

  if ($result) {
    $_SESSION['delete_message'] = 'Product Review Deleted Sucessfully';
    header('Location: ../review.php');
  } else {
    $_SESSION['delete_message'] = 'Someting Went Wrong' . $connection->error;
    header('Location: ../review.php');
  }
}

if (isset($_POST['set_tracking_no_btn'])) {
  $tracking_no = mysqli_real_escape_string($connection, $_POST['tracking_no']);
  $customer_id = mysqli_real_escape_string($connection, $_POST['customer_id']);

  $_SESSION['tracking_order'] = 'You are updating the status of order number ';
  $_SESSION['tracking_no'] = $tracking_no;
  $_SESSION['customer_id'] = $customer_id;
  header('Location: ../orders.php');
}

if (isset($_POST['update_status_btn'])) {
  $tracking_no = mysqli_real_escape_string($connection, $_POST['tracking_no']);
  $customer_id = mysqli_real_escape_string($connection, $_POST['customer_id']);
  $new_status = mysqli_real_escape_string($connection, $_POST['new_status']);

  $check_existing_order = "SELECT * FROM orders WHERE userd_id = '$customer_id' AND tracking_no = '$tracking_no'";
  $check_existing_order_run = mysqli_query($connection, $check_existing_order);

  if ($check_existing_order_run && mysqli_num_rows($check_existing_order_run) > 0) {
    // Update
    $sql = "UPDATE orders SET status = '$new_status' WHERE tracking_no = '$tracking_no' AND userd_id = '$customer_id'";;
    $update_query_run = mysqli_query($connection, $sql);

    if ($update_query_run) {
      $_SESSION['delete_message'] = 'Order Status Updated Sucessfully!';
      header('Location: ../orders.php');
    } else {
      $_SESSION['delete_message'] = 'Error 1: ' . $connection->error;
      header('Location: ../orders.php');
    }
  } else {
    $_SESSION['delete_message'] = 'Error 2: ' . $connection->error;
    header('Location: ../orders.php');
  }
}

if (isset($_POST['update_stock_level_btn'])) {
  $low_level = mysqli_real_escape_string($connection, $_POST['low_level']);
  $medium_level = mysqli_real_escape_string($connection, $_POST['medium_level']);
  $good_level = mysqli_real_escape_string($connection, $_POST['good_level']);

  $_SESSION['stock_update'] = 'Stock level Updated!';
  $_SESSION['low_level'] = $low_level;
  $_SESSION['medium_level'] = $medium_level;
  $_SESSION['good_level'] = $good_level;
  header('Location: ../inventory.php');
}
