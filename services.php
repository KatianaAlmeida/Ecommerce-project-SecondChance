<?php
session_start();
include('config/dbcon.php');
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
          <div class="sell_serivice_container">
            <section class="hero">
              <div class="container">
                <p>Selling your products online has never been easier. Simply apply to sell as a Second Chance seller today.</p>
              </div>
            </section>
            <div class="tools_needed">
              <div class="section">
                <div class="img_container">
                  <img src="assets/images/one.jpg" alt="">
                </div>
                <div>
                  <h2>Optimise Your Growth</h2>
                  <p>Easily boost your sales by leveraging our active customer base of over 3 million happy online shoppers.</p>
                </div>
              </div>
              <div class="section">
                <div class="img_container">
                  <img src="assets/images/two.jpg" alt="">
                </div>
                <div>
                  <h2>End-to-End Solutions</h2>
                  <p>We'll provide the tools you need to set up and sell – manage your stock, pricing, product selection and more from the Second Chance Seller Portal.</p>
                </div>
              </div>
              <div class="section">
                <div class="img_container">
                  <img src="assets/images/three.jpg" alt="">
                </div>
                <div>
                  <h2>Hassle-Free Logistics</h2>
                  <p>From handling warehousing to delivery and returns, we've made online retail easier than ever.</p>
                </div>
              </div>

              <div class="section">
                <div class="img_container">
                  <img src="assets/images/four.jpg" alt="">
                </div>
                <div>
                  <h2>Safe & Secure Online Payments</h2>
                  <p>Payments are made directly to you four times per month.</p>
                </div>
              </div>
            </div>
            <div class="cta-buttons">
              <p><a id="apply" href="#apply-process">Apply to Sell</a></p>
            </div>
            <div class="section">
              <h2>Start selling online in just a few easy steps</h2>
              <div class="Start_selling_online">
                <div class="section2">
                  <div><img src="assets/images/image1.svg" alt=""></div>
                  <div>
                    <h3>Application</h3>
                    <p>Apply now and tell us about your business and products.</p>
                  </div>
                </div>
                <div class="section2">
                  <div><img src="assets/images/image2.svg" alt=""></div>
                  <div>
                    <h3>Approval</h3>
                    <p>We'll review your application and get in touch within 10 business days.</p>
                  </div>
                </div>
                <div class="section2">
                  <div><img src="assets/images/image3.svg" alt=""></div>
                  <div>
                    <h3>Registration</h3>
                    <p>Complete your Second Chance Seller account by supplying all the required information and paperwork.</p>
                  </div>
                </div>
                <div class="section2">
                  <div><img src="assets/images/image4.svg" alt=""></div>
                  <div>
                    <h3>Onboarding</h3>
                    <p>Learn all about our processes and choose your stock model.</p>
                  </div>
                </div>
                <div class="section2">
                  <div><img src="assets/images/image5.svg" alt=""></div>
                  <div>
                    <h3>Sales</h3>
                    <p>Get your products live and start selling.</p>
                  </div>
                </div>
                <div class="section2">
                  <div><img src="assets/images/image6.svg" alt=""></div>
                  <div>
                    <h3>Growth</h3>
                    <p>Boost your online sales via promotions, analyse your performance using reports and so much more.</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="section pricing">
              <h2>Pricing</h2>
              <p>We charge a monthly subscription fee of R400* per seller account/month. You can choose to cancel your account at any time.</p>
            </div>
          </div>
        </div>
      </div>
      <div id="service_page2" class="tab-content">
        <div class="contentt_container">
          <section class="hero">
            <div class="container">
              <p>Upgrade your old electronics and gadgets with our convenient trade-in service!</p>
            </div>
          </section>
          <section class="content">
            <div class="container">
              <h3>How It Works</h3>
              <p>At Second Chance Emperioum, we offer a seamless trade-in service that allows you to exchange your old electronics, appliances, musical instruments, and tools for store credit or cash. Follow these simple steps:</p>
              <ol>
                <li>Bring your old item to our store.</li>
                <li>Our experts will assess the condition and value of your item.</li>
                <li>Receive an offer for store credit or cash.</li>
                <li>Accept the offer and get immediate credit or cash for your next purchase!</li>
              </ol>
              <h3>Why Trade-In?</h3>
              <ul>
                <li>Get value for your old items and upgrade to the latest models.</li>
                <li>Reduce electronic waste and contribute to a more sustainable environment.</li>
                <li>Enjoy exclusive discounts and offers on trade-in deals.</li>
              </ul>
              <h3>Items We Accept</h3>
              <span>We accept a wide range of items, including:</span>
              <ul>
                <li>Electronics (phones, laptops, gaming consoles)</li>
                <li>Appliances (kitchen gadgets, household appliances)</li>
                <li>Musical Instruments</li>
                <li>Tools and Equipment</li>
              </ul>
              <h3>Contact Us</h3>
              <span>For more information or to inquire about specific items, visit our store or contact us at <a href="mailto:info@secondchance.com">info@secondchance.com</a>.</span>
            </div>
          </section>
        </div>
      </div>
      <div id="service_page3" class="tab-content">
        <div class="content_container">
          <section class="hero">
            <div class="container">
              <p>Get your electronics, appliances, and more fixed with our reliable repair service!</p>
            </div>
          </section>
          <section class="content">
            <div class="container">
              <h3>How It Works</h3>
              <p>At Second Chance Emperioum, we offer a comprehensive repair service for your electronics, appliances, musical instruments, and tools. Follow these simple steps:</p>
              <ol>
                <li>Bring your item to our store.</li>
                <li>Our skilled technicians will diagnose the issue and provide a repair estimate.</li>
                <li>Approve the estimate and our team will get to work fixing your item.</li>
                <li>Pick up your repaired item and enjoy its renewed functionality!</li>
              </ol>
              <h3>Why Choose Us?</h3>
              <ul>
                <li>Expert technicians with years of experience.</li>
                <li>High-quality parts and tools used for repairs.</li>
                <li>Fast turnaround times and competitive pricing.</li>
                <li>Warranty on all repairs performed.</li>
              </ul>
              <h3>Items We Repair</h3>
              <span>We offer repair services for a wide range of items, including:</span>
              <ul>
                <li>Electronics (phones, laptops, gaming consoles)</li>
                <li>Appliances (kitchen gadgets, household appliances)</li>
                <li>Musical Instruments</li>
                <li>Tools and Equipment</li>
              </ul>
              <h3>Contact Us</h3>
              <span>For more information or to inquire about specific repair needs, visit our store or contact us at <a href="mailto:info@secondchance.com">info@secondchance.com</a>.</span>
            </div>
          </section>
        </div>
      </div>
      <div id="service_page4" class="tab-content">
        <div class="content_container">
          <section class="hero">
            <div class="container">
              <p>Secure your favorite items with our flexible layaway service!</p>
            </div>
          </section>
          <section class="content">
            <div class="container">
              <h3>How It Works</h3>
              <p>Our layaway service allows you to purchase items over time with easy, manageable payments. Here's how it works:</p>
              <ol>
                <li>Select the items you want to put on layaway.</li>
                <li>Make a small down payment to reserve your items.</li>
                <li>Make regular payments at intervals that suit you.</li>
                <li>Pick up your items once the full amount is paid off.</li>
              </ol>
              <h3>Why Use Layaway?</h3>
              <ul>
                <li>Secure the items you want before they sell out.</li>
                <li>Spread the cost of your purchase over time.</li>
                <li>No interest or credit checks required.</li>
                <li>Flexible payment plans tailored to your needs.</li>
              </ul>
              <h3>Terms and Conditions</h3>
              <span>Please note the following terms for our layaway service:</span>
              <ul>
                <li>Layaway items must be paid off within a specified period (typically 90 days).</li>
                <li>A minimum down payment is required to initiate the layaway plan.</li>
                <li>Regular payments must be made to avoid cancellation.</li>
                <li>If the layaway plan is cancelled, a restocking fee may apply.</li>
              </ul>
              <h3>Contact Us</h3>
              <span>For more information about our layaway service, visit our store or contact us at <a href="mailto:info@secondchance.com">info@secondchance.com</a>.</span>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
</main>
<?php
include('components/footer.php');
?>