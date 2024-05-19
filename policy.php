<?php
 include('components/header.php');
 include('components/navbar.php');
 include('components/frontbar.php');
 ?>
  <main class="user_main">
    <div class="physical_store_container">
        <p>Hello World</p>
        <div class="tab-container">
        <div class="tab-buttons">
            <button class="tab-link active" onclick="openTab(event, 'Tab1')">Shipping & Returns</button>
            <button class="tab-link" onclick="openTab(event, 'Tab2')">Terms & Conditions</button>
            <button class="tab-link" onclick="openTab(event, 'Tab3')">Privacy Policy</button>
            <button class="tab-link" onclick="openTab(event, 'Tab4')">Payment Methods</button>
            <button class="tab-link" onclick="openTab(event, 'Tab5')">FAQ</button>
        </div>
        <div id="Tab1" class="tab-content active">
            <h2>Tab 1 Content</h2>
            <p>This is the content of Tab 1.</p>
        </div>
        <div id="Tab2" class="tab-content">
            <h2>Tab 2 Content</h2>
            <p>This is the content of Tab 2.</p>
        </div>
        <div id="Tab3" class="tab-content">
            <h2>Tab 3 Content</h2>
            <p>This is the content of Tab 3.</p>
        </div>
        <div id="Tab4" class="tab-content">
            <h2>Tab 4 Content</h2>
            <p>This is the content of Tab 4.</p>
        </div>
        <div id="Tab5" class="tab-content">
            <h2>Tab 5 Content</h2>
            <p>This is the content of Tab 5.</p>
        </div>
    </div>
    </div>
  </main>
<?php
 include('components/footer.php');
?>