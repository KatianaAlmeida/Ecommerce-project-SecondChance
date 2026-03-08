<?php

session_start();
include('../config/dbcon.php');
/*
if(isset($_POST['save-newpassword-btn'])){
  $email = pg_escape_string($connection, $_POST['email']);
  $role = pg_escape_string($connection, $_POST['role']);
  $password = pg_escape_string($connection, $_POST['password']);
  $confirmed_password = pg_escape_string($connection, $_POST['confirm-password']);

  // SQL to retrieve id based on username
  $sql = "SELECT id FROM users WHERE email = '$email'";
  $result =  pg_query($connection, $sql);

  if ($result) {
    if ($result->num_rows > 0) {
      // Fetch the user ID
      $row = $result->fetch_assoc();
      $user_id = $row['id'];

      // password
      if($password == $confirmed_password){
        if($password != null || $password != ''){
          $sql_password = "UPDATE users SET password = '$password' WHERE id = $user_id";
          $update_password_run = pg_query($connection, $sql_password);
          if($update_password_run){
            $_SESSION['message'] = 'Password Updated Successfully!';
            header('Location: ../login.php');
          }else{
            $_SESSION['message'] = "Error updating user's detail: " . pg_last_error($connection);
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
}*/
/*
if(isset($_POST['reset-btn'])){
  $email = pg_escape_string($connection, $_POST['email']);
  
  $token = bin2hex(random_bytes(16));
  $token_hash = hash("secondchance", $token);

  $expiry = date("Y-m-d H:i:s", time() + 60 * 30);

  $sql = "UPDATE users SET reset_token_hash = ?, reset_token_expires_at  = ? WHERE email = ?";

  $stmt = $connection->prepare($sql);
  if (!$stmt) {
    die('Error preparing statement: ' . pg_last_error($connection));
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
}*/

if(isset($_POST['save-newpassword-btn'])) {
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = $_POST['password'];
    $confirmed_password = $_POST['confirm-password'];

    // Retrieve user ID based on email
    $sql = "SELECT id FROM users WHERE email = $1";
    $result = pg_query_params($connection, $sql, [$email]);

    if ($result && pg_num_rows($result) > 0) {

        // Fetch the user ID
        $row = pg_fetch_assoc($result);
        $user_id = $row['id'];

        // Check passwords match and not empty
        if ($password === $confirmed_password && !empty($password)) {

            // Hash the new password
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            // Update password
            $sql_password = "UPDATE users SET password = $1 WHERE id = $2";
            $update_password_run = pg_query_params($connection, $sql_password, [$hashed_password, $user_id]);

            if ($update_password_run) {
                $_SESSION['message'] = 'Password Updated Successfully!';
                header('Location: ../login.php');
                exit();
            } else {
                $_SESSION['message'] = "Error updating password: " . connection->error;
                header('Location: ../login.php');
                exit();
            }

        } else {
            $_SESSION['message'] = 'Passwords do not match or are empty!';
            header('Location: ../update_password.php');
            exit();
        }

    } else {
        $_SESSION['message'] = "User not found.";
        header('Location: ../update_password.php');
        exit();
    }

    // Free result set
    pg_free_result($result);
}

if(isset($_POST['reset-btn'])) {
    $email = $_POST['email'];

    // Generate token
    $token = bin2hex(random_bytes(16));
    $token_hash = hash("sha256", $token); // changed to sha256 for standard hashing
    $expiry = date("Y-m-d H:i:s", time() + 60 * 30);

    // Update the user's reset token and expiry
    $sql = "UPDATE users SET reset_token_hash = $1, reset_token_expires_at = $2 WHERE email = $3";
    $update_run = pg_query_params($connection, $sql, [$token_hash, $expiry, $email]);

    if ($update_run && pg_affected_rows($update_run) > 0) {

        // Load mailer
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

        $_SESSION['message'] = 'Message sent, please check your inbox!';
        header('Location: ../reset_password.php');
        exit();

    } else {
        $_SESSION['message'] = 'No account found with that email!';
        header('Location: ../reset_password.php');
        exit();
    }
}


if(isset($_POST['update_user_info_btn'])){
  $username = pg_escape_string($connection, $_POST['username']);
  $email = pg_escape_string($connection, $_POST['email']);
  $full_name = pg_escape_string($connection, $_POST['full_name']);
  $password = pg_escape_string($connection, $_POST['password']);
  $confirmed_password = pg_escape_string($connection, $_POST['confirmed_password']);
  $user_id = pg_escape_string($connection, $_POST['user_id']);

  if(($password != null || $password != '') && ($confirmed_password != null || $confirmed_password != '')){
    if($password == $confirmed_password){
      $hashed_password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password
      $sql_detail = "UPDATE users SET username = '$username', full_name = '$full_name', email = '$email', password = '$hashed_password' WHERE id = '$user_id'";
      $sql_detail_run = pg_query($connection, $sql_detail);
      if($sql_detail_run){
        $_SESSION['message'] = 'Profile Updated Successfully!';
        header('Location: ../customer_info.php#cust_page1');
      }else{
        $_SESSION['message'] = "Error updating user's detail: " . pg_last_error($connection);
        header('Location: ../customer_info.php#cust_page1');
      }
    }else{
      $_SESSION['message'] = 'Password do not match!';
      header('Location: ../customer_info.php#cust_page1');
    }
  }else{
    $sql_password = "UPDATE users SET username = '$username', full_name = '$full_name', email = '$email' WHERE id = '$user_id'";
    $update_password_run = pg_query($connection, $sql_password);
    if($update_password_run){
      $_SESSION['message'] = 'Profile Updated Successfully!';
      header('Location: ../customer_info.php#cust_page1');
    }else{
      $_SESSION['message'] = "Error updating user's detail: " . pg_last_error($connection);
      header('Location: ../customer_info.php#cust_page1');
    }
  }

}
?>