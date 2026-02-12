const images = document.querySelectorAll('.photo-card img');
const lightbox = document.getElementById('lightbox');
const lightboxImg = document.getElementById('lightboxImg');
const closeBtn = document.querySelector('.lightbox .close');
const nextBtn = document.querySelector('.lightbox .next');
const prevBtn = document.querySelector('.lightbox .prev');
const downloadBtn = document.getElementById('downloadBtn'); // NEW

let currentIndex = 0;

images.forEach((img, index) => {
  img.addEventListener('click', () => {
    currentIndex = index;
    showImage();
    lightbox.classList.add('active');
  });
});

function showImage() {
  const src = images[currentIndex].src;
  lightboxImg.src = src;
  downloadBtn.href = src; // NEW
}

nextBtn.addEventListener('click', () => {
  currentIndex = (currentIndex + 1) % images.length;
  showImage();
});

prevBtn.addEventListener('click', () => {
  currentIndex = (currentIndex - 1 + images.length) % images.length;
  showImage();
});

closeBtn.addEventListener('click', () => {
  lightbox.classList.remove('active');
});

lightbox.addEventListener('click', (e) => {
  if (e.target === lightbox) {
    lightbox.classList.remove('active');
  }
});
