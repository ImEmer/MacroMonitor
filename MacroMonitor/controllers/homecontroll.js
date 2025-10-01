 document.querySelectorAll(".faq-toggle").forEach((btn) => {
    btn.addEventListener("click", () => {
      const answer = btn.nextElementSibling;
      const icon = btn.querySelector("i.fas.fa-chevron-down");

      answer.classList.toggle("hidden");
      icon.classList.toggle("rotate-180");
    });
  });