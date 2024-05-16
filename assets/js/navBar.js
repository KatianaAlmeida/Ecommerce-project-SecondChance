function showSidebar(toggle){
  if(toggle === 'js-open'){
    const frontbarElement = document.querySelector('.js-frontbar');
    frontbarElement.style.display = 'flex';

  } else if(toggle === 'js-close'){
    const frontbarElement = document.querySelector('.js-frontbar');
    frontbarElement.style.display = 'none';
  }
}

function loadHTMLItems(property1, property2, html){
  const htmlElement1 = document.querySelector(`.js-${property1}`);
  const htmlElement2 = document.querySelector(`.js-${property2}`);
  htmlElement1.innerHTML = html;
  htmlElement2.innerHTML = html;
}

const html_Array = [`
  <input class="search_bar" type="search" placeholder="Search for products, category..." aria-label="Search">
  <button class="search_button" type="submit"><img class="search_icon" src="https://img.icons8.com/ios-glyphs/30/FFFFFF/search--v1.png" alt="search--v1"/></button>
  `, `
  <?php
  if(isset($_SESSION['auth']) && $_SESSION['auth'] == true){ 
    $user_name = $_SESSION['auth_user']['full_name'];
  ?>
  <div class="signin_Container js-signin_Container">
    <img class="user_icon" src="https://img.icons8.com/material-sharp/24/user-male-circle.png" alt="user-male-circle"/>
    <span class="sign_up_in"><?= $user_name?></span>
    <div class="dropdown-content">
      <a class="dropdown-item" href="#">Order History</a>
      <a class="dropdown-item"  href="#">Account detail</a>
      <a class="dropdown-item" href="#">Address Book</a>
      <a class="dropdown-item"  href="#">Card Details</a>
      <a class="dropdown-item" href="../logout.php">Logout</a>
      <!--logout-->
  </div>
  </div>
  <?php
  }else{
    ?>
    <a class="user_account" href="register.php">
      <img class="user_icon" src="https://img.icons8.com/material-sharp/24/user-male-circle.png" alt="user-male-circle"/>
      <div class="signin_Container">
        <span class="sign_up_in">Sign Up</span>
      </div>
    </a>
    <?php
  }?>
  <a href=""><img class="favorite_icon" src="https://img.icons8.com/fluency-systems-filled/48/hearts.png" alt="hearts"/></a>
  <a href=""><img class="cart_icon" src="https://img.icons8.com/windows/32/shopping-cart.png" alt="shopping-cart"/></a>
  `, `
  <a class="support_link" href="">About</a>
  <a class="support_link" href="">Contact</a>
  <a class="support_link" href="">Help Center</a>
  <a class="support_link" href="">Physical Store</a>
  `, `
  <a class="service_link" href="">Shop All</a>
  <a class="service_link" href="">Sell</a>
  <a class="service_link" href="">Trade-ins</a>
  <a class="service_link" href="">Repair</a>
  <a class="service_link" href="">Layaway</a>
  `
];

loadHTMLItems('search1', 'search2', html_Array[0]);   // search_HTML
//loadHTMLItems('account1', 'account2', html_Array[1]); // accountItems_HTML
loadHTMLItems('support1', 'support2', html_Array[2]); // support_HTML
loadHTMLItems('service1', 'service2', html_Array[3]); // service_HTML


// show account settings
const dropdown = document.querySelector('.signin_Container');
dropdown.addEventListener('click', function() {
  const dropdown_content = document.querySelector('.dropdown-content'); 
  if(!dropdown_content.classList.contains('dropdown_on')){
    dropdown_content.classList.add('dropdown_on');

  } else{
    dropdown_content.classList.remove('dropdown_on');
  }
});

const dropdown2 = document.querySelector('.signin_Container2');
dropdown2.addEventListener('click', function() {
  const dropdown_content = document.querySelector('.dropdown-content2'); 
  if(!dropdown_content.classList.contains('dropdown_on')){
    dropdown_content.classList.add('dropdown_on');

  } else{
    dropdown_content.classList.remove('dropdown_on');
  }
});