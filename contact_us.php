<?php
session_start();
 include('components/header.php');
 include('components/navbar.php');
 include('components/frontbar.php');
 ?>
  <main class="user_main">
    <div class="contactt_conatiner">
      <div class="left">
        <div class="form-group">
          <h2>Get in Touch if Us</h2>
        </div>
        <div class="form-group">
          <p>500 Terry Francine Street San Francisco, CA 94158</p>
        </div>
        <div class="form-group">
          <p>123-456-7890</p>
          <p>info&#64;mysite&#46;com</p>
        </div>
        <div class="form-group">
          <ul class="sociallinks">
            <li>
              <a href="#"><i style="color: white;" class="fab fa-facebook-f"></i></a>
              <a href="#"><i style="color: white;" class="fab fa-instagram"></i></a>
              <a href="#"><i style="color: white;" class="fab fa-twitter"></i></a>
              <a href="#"><i style="color: white;" class="fab fa-linkedin-in"></i></a>
              <a href="#"><i style="color: white;" class="fab fa-youtube"></i></a>
            </li>
          </ul>
        </div>
      </div>
      <div class="right_to_right">
        <form name="form_1" action="functions/send_message.php" method="POST">
          <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" required>
          </div> 
          <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" required>
          </div> 
          <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" required>
          </div>
          <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" name="subject" required>
          </div> 
          <div class="form-group">
            <label for="message">Message</label>
            <textarea rows="5" name="message" required></textarea>
          </div>
          <div class="form-group">
              <button type="submit" onclick="validateForm(1)" name="send-btn">Send</button>
              <?php
                if(isset($_SESSION['send_message'])){ ?>
                <span class="message js-message"> <?= $_SESSION['send_message'];?></span>
                <?php
                  unset($_SESSION['send_message']);
                }
              ?>
              <span id="emailError"></span>
          </div>
        </form>
      </div>
    </div>
  </main>
<?php
 include('components/footer.php');
?>