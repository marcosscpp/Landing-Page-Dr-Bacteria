const benefitsSwiper = new Swiper("[data-swiper='advantages']", {
  speed: 800,
  autoHeight: true,
  slidesPerView: "auto",
  loop: true,
  autoplay: {
    delay: 5000,
    disableOnInteraction: false,
  },
  slidesPerView: 3,
  pagination: {
    el: ".swiper-pagination",
    type: "bullets",
    clickable: true,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  
  breakpoints: {
    320: {
      slidesPerView: 1,
      spaceBetween: 10,
    },
    768: {
      slidesPerView: 2,
      spaceBetween: 10,
    },
    992: {
      slidesPerView: 3,
      spaceBetween: 10,
    },
    1200: {
      slidesPerView: 3,
      spaceBetween: 12,
    },
  },
});

setEqualHeight(".swiper__card");

function setEqualHeight(selector) {
  const slides = document.querySelectorAll(selector);
  let maxHeight = 0;

  slides.forEach((slide) => {
    slide.style.height = "";
    if (slide.offsetHeight > maxHeight) {
      maxHeight = slide.offsetHeight;
    }
  });

  slides.forEach((slide) => {
    slide.style.height = maxHeight + "px";
  });
}
