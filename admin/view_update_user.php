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
      <div class="form_container table-container">
        <h2>All Users</h2>
        <p class="description">View user information below</p>  
        <div class="search_users">
          <div class="search_users_container">
            <input class="search_users_input" placeholder="Search for users" >
            <div class="search_img_container"><img class="search_img" src="https://img.icons8.com/ios-glyphs/30/search--v1.png" alt="search--v1"/></div>
          </div>  
          <div class="radio-container">
            <button class="new_user"><a href="add_users.php">+ Add new</a></button>
          </div>
        </div>
        <?php
        include('functions/viewUsers.php');
        ?>
      </div>
      <div class="form_container">
        <h2>Update Details or Delete Users</h2>
        <p class="description">Update or delete users (type username)</p>
        <form id="update-details" action="functions/updateUsers.php" method="POST">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" required>
        </div>  
        <div class="form-group">
              <label for="fullName">Full Name</label>
              <input type="text" id="fullName" name="fullName">
          </div>
          <div class="form-group">
              <label for="email">Email</label>
              <input type="email" id="email" name="email">
          </div>
          <div class="form-group">
            <p>User role</p>
            <div class="radio-container">
              <input type="radio" id="admin" name="role" value="admin" class="radio-input">
              <label for="admin" class="radio-label">Administrator</label>
            </div>
            <div class="radio-container">
              <input type="radio" id="Support" name="role" value="Support" class="radio-input">
              <label for="Support" class="radio-label">Customer Support</label>
            </div>
            <div class="radio-container">
              <input type="radio" id="manager" name="role" value="manager" class="radio-input">
              <label for="manager" class="radio-label">Manager</label>
            </div>
          </div>
          <div class="form-group">
              <label for="password">Password</label>
              <input type="password" id="password" name="password">
          </div>
          <div class="form-group">
              <label for="confirm-password">Confirm Password</label>
              <input type="password" id="confirm-password" name="confirm-password">
          </div>
          <div class="form-group">
              <button type="submit" name="update-btn">Update</button>
              <button type="submit" name="delete-btn">Delete</button>
              <?php
                if(isset($_SESSION['update'])){ ?>
                <span class="message js-message"> <?= $_SESSION['update'];?></span>
                <?php
                  unset($_SESSION['update']);
                }
              ?>
          </div>
        </form>
      </div>
    </main>
  </div>
<?php
 include('includes/footer.php');
?>