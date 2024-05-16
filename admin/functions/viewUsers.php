<?php

include('../config/dbcon.php');

  $sql = "SELECT * FROM users WHERE role != 'customer'";
  $result =  mysqli_query($connection, $sql);

  if ($result) {
    if (mysqli_num_rows($result) > 0) {
      ?>
      <table class="displayUser">
        <tr>
          <th>Username</th>
          <th>Full Name</th>
          <th>Email</th>
          <th>Role</th>
        </tr>
      <?
      while ($row = $result->fetch_assoc()) {
        ?>
          <tr>
            <td class="user_row"><?= $row["username"]; ?></td>
            <td class="user_row"><?= $row["full_name"]; ?></td>
            <td class="user_row"><?= $row["email"]; ?></td>
            <td class="user_row"><?= $row["role"]; ?></td>
          </tr>
        <?        
      }
      ?>
      </table>
      <?
    } else {
      $_SESSION['permission_message'] = 'No user found!';
      header('Location: ../add_users.php');
    }
  } else {
    $_SESSION['permission_message'] = 'Execution Error: '. $connection->error;
    header('Location: ../add_users.php');
  }

?>