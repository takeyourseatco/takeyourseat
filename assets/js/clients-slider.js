  const clients_track = document.querySelector('.client-marquee-track');
  let client_speed = 0.5; // control speed
  let client_position = 0;

  function animateClientMarquee() {
    client_position -= client_speed;

    if (Math.abs(client_position) >= clients_track.scrollWidth / 2) {
      client_position = 0;
    }

    clients_track.style.transform = `translateX(${client_position}px)`;
    requestAnimationFrame(animateClientMarquee);
  }

  animateClientMarquee();

  // Pause on hover
  clients_track.addEventListener('mouseenter', () => client_speed = 0);
  clients_track.addEventListener('mouseleave', () => client_speed = 0.5);  