const counters = document.querySelectorAll('.counter');
let hasAnimated = false;

const startCounting = () => {
  counters.forEach(counter => {
    const target = +counter.getAttribute('data-target');
    let count = 0;

    const updateCounter = () => {
      const increment = Math.ceil(target / 100);

      if (count < target) {
        count += increment;
        counter.innerText = count + "+";
        setTimeout(updateCounter, 20);
      } else {
        counter.innerText = target + "+";
      }
    };

    updateCounter();
  });
};

// Observe stats section
const statsSection = document.querySelector('.stats-section');

const observer = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    if (entry.isIntersecting && !hasAnimated) {
      startCounting();
      hasAnimated = true; 
    }
  });
}, {
  threshold: 0.4 // 40% visible
});

observer.observe(statsSection);
