/*============================= each product page =====================================*/
const info_dropdown = document.querySelector('.info_dropdown');
info_dropdown.addEventListener('click', function () {
  const info_content = document.querySelector('.info_content_off');
  const sign = document.querySelector('.sign1-js');
  if (!info_content.classList.contains('info_content_on')) {
    info_content.classList.add('info_content_on');
    sign.innerHTML = '-';

  } else {
    info_content.classList.remove('info_content_on');
    sign.innerHTML = '+';
  }
});

const descr_dropdown = document.querySelector('.descr_dropdown');
descr_dropdown.addEventListener('click', function () {
  const info_content = document.querySelector('.descr_content_off');
  const sign = document.querySelector('.sign2-js');
  if (!info_content.classList.contains('descr_content_on')) {
    info_content.classList.add('descr_content_on');
    sign.innerHTML = '-';

  } else {
    info_content.classList.remove('descr_content_on');
    sign.innerHTML = '+';
  }
});

//------------------------------------------------------------
function switch_review_container() {
  const review = document.querySelector('.review_off');
  const no_review = document.querySelector('.no_review_on');
  if (!review.classList.contains('review_on')) {
    no_review.style.display = 'none'; // Corrected line
    review.classList.add('review_on');
  } else if (!no_review.classList.contains('no_review_off')) {
    no_review.style.display = 'flex'; // Corrected line
    review.classList.remove('review_on');
  }
}

const leave_review = document.querySelector('.Leave_review_js');
leave_review.addEventListener('click', function () {
  const review = document.querySelector('.review_off_1');
  if (!review.classList.contains('review_on_1')) {
    review.classList.add('review_on_1');

  } else {
    review.classList.remove('review_on_1');
  }
});

// --------------------------------------------------------------
const fileInput = document.getElementById('file-input');
const fileLabel = document.querySelector('.file-label');

fileInput.addEventListener('change', () => {
  const files = fileInput.files;
  if (files.length > 0) {
    fileLabel.querySelector('.file-text').textContent = `${files.length} File(s) Selected`;
  } else {
    fileLabel.querySelector('.file-text').textContent = 'Add File';
  }
});

// show account settings
const open_close = document.querySelector('.open_close');
open_close.addEventListener('click', function () {
  const dropdownContent3 = document.querySelector('.dropdown_content_off');
  if (!dropdownContent3.classList.contains('dropdown_content_on')) {
    dropdownContent3.classList.add('dropdown_content_on');

  } else {
    dropdownContent3.classList.remove('dropdown_content_on');
  }
});

const open_edit = document.querySelector('.open_edit');
open_edit.addEventListener('click', function () {
  const update = document.querySelector('.update_off');
  if (!update.classList.contains('update_on')) {
    update.classList.add('update_on');

  } else {
    update.classList.remove('update_on');
  }
});