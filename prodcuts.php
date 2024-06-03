<?php
session_start();
include('config/dbcon.php');
 include('components/header.php');
 include('components/navbar.php');
 include('components/frontbar.php');

 if(isset($_GET['category'])){

 $category_name = $_GET['category'];
 $category_query =  "SELECT * FROM categories WHERE name = '$category_name' LIMIT 1";
 $result = mysqli_query($connection, $category_query);

 ?>
  <main class="shop_all_page">
    <?php
    if ($result && mysqli_num_rows($result) > 0) {
      $category = mysqli_fetch_assoc($result);
      $category_id = $category["id"];
      ?>
      <div>
        <h1><?= $category["name"]; ?></h1>
      </div>
      <?php
      }else {
        ?>
        <div>
          <h1>No Products in this Category!</h1>
        </div>
        <?php
      }
    ?>
    <div class="shop_all_container">
      <div class="browse_by">
        <h3 class="category_title" onclick="showItems();">
          Browse by&nbsp;&nbsp;&nbsp;
          <span class="js-arrow-5"><img class="arrow" src="https://img.icons8.com/forma-thin-filled/24/1A1A1A/play.png" alt="play"/></span>
        </h3>
        <div class="shop_category_container">
          <?php
            $sql = "SELECT * FROM categories";
            $result =  mysqli_query($connection, $sql);
            if ($result) {
              if (mysqli_num_rows($result) > 0) {
                foreach ($result as $items) {
                  if ($items["status"] != "Hidden") {
                    $isActive = $items["name"] === $category_name ? 'active-category' : '';
                    ?>
                    <div class="checkbox-container">
                      <a href="prodcuts.php?category=<?= $items["name"]; ?>" class="<?= $isActive; ?>"><span><?= $items["name"]; ?></span></a>
                    </div>
                    <?php
                  }
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
        </div>
        <a href="shop_all.php" ><span>All Products</span></a>
      </div>
      <div class="shop_products">
        <div class="product-containerr" id="product-container">
          <?php
            $sql = "SELECT * FROM products WHERE category_id = '$category_id'";
            $result = mysqli_query($connection, $sql);

            if ($result) {
              if (mysqli_num_rows($result) > 0) {
                $count = 0;
                foreach ($result as $items) {
                  ?>
                  <div class="productt">
                    <a href="each_product_view.php?product=<?= $items["incremented_name"];?>&page_name=prodcuts&category=Computers">
                      <div class="image_container2"><img src="admin/uploads/<?= $items["image_1"]; ?>" alt="<?= $items["product_name"]; ?>"></div>
                      <p class="product-name1"><?= $items["product_name"]; ?></p>
                    </a>
                    <?php
                    if($items["quantitty"] != 0){
                      ?>
                      <span class="product-price1">R<?= $items["price"]; ?>.00</span>
                      <form action="functions/handle_cart.php" method="post">
                        <input type="hidden" value="1" name="quantity" id="quantity" min="1">
                        <input type="hidden" name="stock_qty" value="<?= $items["quantitty"]; ?>">
                        <input type="hidden"  name="product_id" value="<?=$items["id"];?>">
                        <input type="hidden"  name="SKU" value="<?=$items["incremented_name"];?>">
                        <input type="hidden"  name="category_name" value="<?=$category_name;?>">
                        <input type="hidden"  name="page" value="category_search">
                        <button class="add-to-cart" type="submit" name="add_to_cart-btn" data-product-id="<?= $items["id"]; ?>">Add to Cart</button>
                      </form>
                      <?php
                    }else{
                      ?>
                      <span class="old-price">Out of Stock</span>
                      <button class="add-to-cart" disabled data-product-id="<?= $items["id"]; ?>">Maybe Next Time</button>
                      <?php
                    }
                    ?>
                  </div>
                  <?php
                }
              } else {
                ?>
                <div class="each_category">
                  <p>No Products Available!</p>
                </div>
                <?php
              }
            } else {
              ?>
              <div class="each_category">
                <p>Something Went Wrong! Sorry About that.</p>
              </div>
              <?php
            }
          ?>
        </div>
      </div>
    </div>
  </main>
 <?php
 } else{
  echo "Something went wrong!";
 }
 include('components/footer.php');
?>