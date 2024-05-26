  <!-- count how many prodcuts there is in the cart -->
<?php
  include('config/dbcon.php');

  $cart_count = 0;
  // Check if the user is authenticated
  if (isset($_SESSION['auth'])) {
    $user_id = $_SESSION['auth_user']['id'];

    // Query to get the count of items in the user's cart
    $sql = "SELECT SUM(product_qty) as cart_count FROM carts WHERE user_id = '$user_id'";
    $result = mysqli_query($connection, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      $cart_count = $row['cart_count'];
      if($cart_count == ''){
        $cart_count = 0;
      }
    }
  }else {
    $cart_count = 0;
  }
?>
  <!-- header -->
  <header class="header">
    <div class="promotion">
      <img class="promo_image" src="https://img.icons8.com/ios/50/FFFFFF/gift--v1.png" alt="gift--v1"/>
      <p>Get 20% off yor first order&#46;&#160;<a href="../register.php">Subscribe</a></p>
    </div>
    <div class="support js-support1">
      <!-- loadHTMLItems(); -->
    </div>
  </header> 
  <!-- NavBar -->
  <nav>
    <!-- top_section -->
    <div class="nav_top_section">
      <div class="left">
        <a href="../home.php"><img class="logo" src="assets/images/secondChance1.png" alt="logo"></a>
        <a class="navbar_brand" href="../home.php">SecondChange</a>          
      </div>
      <div class="middle js-search1">
        <!-- loadHTMLItems(); -->
      </div>
      <div class="right js-account1">
        <!-- -------------------------- -->
        <?php
        if(isset($_SESSION['auth']) && $_SESSION['auth'] == true){ 
          $user_name = $_SESSION['auth_user']['full_name'];
        ?>
        <div class="signin_Container2 js-signin_Container">
          <img class="user_icon" src="https://img.icons8.com/material-sharp/24/user-male-circle.png" alt="user-male-circle"/>
          <span class="sign_up_in"><?= $user_name?></span>
          <div class="dropdown-content2">
            <a class="dropdown-item" href="#">Order History</a>
            <a class="dropdown-item"  href="#">Account detail</a>
            <a class="dropdown-item" href="#">Address Book</a>
            <a class="dropdown-item"  href="#">Card Details</a>
            <a class="dropdown-item" href="..//functions/logout.php">Logout</a>
            <!--logout-->
          </div>
        </div>
        <?php
        }else{
          ?>
          <a class="user_account" href="register.php">
            <img class="user_icon" src="https://img.icons8.com/material-sharp/24/user-male-circle.png" alt="user-male-circle"/>
            <div class="signin_Container">
              <span class="sign_up_in">Sign Up</span>
            </div>
          </a>
          <?php
        }?>
          <a href=""><img class="favorite_icon" src="https://img.icons8.com/fluency-systems-filled/48/hearts.png" alt="hearts"/></a>
          <div class="notification_Container">
            <a href="../cart_page.php"><img class="cart_icon" src="https://img.icons8.com/windows/32/shopping-cart.png" alt="shopping-cart"/></a>
            <div class="notificationCount"><?= $cart_count; ?></div>
          </div>
        <!-- -------------------------- -->
      </div>
      <!--hamburger_button/phone-->
      <div class="js-menu_button">
        <img class="hamburger_button js-open" onclick="showSidebar('js-open');" src="https://img.icons8.com/ios-filled/50/1A1A1A/menu--v6.png" alt="menu--v6"/>
      </div>
    </div>
    
    <!-- bottom_section -->
    <div class="nav_bottom_section">
      <div class="services js-service1">
        <!-- loadHTMLItems(); -->
      </div>
      <!-- search_menu/phone-->
      <div class="search_menu js-search2">
        <!-- loadHTMLItems(); -->
      </div>
    </div> 
  </nav>