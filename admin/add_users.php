<?php
  session_start();
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
      <div class="form_container">
        <h2>User Registration</h2>
        <p class="description">Fill in the information below to add a new account</p>
        <form id="user-details" action="functions/authcode.php" method="POST">
          <div class="form-group">
              <label for="fullName">Full Name</label>
              <input type="text" id="fullName" name="fullName" required>
          </div>
          <div class="form-group">
              <label for="username">Username</label>
              <input type="text" id="username" name="username" required>
          </div>
          <div class="form-group">
              <label for="email">Email</label>
              <input type="email" id="email" name="email" required>
          </div>
          <div class="form-group">
              <label for="password">Password</label>
              <input type="password" id="password" name="password" required>
          </div>
          <div class="form-group">
              <label for="confirm-password">Confirm Password</label>
              <input type="password" id="confirm-password" name="confirm-password" required>
          </div>
          <div class="form-group">
            <p>User role</p>
            <div class="radio-container">
              <input type="radio" id="admin" name="role" value="admin" class="radio-input">
              <label for="admin" class="radio-label">Admin</label>
            </div>
            <div class="radio-container">
              <input type="radio" id="staff" name="role" value="staff" class="radio-input">
              <label for="staff" class="radio-label">Staff</label>
            </div>
          </div>
          <div class="form-group">
              <button type="submit" name="register-btn">Register</button>
              <?php
                if(isset($_SESSION['message'])){ ?>
                <span class="message js-message"> <?= $_SESSION['message'];?></span>
                <?php
                  unset($_SESSION['message']);
                }
              ?>
          </div>
        </form>
      </div>
      <div class="form_container">
        <h2>Permission</h2>
        <p class="description">Products that the account is allowed to edit</p>
        <form id="user-permissions" action="functions/permission.php" method="POST">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" name="username" required>
        </div> 
        <div class="form-group">
          <p>Add product</p>
          <div class="radio-container">
            <input type="radio" id="addAllowed" value="allow" name="permission_to_add" class="radio-input">
            <label for="addAllowed" class="radio-label">Allow</label>
          </div>
          <div class="radio-container">
            <input type="radio" id="addDenied" value="deny" name="permission_to_add" class="radio-input">
            <label for="addDenied" class="radio-label">Deny</label>
          </div>
        </div>
        <div class="form-group">
          <p>Update product</p>
          <div class="radio-container">
            <input type="radio" id="updateAllowed" value="allow" name="permission_to_update" class="radio-input">
            <label for="updateAllowed" class="radio-label">Allow</label>
          </div>
          <div class="radio-container">
            <input type="radio" id="updateDenied" value="deny" name="permission_to_update" class="radio-input">
            <label for="updateDenied" class="radio-label">Deny</label>
          </div>
        </div>
        <div class="form-group">
          <p>Delete product</p>
          <div class="radio-container">
            <input type="radio" id="deleteAllowed" value="allow" name="permission_to_delete" class="radio-input">
            <label for="deleteAllowed" class="radio-label">Allow</label>
          </div>
          <div class="radio-container">
            <input type="radio" id="deleteDenied" value="deny" name="permission_to_delete" class="radio-input">
            <label for="deleteDenied" class="radio-label">Deny</label>
          </div>
        </div>
        <div class="form-group">
            <button type="submit" name="save-btn">Save</button>
            <?php
              if(isset($_SESSION['permission_message'])){ ?>
              <span class="message js-message"> <?= $_SESSION['permission_message'];?></span>
              <?php
                unset($_SESSION['permission_message']);
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