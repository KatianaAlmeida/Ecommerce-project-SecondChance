<?php
session_start();
include('../config/dbcon.php');

if (!isset($_SESSION['auth_admin'])) {
  header('Location: /admin/index.php');
  exit();
}

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
    <div class="form_container" style="overflow-x: auto;">
      <h2>All Orders</h2>
      <p class="description">View customers order history or update the status of a recent order.</p>
      <div class="contentt_container">
          <?php
          $sql = "SELECT * FROM orders";
          $result =  mysqli_query($connection, $sql);

        if ($result) {
          if (mysqli_num_rows($result) > 0) {
            ?>
            <div class=""></div>
            <table class="styled_table1">
              <tr>
                <th>Date</th>
                <th>Order Number</th>
                <th>Status</th>
                <th>Order Details</th>
                <th>Manage Status</th>
              </tr>
              <?php 
              foreach ($result as $index => $items) { 
                $tracking_no = $items["tracking_no"]; 
                $total_price = $items["total_price"];
                ?>
                <tr>
                  <td class="user_row"><?= date('Y-m-d', strtotime($items["created_at"])); ?></td>
                  <td class="user_row">#<?= $tracking_no; ?></td>
                  <td class="user_row"><?= $items["status"]; ?></td>
                  <td class="user_row"><button class="new_address expand_btn" data-index="<?= $index; ?>">Expand</button></td>
                  <td class="user_row">
                    <form action="/admin/functions/everthing_products.php" method="POST">
                      <input type="hidden" name="customer_id" value="<?= $items["userd_id"]; ?>">
                      <input type="hidden" name="tracking_no" value="<?= $items["tracking_no"]; ?>">
                      <button class="change_color" name="set_tracking_no_btn">update</button>
                    </form>
                  </td>
                </tr>
                <tr class="order_detail details_off" id="details-<?= $index; ?>">
                  <td colspan="5">
                    <?php
                    $order_detail = "SELECT 
                      p.image_1 AS image,
                      p.product_name,
                      p.incremented_name AS SKU,
                      p.price,
                      oi.qty AS product_quantity,
                      o.delivery_fee,
                      ab.recipient_name,
                      ab.address_type,
                      ab.complex_name,
                      ab.address_street,
                      ab.suburb,
                      ab.town,
                      ab.province,
                      ab.postal_code,
                      ab.phone_number
                      FROM order_items oi JOIN orders o ON oi.order_id = o.id JOIN address_book ab ON o.address_id = ab.id
                      JOIN products p ON oi.product_id = p.id
                      WHERE o.id = oi.order_id AND o.tracking_no = '$tracking_no'";
                      $order_detail_run =  mysqli_query($connection, $order_detail);

                      if ($order_detail_run && mysqli_num_rows($order_detail_run) > 0) {
                        ?>
                        <div class="all_products_order">
                          <?php
                          $subtotal = 0;
                          foreach ($order_detail_run as $items) {
                          ?>
                            <div class="div1">
                              <img src="uploads/<?= $items["image"];?>" alt="<?= $items["product_name"]; ?>">
                              <div>
                                <p><?= $items["product_name"]; ?></p>
                                <p>SKU: <?= $items["SKU"]; ?></p>
                              </div>
                              <div>
                                <p>QTY: <?= $items["product_quantity"]; ?></p>
                              </div>
                              <div>
                                <p>R <?= $items["price"]; ?></p>
                              </div>
                            </div>
                          <?php
                            $subtotal += $items["price"] * $items["product_quantity"];
                            $delivery_fee = $items["delivery_fee"];
                            $address_type = $items["address_type"];
                            $recipient_name = $items["recipient_name"];
                            $complex_name = $items["complex_name"];
                            $address_street = $items["address_street"];
                            $suburb = $items["suburb"];
                            $town = $items["town"];
                            $postal_code = $items["postal_code"];
                            $province = $items["province"];
                            $phone_number = $items["phone_number"];
                          }
                          ?>
                          <div class="div2 each_address">
                            <div class="div_1">
                              <h4>Shipping Information</h4>
                              <p class="name_number"><?= $address_type; ?></p>
                              <p><?= $recipient_name; ?></p>
                              <p><?= $complex_name; ?></p>
                              <p><?= $address_street; ?></p>
                              <p><?= $suburb; ?>, <?= $town; ?>, <?= $postal_code; ?></p>
                              <p><?= $province; ?></p>
                              <p class="name_number"><?= $phone_number; ?></p>
                            </div>
                            <div class="div_2">
                              <div>
                                <p>Subtotal</p>
                                <p>R<?= $subtotal; ?></p>
                              </div>
                              <div>
                                <p>Delivery Fee</p>
                                <p>R<?= $delivery_fee; ?></p>
                              </div>
                              <hr>
                              <div>
                                <p>Total</p>
                                <p>R<?= $total_price; ?></p>
                              </div>
                            </div>
                          </div>
                        </div>
                      <?php
                      }else {
                        $order_detail_collect = "SELECT 
                          p.image_1 AS image,
                          p.product_name,
                          p.incremented_name AS SKU,
                          p.price,
                          oi.qty AS product_quantity,
                          o.delivery_fee
                          FROM order_items oi 
                          JOIN orders o ON oi.order_id = o.id 
                          JOIN products p ON oi.product_id = p.id
                          WHERE o.id = oi.order_id AND o.tracking_no = '$tracking_no'";
                        $order_detail_collect_run =  mysqli_query($connection, $order_detail_collect);

                        if ($order_detail_collect_run && mysqli_num_rows($order_detail_collect_run) > 0) {
                          ?>
                          <div class="all_products_order">
                            <?php
                            $subtotal = 0;
                            foreach ($order_detail_collect_run as $items) { 
                              ?>
                              <div class="div1">
                                <img src="uploads/<?= $items["image"];?>" alt="<?= $items["product_name"]; ?>">
                                <div>
                                  <p><?= $items["product_name"]; ?></p>
                                  <p>SKU: <?= $items["SKU"]; ?></p>
                                </div>
                                <div><p>QTY: <?= $items["product_quantity"]; ?></p></div>
                                <div><p>R <?= $items["price"]; ?></p></div>
                              </div>
                              <?php
                                $subtotal += $items["price"] * $items["product_quantity"];
                                $delivery_fee =  $items["delivery_fee"];
                            }
                            ?>
                            <div class="div2 each_address">
                              <div class="div_1">
                                <h4>Store Location (Pick Up)</h4>
                                <p class="name_number">Business</p>
                                <p>Second Chance Emperium</p>
                                <p>53 Main Rd</p>
                                <p>Claremont, Cape Town, 7700</p>
                                <p>Western Cape</p>
                                <p class="name_number">123-456-7890</p>
                              </div>
                              <div class="div_2">
                                <div>
                                  <p>Subtotal</p>
                                  <p>R<?= $subtotal; ?></p>
                                </div>
                                <div>
                                  <p>VAT</p>
                                  <p>R<?= $delivery_fee; ?></p>
                                </div>
                                <hr>
                                <div>
                                  <p>Total</p>
                                  <p>R<?= $total_price; ?></p>
                                </div>
                              </div>
                            </div>
                          </div>
                          <?php
                        }else{
                          ?>
                          <p class="message_order">No products found in this order!</p>
                          <?php
                        }
                      }
                      ?>
                  </td>
                </tr>
                <?php 
              } 
            ?>
            </table>
            <?php
          } else {
            ?>
            <p class="message_order">No orders found! <a href="shop_all.php">Go to shop</a></p>
            <?php
          }
        } else {
          ?>
          <p class="message_order">Execution Error: <?= $connection->error;?></p>
          <?php
        }
        ?>
      </div>
    </div>
    <div class="form_container table-container">
      <h2>Customer Order</h2>
      <p class="description">Update order status</p>
      <div class="form-group">
        <?php
        if (isset($_SESSION['tracking_order'])) { ?>
          <p class=""><?= $_SESSION['tracking_order']; ?><span class="message">#<?= $_SESSION['tracking_no'];?></span></p>
          <?php
          unset($_SESSION['getID_message']);
        } else {
          ?>
          <span class="message">Click the 'update' button to change the order status!</span>
          <?php
        }
        ?>
      </div>
      <div class="contentt_container">
        <?php
        if (isset($_SESSION['tracking_order'])) {
          $customer_id = $_SESSION['customer_id'];
          $tracking_no = $_SESSION['tracking_no'];
          ?>
          <form action="/admin/functions/everthing_products.php" method="POST">
            <div class="form-group">
              <label for="name">New Status</label>
              <select name="new_status" class="categotySelect" required>
                <option disabled selected hidden>Select status</option>
                <option value="In progress">In progress</option>
                <option value="Completed">Completed</option>
                <option value="Cancelled">Cancelled</option>
                <option value="Shipped">Shipped</option>
              </select>
            </div>
            <div class="form-group">
              <input type="hidden" name="tracking_no" value="<?= $tracking_no; ?>">
              <input type="hidden" name="customer_id" value="<?= $customer_id; ?>">
              <button type="submit" name="update_status_btn">Save</button>
            </div>
          </form>
          <?php
          unset($_SESSION['tracking_no']);
          unset($_SESSION['tracking_order']);
          unset($_SESSION['customer_id']);
        }else{
          ?>
          <p class="">Which users order do you wish to update?</p>
          <?php
        }
        ?>
        <div class="form-group">
          <?php
          if(isset($_SESSION['delete_message'])){ ?>
          <span class="message"> <?= $_SESSION['delete_message'];?></span>
          <?php
            unset($_SESSION['delete_message']);
          }
          ?>
        </div>
      </div>
    </div>
  </main>
</div>
<?php
include('includes/footer.php');
?>