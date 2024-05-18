<?php

session_start();
include('../../config/dbcon.php');

if(isset($_POST['reply-btn'])){
  $email = mysqli_real_escape_string($connection, $_POST['email']);
  $Name = mysqli_real_escape_string($connection, $_POST['Name']);
  $id = mysqli_real_escape_string($connection, $_POST['id']);

  $_SESSION['reply_message'] = 'You are replying to '.$Name.'. Email: {'.$email.'}';
  $_SESSION['email'] = $email;
  $_SESSION['id'] = $id;
  header('Location: ../customer_messages.php');
}

if(isset($_POST['send_reply-btn'])){
  $email = mysqli_real_escape_string($connection, $_POST['email']);
  $message_id = mysqli_real_escape_string($connection, $_POST['id']);
  $content = mysqli_real_escape_string($connection, $_POST['message_reply']);

  // send email to the user here
    //...

  // store reply in the database
  $sql = "INSERT INTO reply (content, message_id) VALUES('$content', '$message_id')";
  $check_query_run = mysqli_query($connection, $sql);

  if($check_query_run){
    $_SESSION['reply_to_message'] = 'Message Send Sucessfully!';
    header('Location: ../customer_messages.php');
  }else{
    $_SESSION['reply_to_message'] = 'Someting Went Wrong'.$connection->error;
    header('Location: ../customer_messages.php');
  }
}


?>