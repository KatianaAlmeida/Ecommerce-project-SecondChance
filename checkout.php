<?php
  session_start();
  include('config/dbcon.php');
  if(!isset($_SESSION['auth'])){
    header('Location: login.php');
  };
  include('components/header.php');
  include('components/navbar.php');
  include('components/frontbar.php');
 ?>
  <main class="checkout_page_container">
    <div class="product_details background horiz_ruler">
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
            <div class="checkout_details1">
              <div class="info_dropdown"><span>Secure Checkout</span></div>
              <hr>
              <div class="delivery_method">
                <div class="method1">
                  <p>Delivery Method</p>
                  <div class="form-group">
                    <div class="radio-container">
                      <input type="radio" id="delivery" value="Delivery" name="delivery_type" class="delivery_type radio-input">
                      <label for="delivery" onclick="open_address();" class="radio-label">Delivery</label>
                    </div>
                    <div class="radio-container">
                      <input type="radio" id="collect" value="Collect" name="delivery_type" class="delivery_type radio-input">
                      <label for="collect" onclick="close_address();" class="radio-label close_address">Collect</label>
                    </div>
                  </div> 
                </div>
                <?php
                if(isset($_SESSION['adress_added'])){ ?>
                <p class="message_address"> <?= $_SESSION['adress_added'];?></p>
                <?php
                  unset($_SESSION['adress_added']);
                }
                ?>
              </div>
              <div class="delivery_address delivery_address_off">
                <div class="address1">
                  <p>Delivery Address</p> 
                  <button onclick="insert_form();" class="new_address">New Address</button>
                </div>
                <div class="address_info">
                  <?php
                  $address_sql = "SELECT * FROM address_book WHERE user_id = '$user_id'";
                  $address_sql_run =  mysqli_query($connection, $address_sql);
                  if ($address_sql_run) {
                    if (mysqli_num_rows($address_sql_run) > 0) {
                      $count = 0;
                      foreach ($address_sql_run as $items) {
                        $count++; // Increment count at the beginning of the loop
                        ?>
                        <div class="radio_container">
                          <input type="radio" id="user_address<?= $count; ?>" value="<?= $items["id"]; ?>" name="choosen_address" class="radio_input" required>
                          <label for="user_address<?= $count; ?>" class="radio_label">
                            <div class="each_address">
                              <div class="name_close_container">
                                <p class="name_number"><?= $items["address_type"]; ?></p>
                                <form class="close_btn_container" action="functions/place_order.php" method="post">
                                  <input type="hidden"  name="address_id" value="<?= $items["id"]; ?>">
                                  <input type="hidden"  name="page" value="checkout_page">
                                  <button type="submit" name="delete_address_btn" class="product-name1"><img src="https://img.icons8.com/ios/50/delete-sign--v1.png" alt="delete-sign--v1"/></button>
                                </form>
                              </div>
                              <p><?= $items["complex_name"]; ?></p>
                              <p><?= $items["address_street"]; ?></p>
                              <p><?= $items["suburb"]; ?>, <?= $items["town"]; ?>, <?= $items["postal_code"]; ?></p>
                              <p class="name_number"><?= $items["recipient_name"]; ?>&nbsp;&nbsp;&nbsp;&nbsp;<?= $items["phone_number"]; ?></p>
                            </div>
                          </label>
                        </div>
                        <?php
                      }
                    }
                  } else {
                    $_SESSION['adress_added'] = 'Execution Error: '. $connection->error;
                    header('Location: ../adress_added.php');
                  }
                  ?>
                </div>
              </div>
              <div class="insert_address_info insert_address_off">
                <form enctype="multipart/form-data" action="functions/place_order.php" method="POST">
                  <p>Add New Address</p>
                  <div class="form-group">
                    <div class="radio-container">
                      <input type="radio" id="residency" value="Residential" name="address_type" class="radio-input" required>
                      <label for="residency" class="radio-label">Residential</label>
                    </div>
                    <div class="radio-container">
                      <input type="radio" id="business" value="Business" name="address_type" class="radio-input">
                      <label for="business" class="radio-label">Business</label>
                    </div>
                  </div>  
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" required>
                  </div>    
                  <div class="form-group">
                    <label for="phone_number">Mobile Number</label>
                    <input type="text" name="phone_number" required>
                  </div>
                  <div class="form-group">
                    <label for="complex_name">Complex / Buiding Name</label>
                    <input type="text" name="complex_name" required>
                  </div>  
                  <div class="form-group">
                    <label for="address_street">Address Street</label>
                    <input type="text" name="address_street" required>
                  </div>          
                  <div class="form-group">
                    <label for="suburb">Suburb</label>
                    <input type="text" name="suburb" required>
                  </div> 
                  <div class="form-group">
                    <label for="town">City / Town</label>
                    <input type="text" name="town" required>
                  </div> 
                  <div class="form-group">
                    <label for="name">Province</label>
                    <select name="province" class="categotySelect" required>
                      <option disabled selected hidden>Select Province</option>
                      <option value="Eastern Cape">Eastern Cape</option>
                      <option value="Free State">Free State</option>
                      <option value="Gauteng">Gauteng</option>
                      <option value="KwaZulu-Natal">KwaZulu-Natal</option>
                      <option value="Limpopo">Limpopo</option>
                      <option value="Mpumalanga">Mpumalanga</option>
                      <option value="Northern Cape">Northern Cape</option>
                      <option value="North West">North West</option>
                      <option value="Western Cape">Western Cape</option>
                    </select>
                  </div> 
                  <div class="form-group">
                    <label for="postal_code">Postal Code</label>
                    <input type="text" name="postal_code" required>
                  </div> 
                  <div class="form-group">
                    <input type="hidden"  name="page" value="checkout_page">
                    <button type="submit" name="save_address_btn">Save Address</button>
                  </div>
                </form>
              </div>
              <div class="delivery_address">
                <div class="address1">
                  <p>Payment Method</p> 
                </div>
                <div class="address_info">
                  <div class="radio_container">
                    <input type="radio" onclick="toggleMessage()" id="card" value="Credit and Debit Card" name="choosen_payment" class="radio_input" required>
                    <label for="card" class="radio_label">
                      <div class="each_address">
                        <p>Credit & Debit Card</p>
                        <div class="card_options">
                          <a href=""><img class="payment_method_icon" src="https://skanticket.com/img/visa.666f05f2.png" alt=""></a>
                          <a href=""><img class="payment_method_icon" src="https://logodownload.org/wp-content/uploads/2014/07/mastercard-logo.png" alt=""></a>
                        </div>
                      </div>
                    </label>
                  </div>
                  <div id="display_card_info">
                    <div class="delivery_address">
                      <div class="address1">
                      <div class="customer_info_title">
                        <p>Card Details</p>
                      </div>
                        <button onclick="insert_form1();" class="new_address new_address1">New Card</button>
                      </div>
                      <div class="address_info">
                        <?php
                        $card_sql = "SELECT * FROM card_details WHERE user_id = '$user_id'";
                        $card_sql_run =  mysqli_query($connection, $card_sql);
                        if ($card_sql_run) {
                          if (mysqli_num_rows($card_sql_run) > 0) {
                            $count = 0;
                            foreach ($card_sql_run as $items) {
                              $count++; 
                              $last_4_digits = substr($items["card_number"], -4);
                              ?>
                              <div class="radio_container">
                                <input type="radio" id="user_address<?= $count; ?>" value="<?= $items["id"]; ?>" name="choosen_address" class="radio_input" required>
                                <label for="user_address<?= $count; ?>" class="radio_label">
                                  <div class="each_address">
                                    <div class="name_close_container">
                                      <p class="name_number">Card Ending with <?=  $last_4_digits; ?></p>
                                      <form class="close_btn_container" action="functions/place_order.php" method="post">
                                        <input type="hidden"  name="card_id" value="<?= $items["id"]; ?>">
                                        <input type="hidden"  name="page" value="checkout_page">
                                        <button type="submit" name="delete_card_btn" class="product-name1"><img src="https://img.icons8.com/ios/50/delete-sign--v1.png" alt="delete-sign--v1"/></button>
                                      </form>
                                    </div>
                                    <p><?= $items["name_on_card"]; ?></p>
                                    <p>Visa ****<?= $last_4_digits; ?></p>
                                    <p>Expires <?= $items["expiry_month"]; ?>, <?= $items["expiry_year"]; ?></p>
                                  </div>
                                </label>
                              </div>
                              <?php
                            }
                          }
                        } else {
                          $_SESSION['adress_added'] = 'Execution Error: '. $connection->error;
                          header('Location: ../adress_added.php');
                        }
                        ?>
                      </div>
                    </div>
                    <div class="insert_address_info insert_address1_off">
                      <form id="add_card" enctype="multipart/form-data" action="functions/place_order.php" method="POST">
                        <p>Add Card Details</p>  
                        <div class="form-group">
                          <label for="name_on_card">Name on Card</label>
                          <input type="text" name="name_on_card" required>
                        </div>    
                        <div class="form-group">
                          <label for="card_number">Card Number</label>
                          <input type="number" id="card_number" name="card_number" required>
                        </div>
                        <div class="form-group">
                          <label for="name">Expiry Month</label>
                          <select name="expiry_month" class="categotySelect" required>
                            <option disabled selected hidden>Select Month</option>
                            <option value="January">January</option>
                            <option value="February">February</option>
                            <option value="March">March</option>
                            <option value="April">April</option>
                            <option value="May">May</option>
                            <option value="June">June</option>
                            <option value="July">July</option>
                            <option value="August">August</option>
                            <option value="September">September</option>
                            <option value="October">October</option>
                            <option value="November">November</option>
                            <option value="December">December</option>
                          </select>
                        </div>  
                        <div class="form-group">
                          <label for="expiry_year">Expiry Year</label>
                          <input type="number" id="expiry_year" name="expiry_year" required>
                        </div> 
                        <div class="form-group">
                          <label for="cvv">CVV</label>
                          <input type="text" name="cvv" required>
                        </div> 
                        <div class="form-group">
                          <input type="hidden"  name="page" value="checkout_page">
                          <button type="submit" name="save_card_btn">Save Card</button>
                        </div>
                      </form>
                    </div>
                  </div>
                  <?php
                        if(isset($_SESSION['card_added'])){ 
                          ?>
                          <p class="message_address"> <?= $_SESSION['card_added'];?></p>
                          <?php
                          unset($_SESSION['card_added']);
                        }
                      ?>
                  <div class="radio_container">
                    <input type="radio" onclick="toggleMessage()" id="paypal" value="Paypal" name="choosen_payment" class="radio_input">
                    <label for="paypal" class="radio_label">
                      <div class="each_address">
                        <p>Paypal</p>
                        <div class="card_options">
                          <a href=""><img class="payment_method_icon" src="https://logos-world.net/wp-content/uploads/2020/04/PayPal-Emblem.png" alt=""></a>
                        </div>
                      </div>
                    </label>
                  </div>
                  <div class="radio_container">
                    <input type="radio" onclick="toggleMessage()" id="cash" value="Cash" name="choosen_payment" class="radio_input">
                    <label for="cash" class="radio_label">
                      <div class="each_address">
                        <p>Cash</p>
                        <div class="card_options">
                          <img width="28" height="28" src="https://img.icons8.com/doodle/48/money.png" alt="money"/>
                        </div>
                      </div>
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <div class="checkout_details2">
              <div class="product_info_container">
                <div class="info_dropdown">
                  <span class="order_s">Order summary (<?= $cart_count; ?>)</span>
                  <span><a href="cart_page.php">Edit Cart</a></span>
                </div>
                <hr>
                <div class="order_summary">
                  <?php
                  $initial_amout = 0;
                  $index = 0;
                  foreach ($result as $items) {
                    $initial_amout = $initial_amout + ($items["price"] * $items["product_qty"]);
                    $index = $index + 1;
                    $_SESSION['count'] = $index;
                    ?>
                    <div class="product_in_checkout">
                      <div class="img_container">
                        <p class="product_img"><img src="admin/uploads/<?= $items["image_1"]; ?>" alt="<?= $items["image_1"]; ?>"></p>
                      </div>
                      <div class="middle_container1">
                        <div class="name_container1">
                          <p class="product-name1"><?= $items["product_name"]; ?></p>
                        </div>
                        <div class="prod_qty_container">
                          <label for="quantity">QTY: </label>
                          <input type="text" value="<?= $items["product_qty"]; ?>" class="quantity" id="quantity" min="1">
                          <span class="product-name1">R<span class="itotal"><?= $items["price"] * $items["product_qty"]; ?></span></span>
                        </div>
                      </div>
                    </div>
                    <hr>
                    <?php
                  }
                  ?>
                </div>
                <div class="initial_amout">
                  <p>Subtotal</p>
                  <p>R<span id="gtotal"><?= $initial_amout; ?></span></p>
                </div>
                <?php
                $deliver = 0;
                $total = $initial_amout;

                if ($initial_amout < 500) {
                  $deliver = $initial_amout * 0.15;
                  $total += $deliver;
                }
                ?>
                <div class="delivery">
                  <p>Delivery</p>
                  <p>
                    <span><span id="deliver"><?= ($deliver > 0) ? number_format($deliver, 2) : 'FREE'; ?></span></span>
                  </p>
                </div>
                <div class="delivery">
                  <p>VAT</p>
                  <span>R0.00</span>
                </div>
                <hr> 
                <div class="final_price">
                  <p>Total</p>
                  <p>R<span id="total"><?= number_format($total, 2); ?></span></p>
                </div>
              </div> 
              <form class="cart_wish_container" action="functions/place_order.php" method="post">
                <input type="hidden"  name="delivery_type_h" value="delivery_type" id="delivery_type_hidden">
                <input type="hidden"  name="choosen_address_h" value="choosen_address" id="choosen_address_hidden">
                <input type="hidden"  name="choosen_payment_h" value="choosen_payment" id="choosen_payment_hidden">
                <input type="hidden"  name="delivery" value="<?= $deliver; ?>">
                <input type="hidden"  name="payment_id" value="">
                <input class="add_product_button-js" type="submit"  value="Order" name="make_checkout_btn">
              </form>
              <div class="secure_checkout">
                <img src="https://img.icons8.com/ios-glyphs/30/lock--v1.png" alt="lock--v1"/>
                <p>Secure Checkout</p>
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
              <p>Cart is empty (<a href="login.php">Click here to Login</a>)</p>
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