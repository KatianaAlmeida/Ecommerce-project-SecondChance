<?php

session_start();
include('../../config/dbcon.php');

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
    header('Location: ../add_users.php');
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
        header('Location: ../add_users.php');
      }else{
        $_SESSION['message'] = 'Something went wrong!';
        header('Location: ../add_users.php');
      }
    }else{
      $_SESSION['message'] = 'Password do not match!';
      header('Location: ../add_users.php');
    }
  }
}

if(isset($_POST['login-btn'])){

  if(isset($_SESSION['auth_admin'])){ 
    header('Location: ../dashboard.php');
   }else{
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
  
    $login_query = "SELECT * FROM users WHERE email='$email' AND password='$password' AND role != 'customer'";
    $run_query = mysqli_query($connection, $login_query);
  
    if($run_query->num_rows > 0){
      $_SESSION['auth_admin'] = true;
      $userdata = mysqli_fetch_array($run_query);
      $user_name = $userdata['full_name'];
      $user_email = $userdata['email'];
  
      $_SESSION['auth_user_admin'] = [
        'full_name' => $user_name,
        'email' => $user_email
      ];
      header('Location: ../dashboard.php');
  
    } else{
      $_SESSION['message'] = 'Invalid Credentials!';
      header('Location: ../index.php');
    }
   }
}
?>