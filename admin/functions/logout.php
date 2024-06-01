<?php
 session_start();

 if(isset($_SESSION['auth_admin'])){ 
  unset($_SESSION['auth_admin']);
  unset($_SESSION['auth_user_admin']);

  $_SESSION['message'] = 'Logged out Succefully!';
 }

 header('Location: /admin/index.php');
?>