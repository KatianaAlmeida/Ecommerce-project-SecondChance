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
      <h2>Customers & Visitors</h2>
      <p class="description">View customer and visitor details</p>
      <div class="search_users">
        <div class="search_users_container">
          <input class="search_users_input" placeholder="Search for products">
          <div class="search_img_container">
            <img class="search_img" src="https://img.icons8.com/ios-glyphs/30/search--v1.png" alt="search--v1" />
          </div>
        </div>
      </div>
      <table class="displayUser">
        <tr>
          <th>Full Name</th>
          <th>Email</th>
          <th>Role</th>
          <th>All Orders</th>
        </tr>
        <?php
        $sql = "SELECT id, full_name, email, 'Customer' AS role
                  FROM users
                  WHERE role = 'Customer' 
                  UNION
                  SELECT id, 
                    CONCAT(first_name, ' ', last_name) AS full_name,
                    email,
                    'Visitor' AS role
                  FROM visitor";
        $result = mysqli_query($connection, $sql);

        if ($result) {
          if (mysqli_num_rows($result) > 0) {
            foreach ($result as $items) {
              ?>
              <tr>
                <td class="user_row"><?= $items["full_name"]; ?></td>
                <td class="user_row"><?= $items["email"]; ?></td>
                <td class="user_row"><?= $items["role"]; ?></td>
                <td class="user_row">
                  <?php if ($items["role"] != 'Visitor') { ?>
                    <form action="/admin/functions/updateUsers.php" method="POST">
                      <input type="hidden" name="customer_id" value="<?= $items["id"]; ?>">
                      <input type="hidden" name="full_name" value="<?= $items["full_name"]; ?>">
                      <button class="delete_button" name="customer_id_btn">View</button>
                    </form>
                  <?php } ?>
                </td>
              </tr>
            <?php
            }
          } else {
            ?>
            <span class="message">No users found!</span>
            <?php
          }
        } else {
          ?>
          <span class="message">Execution Error: <?= $connection->error; ?></span>
          <?php
        }
        ?>
      </table>
    </div>
    <div class="form_container table-container">
      <h2>Customer Order</h2>
      <p class="description">View basic information about the customer purchase.</p>
      <div class="form-group">
        <?php
        if (isset($_SESSION['getID_message'])) { ?>
          <input type="hidden" name="customer_id" value="<?= $_SESSION['id']; ?>">
          <input type="hidden" name="full_name" value="<?= $_SESSION['name']; ?>">
          <span class="message"><?= $_SESSION['getID_message']; ?></span>
          <?php
          unset($_SESSION['getID_message']);
        } else {
          ?>
          <span class="message">Click the 'view' button to see the customer's order!</span>
          <?php
        }
        ?>
      </div>
      <div class="contentt_container">
        <?php
        if (isset($_SESSION['id'])) {
          $user_id = $_SESSION['id'];
          $sql = "SELECT * FROM orders WHERE userd_id = '$user_id'";
          $result = mysqli_query($connection, $sql);
  
          if ($result) {
            if (mysqli_num_rows($result) > 0) {
              ?>
              <table class="styled_table1">
                <tr>
                  <th>Date</th>
                  <th>Order Number</th>
                  <th>Status</th>
                  <th>Price</th>
                  <th>Mode</th>
                </tr>
                <?php
                foreach ($result as $items) {
                  $tracking_no = $items["tracking_no"];
                  $total_price = $items["total_price"];
                  ?>
                  <tr>
                    <td class="user_row"><?= date('Y-m-d', strtotime($items["created_at"])); ?></td>
                    <td class="user_row">#<?= $tracking_no; ?></td>
                    <td class="user_row"><?= $items["status"]; ?></td>
                    <td class="user_row">R<?= $total_price; ?></td>
                    <td class="user_row"><?= $items["delivery_mode"]; ?></td>
                  </tr>
                  <?php
                }
                ?>
              </table>
              <?php
            } else {
              ?>
              <p class="message_order">No orders found!</p>
              <?php
            }
          } else {
            ?>
            <p class="message_order">Execution Error: <?= $connection->error; ?></p>
            <?php
          }
          unset($_SESSION['name']);
          unset($_SESSION['id']);
        }else{
          ?>
          <p class="message_order">Which users order do you wish to view?</p>
          <?php
        }
        ?>
      </div>
    </div>
  </main>
</div>
<?php
include('includes/footer.php');
?>