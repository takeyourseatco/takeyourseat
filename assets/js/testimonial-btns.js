const testimonials = document.querySelectorAll(".testimonial-card");
const testimonialprevBtn = document.getElementById("testimonialprevBtn");
const testimonialnextBtn = document.getElementById("testimonialnextBtn");

let testimonialcurrentIndex = 0;

function updateTestimonial() {
  testimonials.forEach((item, index) => {
    item.classList.toggle("active", index === testimonialcurrentIndex);
  });

  testimonialprevBtn.style.display = testimonialcurrentIndex === 0 ? "none" : "inline-block";
  testimonialnextBtn.style.display =
    testimonialcurrentIndex === testimonials.length - 1 ? "none" : "inline-block";
}

testimonialnextBtn.addEventListener("click", () => {
  if (testimonialcurrentIndex < testimonials.length - 1) {
    testimonialcurrentIndex++;
    updateTestimonial();
  }
});

testimonialprevBtn.addEventListener("click", () => {
  if (testimonialcurrentIndex > 0) {
    testimonialcurrentIndex--;
    updateTestimonial();
  }
});

updateTestimonial();
