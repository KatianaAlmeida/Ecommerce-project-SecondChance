<?php

session_start();
include('../../config/dbcon.php');

if(isset($_POST['add_category-btn'])){
  $name = pg_escape_string($connection, $_POST['name']);
  $description = pg_escape_string($connection, $_POST['description']);
  $status = isset($_POST['status']) ? 'Visible':'Hidden';

  $image = $_FILES['image']['name'];
  $path = "../uploads";
  $image_extention = pathinfo($image, PATHINFO_EXTENSION);

  $filename = time().'.'.$image_extention;
  
  $sql = "INSERT INTO categories (name, description, status, image) VALUES('$name', '$description', '$status', '$filename')";
  $check_query_run = pg_query($connection, $sql);

  if($check_query_run){
    move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);
    $_SESSION['message'] = 'Category Added Sucessfully!';
    header('Location: ../category.php');
  }else{
    $_SESSION['message'] = 'Someting Went Wrong' . pg_last_error($connection);
    header('Location: ../category.php');
  }
}

if(isset($_POST['delete_category-btn'])){
  $category_id = pg_escape_string($connection, $_POST['category_id']);

  $sql = "DELETE FROM categories WHERE id='$category_id'";
  $result =  pg_query($connection, $sql);

  if ($result) {
    $_SESSION['message'] = 'Category Deleted Sucessfully';
    header('Location: ../category.php');
  }else{
    $_SESSION['message'] = 'Someting Went Wrong' . pg_last_error($connection);
    header('Location: ../category.php');
  }
}
?>