const MenuOpen = document.querySelector(".menu-open");
const MenuClose = document.querySelector(".menu-close");

let tlMenu = gsap.timeline({ paused: true, ease: "power4.inOut" });

tlMenu.fromTo(
  ".menu-responsive",
  { clipPath: "circle(0.0% at 100% 0)" },
  {
    clipPath: "circle(141.2% at 100% 0)",
    duration: 1,
  }
);

tlMenu.fromTo(
  ".hide",
  { y: -50 },
  {
    y: 0,
    delay: 0.2,
  }
);

tlMenu.reverse();

MenuOpen.addEventListener("click", () => {
  tlMenu.reversed(!tlMenu.reversed());
});

MenuClose.addEventListener("click", () => {
  tlMenu.reversed(!tlMenu.reversed());
});