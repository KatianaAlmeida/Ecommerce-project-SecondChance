<?php
session_start();
 include('components/header.php');
?>

<div class="register_container">
  <div class="form_container">
    <div class="close_register"><a href="home.php"><img src="https://img.icons8.com/ios/50/close-window--v1.png" alt="close-window--v1"/></a></div>
    <h1 class="sign_up">Sign Up</h1>
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
          <button class="register" type="submit" name="register-btn">Register</button>
          <?php
            if(isset($_SESSION['message'])){ ?>
            <span class="message js-message"> <?= $_SESSION['message'];?></span>
            <?php
              unset($_SESSION['message']);
            }
          ?>
      </div>

      <div class="form-group">
        <p>Alredy a member?<a href="login.php">&nbsp;<b>Log In</b></a></p>
      </div>
    </form>
  </div>
</div>