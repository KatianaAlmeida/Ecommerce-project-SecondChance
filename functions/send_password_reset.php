-<?php

session_start();
include('../config/dbcon.php');

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
?>