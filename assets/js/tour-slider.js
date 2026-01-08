function slideTours(direction) {
  const slider = document.getElementById('tourSlider');
  const cardWidth = slider.querySelector('.tour-card').offsetWidth + 25;
  slider.scrollLeft += direction * cardWidth;
}
