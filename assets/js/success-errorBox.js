document.addEventListener("DOMContentLoaded", () => {
  const successBox = document.getElementById("successBox");

  if (successBox) {
    setTimeout(() => {
      successBox.style.transition = "opacity 0.6s ease";
      successBox.style.opacity = "0";

      setTimeout(() => {
        successBox.remove();
      }, 600);
    }, 5000);

    if (window.history.replaceState) {
      const cleanURL = window.location.pathname + window.location.search.replace(/([?&])success=1(&|$)/, '$1').replace(/[\?&]$/, '');
      window.history.replaceState({}, document.title, cleanURL);
    }
  }
});
