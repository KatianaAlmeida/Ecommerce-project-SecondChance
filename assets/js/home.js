const images = [
  '../../assets/images/home2.webp',
  '../../assets/images/home3.webp',
  '../../assets/images/home1.webp'
];
let index = 0;

function changeBackground() {
  index = (index + 1) % images.length;
  document.getElementById('slideContainer').style.backgroundImage = `url('${images[index]}')`;
}

setInterval(changeBackground, 5000);
//-------------------------------------------
function initializeSlider(containerId, buttonNextId, buttonPrevId) {
  const container = document.getElementById(containerId);
  const buttonNext = document.getElementById(buttonNextId);
  const buttonPrev = document.getElementById(buttonPrevId);

  let currentSlide = 0;
  const products = container.querySelectorAll('.product');
  const productWidth = products[0].offsetWidth + 20; // Adjust based on margin/padding

  buttonNext.addEventListener('click', () => {
      if ((currentSlide + 1) * productWidth < container.scrollWidth) {
          currentSlide++;
          container.style.transform = `translateX(-${currentSlide * productWidth}px)`;
      }
  });

  buttonPrev.addEventListener('click', () => {
      if (currentSlide > 0) {
          currentSlide--;
          container.style.transform = `translateX(-${currentSlide * productWidth}px)`;
      }
  });
}

initializeSlider('product-container', 'slide-button-next', 'slide-button-prev');
initializeSlider('product-container1', 'slide-button-next1', 'slide-button-prev1');