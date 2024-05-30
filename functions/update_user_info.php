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

if(isset($_POST['reset-btn'])){
  $email = mysqli_real_escape_string($connection, $_POST['email']);
  
  $token = bin2hex(random_bytes(16));
  $token_hash = hash("sha256", $token);

  $expiry = date("Y-m-d H:i:s", time() + 60 * 30);

  $sql = "UPDATE users SET reset_token_hash = ?, reset_token_expires_at  = ? WHERE email = ?";

  $stmt = $connection->prepare($sql);
  if (!$stmt) {
    die('Error preparing statement: ' . $connection->error);
  }
  $stmt->bind_param("sss", $token_hash, $expiry, $email);
  if (!$stmt->execute()) {
    die('Error executing statement: ' . $stmt->error);
  }

  $stmt->execute();

  if($connection->affected_rows){

    $mail = require __DIR__ . "/mailer.php";

    $mail->setFrom("noreply@gmail.com");
    $mail->addAddress($email);
    $mail->Subject = "Password Reset";
    $mail->Body = <<<END

    Click <a href="http://localhost:3000/reset_password.php?token=$token">here</a> 
    to reset your password.

    END;

    try {

        $mail->send();

    } catch (Exception $e) {

        echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";

    }
  }
  $_SESSION['message'] = 'Message sent, please check your inbox!';
  header('Location: ../reset_password.php');
}

if(isset($_POST['update_user_info_btn'])){
  $username = mysqli_real_escape_string($connection, $_POST['username']);
  $email = mysqli_real_escape_string($connection, $_POST['email']);
  $full_name = mysqli_real_escape_string($connection, $_POST['full_name']);
  $password = mysqli_real_escape_string($connection, $_POST['password']);
  $confirmed_password = mysqli_real_escape_string($connection, $_POST['confirmed_password']);
  $user_id = mysqli_real_escape_string($connection, $_POST['user_id']);



  if(($password != null || $password != '') && ($confirmed_password != null || $confirmed_password != '')){
    if($password == $confirmed_password){
      $sql_detail = "UPDATE users SET username = '$username', full_name = '$full_name', email = '$email', password = '$password' WHERE id = '$user_id'";
      $sql_detail_run = mysqli_query($connection, $sql_detail);
      if($sql_detail_run){
        $_SESSION['message'] = 'Profile Updated Successfully!';
        header('Location: ../customer_info.php#cust_page1');
      }else{
        $_SESSION['message'] = "Error updating user's detail: " . $connection->error;
        header('Location: ../customer_info.php#cust_page1');
      }
    }else{
      $_SESSION['message'] = 'Password do not match!';
      header('Location: ../customer_info.php#cust_page1');
    }
  }else{
    $sql_password = "UPDATE users SET username = '$username', full_name = '$full_name', email = '$email' WHERE id = '$user_id'";
    $update_password_run = mysqli_query($connection, $sql_password);
    if($update_password_run){
      $_SESSION['message'] = 'Profile Updated Successfully!';
      header('Location: ../customer_info.php#cust_page1');
    }else{
      $_SESSION['message'] = "Error updating user's detail: " . $connection->error;
      header('Location: ../customer_info.php#cust_page1');
    }
  }

}
?>