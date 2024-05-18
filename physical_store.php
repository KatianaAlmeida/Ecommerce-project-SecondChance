<?php
 include('components/header.php');
 include('components/navbar.php');
 include('components/frontbar.php');
 ?>
  <main class="user_main">
    <div class="physical_store_container">
      <h1>Visit Us</h1>
      <div class="store_info">
        <div class="left">
          <h3>Address</h3>
          <div class="form-group">
            <p>53 Main Rd, Claremont, Cape Town, 7700, CA 94158</p>
          </div>
        </div>
        <div class="middle">
          <h3>Contact</h3>
          <div class="form-group">
            <p>123-456-7890</p>
            <p>info&#64;mysite&#46;com</p>
          </div>
          <div class="form-group">
            <ul class="sociallinks">
              <li>
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
              </li>
            </ul>
          </div>
        </div>
        <div class="right">
          <h3>Opening Hours</h3>
          <div class="form-group">
            <p><span>Mon - Fri</span><span class="opening_hous">8:00 am-8:00 pm</span></p>
            <p><span>Saturday</span><span class="opening_hous">9:00 am-9:00 pm</span></p>
            <p><span>Sunday&nbsp;&nbsp;</span> <span class="opening_hous">9:00 am-9:00 pm</span></p>
          </div>
        </div>
      </div>
      <div class="physical_store_map">
        <div id="map"></div>
        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
        <script>
            // Initialize the map and set its view to Claremont, Cape Town coordinates
            var map = L.map('map').setView([-33.9806, 18.4649], 13);

            // Set up the OpenStreetMap layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap'
            }).addTo(map);

            // Add a marker for Second Chance Emporium
            var marker = L.marker([-33.9806, 18.4649]).addTo(map)
                .bindPopup('<b>Second Chance Emporium</b><br />We are here in Claremont, Cape Town.').openPopup();
        </script>
      </div>
    </div>
  </main>
<?php
 include('components/footer.php');
?>