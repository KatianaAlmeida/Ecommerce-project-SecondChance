<?php

session_start();
include('../../config/dbcon.php');

if (isset($_POST['save-btn'])) {
  $username = mysqli_real_escape_string($connection, $_POST['username']);
  $permission_to_add = mysqli_real_escape_string($connection, $_POST['permission_to_add']);
  $permission_to_update = mysqli_real_escape_string($connection, $_POST['permission_to_update']);
  $permission_to_delete = mysqli_real_escape_string($connection, $_POST['permission_to_delete']);
  $permission_to_select = mysqli_real_escape_string($connection, $_POST['permission_to_select']);

  // SQL to retrieve id based on username
  $sql = "SELECT id FROM users WHERE username = '$username'";
  $result =  mysqli_query($connection, $sql);

  if ($result) {
    if (mysqli_num_rows($result) > 0) {
      if (($permission_to_add != 'allow') && ($permission_to_update != 'allow') && ($permission_to_delete != 'allow')) {
        $_SESSION['permission_message'] = 'No permissions granted to this user!';
        header('Location: ../add_users.php');
      }
      // permission to insert user data
      if ($permission_to_add == 'allow') {
        $add_permission_insert = "GRANT INSERT ON $database.* TO '$username'@'localhost'";
        $grant_permission_to_add = mysqli_query($connection, $add_permission_insert);

        if ($grant_permission_to_add) {
          $_SESSION['permission_message'] = 'Permission granted to ' . $username . '.';
          header('Location: ../add_users.php');
        } else {
          $_SESSION['permission_message'] = $connection->error;
          header('Location: ../add_users.php');
        }
      } else {
        $revoke = "REVOKE INSERT ON $database.* FROM '$username'@'localhost'";
        $revoke_insert = mysqli_query($connection, $revoke);

        if ($revoke_insert) {
          $_SESSION['permission_message'] = 'Permission to INSERT revoked from ' . $username . '.';
          header('Location: ../add_users.php');
        } else {
          $_SESSION['permission_message'] = $connection->error;
          header('Location: ../add_users.php');
        }
      }

      // permission to update user data
      if ($permission_to_update == 'allow') {
        $add_permission_update = "GRANT UPDATE ON $database.* TO '$username'@'localhost'";
        $grant_permission_to_update = mysqli_query($connection, $add_permission_update);

        if ($grant_permission_to_update) {
          $_SESSION['permission_message'] = 'Permission granted to ' . $username . '.';
          header('Location: ../add_users.php');
        } else {
          $_SESSION['permission_message'] = $connection->error;
          header('Location: ../add_users.php');
        }
      } else {
        $revoke = "REVOKE UPDATE ON $database.* FROM '$username'@'localhost'";
        $revoke_update = mysqli_query($connection, $revoke);

        if ($revoke_update) {
          $_SESSION['permission_message'] = 'Permission to UPDATE revoked from ' . $username . '.';
          header('Location: ../add_users.php');
        } else {
          $_SESSION['permission_message'] = $connection->error;
          header('Location: ../add_users.php');
        }
      }

      // permission to delete user data
      if ($permission_to_delete == 'allow') {
        $add_permission_delete = "GRANT DELETE ON $database.* TO '$username'@'localhost'";
        $grant_permission_to_delete = mysqli_query($connection, $add_permission_delete);

        if ($grant_permission_to_delete) {
          $_SESSION['permission_message'] = 'Permission granted to ' . $username . '.';
          header('Location: ../add_users.php');
        } else {
          $_SESSION['permission_message'] = $connection->error;
          header('Location: ../add_users.php');
        }
      } else {
        $revoke = "REVOKE DELETE ON $database.* FROM '$username'@'localhost'";
        $revoke_delete = mysqli_query($connection, $revoke);

        if ($revoke_delete) {
          $_SESSION['permission_message'] = 'Permission to DELETE revoked from ' . $username . '.';
          header('Location: ../add_users.php');
        } else {
          $_SESSION['permission_message'] = $connection->error;
          header('Location: ../add_users.php');
        }
      }

      // permission to select user data
      if ($permission_to_select == 'allow') {
        $add_permission_select = "GRANT SELECT ON $database.* TO '$username'@'localhost'";
        $grant_permission_to_select = mysqli_query($connection, $add_permission_select);

        if ($grant_permission_to_select) {
          $_SESSION['permission_message'] = 'Permission granted to ' . $username . '.';
          header('Location: ../add_users.php');
        } else {
          $_SESSION['permission_message'] = $connection->error;
          header('Location: ../add_users.php');
        }
      } else {
        $revoke = "REVOKE SELECT ON $database.* FROM '$username'@'localhost'";
        $revoke_select = mysqli_query($connection, $revoke);

        if ($revoke_select) {
          $_SESSION['permission_message'] = 'Permission to SELECT revoked from ' . $username . '.';
          header('Location: ../add_users.php');
        } else {
          $_SESSION['permission_message'] = $connection->error;
          header('Location: ../add_users.php');
        }
      }
    } else {
      $_SESSION['permission_message'] = 'No user found with that email!';
      header('Location: ../add_users.php');
    }
  } else {
    $_SESSION['permission_message'] = 'Execution Error: ' . $connection->error;;
    header('Location: ../add_users.php');
  }
}
