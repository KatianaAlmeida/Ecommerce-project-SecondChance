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
    //$product_name = $product["product_name"];
    //$incremented_name = $product["incremented_name"];
    //$product_description = $product["product_description"];
    //$price = $product["price"];
    //$quantitty = $product["quantitty"];
    //$image_1 = $product["image_1"];

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
          <div>
            image
            <div class="image_container2"><img src="admin/uploads/<?= $product["image_1"]; ?>" alt="<?= $product["image_1"]; ?>"></div>
          </div>
          <div>
            description
            <p><?= $product["product_description"]; ?></p>
          </div>
        </div>
        <div class="product_details2">
          <div>
            name
            <p class="product-name1"><?= $product["product_name"]; ?></p>
          </div>
          <div>
            incremented_name
            <p><?= $product["incremented_name"]; ?></p>
          </div>
          <div>
            price
            <p>R<?= $product["price"]; ?></p>
          </div>
          <div>cart quantity</div>
          <div class="cart_wish_container">
            <button>Add to Cart</button>
            <div>whishList</div>
          </div>
          <div><button>Buy Now</button></div>   
          <div>Product Info</div>
          <div>Return & Refund Policy</div>
          <div>Shipping Info</div>       
        </div>
      </div>
      <div class="product_reviews">
        <p>product_reviews</p>
      </div>
      <div class="product_recomendation">
        <p>product_recomendation</p>
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