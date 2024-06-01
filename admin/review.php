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
      <div class="form_container2 table-container">
        <h2>Product Review List</h2>
        <p class="description">View and reply to customer's review.</p>  
        <div class="search_users">
          <div class="search_users_container">
            <input class="search_users_input" placeholder="Search for message" >
            <div class="search_img_container"><img class="search_img" src="https://img.icons8.com/ios-glyphs/30/search--v1.png" alt="search--v1"/></div>
          </div>  
        </div>
        <table class="displayUser">
          <tr>
            <th>Reviewer_name</th>
            <th>Product_name</th>
            <th>SKU</th>
            <th>Title</th>
            <th>Content</th>
            <th>Rating</th>
            <th>Uploads</th>
            <th>Date</th>
            <th>Approval</th>
          </tr>
          <?php
          $sql = "SELECT  r.id, r.title, r.content, r.rating, r.image, r.created_at AS review_date,
                  p.product_name,
                  p.incremented_name AS SKU,
                  u.username AS reviewer_name,
                  u.email AS reviewer_email
                  FROM reviews r JOIN  products p ON r.product_id = p.id
                  JOIN  users u ON r.user_id = u.id;";
          $result =  mysqli_query($connection, $sql);

          if ($result) {
          if (mysqli_num_rows($result) > 0) {
            foreach ($result as $items) {
              ?>
                <tr>
                  <td class="user_row"><?= $items["reviewer_name"]; ?></td>
                  <td class="user_row"><?= $items["product_name"]; ?></td>
                  <td class="user_row"><?= $items["SKU"]; ?></td>
                  <td class="user_row"><?= $items["title"]; ?></td>
                  <td class="user_row"><?= $items["content"]; ?></td>
                  <td class="user_row"><?= $items["rating"]; ?></td>
                  <td class="user_row"><img width="70px" height="70px" src="../uploads/<?= $items["image"];?>" alt="<?= $items["product_name"]; ?>"></td>
                  <td class="user_row"><?= date('Y-m-d', strtotime($items["review_date"])); ?></td>
                  <td class="user_row">
                    <form action="/admin/functions/everthing_products.php" method="POST">
                      <input type="hidden" name="review_id" value="<?= $items["id"]; ?>">
                      <button class="delete_button" name="delete_products_review_btn">Delete</button>
                    </form>
                  </td>
                </tr>
              <?php        
            }
            ?>
           </table>
            <?php
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
    </main>
  </div>
<?php
 include('includes/footer.php');
?>