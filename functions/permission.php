<?php

session_start();
include('../config/dbcon.php');

if(isset($_POST['save-btn'])){
  $username = mysqli_real_escape_string($connection, $_POST['username']);
  $permission_to_add = mysqli_real_escape_string($connection, $_POST['permission_to_add']);
  $permission_to_update = mysqli_real_escape_string($connection, $_POST['permission_to_update']);
  $permission_to_delete = mysqli_real_escape_string($connection, $_POST['permission_to_delete']);


  // SQL to retrieve id based on username
  $sql = "SELECT id FROM users WHERE username = '$username'";
  $result =  mysqli_query($connection, $sql);

  if ($result) {
    if (mysqli_num_rows($result) > 0) {
      if(($permission_to_add != 'allow') && ($permission_to_update != 'allow') && ($permission_to_delete != 'allow')){
        $_SESSION['permission_message'] = 'No permissions granted to this user!';
        header('Location: ../admin/add_users.php');
      }
      // permission to insert user data
      if($permission_to_add == 'allow'){
        $row = $result->fetch_assoc();
        $user_ID = $row["id"];

        $add_permission_insert = "GRANT INSERT ON $database.* TO '$username'@'localhost'";
        $grant_permission_to_add = mysqli_query($connection, $add_permission_insert);

        if($grant_permission_to_add){
          $_SESSION['permission_message'] = 'Permission granted to '. $username .'.';
          header('Location: ../admin/add_users.php');
        }else{
          $_SESSION['permission_message'] = $connection->error;
          header('Location: ../admin/add_users.php');
        }
      }

      // permission to update user data
      if($permission_to_update == 'allow'){
        $row = $result->fetch_assoc();
        $user_ID = $row["id"];

        $add_permission_update = "GRANT UPDATE ON $database.* TO '$username'@'localhost'";
        $grant_permission_to_update = mysqli_query($connection, $add_permission_update);

        if($grant_permission_to_update){
          $_SESSION['permission_message'] = 'Permission granted to '. $username .'.';
          header('Location: ../admin/add_users.php');
        }else{
          $_SESSION['permission_message'] = $connection->error;
          header('Location: ../admin/add_users.php');
        }
      }

      // permission to delete user data
      if($permission_to_delete == 'allow'){
        $row = $result->fetch_assoc();
        $user_ID = $row["id"];

        $add_permission_delete = "GRANT DELETE ON $database.* TO '$username'@'localhost'";
        $grant_permission_to_delete = mysqli_query($connection, $add_permission_delete);

        if($grant_permission_to_delete){
          $_SESSION['permission_message'] = 'Permission granted to '. $username .'.';
          header('Location: ../admin/add_users.php');
        }else{
          $_SESSION['permission_message'] = $connection->error;
          header('Location: ../admin/add_users.php');
        }
      }
    } else {
      $_SESSION['permission_message'] = 'No user found with that email!';
      header('Location: ../admin/add_users.php');
    }
  } else {
    $_SESSION['permission_message'] = 'Execution Error: '. $connection->error;;
    header('Location: ../admin/add_users.php');
  }
}
?>