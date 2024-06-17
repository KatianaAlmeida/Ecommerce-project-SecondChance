<?php
  include('../config/dbcon.php');
  $message_count = 0;
  $sql ="SELECT COUNT(*) AS total_messages FROM message";
  $sql_run = mysqli_query($connection, $sql);

  if ($sql_run && mysqli_num_rows($sql_run) > 0) {
    foreach ($sql_run as $items) {
      $message_count = $items['total_messages']; 
      if($message_count == ''){
        $message_count = 0;
      }      
    }
  }else{
    ?>
    <p>Error: <?= $connection->error; ?></p>
    <?php
  }
?>
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
    <a href="/admin/customer_messages.php"><img class="messages" src="https://img.icons8.com/forma-thin-filled/24/1A1A1A/speech-bubble-with-dots.png" alt="speech-bubble-with-dots"/></a>
      <div class="notificationCount"><?= $message_count;?></div>
    </div>
    <?php
    if(isset($_SESSION['auth_admin']) && $_SESSION['auth_admin'] == true){ 
      $user_name = $_SESSION['auth_user_admin']['full_name'];
    ?>
      <div class="user_container">
        <img class="user" src="https://img.icons8.com/ink/48/person-female.png" alt="person-female"/>
      </div>
      <select id="pages" class="custom-dropdown" onchange="navigate();">
        <option value="" class="admin_name" disabled selected hidden><?= $user_name?></option>
        <option value="http://localhost:3000/admin/functions/logout.php">Logout</option>
      </select>
    <?php
    }?>
  </div>
</nav>