window.addEventListener('scroll', function () {
    const navbar = document.getElementById('navbar');
    if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});

function revealOnScroll() {
  const reveals = document.querySelectorAll('.reveal');
  for (let i = 0; i < reveals.length; i++) {
    const windowHeight = window.innerHeight;
    const elementTop = reveals[i].getBoundingClientRect().top;
    const elementVisible = 100;

    if (elementTop < windowHeight - elementVisible) {
      reveals[i].classList.add('active');
    } else {
      reveals[i].classList.remove('active');
    }
  }
}

window.addEventListener('scroll', revealOnScroll);
window.addEventListener('load', revealOnScroll); 

function validateSignup() {
    const password = document.getElementById("password").value;
    const confirm = document.getElementById("confirm_password").value;
    const errorMsg = document.getElementById("error-message");

    if (password !== confirm) {
        errorMsg.textContent = "Passwords do not match. Please try again.";
        document.getElementById("password").value = "";
        document.getElementById("confirm_password").value = "";
        return false;
    }

    errorMsg.textContent = "";
    return true;
}


document.addEventListener("DOMContentLoaded", function () {
    const profileBtn = document.getElementById("profileToggle");
    const dropdownMenu = document.getElementById("dropdownMenu");

    if (profileBtn) {
        profileBtn.addEventListener("click", function (e) {
            e.stopPropagation();
            dropdownMenu.style.display = dropdownMenu.style.display === "block" ? "none" : "block";
        });

        // Hide dropdown when clicking outside
        document.addEventListener("click", function () {
            dropdownMenu.style.display = "none";
        });
    }
});

