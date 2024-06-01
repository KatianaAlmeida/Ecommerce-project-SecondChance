<?php
 session_start();
 include('../config/dbcon.php');
 
 if(!isset($_SESSION['auth_admin'])){
  header('Location: /admin/index.php');
 };

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
      <div class="dashboard_main_container">
        <div class="dashboard_title">
          <h2>Dashboard Overview</h2>
          <p ch2lass="description">View all the information below</p>
        </div>
        <div class="dashboard_content_container">
          <a class="dashboard_content" href="update_products.php">
            <div>
              <?php
              $sql ="SELECT COUNT(*) AS total_products FROM products";
              $sql_run = mysqli_query($connection, $sql);

              if ($sql_run && mysqli_num_rows($sql_run) > 0) {
                foreach ($sql_run as $items) {
                  ?>
                    <p><?= $items["total_products"]; ?></p>
                    <span>Products</span>
                  <?php        
                }
              }else{
                ?>
                <p>Error: <?= $connection->error; ?></p>
                <?php
              }
              ?>
            </div>
            <div>
              <img src="https://img.icons8.com/dotty/80/737373/shopping-cart.png" alt="shopping-cart"/>
            </div>
          </a>
          <a class="dashboard_content" href="category.php">
            <div>
              <?php
              $sql ="SELECT COUNT(*) AS total_categories FROM categories";
              $sql_run = mysqli_query($connection, $sql);

              if ($sql_run && mysqli_num_rows($sql_run) > 0) {
                foreach ($sql_run as $items) {
                  ?>
                    <p><?= $items["total_categories"]; ?></p>
                    <span>Categories</span>
                  <?php        
                }
              }else{
                ?>
                <p>Error: <?= $connection->error; ?></p>
                <?php
              }
              ?>
            </div>
            <div>
              <img src="https://img.icons8.com/dotty/80/737373/product.png" alt="product"/>
            </div>
          </a>        
          <a class="dashboard_content" href="orders.php">
            <div>
              <?php
              $sql ="SELECT COUNT(*) AS completed_orders FROM orders WHERE status = 'Completed';";
              $sql_run = mysqli_query($connection, $sql);

              if ($sql_run && mysqli_num_rows($sql_run) > 0) {
                foreach ($sql_run as $items) {
                  ?>
                    <p><?= $items["completed_orders"]; ?></p>
                    <span>Completed Orders</span>
                  <?php        
                }
              }else{
                ?>
                <p>Error: <?= $connection->error; ?></p>
                <?php
              }
              ?>
            </div>
            <div>
              <img src="https://img.icons8.com/dotty/80/737373/task-completed.png" alt="task-completed"/>
            </div>
          </a>         
          <a class="dashboard_content" href="orders.php">
            <div>
              <?php
              $sql ="SELECT COUNT(*) AS in_progress_orders FROM orders WHERE status = 'In Progress';";
              $sql_run = mysqli_query($connection, $sql);

              if ($sql_run && mysqli_num_rows($sql_run) > 0) {
                foreach ($sql_run as $items) {
                  ?>
                    <p><?= $items["in_progress_orders"]; ?></p>
                    <span>In Progress Orders</span>
                  <?php        
                }
              }else{
                ?>
                <p>Error: <?= $connection->error; ?></p>
                <?php
              }
              ?>
            </div>
            <div>
              <img src="https://img.icons8.com/dotty/80/737373/purchase-order.png" alt="purchase-order"/>
            </div>
          </a> 
          <a class="dashboard_content" href="orders.php">
            <div>
              <?php
              $sql ="SELECT COUNT(*) AS shipped_orders FROM orders WHERE status = 'Shipped';";
              $sql_run = mysqli_query($connection, $sql);

              if ($sql_run && mysqli_num_rows($sql_run) > 0) {
                foreach ($sql_run as $items) {
                  ?>
                    <p><?= $items["shipped_orders"]; ?></p>
                    <span>Shipped Orders</span>
                  <?php        
                }
              }else{
                ?>
                <p>Error: <?= $connection->error; ?></p>
                <?php
              }
              ?>
            </div>
            <div>
              <img src="https://img.icons8.com/dotty/80/737373/shipped.png" alt="shipped"/>
            </div>
          </a> 
          <a class="dashboard_content" href="orders.php">
            <div>
              <?php
              $sql ="SELECT COUNT(*) AS cancelled_orders FROM orders WHERE status = 'Cancelled';";
              $sql_run = mysqli_query($connection, $sql);

              if ($sql_run && mysqli_num_rows($sql_run) > 0) {
                foreach ($sql_run as $items) {
                  ?>
                    <p><?= $items["cancelled_orders"]; ?></p>
                    <span>Cancelled Orders</span>
                  <?php        
                }
              }else{
                ?>
                <p>Error: <?= $connection->error; ?></p>
                <?php
              }
              ?>
            </div>
            <div>
              <img src="https://img.icons8.com/ios/80/737373/cancel-order.png" alt="cancel-order"/>
            </div>
          </a> 
          <a class="dashboard_content" href="view_update_user.php">
            <div>
              <?php
              $sql ="SELECT COUNT(*) AS staff FROM users WHERE role != 'customer';";
              $sql_run = mysqli_query($connection, $sql);

              if ($sql_run && mysqli_num_rows($sql_run) > 0) {
                foreach ($sql_run as $items) {
                  ?>
                    <p><?= $items["staff"]; ?></p>
                    <span>Staff and Admin</span>
                  <?php        
                }
              }else{
                ?>
                <p>Error: <?= $connection->error; ?></p>
                <?php
              }
              ?>
            </div>
            <div>
              <img src="https://img.icons8.com/dotty/80/737373/conference-background-selected.png" alt="conference-background-selected"/>
            </div>
          </a> 
          <a class="dashboard_content" href="add_users.php">
            <div>
              <span>Roles</span>
              <span>&</span>
              <span>Permissions</span>
            </div>
            <div>
              <img src="https://img.icons8.com/ios/50/737373/connection-to-account.png" alt="connection-to-account"/>
            </div>
          </a>
          <a class="dashboard_content" href="customer_details.php">
            <div>
              <?php
              $sql ="SELECT COUNT(*) AS customer FROM users WHERE role = 'customer';";
              $sql_run = mysqli_query($connection, $sql);

              if ($sql_run && mysqli_num_rows($sql_run) > 0) {
                foreach ($sql_run as $items) {
                  ?>
                    <p><?= $items["customer"]; ?></p>
                    <span>Customer</span>
                  <?php        
                }
              }else{
                ?>
                <p>Error: <?= $connection->error; ?></p>
                <?php
              }
              ?>
            </div>
            <div>
              <img src="https://img.icons8.com/carbon-copy/80/737373/budget.png" alt="budget"/>
            </div>
          </a> 
          <a class="dashboard_content" href="customer_messages.php">
            <div>
              <?php
              $sql ="SELECT COUNT(*) AS total_messages FROM message";
              $sql_run = mysqli_query($connection, $sql);

              if ($sql_run && mysqli_num_rows($sql_run) > 0) {
                foreach ($sql_run as $items) {
                  ?>
                    <p><?= $items["total_messages"]; ?></p>
                    <span>Total Messages</span>
                  <?php        
                }
              }else{
                ?>
                <p>Error: <?= $connection->error; ?></p>
                <?php
              }
              ?>
            </div>
            <div>
              <img src="https://img.icons8.com/dotty/80/737373/imessage.png" alt="imessage"/>
            </div>
          </a>
          <a class="dashboard_content" href="review.php">
            <div>
              <?php
              $sql ="SELECT COUNT(*) AS total_reviews FROM reviews";
              $sql_run = mysqli_query($connection, $sql);

              if ($sql_run && mysqli_num_rows($sql_run) > 0) {
                foreach ($sql_run as $items) {
                  ?>
                    <p><?= $items["total_reviews"]; ?></p>
                    <span>Total Reviews</span>
                  <?php        
                }
              }else{
                ?>
                <p>Error: <?= $connection->error; ?></p>
                <?php
              }
              ?>
            </div>
            <div>
              <img src="https://img.icons8.com/dotty/80/737373/ratings.png" alt="ratings"/>
            </div>
          </a>
          <a class="dashboard_content" href="inventory.php">
            <div>
              <span>Low</span>
              <span>Medium</span>
              <span>Good</span>
            </div>
            <div>
              <img src="https://img.icons8.com/wired/80/737373/medium-battery.png" alt="medium-battery"/>
            </div>
          </a>
        </div>
      </div>
    </main>
  </div>
<?php
 include('includes/footer.php');
?>