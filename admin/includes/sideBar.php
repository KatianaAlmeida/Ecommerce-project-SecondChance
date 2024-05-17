<div class="sideBar_container">
  <!-- sideBar -->
  <section class="sideBar sideBar_off">
    <div class="top">
      <img class="logo" src="assets/images/secondChance.png" alt="logo">
      <span>SecondChange</span>
    </div>
    <div class="user_management">
      <!-- dashboard Overview -->
      <div>
        <div class="title">
          <div><img width="24" height="24" src="https://img.icons8.com/fluency-systems-regular/48/dashboard-layout.png" alt="dashboard-layout"/></div>
          <div>
            <a href="/admin/dashboard.php"><span>Dashboard Overview</span></a>
          </div>
        </div>
      </div>
      <!-- user management -->
      <div onclick="showItems('account', 'account', '1');">
        <div class="title">
          <div><img width="24" height="24" src="https://img.icons8.com/windows/32/user.png" alt="user"/></div>
          <div>
            <span>User Management</span>
            <span class="js-arrow-1"><img class="arrow" src="https://img.icons8.com/forma-thin-filled/24/1A1A1A/play.png" alt="play"/></span>
          </div>
        </div>
        <div class="account_management account_off">
          <div class="sub_item "><a href="/admin/add_users.php"><span>Add User & Permission</span></a></div> 
          <div class="sub_item "><a href="/admin/view_update_user.php"><span>Update & Delete Users</span></a></div>  
        </div>
      </div>
      <!-- customer management -->
      <div onclick="showItems('customer', 'customer', '2');">
        <div class="title">
          <div><img width="24" height="24" src="https://img.icons8.com/windows/32/client-management.png" alt="client-management"/></div>
          <div>
            <span>Customer Management</span>
            <span class="js-arrow-2"><img class="arrow" src="https://img.icons8.com/forma-thin-filled/24/1A1A1A/play.png" alt="play"/></span>
          </div>
        </div>
        <div class="customer_management customer_off">
          <div class="sub_item "><a href="/admin/customer_details.php"><span>View Customer Details</span></a></div>
          <div class="sub_item "><a href="/admin/customer_messages.php"><span>Customers Messages</span></a></div>
        </div>
      </div>
    </div>
    <div class="items_management">
      <!-- product management -->
      <div onclick="showItems('product', 'product', '3');">
        <div class="title">
          <div><img width="24" height="24" src="https://img.icons8.com/fluency-systems-regular/48/shopping-cart--v1.png" alt="shopping-cart--v1"/></div>
          <div>
            <span>Product Management</span>
            <span class="js-arrow-3"><img class="arrow" src="https://img.icons8.com/forma-thin-filled/24/1A1A1A/play.png" alt="play"/></span>
          </div>
        </div>
        <div class="product_management product_off">
          <div class="sub_item "><a href="/admin/add_products.php"><span>Add Products</span></a></div>
          <div class="sub_item "><a href="/admin/update_products.php"><span>Update Products</span></a></div>
          <div class="sub_item "><a href="/admin/review.php"><span>Review</span></a></div>
        </div>
      </div>
      <!-- category-->
      <div>
        <div class="title">
          <div><img width="24" height="24" src="https://img.icons8.com/external-outline-black-m-oki-orlando/32/external-product-category-supply-chain-management-outline-outline-black-m-oki-orlando.png" alt="external-product-category-supply-chain-management-outline-outline-black-m-oki-orlando"/></div>
          <div>
            <a href="/admin/category.php"><span>Product Category</span></a>
          </div>
      </div>
      <!-- order management -->
      <div >
        <div class="title">
          <div><img width="24" height="24" src="https://img.icons8.com/fluency-systems-regular/48/create-order.png" alt="create-order"/></div>
          <div>
            <a href="/admin/orders.php"><span>Order Management</span></a>
          </div>
        </div>
      </div>
      <!-- analytics management -->
      <div>
        <div class="title">
          <div><img width="24" height="24" src="https://img.icons8.com/forma-regular/24/000000/performance-macbook.png" alt="performance-macbook"/></div>
          <div>
          <a href="/admin/analytics.php"><span>Analytics</span></a>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>