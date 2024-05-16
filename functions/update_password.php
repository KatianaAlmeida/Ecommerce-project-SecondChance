<?php

session_start();
include('../config/dbcon.php');

if(isset($_POST['save-newpassword-btn'])){
  $email = mysqli_real_escape_string($connection, $_POST['email']);
  $role = mysqli_real_escape_string($connection, $_POST['role']);
  $password = mysqli_real_escape_string($connection, $_POST['password']);
  $confirmed_password = mysqli_real_escape_string($connection, $_POST['confirm-password']);

  // SQL to retrieve id based on username
  $sql = "SELECT id FROM users WHERE email = '$email'";
  $result =  mysqli_query($connection, $sql);

  if ($result) {
    if ($result->num_rows > 0) {
      // Fetch the user ID
      $row = $result->fetch_assoc();
      $user_id = $row['id'];

      // password
      if($password == $confirmed_password){
        if($password != null || $password != ''){
          $sql_password = "UPDATE users SET password = '$password' WHERE id = $user_id";
          $update_password_run = mysqli_query($connection, $sql_password);
          if($update_password_run){
            $_SESSION['message'] = 'Password Updated Successfully!';
            header('Location: ../login.php');
          }else{
            $_SESSION['message'] = "Error updating user's detail: " . $connection->error;
            header('Location: ../login.php');
          }
        }
      }

    } else {
      $_SESSION['message'] = "User not found.";
      header('Location: ../update_password.php');
    }
    // Free result set
    $result->free();
  } else {
    $_SESSION['message'] = 'No user found with that username!';
    header('Location: ../update_password.php');
  }
}
?>