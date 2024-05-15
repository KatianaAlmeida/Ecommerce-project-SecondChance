<?php

session_start();
include('../config/dbcon.php');

if(isset($_POST['update-btn'])){
  $username = mysqli_real_escape_string($connection, $_POST['username']);
  $fullName = mysqli_real_escape_string($connection, $_POST['fullName']);
  $email = mysqli_real_escape_string($connection, $_POST['email']);
  $role = mysqli_real_escape_string($connection, $_POST['role']);
  $password = mysqli_real_escape_string($connection, $_POST['password']);
  $confirmed_password = mysqli_real_escape_string($connection, $_POST['confirm-password']);

  // SQL to retrieve id based on username
  $sql = "SELECT id FROM users WHERE username = '$username'";
  $result =  mysqli_query($connection, $sql);

  if ($result) {
    if ($result->num_rows > 0) {
      // Fetch the user ID
      $row = $result->fetch_assoc();
      $user_id = $row['id'];

      if(($fullName == null || $fullName == '') && ($email == null || $email == '') && ($role == null || $role == '') && ($password == null || $password == '')){
        $_SESSION['update'] = 'Field is empty!';
        header('Location: ../admin/view_update_user.php');
      }

      // full name
      if($fullName != null || $fullName != ''){
        $sql_fullName = "UPDATE users SET full_name = '$fullName' WHERE id = $user_id";
        $update_fullName_run = mysqli_query($connection, $sql_fullName);
        if($update_fullName_run){
          $_SESSION['update'] = 'Updated Successfully!';
          header('Location: ../admin/view_update_user.php');
        }else{
          $_SESSION['update'] = "Error updating user's detail: " . $connection->error;
          header('Location: ../admin/view_update_user.php');
        }
      }

      // email
      if($email != null || $email != ''){
        $sql_email = "UPDATE users SET email = '$email' WHERE id = $user_id";
        $update_email_run = mysqli_query($connection, $sql_email);
        if($update_email_run){
          $_SESSION['update'] = 'Updated Successfully!';
          header('Location: ../admin/view_update_user.php');
        }else{
          $_SESSION['update'] = "Error updating user's detail: " . $connection->error;
          header('Location: ../admin/view_update_user.php');
        }
      }

      // role
      if($role != null || $role != ''){
        $sql_role = "UPDATE users SET role = '$role' WHERE id = $user_id";
        $update_role_run = mysqli_query($connection, $sql_role);
        if($update_role_run){
          $_SESSION['update'] = 'Updated Successfully!';
          header('Location: ../admin/view_update_user.php');
        }else{
          $_SESSION['update'] = "Error updating user's detail: " . $connection->error;
          header('Location: ../admin/view_update_user.php');
        }
      }

      // password
      if($password == $confirmed_password){
        if($password != null || $password != ''){
          $sql_password = "UPDATE users SET password = '$password' WHERE id = $user_id";
          $update_password_run = mysqli_query($connection, $sql_password);
          if($update_password_run){
            $_SESSION['update'] = 'Updated Successfully!';
            header('Location: ../admin/view_update_user.php');
          }else{
            $_SESSION['update'] = "Error updating user's detail: " . $connection->error;
            header('Location: ../admin/view_update_user.php');
          }
        }
      }

    } else {
      $_SESSION['update'] = "User not found.";
      header('Location: ../admin/view_update_user.php');
    }
    // Free result set
    $result->free();
  } else {
    $_SESSION['update'] = 'No user found with that username!';
    header('Location: ../admin/view_update_user.php');
  }
}

if(isset($_POST['delete-btn'])){
  $username = mysqli_real_escape_string($connection, $_POST['username']);

  // SQL to retrieve id based on username
  $sql = "SELECT id FROM users WHERE username = '$username'";
  $result =  mysqli_query($connection, $sql);

  if ($result) {
    if ($result->num_rows > 0) {
      // Fetch the user ID
      $row = $result->fetch_assoc();
      $user_id = $row['id'];

      $sql_delete = "DELETE FROM users WHERE id = $user_id";
      $delete_user = mysqli_query($connection, $sql_delete);
      if($delete_user){
        $_SESSION['update'] = 'User Deleted Successfully!';
        header('Location: ../admin/view_update_user.php');
      }else{
        $_SESSION['update'] = "Error deleting user: " . $connection->error;
        header('Location: ../admin/view_update_user.php');
      }

    } else {
      $_SESSION['update'] = "User not found.";
      header('Location: ../admin/view_update_user.php');
    }
    // Free result set
    $result->free();
  } else {
    $_SESSION['update'] = 'No user found with that username!';
    header('Location: ../admin/view_update_user.php');
  }
}

?>