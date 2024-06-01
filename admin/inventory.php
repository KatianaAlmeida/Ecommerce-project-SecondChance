<?php
session_start();
include('../config/dbcon.php');

if (!isset($_SESSION['auth_admin'])) {
  header('Location: /admin/index.php');
};

include('includes/header.php');
include('includes/sideBar.php');
?>
<div class="dashboard_container">
  <div class="overlay_cover js-overlay_cover"></div>

  <?php
  include('includes/navBar.php');
  ?>
  <!-- content/page section -->
  <main class="content">
    <div class="form_container2 table-container">
      <div class="inventory_level_container">
        <div>
          <h2>Product List</h2>
          <p class="description">View and/or delete Products below</p>
          <div class="search_users_container">
            <input class="search_users_input" placeholder="Search for products">
            <div class="search_img_container"><img class="search_img" src="https://img.icons8.com/ios-glyphs/30/search--v1.png" alt="search--v1" /></div>
          </div>
        </div>
        <div class="stock_level">
          <?php
          if(isset($_SESSION['stock_message'])){
            $low_level = $_SESSION['low_level'];
            $medium_level = $_SESSION['medium_level'];
            $good_level = $_SESSION['good_level'] ;
          }else{
            $low_level = 10;
            $medium_level = 20;
            $good_level = 30;
          }
          ?>
          <h2>Manage Stock</h2>
          <form action="functions/everthing_products.php" method="POST">
            
              <label for="low_level">Low:</label>
              <input type="number" name="low_level" value="<?= $low_level; ?>" required>


              <label for="medium_level">Medium:</label>
              <input type="number" name="medium_level" value="<?= $medium_level; ?>" required>

              <label for="good_level">Good:</label>
              <input type="number" name="good_level" value="<?= $good_level; ?>" required>

            <div>
              <button type="submit" name="update_stock_level_btn">Update Stock Level</button>
            </div>
          </form>
          <?php
            if(!isset($_SESSION['stock_message'])){ ?>
            <p class="message"> <?= $_SESSION['stock_message'];?></p>
            <?php
            }
          ?>
        </div>
      </div>
      <table class="displayUser">
        <tr>
          <th>SKU</th>
          <th>Image 1</th>
          <th>Name</th>
          <th>Description</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Stock Level</th>
        </tr>
        <?php
        $sql = "SELECT * FROM products";
        $result =  mysqli_query($connection, $sql);

        if ($result) {
          if (mysqli_num_rows($result) > 0) {
            foreach ($result as $items) {
        ?>
              <tr>
                <td class="user_row"><?= $items["incremented_name"]; ?></td>
                <td class="user_row"><img width="70px" height="70px" src="./uploads/<?= $items["image_1"]; ?>" alt="<?= $items["product_name"]; ?>"></td>
                <td class="user_row"><?= $items["product_name"]; ?></td>
                <td class="user_row"><?= $items["product_description"]; ?></td>
                <td class="user_row">R <?= $items["price"]; ?></td>
                <td class="user_row"><?= $items["quantitty"]; ?></td>
                <td class="user_row">
                  <?php
                  if ($items["quantitty"] < $low_level) {
                  ?>
                    <button class="red">Low</button>
                  <?php
                  } else if ($items["quantitty"] < $medium_level) {
                  ?>
                    <button class="orage">Medium</button>
                  <?php
                  } else {
                  ?>
                    <button class="green">Good</button>
                  <?php
                  }
                  ?>
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
          $_SESSION['message'] = 'Execution Error: ' . $connection->error;
          header('Location: ../category.php');
        }
  ?>
  <div class="form-group">
    <?php
    if (isset($_SESSION['message'])) { ?>
      <span class="message"> <?= $_SESSION['message']; ?></span>
    <?php
      unset($_SESSION['message']);
    }
    ?>
  </div>
    </div>
  </main>
</div>
<?php
include('includes/footer.php');
?>