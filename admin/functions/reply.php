<?php
session_start();
include('../../config/dbcon.php');

if (isset($_POST['reply-btn'])) {
  $email = pg_escape_string($connection, $_POST['email']);
  $Name = pg_escape_string($connection, $_POST['Name']);
  $id = pg_escape_string($connection, $_POST['id']);

  $_SESSION['reply_message'] = 'You are replying to ' . $Name . '. Email: {' . $email . '}';
  $_SESSION['email'] = $email;
  $_SESSION['id'] = $id;
  header('Location: ../customer_messages.php');
}

if (isset($_POST['send_reply-btn'])) {
  $email = pg_escape_string($connection, $_POST['email']);
  $message_id = pg_escape_string($connection, $_POST['id']);
  $content = pg_escape_string($connection, $_POST['message_reply']);
  
  // store reply in the database
  $sql = "INSERT INTO reply (content, message_id) VALUES('$content', '$message_id')";
  $check_query_run = pg_query($connection, $sql);

  if ($check_query_run) {
    $_SESSION['reply_to_message'] = 'Message Send Sucessfully!';
    header('Location: ../customer_messages.php');
  } else {
    $_SESSION['reply_to_message'] = 'Reply didnt save: ' . pg_last_error($connection);
    header('Location: ../customer_messages.php');
  }
}
?>