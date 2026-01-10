const track = document.getElementById('tourTrack');
const nextBtn = document.getElementById('nextBtn');
const prevBtn = document.getElementById('prevBtn');

let index = 0;

function getCardWidth() {
  const card = document.querySelector('.tour-card');
  const gap = 25;
  return card.offsetWidth + gap;
}

nextBtn.addEventListener('click', () => {
  const cardWidth = getCardWidth();
  const totalCards = document.querySelectorAll('.tour-card').length;
  const visibleCards = Math.round(track.parentElement.offsetWidth / cardWidth);

  if (index < totalCards - visibleCards) {
    index++;
    track.style.transform = `translateX(-${index * cardWidth}px)`;
  }
});

prevBtn.addEventListener('click', () => {
  const cardWidth = getCardWidth();

  if (index > 0) {
    index--;
    track.style.transform = `translateX(-${index * cardWidth}px)`;
  }
});
