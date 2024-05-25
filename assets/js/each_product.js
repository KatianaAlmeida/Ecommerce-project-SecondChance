/*============================= each product page =====================================*/
const info_dropdown = document.querySelector('.info_dropdown');
info_dropdown.addEventListener('click', function() {
  const info_content = document.querySelector('.info_content_off'); 
  const sign = document.querySelector('.sign1-js'); 
  if(!info_content.classList.contains('info_content_on')){
    info_content.classList.add('info_content_on');
    sign.innerHTML = '-';

  } else{
    info_content.classList.remove('info_content_on');
    sign.innerHTML = '+';
  }
});

const descr_dropdown = document.querySelector('.descr_dropdown');
descr_dropdown.addEventListener('click', function() {
  const info_content = document.querySelector('.descr_content_off'); 
  const sign = document.querySelector('.sign2-js'); 
  if(!info_content.classList.contains('descr_content_on')){
    info_content.classList.add('descr_content_on');
    sign.innerHTML = '-';

  } else{
    info_content.classList.remove('descr_content_on');
    sign.innerHTML = '+';
  }
});

