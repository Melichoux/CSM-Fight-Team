//ANCHOR -  Page index.php: carroussel
let currentSlide = 0;

function changeSlide(direction) {
  const slides = document.querySelectorAll('.carrousel__slide');
  if (slides.length === 0) return; // si pas de carrousel sur la page, on arrête là
  const dots = document.querySelectorAll('.dot');
  const total = slides.length;

  slides[currentSlide].classList.remove('active');
  dots[currentSlide].classList.remove('active');

  currentSlide = (currentSlide + direction + total) % total;

  slides[currentSlide].classList.add('active');
  dots[currentSlide].classList.add('active');
}

function goToSlide(index) {
  const direction = index - currentSlide;
  changeSlide(direction);
}

// Défilement auto toutes les 5 secondes
if (document.querySelectorAll('.carrousel__slide').length > 0) {
  setInterval(() => changeSlide(1), 5000);
}