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
    // $product["id"];
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
      <div class="product_details" style="background-color: white;">
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
          <!-- Product {quantity, cart, wishList, buyNow and no_stock}-->
          <form action="functions/handle_whish_list.php" method="post">
            <!-- product quantity-->
            <div class="quantity_container">
              <label for="quantity">Quantity</label>
              <input type="number" value="1" name="quantity" id="quantity" min="1">
            </div>
            <?php
            /* cart, wishList, buyNow and no_stock_container*/
            if($product["quantitty"] != 0){
              ?>
              <div class="cart_wish_container">
                <input class="add_product_button-js" type="submit"  value="Add to Cart" name="add_to_cart-btn"></input>
                <input type="hidden"  name="product_id" value="<?=$product["id"];?>">
                <input type="hidden"  name="SKU" value="<?=$product_number;?>">
                <button type="submit" class="whishlist" name="add_whish_btn"><img src="https://img.icons8.com/pastel-glyph/64/751fff/like--v2.png" alt="like--v2"/></button>
              </div>
              <div class="buy_container">
                <input type="submit" value="Buy Now" name="buy_now-btn"></input>
              </div> 
              <?php
            /* no_stock_container*/
            }else{
              ?>
              <div class="no_stock_container">
                <button disabled>Out of Stock</button>
                <img src="https://img.icons8.com/pastel-glyph/64/751fff/like--v2.png" alt="like--v2"/>
              </div>
              <?php
            }
            ?>
          </form>  
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
      <div class="product_reviews horiz_ruler">
        <?php
        $id = $product["id"];
        $check_reviews = "SELECT reviews.*, users.username as user_name  FROM reviews 
            JOIN users ON reviews.user_id = users.id 
            WHERE reviews.product_id = '$id'";
        $check_reviews_run = mysqli_query($connection, $check_reviews);
          if ($check_reviews_run && mysqli_num_rows($check_reviews_run) > 0) {
          ?>
        <div class="info_dropdown horiz_ruler">
          <span>Reviews</span>
        </div>
        <hr>
          <div class="product_reviews_container">
            <div class="review_list_container">
              <?php
              $count = 0;
              $rating = 0;
              foreach ($check_reviews_run as $items) {
                $rating = $rating + $items["rating"];
                $count++;
                ?>
                  <div class="review_list">
                    <div class="review_list_header">
                      <p><b><?= $items["user_name"]; ?> - <?= date('Y-m-d', strtotime($items["created_at"])); ?></b></p>
                      <?php
                      if($_SESSION['auth_user']['username'] ==  $items["user_name"]){
                        ?>
                        <div class="open_close">
                          <img src="https://img.icons8.com/ios-filled/50/menu-2.png" alt="menu-2"/>
                          <div class="dropdown_content_off">
                            <button class="dropdown-item open_edit">Edit</button>
                            <hr>
                            <form action="functions/handle_review.php" method="post">
                              <input type="hidden"  name="SKU" value="<?=$product_number;?>">
                              <input type="hidden"  name="product_id" value="<?=$product["id"];?>">
                              <button type="submit" class="dropdown-item" name="delete_btn" href="#">Delete</button>
                            </form>
                          </div>
                        </div>
                        <?php
                      }
                      ?>
                    </div>
                    <p>
                      <?php
                      for($index = 0; $index < $items["rating"]; $index++){
                        ?>
                        <img width="14" height="14" src="https://img.icons8.com/forma-light-filled/24/751fff/star.png" alt="star"/>
                        <?php
                      }
                      for($index = 0; $index < (5- $items["rating"]); $index++){
                        ?>
                        <img width="15" height="15" src="https://img.icons8.com/forma-bold-filled/24/737373/star.png" alt="star"/>
                        <?php
                      }
                      ?>
                    </p>
                    <p><b><?= $items["title"]; ?></b></p>
                    <p><?= $items["content"]; ?></p>
                    <div class="image_container"><img src="uploads/<?= $items["image"]; ?>" alt="<?= $items["title"]; ?>"></div>
                    <div class="helpful">
                      <span class="space">Was this helpful?</span>
                      <img width="20" height="20" src="https://img.icons8.com/ios/50/facebook-like--v1.png" alt="facebook-like--v1"/>
                      <span class="space">Yes</span>
                      <img width="20" height="20" src="https://img.icons8.com/wired/64/reply.png" alt="reply"/>
                      <span class="space">Reply</span>
                    </div>
                  </div>
                <?php
              }
              ?>
            </div>
            <div class="review_rating_container">
              <h3>Rating Block</h3>
              <div>
                <?php
                $avg = $rating/$count;
                $floor_avg = floor($avg);

                if ($floor_avg == $avg) {
                  for($index = 0; $index < $floor_avg; $index++){
                    ?>
                    <img width="14" height="14" src="https://img.icons8.com/forma-light-filled/24/751fff/star.png" alt="star"/>
                    <?php
                  }
                  for($index = 0; $index < (5- $floor_avg); $index++){
                    ?>
                    <img width="15" height="15" src="https://img.icons8.com/forma-bold-filled/24/737373/star.png" alt="star"/>
                    <?php
                  }
                } else {
                  for($index = 0; $index < $floor_avg; $index++){
                    ?>
                    <img width="14" height="14" src="https://img.icons8.com/forma-light-filled/24/751fff/star.png" alt="star"/>
                    <?php
                  }
                  ?>
                  <img width="15" height="15" src="https://img.icons8.com/material-rounded/24/751fff/star-half-empty.png" alt="star-half-empty"/>
                  <?php
                  for($index = 0; $index < (4- $floor_avg); $index++){
                    ?>
                    <img width="15" height="15" src="https://img.icons8.com/forma-bold-filled/24/737373/star.png" alt="star"/>
                    <?php
                  }
                }
                ?>
                <?= number_format(($rating/$count), 1); ?>
              </div>
              <p>Based on <?= $count; ?> review</p>
                <button class="Leave_review_js write_review">Write a Review</button>
                <div class="product_review_form update_off">
                  <form enctype="multipart/form-data" action="functions/handle_review.php" method="post">
                    <div class="form_group">
                      <label for="review_rating">Rating*</label>
                      <select id="review_rating" name="review_rating">
                        <option value="1">1 star</option>
                        <option value="2">2 stars</option>
                        <option value="3">3 stars</option>
                        <option value="4">4 stars</option>
                        <option value="5">5 stars</option>
                      </select>
                    </div>
                    <div class="form_group">
                      <label for="review_title">Review Title*</label>
                      <input type="text" id="review_title" name="review_title" maxlength="350">
                    </div>
                    <div class="form_group">
                      <label for="review_content">Review*</label>
                      <textarea rows="4" id="review_content" name="review_content" maxlength="500"></textarea>
                    </div>
                    <div class="form_group">
                      <label for="review_media">Add images & videos (1/1)</label>
                      <div class="file-input-container">
                        <input type="file" id="file-input" name="image" class="file-input" accept="image/*, video/*"  multiple>
                        <label for="file-input" class="file-label">
                          <span class="file-icon">+</span>
                          <span class="file-text">Add File</span>
                        </label>
                      </div>
                    </div>
                    <div class="form_actions">
                      <input type="hidden"  name="SKU" value="<?=$product["incremented_name"];?>">
                      <input type="hidden"  name="product_id" value="<?=$product["id"];?>">
                      <button type="submit" name="update_review_btn" class="publish_review">Update Review</button>
                    </div>
                  </form>
                </div>
                <div class="product_review_form review_off_1">
                  <form enctype="multipart/form-data" action="functions/handle_review.php" method="post">
                    <div class="form_group">
                      <label for="review_rating">Rating*</label>
                      <select id="review_rating" name="review_rating">
                        <option value="1">1 star</option>
                        <option value="2">2 stars</option>
                        <option value="3">3 stars</option>
                        <option value="4">4 stars</option>
                        <option value="5">5 stars</option>
                      </select>
                    </div>
                    <div class="form_group">
                      <label for="review_title">Review Title*</label>
                      <input type="text" id="review_title" name="review_title" maxlength="350">
                    </div>
                    <div class="form_group">
                      <label for="review_content">Review*</label>
                      <textarea rows="4" id="review_content" name="review_content" maxlength="500"></textarea>
                    </div>
                    <div class="form_group">
                      <label for="review_media">Add images & videos (1/1)</label>
                      <div class="file-input-container">
                        <input type="file" id="file-input" name="image" class="file-input" accept="image/*, video/*"  multiple>
                        <label for="file-input" class="file-label">
                          <span class="file-icon">+</span>
                          <span class="file-text">Add File</span>
                        </label>
                      </div>
                    </div>
                    <div class="form_actions">
                      <input type="hidden"  name="SKU" value="<?=$product["incremented_name"];?>">
                      <input type="hidden"  name="product_id" value="<?=$product["id"];?>">
                      <button type="submit" name="publish_review_btn" class="publish_review">Publish</button>
                    </div>
                  </form>
                </div>
            </div>
          </div>
            <?php
          }else{
            ?>
            <div class="no_review no_review_on">
              <p>No Reviews Yet</p>
              <p>Share your thoughts. Be the first to leave a review.</p>
              <button onclick="switch_review_container();" class="Leave_review">Leave a Review</button>
            </div>
            <div class="product_review_form review_off">
              <form enctype="multipart/form-data" action="functions/handle_review.php" method="post">
                <div class="form_group">
                  <label for="review_rating">Rating*</label>
                  <select id="review_rating" name="review_rating">
                    <option value="1">1 star</option>
                    <option value="2">2 stars</option>
                    <option value="3">3 stars</option>
                    <option value="4">4 stars</option>
                    <option value="5">5 stars</option>
                  </select>
                </div>
                <div class="form_group">
                  <label for="review_title">Review Title*</label>
                  <input type="text" id="review_title" name="review_title" maxlength="350">
                </div>
                <div class="form_group">
                  <label for="review_content">Review*</label>
                  <textarea rows="4" id="review_content" name="review_content" maxlength="500"></textarea>
                </div>
                <div class="form_group">
                  <label for="review_media">Add images & videos (1/1)</label>
                  <div class="file-input-container">
                    <input type="file" id="file-input" name="image" class="file-input" accept="image/*, video/*"  multiple>
                    <label for="file-input" class="file-label">
                      <span class="file-icon">+</span>
                      <span class="file-text">Add File</span>
                    </label>
                  </div>
                </div>
                <div class="form_actions">
                  <input type="hidden"  name="SKU" value="<?=$product["incremented_name"];?>">
                  <input type="hidden"  name="product_id" value="<?=$product["id"];?>">
                  <button type="button" onclick="switch_review_container();" class="cancel_review">Cancel</button>
                  <button type="submit" name="publish_review_btn" class="publish_review">Publish</button>
                </div>
              </form>
            </div>
            <?php
          }
          ?>
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