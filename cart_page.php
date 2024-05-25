<?php
session_start();
include('config/dbcon.php');
 include('components/header.php');
 include('components/navbar.php');
 include('components/frontbar.php');
 ?>
  <main class="product_page_container">
    <div class="product_details horiz_ruler">
      <?php
      if(isset($_SESSION['auth'])){
        $user_id = $_SESSION['auth_user']['id'];
        $sql = "SELECT c.id as cart_id, c.product_qty, p.id as product_id, p.product_name, p.image_1, p.price 
                FROM carts c, products p 
                WHERE c.product_id = p.id AND c.user_id = '$user_id' 
                ORDER BY c.id DEsC;";
        $result =  mysqli_query($connection, $sql);
        if ($result) {
          if (mysqli_num_rows($result) > 0) {
            ?>
            <div class="product_in_cart_details1">
              <div class="info_dropdown"><span>My cart</span></div>
              <hr>
              <?php
              $initial_amout = 0;
              $index = 0;
              foreach ($result as $items) {
                $initial_amout = $initial_amout + ($items["price"] * $items["product_qty"]);
                $index = $index + 1;
                $_SESSION['count'] = $index;
                ?>
                <div class="product_in_cart">
                  <div class="img_container">
                    <p class="product-name1"><img src="admin/uploads/<?= $items["image_1"]; ?>" alt="<?= $items["image_1"]; ?>"></p>
                  </div>
                  <div class="middle_container">
                    <div class="name_container">
                      <p class="product-name1"><?= $items["product_name"]; ?></p>
                    </div>
                    <div class="prod_qty_container">
                      <form id="numberForm" action="functions/handle_cart.php" method="post">
                        <input type="hidden" class="iprice"  name="price" value="<?=$items["price"];?>">
                        <input onchange="subTotal();" class="iquantity" type="number" id="numberInput" value="<?= $items["product_qty"]; ?>" name="update_cart_btn" min="1">
                      </form>
                      <span class="product-name1">R<span class="itotal"><?= $items["price"]; ?></span></span>
                    </div>
                  </div>
                  <div class="close_btn_container">
                  <p class="product-name1"><img src="https://img.icons8.com/ios/50/delete-sign--v1.png" alt="delete-sign--v1"/></p>
                  </div>
                </div>
                <hr>
                <?php
                /*
                <div class="productt">
                  <p class="product-name1"><?= $items["cart_id"]; ?></p>
                  <p class="product-name1"><?= $items["product_id"]; ?></p>
                </div>
                */
                ?>
                <?php
              }
              ?>
            </div>
            <div class="product_in_cart_details2">
              <div class="product_info_container">
                <div class="info_dropdown"><span class="order_s">Order summary</span></div>
                <hr>
                <div class="initial_amout">
                  <p>Subtotal</p>
                  <p>R<span id="gtotal"><?= $initial_amout; ?></span></p>
                </div>
                <div class="delivery">
                  <p>Delivery</p>
                  <p>
                    <?php
                    $deliver = 0;
                    $total = $initial_amout + $deliver;
                    if($initial_amout > 500){
                      $deliver = 0;
                      ?>
                      <span>FREE</span>
                      <?php
                    }else{
                      $deliver = $initial_amout * 0.15;
                      ?>
                      <span>R<?= $deliver; ?></span>
                      <?php
                    }
                    ?>
                  </p>
                </div>
                <hr> 
                <div class="final_price">
                  <p>Total</p>
                  <p>R<?= $total; ?></p>
                </div>
                <div class="cart_wish_container">
                  <input type="hidden"  name="product_id" value="<?=$product["id"];?>">
                  <input type="hidden"  name="SKU" value="<?=$product_number;?>">
                  <input class="add_product_button-js" type="submit"  value="Checkout" name="add_to_cart-btn"></input>
                </div>
                <span>Secure Checkout</span>
              </div>  
            </div>
            <?php
          } else {
            ?>
            <div class="empty_cart_container">
              <div class="empty_cart">
                <p>My cart</p>
                <div class="cart_container">
                  <p>Cart is empty</p>
                  <a href="shop_all.php">Continue Browsing</a>
                </div>
              </div>
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

      }else{
        ?>
        <div class="empty_cart_container">
          <div class="empty_cart">
            <p>My cart</p>
            <div class="cart_container">
              <p>Cart is empty</p>
              <a href="shop_all.php">Continue Browsing</a>
            </div>
          </div>
        </div>
        <?php
      }
      ?>
    </div>
  </main>
<?php
 include('components/footer.php');
?>