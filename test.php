<div class="form_container">
    <h2>Registered Users</h2>
    <p class="description">View customer and visitor details</p>  
    <div class="search_users">
      <div class="search_users_container">
        <input class="search_users_input" placeholder="Search for products">
        <div class="search_img_container">
          <img class="search_img" src="https://img.icons8.com/ios-glyphs/30/search--v1.png" alt="search--v1"/>
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
                'visitor' AS role
              FROM visitor;";
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
                <?php if ($items["role"] != 'visitor') { ?>
                  <form action="/admin/functions/everthing_products.php" method="POST">
                    <input type="hidden" name="product_id" value="<?= $items["id"]; ?>">
                    <button class="delete_button" name="delete_products-btn">View</button>
                  </form>
                <?php } ?>
              </td>
            </tr>
      <?php
          }
      ?>
    </table>
      <?php
        } else {
          $_SESSION['delete_message'] = 'No category found!';
          header('Location: ../category.php');
          exit();
        }
      } else {
        $_SESSION['delete_message'] = 'Execution Error: ' . $connection->error;
        header('Location: ../category.php');
        exit();
      }
      ?>

    <div class="form-group">
      <?php if (isset($_SESSION['delete_message'])) { ?>
        <span class="message"><?= $_SESSION['delete_message']; ?></span>
      <?php unset($_SESSION['delete_message']); } ?>
    </div>
  </div>