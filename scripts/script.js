const benefitsSwiper = new Swiper("[data-swiper='advantages']", {
  speed: 800,
  autoHeight: true,
  slidesPerView: "auto",
  loop: true,
  autoplay: {
    delay: 5000,
    disableOnInteraction: false,
  },
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

const forms = document.querySelectorAll("[data-form]");
forms.forEach((form) => {
  form.addEventListener("submit", (e) => {
    e.preventDefault();

    const formData = new FormData(form);

    fetch("../send-lead.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.text())
      .catch((error) => {});

    fetch("../cadastro.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.text())
      .catch((error) => {});
  });
});
function activatePixel(phpUrl) {
  var xhr = new XMLHttpRequest();
  xhr.open("GET", phpUrl, true);
  xhr.send();
}

activatePixel("pageview.php");

const modal = document.querySelector(".modal");
const modalButtons = document.querySelectorAll("[data-modal]");
modal.addEventListener("click", (e) => {
  if (e.target.classList.contains("modal")) {
    modal.classList.remove("active");
  }
});
modalButtons.forEach((btn) => {
  btn.addEventListener("click", (e) => {
    modal.classList.toggle("active");
  });
});
