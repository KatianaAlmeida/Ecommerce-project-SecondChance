<?php
session_start();
include('config/dbcon.php');
include('components/header.php');
include('components/navbar.php');
include('components/frontbar.php');
?>
<main class="user_main">
  <div class="physical_store_container">
    <div class="our_vision">
      <h1>Policy</h1>
      <p> If you have any questions or concerns about our policy, or our practices with regards to your personal information, please contact us</p>
      <a href="./contact_us.php"><button>Contact Us</button></a>
    </div>
    <div class="tab-container">
      <div class="tab-buttons">
        <button class="tab-link active" onclick="openTab(event, 'Tab1')">Shipping & Returns</button>
        <button class="tab-link" onclick="openTab(event, 'Tab2')">Terms & Conditions</button>
        <button class="tab-link" onclick="openTab(event, 'Tab3')">Privacy Policy</button>
        <button class="tab-link" onclick="openTab(event, 'Tab4')">Payment Methods</button>
        <button class="tab-link" onclick="openTab(event, 'Tab5')">FAQ</button>
      </div>
      <div id="Tab1" class="tab-content active">
        <h2>Shipping Policy</h2>
        <table class="styled-table">
          <thead>
            <tr>
              <th>Section</th>
              <th>Details</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Order Processing</td>
              <td>Orders are processed within 1-2 business days (excluding weekends and holidays) after receiving your order confirmation email. You will receive another notification when your order has shipped.</td>
            </tr>
            <tr>
              <td>Shipping Rates and Delivery Estimates</td>
              <td>Shipping charges for your order will be calculated and displayed at checkout. Estimated delivery times: - Standard Shipping: 5-7 business days - Express Shipping: 2-3 business days - Overnight Shipping: 1-2 business days Delivery delays can occasionally occur.</td>
            </tr>
            <tr>
              <td>Shipment Confirmation and Order Tracking</td>
              <td>You will receive a shipment confirmation email once your order has shipped, containing your tracking number(s). The tracking number will be active within 24 hours.</td>
            </tr>
            <tr>
              <td>Customs, Duties, and Taxes</td>
              <td>Our website is not responsible for any customs and taxes applied to your order. All fees imposed during or after shipping are the responsibility of the customer (tariffs, taxes, etc.).</td>
            </tr>
            <tr>
              <td>International Shipping</td>
              <td>We currently do not ship outside the SA</td>
            </tr>
          </tbody>
        </table>
        <!---->
        <h2>Returns Policy</h2>
        <table class="styled-table">
          <thead>
            <tr>
              <th>Section</th>
              <th>Details</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Order Processing</td>
              <td>Orders are processed within 1-2 business days (excluding weekends and holidays) after receiving your order confirmation email. You will receive another notification when your order has shipped.</td>
            </tr>
            <tr>
              <td>Shipping Rates and Delivery Estimates</td>
              <td>Shipping charges for your order will be calculated and displayed at checkout. Estimated delivery times: - Standard Shipping: 5-7 business days - Express Shipping: 2-3 business days - Overnight Shipping: 1-2 business days Delivery delays can occasionally occur.</td>
            </tr>
            <tr>
              <td>Shipment Confirmation and Order Tracking</td>
              <td>You will receive a shipment confirmation email once your order has shipped, containing your tracking number(s). The tracking number will be active within 24 hours.</td>
            </tr>
            <tr>
              <td>Customs, Duties, and Taxes</td>
              <td>Our website is not responsible for any customs and taxes applied to your order. All fees imposed during or after shipping are the responsibility of the customer (tariffs, taxes, etc.).</td>
            </tr>
            <tr>
              <td>International Shipping</td>
              <td>We currently do not ship outside the SA</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div id="Tab2" class="tab-content">
        <h2>Terms and Conditions </h2>
        <table class="styled-table">
          <thead>
            <tr>
              <th>Section</th>
              <th>Details</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Introduction</td>
              <td>Welcome to SecondChance Emperium! These terms and conditions outline the rules and regulations for the use of SecondChance Emperium's Website, located at [your website URL]. By accessing this website, we assume you accept these terms and conditions. Do not continue to use SecondChance Emperium if you do not agree to take all of the terms and conditions stated on this page.</td>
            </tr>
            <tr>
              <td>Intellectual Property Rights</td>
              <td>Unless otherwise stated, SecondChance Emperium and/or its licensors own the intellectual property rights for all material on SecondChance Emperium. All intellectual property rights are reserved. You may access this from SecondChance Emperium for your own personal use subjected to restrictions set in these terms and conditions.</td>
            </tr>
            <tr>
              <td>Restrictions</td>
              <td>You are specifically restricted from the following: - Selling, sublicensing, and/or otherwise commercializing any material from SecondChance Emperium. - Using this website in any way that is or may be damaging to this website. - Using this website in any way that impacts user access to this website. - Using this website contrary to applicable laws and regulations, or in any way may cause harm to the website, or to any person or business entity. - Engaging in any data mining, data harvesting, data extracting, or any other similar activity in relation to this website. - Using this website to engage in any advertising or marketing.</td>
            </tr>
            <tr>
              <td>No Warranties</td>
              <td>Our website is not responsible for any customs and taxes applied to your order. All fees imposed during or after shipping are the responsibility of the customer (tariffs, taxes, etc.).</td>
            </tr>
            <tr>
              <td>Limitation of Liability</td>
              <td>We currently do not ship outside the SA</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div id="Tab3" class="tab-content">
        <h2>Privacy Policy</h2>
        <span><strong>Effective Date:</strong> [Date]</span>

        <h3>1. Introduction</h3>
        <p>Welcome to SecondChance Emperium. We are committed to protecting your personal information and your right to privacy. If you have any questions or concerns about our policy, or our practices with regards to your personal information, please contact us at <a href="mailto:[customer service email]">[customer service email]</a>.</p>
        <p>When you visit our website <a href="[your website URL]">[your website URL]</a>, and use our services, you trust us with your personal information. We take your privacy very seriously. In this privacy notice, we describe our privacy policy. We seek to explain to you in the clearest way possible what information we collect, how we use it, and what rights you have in relation to it. We hope you take some time to read through it carefully, as it is important. If there are any terms in this privacy policy that you do not agree with, please discontinue use of our sites and our services.</p>
        <p>This privacy policy applies to all information collected through our website (such as <a href="[your website URL]">[your website URL]</a>), and/or any related services, sales, marketing, or events (we refer to them collectively in this privacy policy as the "Services").</p>

        <h3>2. Information We Collect</h3>
        <p>We collect personal information that you voluntarily provide to us when registering at the Services, expressing an interest in obtaining information about us or our products and services, when participating in activities on the Services (such as posting messages in our online forums or entering competitions, contests, or giveaways) or otherwise contacting us.</p>
        <span>The personal information that we collect depends on the context of your interactions with us and the Services, the choices you make, and the products and features you use. The personal information we collect can include the following:</span>
        <ul>
          <li><strong>Name and Contact Data:</strong> We collect your first and last name, email address, postal address, phone number, and other similar contact data.</li>
          <li><strong>Credentials:</strong> We collect passwords, password hints, and similar security information used for authentication and account access.</li>
          <li><strong>Payment Data:</strong> We collect data necessary to process your payment if you make purchases, such as your payment instrument number (such as a credit card number), and the security code associated with your payment instrument.</li>
        </ul>

        <h3>3. How We Use Your Information</h3>
        <p>We use personal information collected via our Services for a variety of business purposes described below. We process your personal information for these purposes in reliance on our legitimate business interests, in order to enter into or perform a contract with you, with your consent, and/or for compliance with our legal obligations. We indicate the specific processing grounds we rely on next to each purpose listed below:</p>
        <ul>
          <li>To facilitate account creation and logon process.</li>
          <li>To send administrative information to you.</li>
          <li>To fulfill and manage your orders.</li>
          <li>To post testimonials.</li>
          <li>To request feedback.</li>
          <li>To send you marketing and promotional communications.</li>
          <li>To deliver targeted advertising to you.</li>
          <li>To protect our Services.</li>
          <li>To enforce our terms, conditions, and policies.</li>
          <li>For other business purposes.</li>
        </ul>

        <h3>. Will Your Information Be Shared With Anyone?</h3>
        <span>We only share and disclose your information in the following situations:</span>
        <ul>
          <li><strong>Compliance with Laws:</strong> We may disclose your information where we are legally required to do so in order to comply with applicable law, governmental requests, a judicial proceeding, court order, or legal process, such as in response to a court order or a subpoena (including in response to public authorities to meet national security or law enforcement requirements).</li>
          <li><strong>Vital Interests and Legal Rights:</strong> We may disclose your information where we believe it is necessary to investigate, prevent, or take action regarding potential violations of our policies, suspected fraud, situations involving potential threats to the safety of any person, and illegal activities, or as evidence in litigation in which we are involved.</li>
          <li><strong>Vendors, Consultants, and Other Third-Party Service Providers:</strong> We may share your data with third-party vendors, service providers, contractors, or agents who perform services for us or on our behalf and require access to such information to do that work. Examples include payment processing, data analysis, email delivery, hosting services, customer service, and marketing efforts. We may allow selected third parties to use tracking technology on the Services, which will enable them to collect data on our behalf about how you interact with our Services over time. This information may be used to, among other things, analyze and track data, determine the popularity of certain content, pages, or features, and better understand online activity. Unless described in this notice, we do not share, sell, rent, or trade any of your information with third parties for their promotional purposes.</li>
          <li><strong>Business Transfers:</strong> We may share or transfer your information in connection with, or during negotiations of, any merger, sale of company assets, financing, or acquisition of all or a portion of our business to another company.</li>
        </ul>
      </div>
      <div id="Tab4" class="tab-content">
        <h2>Payment Methods</h2>
        <span>At SecondChance Emperium, we strive to provide convenient and secure payment options for our customers. Below are the payment methods we accept:</span>

        <h3>1. Credit/Debit Cards</h3>
        <span>We accept the following credit and debit cards:</span>
        <ul>
          <li>Visa</li>
          <li>MasterCard</li>
          <li>American Express</li>
          <li>Discover</li>
        </ul>

        <h3>2. PayPal</h3>
        <span>You can use your PayPal account to make secure online payments. Simply select PayPal during checkout and follow the instructions to complete your payment.</span>

        <h3>3. Bank Transfers</h3>
        <p>We accept direct bank transfers. You will receive our bank details during the checkout process. Please ensure to use your order number as the payment reference to avoid any delays in processing your order.</p>

        <h3>4. Cash on Delivery (COD)</h3>
        <span>For customers in certain areas, we offer a Cash on Delivery option. Please note that this option is only available for selected products and regions. You will see the option at checkout if it is available for your order.</span>

        <h3>5. Gift Cards and Store Credit</h3>
        <span>You can use SecondChance Emperium gift cards or store credit to make purchases on our website. Simply enter the gift card or store credit code during checkout to apply it to your order.</span>

        <h3>6. Cryptocurrency</h3>
        <span>We accept popular cryptocurrencies such as Bitcoin and Ethereum. Select the cryptocurrency option during checkout and follow the instructions to complete your payment.</span>

        <h3>7. Other Payment Methods</h3>
        <span>We are constantly working to add more payment methods for your convenience. Please check back often or contact our customer service for any specific payment requests.</span>

        <span>If you have any questions or need assistance with payment options, please contact our customer service team at <a href="mailto:[customer service email]">[customer service email]</a>.</span>
      </div>
      <div id="Tab5" class="tab-content">
        <h2>Frequently Asked Questions (FAQ)</h2>

        <div class="faq-section">
          <span class="faq-question">Q1: What types of products does SecondChance Emperium sell?</span>
          <span>A: We specialize in buying and selling second-hand goods such as electronics (phones, laptops, gaming consoles), appliances, musical instruments, and tools. We also offer trade-ins, repair services, and layby services.</span>
        </div>

        <div class="faq-section">
          <span class="faq-question">Q2: How can I place an order?</span>
          <span>A: You can place an order by visiting our website, selecting the products you want to purchase, and following the checkout process. You can also visit our physical store to make a purchase.</span>
        </div>

        <div class="faq-section">
          <span class="faq-question">Q3: What payment methods do you accept?</span>
          <span>A: We accept a variety of payment methods including credit/debit cards, PayPal, bank transfers, Cash on Delivery (COD), gift cards, store credit, and popular cryptocurrencies such as Bitcoin and Ethereum. For more details, please visit our <a href="payment-methods.html">Payment Methods</a> page.</span>
        </div>

        <div class="faq-section">
          <span class="faq-question">Q4: How can I track my order?</span>
          <span>A: Once your order has been shipped, you will receive a tracking number via email. You can use this tracking number to monitor the status of your delivery on the carrier's website.</span>
        </div>

        <div class="faq-section">
          <span class="faq-question">Q5: What is your return policy?</span>
          <span>A: We offer a 30-day return policy for most products. Items must be in their original condition and packaging. For more information, please visit our <a href="shipping-returns.html">Shipping & Returns</a> page.</span>
        </div>

        <div class="faq-section">
          <span class="faq-question">Q6: How can I contact customer service?</span>
          <span>A: You can reach our customer service team by emailing us at <a href="mailto:[customer service email]">[customer service email]</a>. We are here to assist you with any questions or concerns you may have.</span>
        </div>

        <div class="faq-section">
          <span class="faq-question">Q7: Do you offer repair services?</span>
          <span>A: Yes, we offer repair services for a variety of electronics and appliances. Please contact our customer service team or visit our store for more details.</span>
        </div>

        <div class="faq-section">
          <span class="faq-question">Q8: Can I trade in my old items?</span>
          <span>A: Absolutely! We accept trade-ins for a wide range of products. Bring your items to our store, and our team will evaluate them and offer you a fair trade-in value.</span>
        </div>

        <div class="faq-section">
          <span class="faq-question">Q9: Do you offer layby services?</span>
          <span>A: Yes, we offer layby services to help you secure your desired items with a deposit and pay the balance over time. Visit our store or contact us for more information on our layby terms.</span>
        </div>

        <div class="faq-section">
          <span class="faq-question">Q10: How can I stay updated on new products and promotions?</span>
          <span>A: You can stay updated by subscribing to our newsletter, following us on social media, and regularly checking our website for the latest news, products, and special offers.</span>
        </div>
      </div>
    </div>
  </div>
</main>
<?php
include('components/footer.php');
?>