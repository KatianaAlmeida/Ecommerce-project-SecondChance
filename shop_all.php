<?php
session_start();
include('config/dbcon.php');
 include('components/header.php');
 include('components/navbar.php');
 include('components/frontbar.php');
 ?>
 <main class="shop_all_page">
    <?php
    if(isset($_POST['search_btnn']) && $_POST['search_box'] != ''){
      $search_box = mysqli_real_escape_string($connection, $_POST['search_box']);
      ?>
      <div>
        <h1>Searched for "<?= $search_box;?>"</h1>
      </div>
      <div class="shop_all_container">
        <div class="shop_category">
          <h3 class="category_title" onclick="showItems('category_title', 'shop_category', '5');">
            Category&nbsp;&nbsp;&nbsp;
            <span class="js-arrow-5"><img class="arrow" src="https://img.icons8.com/forma-thin-filled/24/1A1A1A/play.png" alt="play"/></span>
          </h3>
          <div class="shop_category_container">
            <?php
              $sql = "SELECT categories.id, categories.name, categories.status, COUNT(products.id) as product_count 
                      FROM categories 
                      LEFT JOIN products ON categories.id = products.category_id 
                      GROUP BY categories.id, categories.name";
              $result =  mysqli_query($connection, $sql);
              if ($result) {
                if (mysqli_num_rows($result) > 0) {
                  foreach ($result as $items) {
                    if ($items["status"] != "Hidden") {
                      ?>
                      <div class="checkbox-container">
                        <input type="checkbox" name="categories[]" value="<?= $items["id"]; ?>" id="category_<?= $items["id"]; ?>" class="styled-checkbox">
                        <label for="category_<?= $items["id"]; ?>"><?= $items["name"]; ?> (<?= $items["product_count"]; ?>)</label>
                      </div>
                      <?php
                    }
                  }
                  ?>
                    <a href="shop_all.php" ><span>All Products</span></a>
                  <?php
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
                  <p>Execution Error: <?= $connection->error; ?></p>
                </div>
                <?php
              }
            ?>
          </div>
          <a href="prodcuts.php?category=Computers" ><h3>Browser</h3></a>
        </div>
        <!-- result box used start-->
        <?php
          // Define the number of products per page
          $products_per_page = 10;

          // Get the current page number from the URL, default to 1 if not set
          $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
          $page = max($page, 1); // Ensure the page number is at least 1

          // Calculate the offset for the SQL query
          $offset = ($page - 1) * $products_per_page;

          // Connect to the database (make sure you have $connection already defined)

          // Get the total number of products
          $total_products_query = "SELECT COUNT(*) AS total FROM products";
          $total_products_result = mysqli_query($connection, $total_products_query);
          $total_products = mysqli_fetch_assoc($total_products_result)['total'];

          // Calculate the total number of pages
          $total_pages = ceil($total_products / $products_per_page);

          // Fetch products for the current page
          $sql = "SELECT * FROM products WHERE product_name LIKE '%{$search_box}%' LIMIT $products_per_page OFFSET $offset";
          $result = mysqli_query($connection, $sql);
          $sql2 = "SELECT id FROM categories WHERE name LIKE '%{$search_box}%' LIMIT $products_per_page OFFSET $offset";
          $result2 = mysqli_query($connection, $sql2);
        ?>        
        <div class="shop_products">
          <div class="product-containerr" id="product-container">
            <?php
            if ($result || $result2) {
              if (mysqli_num_rows($result2) > 0) {
                // -- result box used start {search category} --
                $category = mysqli_fetch_assoc($result2);
                $category_id = $category["id"];
                $sql3 = "SELECT * FROM products WHERE category_id = '$category_id' LIMIT $products_per_page OFFSET $offset";
                $result3 = mysqli_query($connection, $sql3);
                if($result3){
                  foreach ($result3 as $items) {
                    ?>
                    <div class="productt">
                      <a href="#"><div class="image_container2"><img src="admin/uploads/<?= $items["image_1"]; ?>" alt="<?= $items["product_name"]; ?>"></div></a>
                      <a href="#"><p class="product-name1"><?= $items["product_name"]; ?></p></a>
                      <span cla2ss="product-price1">R<?= $items["price"]; ?>.00</span>
                      <a href="#"><button class="add-to-cart" data-product-id="<?= $items["id"]; ?>">Add to Cart</button></a>
                    </div>
                    <?php
                  }                 
                }else {
                  ?>
                  <div class="each_category">
                    <p>No Products Found!</p>
                  </div>
                  <?php
                }
                unset($_POST['search_btnn']);
                unset($_POST['search_box']);
              }else if (mysqli_num_rows($result) > 0) {
                // -- result box used start {search prodcuts} --
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
                unset($_POST['search_btnn']);
                unset($_POST['search_box']);
              } else {
                ?>
                <div class="each_category">
                  <p>No Products Found!</p>
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
        <?php
        unset($_POST['search_btnn']);
        unset($_POST['search_box']);
        ?>
        <!-- result box used end-->
      </div>
        <?php  
    }else{
      ?>
      <div>
        <h1>Search Results</h1>
      </div>
      <div class="shop_all_container">
        <div class="shop_category">
          <h3 class="category_title" onclick="showItems('category_title', 'shop_category', '5');">
            Category&nbsp;&nbsp;&nbsp;
            <span class="js-arrow-5"><img class="arrow" src="https://img.icons8.com/forma-thin-filled/24/1A1A1A/play.png" alt="play"/></span>
          </h3>
          <div class="shop_category_container">
            <?php
              $sql = "SELECT categories.id, categories.name, categories.status, COUNT(products.id) as product_count 
                      FROM categories 
                      LEFT JOIN products ON categories.id = products.category_id 
                      GROUP BY categories.id, categories.name";
              $result =  mysqli_query($connection, $sql);
              if ($result) {
                if (mysqli_num_rows($result) > 0) {
                  foreach ($result as $items) {
                    if ($items["status"] != "Hidden") {
                      ?>
                      <div class="checkbox-container">
                        <input type="checkbox" name="categories[]" value="<?= $items["id"]; ?>" id="category_<?= $items["id"]; ?>" class="styled-checkbox">
                        <label for="category_<?= $items["id"]; ?>"><?= $items["name"]; ?> (<?= $items["product_count"]; ?>)</label>
                      </div>
                      <?php
                    }
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
                  <p>Execution Error: <?= $connection->error; ?></p>
                </div>
                <?php
              }
            ?>
          </div>
          <a href="prodcuts.php?category=Computers" ><h3>Browser</h3></a>
        </div>
        <!-- DID NOT use the search box start-->
        <?php
          // Define the number of products per page
          $products_per_page = 10;

          // Get the current page number from the URL, default to 1 if not set
          $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
          $page = max($page, 1); // Ensure the page number is at least 1

          // Calculate the offset for the SQL query
          $offset = ($page - 1) * $products_per_page;

          // Connect to the database (make sure you have $connection already defined)

          // Get the total number of products
          $total_products_query = "SELECT COUNT(*) AS total FROM products";
          $total_products_result = mysqli_query($connection, $total_products_query);
          $total_products = mysqli_fetch_assoc($total_products_result)['total'];

          // Calculate the total number of pages
          $total_pages = ceil($total_products / $products_per_page);

          // Fetch products for the current page
          $sql = "SELECT * FROM products LIMIT $products_per_page OFFSET $offset";
          $result = mysqli_query($connection, $sql);
        ?>      
        <div class="shop_products">
          <div class="product-containerr" id="product-container">
            <?php
            if ($result) {
              if (mysqli_num_rows($result) > 0) {
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
            <?php if ($page > 1): ?>
              <a href="?page=<?= $page - 1 ?>" id="prev-button">&lt; previous</a>
            <?php else: ?>
              <span class="disabled_button" id="prev-button" disabled>&lt; previous</span>
            <?php endif; ?>

            <span id="page-info">Page <?= $page ?> of <?= $total_pages ?></span>

            <?php if ($page < $total_pages): ?>
              <a href="?page=<?= $page + 1 ?>" id="next-button">next &gt;</a>
            <?php else: ?>
              <span class="disabled_button" id="next-button" disabled>next &gt;</span>
            <?php endif; ?>
          </div>
        </div>    
        <!-- DID NOT use the search box end-->  
      </div>  
      <?php
    }
    ?>
 </main>
 <?php
 include('components/footer.php');
?>
