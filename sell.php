<?php
session_start();
include('config/dbcon.php');
 include('components/header.php');
 include('components/navbar.php');
 include('components/frontbar.php');
 ?>
  <main class="sell_page">
    <div class="container">
      <div class="top">
          <h1>Join SA's Best Online Marketplace Platform</h1>
          <p>Sell to over 3 million happy shoppers</p>
      </div>
      <div class="cta-buttons">
          <a href="#apply">Apply to Sell</a>
          <a href="#pricing">See Pricing</a>
      </div>

      <div class="section">
          <h2>Get the tools you need to increase sales and grow your business online</h2>
          <p>Selling your products online has never been easier. Simply apply to sell as a Takealot seller today and easily reach online shoppers across South Africa.</p>
      </div>

      <div class="tools_needed">
        <div class="section">
            <h2>Optimise Your Growth</h2>
            <p>Easily boost your sales by leveraging our active customer base of over 3 million happy online shoppers.</p>
        </div>

        <div class="section">
            <h2>End-to-End Solutions</h2>
            <p>We'll provide the tools you need to set up and sell – manage your stock, pricing, product selection and more from the Takealot Seller Portal.</p>
        </div>

        <div class="section">
            <h2>Hassle-Free Logistics</h2>
            <p>From handling warehousing to delivery and returns, we've made online retail easier than ever.</p>
        </div>

        <div class="section">
            <h2>Safe & Secure Online Payments</h2>
            <p>Payments are made directly to you four times per month.</p>
        </div>
      </div>
      <div class="cta-buttons">
          <a id="apply" href="#apply-process">Apply to Sell</a>
      </div>

      <div class="section" id="apply-process">
          <h2>Start selling online in just a few easy steps</h2>
          <div class="Start_selling_online">
            <div>
              <h3>Application</h3>
              <p>Apply now and tell us about your business and products.</p>
            </div>

            <div>
              <h3>Approval</h3>
              <p>We'll review your application and get in touch within 10 business days.</p>
            </div>

            <div>
              <h3>Registration</h3>
              <p>Complete your Takealot Seller account by supplying all the required information and paperwork.</p>
            </div>

            <div>
              <h3>Onboarding</h3>
              <p>Learn all about our processes and choose your stock model.</p>
            </div>

            <div>
              <h3>Sales</h3>
              <p>Get your products live and start selling.</p>
            </div>

            <div>
              <h3>Growth</h3>
              <p>Boost your online sales via promotions, analyse your performance using reports and so much more.</p>
            </div>   
          </div>   
        </div>

      <div class="section">
          <h2>Every seller has a success story to share</h2>

          <div class="testimonial">
              <h3>Luvuthando Dolls</h3>
              <p>“Being on Takealot Marketplace has really had a positive impact on my life and my business. I would absolutely recommend it to any budding entrepreneur.”</p>
              <p><strong>Luvuthando Dolls</strong> - Handcrafted Toys</p>
          </div>

          <div class="testimonial">
              <h3>Solly M Sports</h3>
              <p>“From the time that we started, we've only seen an upward trend. It's not only important for income and for revenue and turnover, but also for general business growth.”</p>
              <p><strong>Solly M Sports</strong> - Sports Apparel and Equipment</p>
          </div>

          <div class="testimonial">
              <h3>African Technopreneurs</h3>
              <p>“It's been a smooth transition, being able to talk to our account manager, being able to get our products onto the platform and Takealot has been a reliable partner for us to actually work with.”</p>
              <p><strong>African Technopreneurs</strong> - VR & Augmented Reality</p>
          </div>

          <div class="testimonial">
              <h3>King Kong Leather</h3>
              <p>“We've experienced tremendous growth, and have benefited from great online exposure through Takealot Marketplace.”</p>
              <p><strong>King Kong Leather</strong> - Handcrafted Leather Bags & Accessories</p>
          </div>

          <div class="testimonial">
              <h3>Love Tea Time</h3>
              <p>“I can now own a shop that's open 24 hours a day, and I've experienced 100% year–on–year growth since joining Takealot Marketplace.”</p>
              <p><strong>Love Tea Time</strong> - Luxury Teas & Infusions</p>
          </div>

          <div class="testimonial">
              <h3>Miss Lyn</h3>
              <p>“Takealot Marketplace offers end–to–end solutions, and access to over a million customers countrywide, something that isn't achievable with just brick and mortar stores.”</p>
              <p><strong>Miss Lyn</strong> - Fine Home & Hospitality Bed Linen</p>
          </div>
      </div>

      <div class="section pricing" id="pricing">
          <h2>Pricing</h2>
          <p>We charge a monthly subscription fee of R400* per seller account/month. You can choose to cancel your account at any time.</p>
      </div>
    </div>
  </main>
<?php
 include('components/footer.php');
?>