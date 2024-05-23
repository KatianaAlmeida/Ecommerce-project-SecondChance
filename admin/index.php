<?php
 session_start();
 include('../config/dbcon.php');

 include('includes/header.php');
 include('includes/sideBar.php');
 ?>
 <div class="login_container">
    <!-- content/page section -->
    <main class="content">
      <div class="login_form_container">
        <h2>Login to account</h2>
        <p class="description">Enter your email & password to login</p>
        <form id="user-details" action="functions/authcode.php" method="POST">
          <div class="form-group">
              <label for="email">Email</label>
              <input type="email" id="email" name="email" required>
          </div>
          <div class="form-group">
              <label for="password">Password</label>
              <input type="password" id="password" name="password" required>
          </div>
          
          <div class="form-group">
              <button type="submit" name="login-btn">Login</button>
              <?php
                if(isset($_SESSION['message'])){ ?>
                <span class="message"> <?= $_SESSION['message'];?></span>
                <?php
                  unset($_SESSION['message']);
                }
              ?>
          </div>
        </form>
      </div>
    </main>
  </div>
<?php
 //include('includes/footer.php');
?>