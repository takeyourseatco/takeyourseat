  const airlines_track = document.querySelector('.marquee-track');
  let speed = 0.5; // control speed
  let position = 0;

  function animateMarquee() {
    position -= speed;

    if (Math.abs(position) >= airlines_track.scrollWidth / 2) {
      position = 0;
    }

    airlines_track.style.transform = `translateX(${position}px)`;
    requestAnimationFrame(animateMarquee);
  }

  animateMarquee();

  // Pause on hover
  airlines_track.addEventListener('mouseenter', () => speed = 0);
  airlines_track.addEventListener('mouseleave', () => speed = 0.5);  