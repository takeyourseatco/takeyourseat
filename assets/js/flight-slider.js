const flightTrack = document.getElementById('flightTrack');
const flightCards = document.querySelectorAll('.flight-card');
const flightPrevBtn = document.getElementById('flightPrevBtn');
const flightNextBtn = document.getElementById('flightNextBtn');

let flightIndex = 0;

function updateFlightSlider() {
  flightTrack.style.transform = `translateX(-${flightIndex * 100}%)`;
}

flightNextBtn.addEventListener('click', () => {
  if (flightIndex < flightCards.length - 1) {
    flightIndex++;
    updateFlightSlider();
  }
});

flightPrevBtn.addEventListener('click', () => {
  if (flightIndex > 0) {
    flightIndex--;
    updateFlightSlider();
  }
});
