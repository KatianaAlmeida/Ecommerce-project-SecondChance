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
  <a class="user_account" href="">
    <img class="user_icon" src="https://img.icons8.com/material-sharp/24/user-male-circle.png" alt="user-male-circle"/>
    <span class="sign_up_in">Sign Up</span>
  </a>
  <a href=""><img class="favorite_icon" src="https://img.icons8.com/fluency-systems-filled/48/hearts.png" alt="hearts"/></a>
  <a href=""><img class="cart_icon" src="https://img.icons8.com/windows/32/shopping-cart.png" alt="shopping-cart"/></a>
  `, `
  <a href="">About</a>
  <a href="">Contact</a>
  <a href="">Help Center</a>
  <a href="">Physical Store</a>
  `, `
  <a href="">Shop All</a>
  <a href="">Sell</a>
  <a href="">Trade-ins</a>
  <a href="">Repair</a>
  <a href="">Layaway</a>
  `
];

loadHTMLItems('search1', 'search2', html_Array[0]);   // search_HTML
loadHTMLItems('account1', 'account2', html_Array[1]); // accountItems_HTML
loadHTMLItems('support1', 'support2', html_Array[2]); // support_HTML
loadHTMLItems('service1', 'service2', html_Array[3]); // service_HTML

