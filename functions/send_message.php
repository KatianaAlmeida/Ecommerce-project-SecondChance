<?php

session_start();
include('../config/dbcon.php');

if(isset($_POST['send-btn'])){
  $first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
  $last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
  $email = mysqli_real_escape_string($connection, $_POST['email']);

  $subject = mysqli_real_escape_string($connection, $_POST['subject']);
  $content = mysqli_real_escape_string($connection, $_POST['message']);
  
  $sql_add_visitor = "INSERT INTO visitor (first_name, last_name, email) VALUES('$first_name', '$last_name', '$email')";
  $query_run = mysqli_query($connection, $sql_add_visitor);

  if($query_run){
    $sql = "SELECT id FROM visitor WHERE email = '$email'";
    $result =  mysqli_query($connection, $sql);

    if ($result) {
      if ($result->num_rows > 0) {
        // send message from a customer
        if(isset($_SESSION['auth']) && $_SESSION['auth'] == true){ 
          $user_id = $_SESSION['auth_user']['id'];
          
          $sql_add_message = "INSERT INTO message (subject, content, user_id) VALUES('$subject', '$content', '$user_id')";
          $message_query_run = mysqli_query($connection, $sql_add_message);

          if($message_query_run){
            $_SESSION['send_message'] = 'Message Send Successfully!';
            header('Location: ../contact_us.php');
          }else{
            $_SESSION['send_message'] = "Error: ".$connection->error;
            header('Location: ../contact_us.php');
          }
        }else{ 
          // send message from a visitor
          $row = $result->fetch_assoc();
          $visitor_id = $row['id'];
  
          $sql_add_message_v = "INSERT INTO message (subject, content, visitor_id) VALUES('$subject', '$content', '$visitor_id')";
          $message_query_run_v = mysqli_query($connection, $sql_add_message_v);

          if($message_query_run_v){
            $_SESSION['send_message'] = 'Message Send Successfully!';
            header('Location: ../contact_us.php');
          }else{
            $_SESSION['send_message'] = "Error: ".$connection->error;
            header('Location: ../contact_us.php');
          }
        }

      } else {
        $_SESSION['send_message'] = "Visitor not found";
        header('Location: ../contact_us.php');
      }
    } else {
      $_SESSION['send_message'] = 'No visitor found with that email!';
      header('Location: ../contact_us.php');
    }
  }else{
    $_SESSION['send_message'] = 'Someting Went Wrong'.$connection->error;
    header('Location: ../contact_us.php');
  }
}

?>