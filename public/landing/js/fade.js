document.addEventListener("DOMContentLoaded", function () {
        const faders = document.querySelectorAll(".fade-section");

        const appearOptions = {
          threshold: 0.2, 
          rootMargin: "0px 0px -50px 0px",
        };

        const appearOnScroll = new IntersectionObserver(function (
          entries,
          observer
        ) {
          entries.forEach((entry) => {
            if (!entry.isIntersecting) {
              entry.target.classList.remove("show"); // remove to allow fade-out
              return;
            }
            entry.target.classList.add("show");
          });
        },
        appearOptions);

        faders.forEach((fader) => {
          appearOnScroll.observe(fader);
        });
      });