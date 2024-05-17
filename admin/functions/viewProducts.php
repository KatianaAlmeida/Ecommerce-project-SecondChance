<?php

include('../config/dbcon.php');

$imageDirectory = "./uploads/";
if (!is_dir($imageDirectory)) {
    die("Error: Image directory does not exist.");
}
?>

<table class="displayUser">
  <tr>
    <th>Image 1</th>
    <th>Name</th>
    <th>Description</th>
    <th>Price</th>
    <th>Quantity</th>
    <th>Get the ID</th>
  </tr>
  <?php
  $sql = "SELECT * FROM products";
  $result =  mysqli_query($connection, $sql);

  if ($result) {
  if (mysqli_num_rows($result) > 0) {
    foreach ($result as $items) {
      ?>
        <tr>
          <td class="user_row"><img width="70px" height="70px" src="./uploads/<?= $items["image_1"];?>" alt="<?= $items["product_name"]; ?>"></td>
          <td class="user_row"><?= $items["product_name"]; ?></td>
          <td class="user_row"><?= $items["product_description"]; ?></td>
          <td class="user_row">R <?= $items["price"]; ?></td>
          <td class="user_row"><?= $items["quantitty"]; ?></td>
          <td class="user_row">
            <form action="/admin/functions/everthing_products.php" method="POST">
              <input type="hidden" name="product_id" value="<?= $items["id"]; ?>">
              <input type="hidden" name="product_name" value="<?= $items["product_name"]; ?>">
              <button class="delete_button" name="product_id-btn">ProductID</button>
            </form>
          </td>
        </tr>
      <?        
    }
    ?>
</table>
    <?
  } else {
    $_SESSION['message'] = 'No category found!';
    header('Location: ../category.php');
  }
} else {
  $_SESSION['message'] = 'Execution Error: '. $connection->error;
  header('Location: ../category.php');
}
?>