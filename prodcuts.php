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
        <h3 class="category_title" onclick="showItems('category_title', 'shop_category', '5');">
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
                    <a href="#"><div class="image_container2"><img src="admin/uploads/<?= $items["image_1"]; ?>" alt="<?= $items["product_name"]; ?>"></div></a>
                    <a href="#"><p class="product-name1"><?= $items["product_name"]; ?></p></a>
                    <span class="product-price1">R<?= $items["price"]; ?>.00</span>
                    <a href="#"><button class="add-to-cart" data-product-id="<?= $items["id"]; ?>">Add to Cart</button></a>
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
        <div class="pagination">
          <button id="prev-button" disabled>&lt; previous</button>
          <span id="page-info">1</span>
          <button id="next-button">next &gt;</button>
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