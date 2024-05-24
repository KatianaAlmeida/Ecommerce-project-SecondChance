document.addEventListener('DOMContentLoaded', () => {
  const rows = document.querySelectorAll('.product-row');
  const prevButton = document.getElementById('prev-button');
  const nextButton = document.getElementById('next-button');
  const pageInfo = document.getElementById('page-info');
  let currentPage = 1;
  const rowsPerPage = 2;

  const updatePagination = () => {
    rows.forEach((row, index) => {
      row.style.display = (index >= (currentPage - 1) * rowsPerPage && index < currentPage * rowsPerPage) ? 'flex' : 'none';
    });
    pageInfo.textContent = currentPage;
    prevButton.disabled = currentPage === 1;
    nextButton.disabled = currentPage === Math.ceil(rows.length / rowsPerPage);
  };

  prevButton.addEventListener('click', () => {
    if (currentPage > 1) {
      currentPage--;
      updatePagination();
    }
  });

  nextButton.addEventListener('click', () => {
    if (currentPage < Math.ceil(rows.length / rowsPerPage)) {
      currentPage++;
      updatePagination();
    }
  });

  updatePagination();
});

/*===============================*/
function showItems(){
  const subtItemsElement = document.querySelector(`.category_title`); 
  const subtItemsElement_Container = document.querySelector(`.shop_category_container`); 
  const arrowIcon_Container = document.querySelector(`.js-arrow-5`);

  if(subtItemsElement_Container.style.display === 'none'){
      subtItemsElement_Container.style.display = 'block';

      const html = `
      <img class="arrow arrowUp" src="https://img.icons8.com/forma-thin-filled/24/1A1A1A/play.png" alt="play"/></span>
      `;
      arrowIcon_Container.innerHTML = html;
  } else{
      subtItemsElement_Container.style.display = 'none';

      const html = `
      <img class="arrow arrowDown" src="https://img.icons8.com/forma-thin-filled/24/1A1A1A/play.png" alt="play"/></span>
      `;
      arrowIcon_Container.innerHTML = html;
  }
}

window.addEventListener('resize', function() {
  //console.log(window.innerWidth);
  const subtItemsElement_Container = document.querySelector(`.shop_category_container`); 
  const arrowIcon_Container = document.querySelector(`.js-arrow-5`);
  if(788 > window.innerWidth){
        subtItemsElement_Container.style.display = 'none';
        const html = `
        <img class="arrow arrowDown" src="https://img.icons8.com/forma-thin-filled/24/1A1A1A/play.png" alt="play"/></span>
        `;
        arrowIcon_Container.innerHTML = html;
    } else{
        subtItemsElement_Container.style.display = 'block';
  
        const html = `
        <img class="arrow arrowUp" src="https://img.icons8.com/forma-thin-filled/24/1A1A1A/play.png" alt="play"/></span>
        `;
        arrowIcon_Container.innerHTML = html;
    }
});
