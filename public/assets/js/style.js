// import { async } from "regenerator-runtime/runtime";
// import { async } from "regenerator-runtime";

//evenement sur la NavBar au moment du scroll
function updateNavbarBackground() {
  const navbar = document.querySelector("nav");

  if (window.scrollY > 450) {
    navbar.classList.remove("transparent");
    navbar.classList.add("scrolled");
  } else {
    navbar.classList.remove("scrolled");
    navbar.classList.add("transparent");
  }
}
window.addEventListener("scroll", updateNavbarBackground);
//

document.addEventListener("DOMContentLoaded", () => {
  new App();
});

class App {
  constructor() {
    this.handleReviewForm();
  }
  handleReviewForm() {
    const reviewForm = document.querySelector("form.reviewForm");

    if (null === reviewForm) {
      return;
    }

    reviewForm.addEventListener("submit", async (e) => {
      e.preventDefault();

      const response = await fetch("/ajax/review", {
        method: "POST",
        body: new FormData(e.target),
      });

      if (!response.ok) {
        return;
      }

      const json = await response.json();
      console.log(json);
    });
  }
}
