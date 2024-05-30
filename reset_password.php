<?php
 session_start();
 include('components/header.php');
 ?>
<div class="register_container">
  <div class="form_container">
    <div class="close_register"><a href="login.php"><img src="https://img.icons8.com/ios/50/close-window--v1.png" alt="close-window--v1"/></a></div>
    <h1 class="resettitle">Reset password</h1>
    <p class="description">Enter your login email and we'll send you a link to reset your password</p>
    <form id="user-details" action="functions/update_user_info.php" method="POST">
      <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" required>
      </div>
      <div class="form-group">
          <button type="submit" name="reset-btn">Reset Password</button>
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
</div>
 
<?php
 //include('includes/footer.php');
?>