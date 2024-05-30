<?php
  session_start();
  include('config/dbcon.php');
  if(!isset($_SESSION['auth'])){
    header('Location: login.php');
  };
  include('components/header.php');
  include('components/navbar.php');
  include('components/frontbar.php');
 ?>
  <main class="user_main">
    <div class="customer_info_container">
      <div class="tab-container">
        <div class="customer_info">
          <h1>Services Offered</h1>
        </div>
        <div class="tab-buttons">
            <button class="tab-link active" onclick="openTab(event, 'service_page1')">Sell</button>
            <button class="tab-link" onclick="openTab(event, 'service_page2')">Trade-Ins</button>
            <button class="tab-link" onclick="openTab(event, 'service_page3')">Repair</button>
            <button class="tab-link" onclick="openTab(event, 'service_page4')">Layaway</button>
        </div>
        <div id="service_page1" class="tab-content active">
          <div class="contentt_container">
            <P>Hello There</P>
          </div>
        </div>
        <div id="service_page2" class="tab-content">
          <div class="contentt_container">
            <P>Hello There</P>
          </div>
        </div>
        <div id="service_page3" class="tab-content">
          <div class="contentt_container">
            <P>Hello There</P>
          </div>
        </div>
        <div id="service_page4" class="tab-content">
          <div class="contentt_container">
            <P>Hello There</P>
          </div>
        </div>
      </div>
    </div>
  </main>
<?php
 include('components/footer.php');
?>