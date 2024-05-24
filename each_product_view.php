<?php
session_start();
include('config/dbcon.php');
 include('components/header.php');
 include('components/navbar.php');
 include('components/frontbar.php');

 if(isset($_GET['product'])){
  $product_number = $_GET['product'];
  $product_query =  "SELECT * FROM products WHERE incremented_name = '$product_number' LIMIT 1";
  $result = mysqli_query($connection, $product_query);

  if ($result && mysqli_num_rows($result) > 0) {
    $product = mysqli_fetch_assoc($result);
    // $product["product_name"];
    // $product["incremented_name"];
    // $product["product_description"];
    // $product["price"];
    // $product["quantitty"];
    // $product["image_1"];
    // $product["category_id"];
    ?>
    <main class="product_page_container">
      <div class="product_navigation">
        <?php
        if(isset($_GET['page_name']) && isset($_GET['category'])){
          $page_name = $_GET['page_name'];
          $go_back_category = $_GET['category'];
          ?>
          <p><a href="home.php">Home&nbsp;</a>/&nbsp;<a href="<?=$page_name;?>.php?category=<?=$go_back_category;?>">Browse by Category&nbsp;</a> /&nbsp; <span class="prod_name_disable"><?= $product["product_name"]; ?></span></p>
          <?php
        } else if(isset($_GET['page_name'])){
          $page_name = $_GET['page_name'];
          ?>
          <p><a href="home.php">Home&nbsp;</a>/&nbsp;<a href="<?=$page_name;?>.php?">Shop All&nbsp;</a> /&nbsp; <span class="prod_name_disable"><?= $product["product_name"]; ?></span></p>
          <?php
        } else{
          ?>
          <p><a href="home.php">Home&nbsp;</a>/&nbsp;<span class="prod_name_disable"><?= $product["product_name"]; ?></span></p>
          <?php
        }
        ?>
      </div>
      <div class="product_details">
        <div class="product_details1">
          <div class="product_image_container">
            <img src="admin/uploads/<?= $product["image_1"]; ?>" alt="<?= $product["image_1"]; ?>">
          </div>
        </div>
        <div class="product_details2">
          <div class="product_name_container">
            <p class="product-name1"><?= $product["product_name"]; ?></p>
          </div>
          <div class="product_incremented_container">
            <p>SKU:&nbsp;<?= $product["incremented_name"]; ?></p>
          </div>
          <div class="product_price_container">
            <p>R<?= $product["price"]; ?></p>
          </div>
          <div class="quantity_container">
            <label for="quantity">Quantity</label>
            <input type="number" value="1" name="quantity" id="quantity" min="1">
          </div>
          <?php
          /* cart_wish_container and no_stock_container*/
          if($product["quantitty"] != 0){
            ?>
            <div class="cart_wish_container">
              <button>Add to Cart</button>
              <img src="https://img.icons8.com/pastel-glyph/64/751fff/like--v2.png" alt="like--v2"/>
            </div>
            <div class="buy_container">
              <button>Buy Now</button>
            </div> 
            <?php
          }else{
            ?>
            <div class="no_stock_container">
              <button>Out of Stock</button>
              <img src="https://img.icons8.com/pastel-glyph/64/751fff/like--v2.png" alt="like--v2"/>
            </div>
            <?php
          }
          ?>  
          <div class="product_info_container">
            <div class="info_dropdown"><span>Product Info</span><span class="sign sign1-js">+</span></div>
            <div class="info_content_off">
              <p>I'm a product detail. I'm a great place to add more information about your product such as sizing, material, care and cleaning instructions. This is also a great space to write what makes this product special and how your customers can benefit from this item.</p>
            </div>
            <hr>
            <div class="descr_dropdown"><span>Product Description</span><span class="sign sign2-js">+</span></div>
            <div class="descr_content_off">
              <p><?= $product["product_description"]; ?></p>
            </div>
            <hr>
            <ul class="points">
              <li>Eligible for Cash on Delivery.</li>
              <li>Hassle-Free Exchanges</li>
              <li>Returns for 30 Days.</li>
              <li>6-Month Limited Warranty.</li>
            </ul>   
          </div>  
        </div>
      </div>
      <div class="product_reviews">
        <p>product_reviews</p>
      </div>
      <div class="product_recomendation">
          <h3>You Might Also Like</h3>
        <div class="">
          <div class="best_sale_container">
            <div class="best-sale-section">
              <div class="product-container" id="product-container3">
                <?php
                  $sql = "SELECT * FROM products";
                  $result = mysqli_query($connection, $sql);

                  if ($result) {
                    if (mysqli_num_rows($result) > 0) {
                      $count = 0;
                      foreach ($result as $items) {
                        if ($items["category_id"] == $product["category_id"] && $items["incremented_name"] != $product["incremented_name"]) {
                          ?>
                          <div class="product">
                            <!--link to a specific product page-->
                            <a href="each_product_view.php?product=<?= $items["incremented_name"]; ?>">
                              <div class="image_container1"><img src="admin/uploads/<?= $items["image_1"]; ?>" alt="<?= $items["product_name"]; ?>"></div>
                              <p class="product-name"><?= $items["product_name"]; ?></p>
                            </a>
                            <p>
                            <?php
                            if($items["quantitty"] != 0){
                              ?>
                              <span class="old-price">R305</span>&nbsp;&nbsp;<span class="product-price">R<?= $items["price"]; ?></span>
                              <?php
                            }else{
                              ?>
                              <span class="old-price">Out of Stock</span>
                              <?php
                            }
                            ?>
                          </p>
                          </div>
                          <?php
                          $count++;
                          if ($count >= 4) {
                            break;
                          }
                        }
                      }
                    } else {
                      ?>
                      <div class="each_category">
                        <p>No Categories Avaliable!</p>
                      </div>
                      <?php 
                    }
                  } else {
                    ?>
                    <div class="each_category">
                      <p>Somehing Went Wrong! Sorry About that.</p>
                    </div>
                    <?php 
                  }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <?php
    }else {
        echo "Something went wrong!";
    }
} else{
  echo "Something went wrong!";
 }
 include('components/footer.php');
?>