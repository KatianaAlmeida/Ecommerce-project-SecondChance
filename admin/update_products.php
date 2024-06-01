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
      <div class="form_container1 table-container">
        <h2>Product List</h2>
        <p class="description">View and/or delete Products below</p>  
        <div class="search_users">
          <div class="search_users_container">
            <input class="search_users_input" placeholder="Search for products" >
            <div class="search_img_container"><img class="search_img" src="https://img.icons8.com/ios-glyphs/30/search--v1.png" alt="search--v1"/></div>
          </div>  
          <div class="radio-container">
            <button class="new_user"><a href="add_products.php">+ Add new</a></button>
          </div>
        </div>
        <?php
          include('functions/viewProducts.php');
        ?>
        <div class="form-group">
          <?php
          if(isset($_SESSION['message'])){ ?>
          <span class="message"> <?= $_SESSION['message'];?></span>
          <?php
            unset($_SESSION['message']);
          }
          ?>
        </div>
      </div>
      <div class="form_container">
        <h2>Update Products</h2>
        <p class="description">Do not exceed 20 characters when entering the product name.</p>
        <form enctype="multipart/form-data" action="functions/everthing_products.php" method="POST">
          <div class="form-group">
            <?php
            if(isset($_SESSION['getID_message'])){ ?>
            <input type="hidden" name="product_id" value="<?= $_SESSION['product_id'];?>">
            <span class="message"> <?= $_SESSION['getID_message'];?></span>
            <?php
              unset($_SESSION['getID_message']);
            }else{
            ?>
            <span class="message">Click the 'ProductID' button to update a prodcut!</span>
            <?php
            }
            ?>
          </div>
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
            <input type="text" name="name">
          </div>  
          <div class="form-group">
            <label for="description">Description</label>
            <textarea rows="4" name="description"></textarea>
          </div>
          <div class="form-grop2">
            <div>
              <label for="price">Price</label>
              <input type="number" name="price" min="1">
            </div>
            <div>
              <label for="quantity">Quantity</label>
              <input type="number" name="quantity" min="1">
            </div>
          </div> 
          <div class="form-group">
            <label for="image1">Upload Image 1</label>
            <input type="file" name="image1">
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
            <button type="submit" name="update-btn">Update</button>
            <?php
            if(isset($_SESSION['update_message'])){ ?>
            <span class="message"> <?= $_SESSION['update_message'];?></span>
            <?php
              unset($_SESSION['update_message']);
            }
            ?>
          </div>
        </form>
      </div>
    </main>
  </div>
<?php
 include('includes/footer.php');
?>