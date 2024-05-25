  <!-- footer-->
  <footer class="footer">
    <div class="container">
      <div class="row">
        <div class="footer-col">
          <h4>Store Location</h4>
          <ul>
            <li><a href="#">53 Main Rd, Claremont, Cape Town, 7700, CA 94158</a></li>
            <li><a href="#">info&#64;mysite&#46;com</a></li>
            <li><a href="#">123-456-7890</a></li>
            <li class="social-links">
              <a href="#"><i class="fab fa-facebook-f"></i></a>
              <a href="#"><i class="fab fa-instagram"></i></a>
              <a href="#"><i class="fab fa-twitter"></i></a>
              <a href="#"><i class="fab fa-linkedin-in"></i></a>
              <a href="#"><i class="fab fa-youtube"></i></a>
            </li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>Services</h4>
          <ul>
            <li><a href="#">Shop All</a></li>
            <li><a href="#">Sell</a></li>
            <li><a href="#">Trade-ins</a></li>
            <li><a href="#">Repair</a></li>
            <li><a href="#">Layaway</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>Costumer Support</h4>
          <ul>
            <li><a href="../contact_us.php">Contact Us</a></li>
            <li><a href="../help_center.php">Help Center</a></li>
            <li><a href="../about_us.php">About Us</a></li>
            <li><a href="../physical_store.php">Physical Store</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>Policy</h4>
          <ul>
            <li><a href="../policy.php#Tab1">Shipping &#38; Returns</a></li>
            <li><a href="../policy.php#Tab2">Terms &#38; Conditions</a></li>
            <li><a href="../policy.php#Tab3">Privacy Policy</a></li>
            <li><a href="../policy.php#Tab4">Payment Methods</a></li>
            <li><a href="../policy.php#Tab5">FAQ</a></li>
          </ul>
        </div>
      </div>
      <hr>
      <p>We accept the following paying methods</p>
      <div class="payment_method">
        <a href=""><img class="payment_method_icon" src="https://logos-world.net/wp-content/uploads/2020/04/PayPal-Emblem.png" alt=""></a>
        <a href=""><img class="payment_method_icon" src="https://skanticket.com/img/visa.666f05f2.png" alt=""></a>
        <a href=""><img class="payment_method_icon" src="https://logodownload.org/wp-content/uploads/2014/07/mastercard-logo.png" alt=""></a>
        <a href=""><img class="payment_method_icon" src="assets/images/payFast.png" alt=""></a>
      </div>
    </div>
    <div class="copyRight">&#169; SecondChange Emperium Online (Pty) Ltd&#46;</div>
  </footer>
  <!-- JavaScript -->
  <script src="assets/js/navBar.js"></script>
  <script src="assets/js/help_center.js"></script>
  <script src="assets/js/home.js"></script>
  <script src="assets/js/shop_all.js"></script>
  <script src="assets/js/each_product.js"></script>
  <!-- Function to display alert if there's a message -->
  <script>
    function showAlert(message) {
      if (message) {
        alert(message);
      }
    }
  </script>
  <script>
    var gt = 0;
    var iprice = document.getElementsByClassName('iprice');
    var iquantity = document.getElementsByClassName('iquantity');
    var itotal = document.getElementsByClassName('itotal'); // each product total
    var gtotal = document.getElementById('gtotal');// final total
    var quantity;

    function subTotal(){
      gt=0;
      for(i = 0; i < iprice.length; i++){
        itotal[i].innerHTML = (iprice[i].value) * (iquantity[i].value);
        gt = gt + (iprice[i].value) * (iquantity[i].value);
      }
      gtotal.innerHTML = gt;
    }
  </script>
  <!-- Check if the session cart_add_message is set -->
  <?php
    if (isset($_SESSION['cart_add_message'])) {
      $message = $_SESSION['cart_add_message'];
      unset($_SESSION['cart_add_message']); // Unset the session message after use
      echo "<script>showAlert('$message');</script>";
    }
  ?>
</body>
</html>