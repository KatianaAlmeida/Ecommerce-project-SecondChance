<?php
 session_start();
 include('../config/dbcon.php');
 
 if(!isset($_SESSION['auth_admin'])){
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
      <div class="form_container">
        <h2>Add Products</h2>
        <p class="description">Do not exceed 20 characters when entering the product name.</p>
        <form enctype="multipart/form-data" action="functions/everthing_products.php" method="POST">
          <div class="form-group">
            <label for="name">Select Category</label>
            <select name="category_id" class="categotySelect">
              <option disabled selected hidden>Select Category</option>
              <?php
              $sql = "SELECT * FROM categories";
              $result =  mysqli_query($connection, $sql);
              if ($result) {
                if (mysqli_num_rows($result) > 0) {
                  foreach ($result as $items) {
                    ?>
                    <option value="<?= $items["id"]; ?>"><?= $items["name"]; ?></option>
                    <?        
                  }
                } else {
                  $_SESSION['message'] = 'No category found!';
                  header('Location: ../add_products.php');
                }
              } else {
                $_SESSION['message'] = 'Execution Error: '. $connection->error;
                header('Location: ../add_products.php');
              }
              ?>
            </select>
          </div>  
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" required>
          </div>  
          <div class="form-group">
            <label for="">Description</label>
            <textarea rows="4" name="description"></textarea>
          </div>
          <div class="form-grop2">
            <div>
              <label for="price">Price</label>
              <input type="text" name="price" min="1" required>
            </div>
            <div>
              <label for="quantity">Quantity</label>
              <input type="number" name="quantity" min="0" required>
            </div>
          </div> 
          <div class="form-group">
            <label for="image1">Upload Image 1</label>
            <input type="file" name="image1" required>
          </div>
          <div class="form-group">
            <label for="image2">Upload Image 2</label>
            <input type="file" name="image2">
          </div>
          <div class="form-group">
            <label for="image3">Upload Image 3</label>
            <input type="file" name="image3">
          </div>
          <div class="form-group">
            <button type="submit" name="add_product-btn">Save</button>
            <?php
            if(isset($_SESSION['message'])){ ?>
            <span class="message"> <?= $_SESSION['message'];?></span>
            <?php
              unset($_SESSION['message']);
            }
            ?>
          </div>
        </form>
      </div>
      <div class="form_container1 table-container">
          <h2>Product List</h2>
          <p class="description">View and/or delete Products below</p>  
          <div class="search_users">
            <div class="search_users_container">
              <input class="search_users_input" placeholder="Search for products" >
              <div class="search_img_container"><img class="search_img" src="https://img.icons8.com/ios-glyphs/30/search--v1.png" alt="search--v1"/></div>
            </div>  
          </div>          
          <table class="displayUser">
            <tr>
              <th>Image 1</th>
              <th>Name</th>
              <th>Description</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Delete</th>
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
                    <td class="user_row">R<?= $items["price"]; ?></td>
                    <td class="user_row"><?= $items["quantitty"]; ?></td>
                    <td class="user_row">
                      <form action="/admin/functions/everthing_products.php" method="POST">
                        <input type="hidden" name="product_id" value="<?= $items["id"]; ?>">
                        <button class="delete_button" name="delete_products-btn">Delete</button>
                      </form>
                    </td>
                  </tr>
                <?        
              }
              ?>
          </table>
              <?
            } else {
              $_SESSION['delete_message'] = 'No category found!';
              header('Location: ../category.php');
            }
          } else {
            $_SESSION['delete_message'] = 'Execution Error: '. $connection->error;
            header('Location: ../category.php');
          }
          ?>

          <div class="form-group">
            <?php
            if(isset($_SESSION['delete_message'])){ ?>
            <span class="message"> <?= $_SESSION['delete_message'];?></span>
            <?php
              unset($_SESSION['delete_message']);
            }
            ?>
          </div>
      </div>
    </main>
  </div>
<?php
 include('includes/footer.php');
?>