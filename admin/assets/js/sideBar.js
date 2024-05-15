// show subItems when main items is clicked
function showItems(item, container, number){
  const subtItemsElement = document.querySelector(`.${item}_off`); 
  const subtItemsElement_Container = document.querySelector(`.${container}_management`); 
  const arrowIcon_Container = document.querySelector(`.js-arrow-${number}`);

  if(!subtItemsElement.classList.contains(`${item}_on`)){
      subtItemsElement.classList.add(`${item}_on`);
      subtItemsElement_Container.style.display = 'flex';

      const html = `
      <img class="arrow arrowUp" src="https://img.icons8.com/forma-thin-filled/24/1A1A1A/play.png" alt="play"/></span>
      `;
      arrowIcon_Container.innerHTML = html;
  } else{
      subtItemsElement.classList.remove(`${item}_on`);
      subtItemsElement_Container.style.display = 'none';

      const html = `
      <img class="arrow arrowDown" src="https://img.icons8.com/forma-thin-filled/24/1A1A1A/play.png" alt="play"/></span>
      `;
      arrowIcon_Container.innerHTML = html;
  }
}

const hamburger_button = document.querySelector('.hamburger_button');
const overlay_cover_Container = document.querySelector('.js-overlay_cover');
const searchElement_Container = document.querySelector('.search_container'); 
const new_user_button = document.querySelector('.new_user');

// sideBarElement on and off
hamburger_button.addEventListener('click', function() {
  const sideBarElement = document.querySelector('.sideBar_off'); 
  const sideBarElement_Container = document.querySelector('.sideBar_container');
  if(!sideBarElement.classList.contains('sideBar_on')){
    sideBarElement.classList.add('sideBar_on');
    sideBarElement_Container.style.display = 'flex';

    // display an overlay on small screen device
    if(700 > window.innerWidth){
      overlay_cover_Container.style.display = 'flex';
    }else{
      overlay_cover_Container.style.display = 'none';
    }

  } else{
    sideBarElement.classList.remove('sideBar_on');
    sideBarElement_Container.style.display = 'none';
    overlay_cover_Container.style.display = 'none';
  }
});

// close the sidebar when the overlay_cover_Container is clicked
overlay_cover_Container.addEventListener('click', function() {
  const sideBarElement = document.querySelector('.sideBar_off'); 
  const sideBarElement_Container = document.querySelector('.sideBar_container');
  sideBarElement.classList.remove('sideBar_on');
  sideBarElement_Container.style.display = 'none';
  overlay_cover_Container.style.display = 'none';
});

let menu = 'close';

// if sidebar is  open/closed put searchbar on/off
hamburger_button.addEventListener('click', function() {
  if(menu != 'open'){
    searchElement_Container.style.display = 'none';
    menu = 'open';
    if(1550 > window.innerWidth){
      new_user_button.style.display = 'none';
    } else if (1550 <= window.innerWidth){
      new_user_button.style.display = 'flex';
    }
  } else{
    if(700 > window.innerWidth){
      searchElement_Container.style.display = 'none';
    } else{
      searchElement_Container.style.display = 'flex';
      menu = 'close'
    }
  }
});

// if windows paged is small/bif put searchbar on/off
window.addEventListener('resize', function() {
  //console.log(window.innerWidth);
  if(menu === 'open' && 1000 > window.innerWidth){
    console.log('open');
    searchElement_Container.style.display = 'none';
    if(700 > window.innerWidth){
      overlay_cover_Container.style.display = 'flex';
    }else{
      overlay_cover_Container.style.display = 'none';
    }
  } else  if(menu === 'close' && 700 > window.innerWidth){
    //console.log('close');
    searchElement_Container.style.display = 'none';
  }else {
    searchElement_Container.style.display = 'flex';
  }

  if(menu === 'open' && 1550 > window.innerWidth){
    new_user_button.style.display = 'none';
  } else if (menu === 'open' && 1550 <= window.innerWidth){
    new_user_button.style.display = 'flex';
  } else if(menu === 'close' && 1300 > window.innerWidth){
    new_user_button.style.display = 'none';
  } else if (menu === 'close' && 1000 <= window.innerWidth){
    new_user_button.style.display = 'flex';
  }
});