<!-- navigationBar -->
<nav class="navigation js-navigation">
  <!-- -- -->
  <div class="left_section">
    <img class="hamburger_button" src="https://img.icons8.com/ios-filled/50/1A1A1A/menu--v6.png" alt="menu--v6"/>
    <div class="search_container">
      <input class="search_bar" type="search" placeholder="Search" aria-label="Search">
      <button class="search_button" type="submit"><img class="search_icon" src="https://img.icons8.com/ios-glyphs/30/FFFFFF/search--v1.png" alt="search--v1"/></button>
    </div>
  </div>
  <!-- -- -->
  <div class="right_section">
    <div class="notification_Container">
      <a href="/admin/review.php"><img class="notification" src="https://img.icons8.com/forma-light-filled/24/1A1A1A/appointment-reminders.png" alt="appointment-reminders"/></a>
      <div class="notificationCount">3</div>
    </div>
    <div class="messages_container">
      <a href="/admin/customer_messages.php"><img class="messages" src="https://img.icons8.com/forma-thin-filled/24/1A1A1A/speech-bubble-with-dots.png" alt="speech-bubble-with-dots"/></a>
    </div>
    <?php
    if(isset($_SESSION['auth']) && $_SESSION['auth'] == true){ 
      $user_name = $_SESSION['auth_user']['full_name'];
    ?>
      <div class="user_container">
        <img class="user" src="https://img.icons8.com/ink/48/person-female.png" alt="person-female"/>
      </div>
      <select id="pages" class="custom-dropdown" onchange="navigate();">
        <option value="" class="admin_name" disabled selected hidden><?= $user_name?></option>
        <option value="http://localhost:3000/admin/logout.php">Logout</option>
      </select>
    <?php
    }?>
  </div>
</nav>