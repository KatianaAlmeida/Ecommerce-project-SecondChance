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
      <th>Edit</th>
    </tr>
  <?
  $sql = "SELECT * FROM categories";
  $result =  mysqli_query($connection, $sql);

  if ($result) {
    if (mysqli_num_rows($result) > 0) {
      foreach ($result as $items) {
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
        <?        
      }
      ?>
      </table>
      <?
    } else {
      $_SESSION['permission_message'] = 'No category found!';
      header('Location: ../category.php');
    }
  } else {
    $_SESSION['permission_message'] = 'Execution Error: '. $connection->error;
    header('Location: ../category.php');
  }

?>