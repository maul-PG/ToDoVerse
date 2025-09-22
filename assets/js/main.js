// ScrollSpy Active Link Highlight
const sections = document.querySelectorAll("section");
const navLinks = document.querySelectorAll("nav .nav-link");

window.addEventListener("scroll", () => {
  let current = "";
  sections.forEach((section) => {
    const sectionTop = section.offsetTop - 150;
    if (scrollY >= sectionTop) {
      current = section.getAttribute("id");
    }
  });

  navLinks.forEach((link) => {
    link.classList.remove("active");
    if (link.getAttribute("href").includes(current)) {
      link.classList.add("active");
    }
  });

  // Navbar scroll effect
  const navbar = document.querySelector(".navbar");
  if (window.scrollY > 100) {
    navbar.classList.add("scrolled");
  } else {
    navbar.classList.remove("scrolled");
  }
});

// AOS Init
// Initialize AOS with custom settings
AOS.init({
    duration: 1000, // Default animation duration
    once: true,     // Whether animation should happen only once
    offset: 100,    // Offset (in px) from the original trigger point
    easing: 'ease-in-out'
});
