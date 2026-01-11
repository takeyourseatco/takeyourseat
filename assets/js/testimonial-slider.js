let currentIndex = 0;

function slideTestimonial(direction) {
  const track = document.getElementById('testimonialTrack');
  const cards = document.querySelectorAll('.testimonial-card');
  const visibleCards = window.innerWidth <= 576 ? 1 : window.innerWidth <= 992 ? 2 : 3;
  const cardWidth = cards[0].offsetWidth + 30;
  const maxIndex = cards.length - visibleCards;

  currentIndex += direction;

  if (currentIndex < 0) currentIndex = 0;
  if (currentIndex > maxIndex) currentIndex = maxIndex;

  track.style.transform = `translateX(-${currentIndex * cardWidth}px)`;
}