<?php

session_start();
include('../config/dbcon.php');

if(isset($_POST['register-btn'])){
  $fullName = mysqli_real_escape_string($connection, $_POST['fullName']);
  $username = mysqli_real_escape_string($connection, $_POST['username']);
  $email = mysqli_real_escape_string($connection, $_POST['email']);
  $password = mysqli_real_escape_string($connection, $_POST['password']);
  $confirmed_password = mysqli_real_escape_string($connection, $_POST['confirm-password']);
  $role = mysqli_real_escape_string($connection, $_POST['role']);
  
  // check if email alredy registered
  $check_email = "SELECT email FROM users WHERE email='$email'";
  $check_query_run = mysqli_query($connection, $check_email);

  if($check_query_run->num_rows > 0){
    $_SESSION['message'] = 'Email alredy registered!';
    header('Location: ../admin/add_users.php');
  }else{
    if($password == $confirmed_password){
      // create user
      $createUserSql = "CREATE USER '$username'@'localhost' IDENTIFIED BY '$password'";
      $createUserSql_run = mysqli_query($connection, $createUserSql);
      // insert user data
      $insert_query = "INSERT INTO users (username, full_name, email, password, role) VALUES ('$username', '$fullName', '$email', '$password', '$role')";
      $insert_query_run = mysqli_query($connection, $insert_query);
  
      if($insert_query_run && $createUserSql_run){
        $_SESSION['message'] = 'Registered Successfully!';
        header('Location: ../admin/add_users.php');
      }else{
        $_SESSION['message'] = 'Something went wrong!';
        header('Location: ../admin/add_users.php');
      }
    }else{
      $_SESSION['message'] = 'Password do not match!';
      header('Location: ../admin/add_users.php');
    }
  }
}
?>