<?php

include('../config/dbcon.php');
/*
$imageDirectory = "./uploads/";
if (!is_dir($imageDirectory)) {
    die("Error: Image directory does not exist.");
}*/
?>
  <table class="displayUser">
    <tr>
      <th>Image</th>
      <th>Category</th>
      <th>Description</th>
      <th>Status</th>
      <th>Delete</th>
    </tr>
  <?php
  $sql = "SELECT * FROM categories";
  $result =  pg_query($connection, $sql);

  if ($result) {
    if (pg_num_rows($result) > 0) {
      while ($items = pg_fetch_assoc($result)) {
        ?>
          <tr>
            <td class="user_row"><img width="70px" height="70px" src="./uploads/<?= $items["image"];?>" alt="<?= $items["name"]; ?>"></td>
            <td class="user_row"><?= $items["name"]; ?></td>
            <td class="user_row"><?= $items["description"]; ?></td>
            <td class="user_row"><?= $items["status"]; ?></td>
            <td class="user_row">
              <form action="/admin/functions/add_category.php" method="POST">
                <input type="hidden" name="category_id" value="<?= $items["id"]; ?>">
                <button class="delete_button" name="delete_category-btn">Delete</button>
              </form>
            </td>
          </tr>
        <?php        
      }
      ?>
      </table>
      <?php
    } else {
      $_SESSION['message'] = 'No category found!';
      header('Location: ../category.php');
    }
  } else {
    $_SESSION['message'] = 'Execution Error: '. pg_last_error($connection);
    header('Location: ../category.php');
  }

?>