document.addEventListener("DOMContentLoaded", () => {

  const form = document.getElementById("userForm");

  const fields = {
    name: {
      input: document.getElementById("name"),
      regex: /^[A-Za-z\s]{3,}$/,
      message: "Name must contain only letters (min 3 characters)"
    },
    email: {
      input: document.getElementById("email"),
      regex: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
      message: "Enter a valid email address"
    },
    phone: {
      input: document.getElementById("phone"),
      regex: /^[0-9]{7,15}$/,
      message: "Phone must be 7–15 digits only"
    },
    message: {
      input: document.getElementById("message"),
      regex: /^.{10,}$/,
      message: "Inquiry or Message must be at least 10 characters"
    }
  };

  // Live validation
  Object.values(fields).forEach(field => {
    field.input.addEventListener("input", () => {
      validateField(field);
    });
  });

  // On submit
  form.addEventListener("submit", (e) => {
    let valid = true;

    Object.values(fields).forEach(field => {
      if (!validateField(field)) {
        valid = false;
      }
    });

    if (!valid) {
      e.preventDefault();
    }
  });

  function validateField(field) {
    const value = field.input.value.trim();
    const formGroup = field.input.parentElement;
    const errorEl = formGroup.querySelector("small.error");

    if (field.input.id === "email" && value === "") {
      formGroup.classList.remove("error");
      errorEl.textContent = "";
      return true;
    }

    if (!field.regex.test(value)) {
      formGroup.classList.add("error");
      errorEl.textContent = field.message;
      return false;
    } else {
      formGroup.classList.remove("error");
      errorEl.textContent = "";
      return true;
    }
  }

});
