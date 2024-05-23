<?php
session_start();
include('config/dbcon.php');
 include('components/header.php');
 include('components/navbar.php');
 include('components/frontbar.php');

 if(isset($_GET['product'])){
  $product_number = $_GET['product'];
  $product_query =  "SELECT * FROM products WHERE incremented_name = '$product_number' LIMIT 1";
  $result = mysqli_query($connection, $product_query)
 ?>
  <main class="product_page_container">
    <div class="product_page">
      <div class="product_navigation">
        
        <p>Home / Wearable Tech / Safay GEN 2 256GB VR headset With Touch Controllers</p>
      </div>
      <div class="product_details">
        <p>product_details</p>
      </div>
      <div class="product_reviews">
        <p>product_reviews</p>
      </div>
      <div class="product_recomendation">
        <p>product_recomendation</p>
      </div>
    </div>
  </main>
<?php
} else{
  echo "Something went wrong!";
 }
 include('components/footer.php');
?>