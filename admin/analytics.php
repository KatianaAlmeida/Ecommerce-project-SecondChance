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
    <main class="js-content">Sales Analytics, Trafic Analytics ...</main>
  </div>
<?php
 include('includes/footer.php');
?>