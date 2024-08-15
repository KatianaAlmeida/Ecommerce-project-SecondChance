<?php
session_start();
include('config/dbcon.php');
 include('components/header.php');
 include('components/navbar.php');
 include('components/frontbar.php');
 ?>
  <main>
    <div class="home_container">
      <div class="slide_container" id="slideContainer">
        <div class="home_intro_container">
        <p>Local & Affordable</p>
        <h1>Rediscover Quality at SecondChance Emporium</h1>
        <p>Great Savings on Quality Products</p>
        <a href="shop_all.php"><button class="home_button">Explore Now</button></a>
        </div>
      </div>
      <div class="categoty_container">
        <div class="title">
          <h2>Browse By Category</h2>
        </div>
        <div class="category1">
          <?php
            $sql = "SELECT * FROM categories";
            $result = mysqli_query($connection, $sql);

            if ($result) {
              if (mysqli_num_rows($result) > 0) {
                $count = 0;
                foreach ($result as $items) {
                  if ($items["status"] != "Hidden") {
                    ?>
                    <div class="each_category">
                      <a href="prodcuts.php?category=<?= $items["name"]; ?>">
                        <div class="image_container1"><img src="admin/uploads/<?= $items["image"]; ?>" alt="<?= $items["name"]; ?>"></div>
                        <p><?= $items["name"]; ?></p>
                      </a>
                    </div>
                    <?php
                    $count++;
                    if ($count >= 5) {
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
        <div class="button">
          <a href="products_category.php"><button class="home_button">View All</button></a>
        </div>
      </div>
      <div class="best_selling_container">
        <div class="title">
          <h2>Best Selling Products</h2>
        </div>
        <div class="best_sale_container">
          <button class="slide-button" id="slide-button-prev">&lt;</button>
          <div class="best-sale-section">
            <div class="product-container" id="product-container">
              <?php
                $sql = "SELECT * FROM products";
                $result = mysqli_query($connection, $sql);

                if ($result) {
                  if (mysqli_num_rows($result) > 0) {
                    $count = 0;
                    foreach ($result as $items) {
                      if ($items["category_id"] == 22 || $items["category_id"] == 21) {
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
          <button class="slide-button" id="slide-button-next">&gt;</button>
        </div>
        <div class="button">
          <a href="prodcuts.php?category=Best Sellers"><button class="home_button">See More</button></a>
        </div>
      </div>
      <div class="best_deal_container">
        <div class="leftt">
          <img src="assets/images/best_deal.jpg" alt="">
          <div class="best_deal2">Best Deals</div>
        </div>
        <div class="rightt">
          <p>Save up to</p>
          <p>R150</p>
          <p>on Leading Brands</p>
          <p>Terms apply</p>
          <a href="prodcuts.php?category=Best Deals"><button class="home_button">Browse</button></a>
        </div>
      </div>
      <div class="explore_more_container">
        <div class="title">
          <h2>Explore Our Products</h2>
        </div>
        <div class="best_sale_container">
          <button class="slide-button" id="slide-button-prev1">&lt;</button>
          <div class="best-sale-section">
            <div class="product-container" id="product-container1">
              <?php
                $sql = "SELECT * FROM products";
                $result = mysqli_query($connection, $sql);

                if ($result) {
                  if (mysqli_num_rows($result) > 0) {
                    $count = 0;
                    foreach ($result as $items) {
                      if ($items["category_id"] == 16 || $items["category_id"] == 19) {
                        ?>
                        <!--link to a specific product page-->
                        <div class="product">
                          <a href="each_product_view.php?product=<?= $items["incremented_name"]; ?>">
                            <div class="image_container1"><img src="admin/uploads/<?= $items["image_1"]; ?>" alt="<?= $items["product_name"]; ?>"></div>
                            <p class="product-name"><?= $items["product_name"]; ?></p>
                          </a>
                          <p><span class="old-price">R85</span>&nbsp;&nbsp;<span class="product-price">R<?= $items["price"]; ?></span></p>
                        </div>
                        <?php
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
          <button class="slide-button" id="slide-button-next1">&gt;</button>
        </div>
        <div class="button">
          <a href="shop_all.php"><button class="home_button">Explore Details</button></a>
        </div>
      </div>
      <div class="need_help_container">
        <div class="textt_container">
          <div>
            <p>Need Help? Have Any Question? Contact Us</p>
            <p>I'm a paragraph. Click here to add your own text and edit me. Let your users get to know you.</p>
            <a href="contact_us.php"><button class="home_button">Contact Information</button></a>
          </div>
        </div>
        <div class="image_container">
          <img src="assets/images/footer.webp" alt="">
        </div>
      </div>      
    </div>
  </main>
<?php
 include('components/footer.php');
?>