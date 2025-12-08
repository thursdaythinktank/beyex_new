(function ($) {
  "use strict";
  // Custom Cursor start
  const cursor = document.querySelector(".cursor");
  if (cursor) {
    const editCursor = (e) => {
      const { clientX: x, clientY: y } = e;
      cursor.style.left = x + "px";
      cursor.style.top = y + "px";
    };
    window.addEventListener("mousemove", editCursor);

    document.querySelectorAll("a, .cursor-pointer").forEach((item) => {
      item.addEventListener("mouseover", () => {
        cursor.classList.add("cursor-active");
      });

      item.addEventListener("mouseout", () => {
        cursor.classList.remove("cursor-active");
      });
    });
  }
  // Custom Cursor End

  // Side Panale Star
  const activator = document.querySelector(".side-panel__activator");
  const overlay = document.querySelector(".side-panel__overlay");
  const sidePanel = document.querySelector(".side-panel");
  const closer = document.querySelector(".side-panel__closer");
  if (activator && overlay && sidePanel && closer) {
    const openPanel = () => {
      overlay.classList.add("active");
      sidePanel.classList.add("active");
    };

    const closePanel = () => {
      overlay.classList.remove("active");
      sidePanel.classList.remove("active");
    };

    activator.addEventListener("click", openPanel);

    overlay.addEventListener("click", closePanel);
    closer.addEventListener("click", closePanel);
  }
  // Side Panale End

  // Bottom to top start
  $(document).ready(function () {
    $(window).on("scroll", function () {
      if ($(this).scrollTop() > 100) {
        $("#scroll-top").fadeIn();
      } else {
        $("#scroll-top").fadeOut();
      }
    });
    $("#scroll-top").on("click", function () {
      $("html, body").animate({ scrollTop: 0 }, 600);
      return false;
    });
  });
  // Bottom to top End

  // Search Popup Start
  const searchBtns = document.querySelectorAll(".search__btn");
  const searchPopup = document.querySelector(".search__popup");
  const searchToggle = document.querySelector(".search__popup-toggle");
  const searchClear = document.querySelector(".search-clear");
  const searchInput = document.querySelector(".search__input");

  if (searchBtns.length > 0 && searchPopup) {
    searchBtns.forEach((btn) => {
      btn.addEventListener("click", function () {
        searchPopup.classList.add("active");
      });
    });

    if (searchToggle) {
      searchToggle.addEventListener("click", function () {
        searchPopup.classList.remove("active");
      });
    }
    if (searchClear && searchInput) {
      searchClear.addEventListener("click", function () {
        searchInput.value = "";
        searchInput.focus();
      });
    }

    if (searchInput && searchClear) {
      searchInput.addEventListener("input", function () {
        if (searchInput.value.trim() !== "") {
          searchClear.classList.add("active");
        } else {
          searchClear.classList.remove("active");
        }
      });

      searchClear.addEventListener("click", function () {
        searchInput.value = "";
        searchClear.classList.remove("active");
        searchInput.focus();
      });
    }
  }

  // Search Popup End

  // Menu start
  jQuery(document).ready(function () {

    jQuery("header .mainmenu").meanmenu({
      meanMenuContainer: ".side-panel__mobile-menu",
      meanMenuOpen: ".side-panel__activator",
      meanScreenWidth: "991",
    });
  });

  document
    .querySelectorAll(".menu-anim > li > a")
    .forEach(
      (button) =>
        (button.innerHTML =
          '<div class="menu-text"><span>' +
          button.textContent.split("").join("</span><span>") +
          "</span></div>")
    );

  setTimeout(() => {
    var menu_text = document.querySelectorAll(".menu-text span");
    menu_text.forEach((item) => {
      var font_sizes = window.getComputedStyle(item, null);
      let font_size = font_sizes.getPropertyValue("font-size");
      let size_in_number = parseInt(font_size.replace("px", ""), 10);
      let new_size = parseInt(size_in_number / 3, 10);
      new_size = new_size + "px";
      if (item.innerHTML === " ") {
        item.style.width = new_size;
      }
    });
  }, 1000);
  // Menu End

  // Sticky Menu Start
  $(window).on("scroll", function () {
    var scroll = $(window).scrollTop();
    if (scroll >= 100) {
      $(".menu-area").addClass("sticky");
    } else {
      $(".menu-area").removeClass("sticky");
    }
  });
  // Sticky Menu End

 // related post
  const postRelated__slider = document.querySelector(".unikon-post-related-slider-active");
  if (postRelated__slider) {

    var swiper = new Swiper(postRelated__slider, {
    loop: true,
    slidesPerView: 3,
    spaceBetween: 30,
    speed: 1000,
    autoHeight: true,
    autoplay: {
      delay: 5000,
      disableOnInteraction: true,
    },
    pagination: {
      el: '.liko-post-related-dots',
      clickable: true,
    },
    breakpoints: {
      '1400': {
        slidesPerView: 3,
      },
      '1200': {
        slidesPerView: 3,
      },
      '992': {
        slidesPerView: 3,
      },
      '768': {
        slidesPerView: 3,
      },
      '576': {
        slidesPerView: 2,
      },
      '0': {
        slidesPerView: 1,
      },
    },
  });
}

  // post_gallery__slider start
  const postGallerySlider = document.querySelector(".postbox_gallery-slider-active");
  if (postGallerySlider) {
    var swiper = new Swiper(postGallerySlider, {
      slidesPerView: 1,
      spaceBetween: 20,
      speed: 3000,
      autoplay: false,
      loop: false,
      pagination: {
        el: ".wpr-postbox-gallery-pagination",
        clickable: true,
      },
      breakpoints: {
        768: {
          slidesPerView: 1,
          spaceBetween: 20,
        },
        1024: {
          slidesPerView: 1,
          spaceBetween: 20,
        },
        1200: {
          slidesPerView: 1,
          spaceBetween: 20,
        },
      },
    });
  }

  // gallery-sa__slider start
  const gallerySaSlider = document.querySelector(".gallery-sa__slider");
  if (gallerySaSlider) {
    var swiper = new Swiper(gallerySaSlider, {
      slidesPerView: 4,
      spaceBetween: 30,
      speed: 3000,
      autoplay: {
        delay: 1,
      },
      loop: true,
      breakpoints: {
        768: {
          slidesPerView: 2,
          spaceBetween: 20,
        },
        1024: {
          slidesPerView: 3,
          spaceBetween: 20,
        },
        1200: {
          slidesPerView: 4,
          spaceBetween: 30,
        },
      },
    });
  }
  // gallery-sa__slider End



  // image-slider start
  const imageSlider = document.querySelector(".image-slider");
  const progressCircle = document.querySelector(".autoplay-progress svg");
  const progressContent = document.querySelector(".autoplay-progress span");
  if (imageSlider && progressCircle && progressContent) {
    var swiper = new Swiper(imageSlider, {
      centeredSlides: true,
      speed: 2500,
      effect: "fade",
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      on: {
        autoplayTimeLeft(s, time, progress) {
          progressCircle.style.setProperty("--progress", 1 - progress);
          progressContent.textContent = `${Math.ceil(time / 1000)}s`;
        },
      },
    });
  }
  // image-slider End

  // resources__slider Start
  const testimonialLaSlider = document.querySelector(".testimonial-la__slider");
  if (testimonialLaSlider) {
    var swiper = new Swiper(testimonialLaSlider, {
      slidesPerView: 1,
      spaceBetween: 30,
      loop: true,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
    });
  }
  // resources__slider End

  function counterSliderActive(){
    // funfact End
    const funfactItems = document.querySelector(".funfact__items");
    if (funfactItems) {
      var swiper = new Swiper(funfactItems, {
        slidesPerView: 1,
        speed: 3000,
        autoplay: {
          delay: 1,
        },
        loop: true,
        disableOnInteraction: true,
        breakpoints: {
          425: {
            slidesPerView: 2,
          },
          768: {
            slidesPerView: 3,
          },
          992: {
            slidesPerView: 4,
          },
          1200: {
            slidesPerView: 4,
          },
          1300: {
            slidesPerView: 5,
          },
        },
      });
    }
    // resources__slider End
  }


 function blogSliderActive(){
  // resources__slider Start
  const resourcesSlider = document.querySelector(".resources-ca__slider");
  if (resourcesSlider) {
    var swiper = new Swiper(resourcesSlider, {
      spaceBetween: 10,
      speed: 2500,
      loop: true,
      pagination: {
        el: ".resources-ca__slider-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".resources-ca__slider-next",
        prevEl: ".resources-ca__slider-prev",
      },
      breakpoints: {
        768: {
          slidesPerView: 2,
        },
        1024: {
          slidesPerView: 2,
          spaceBetween: 20,
        },
        1200: {
          slidesPerView: 3,
          spaceBetween: 40,
        },
      },
    });
  }
  // resources__slider End
 }

  function serviceSliderActive(){
    // service-ca__slider start
    const serviceCaSlider = document.querySelector(".service-ca__slider");
    if (serviceCaSlider) {
      var swiper = new Swiper(serviceCaSlider, {
        slidesPerView: 1,
        spaceBetween: 10,
        speed: 2500,
         autoplay: {
          delay: 1,
         },
        loop: true,
        navigation: {
          nextEl: ".service-ca__slider-next",
          prevEl: ".service-ca__slider-prev",
        },
        breakpoints: {
          768: {
            slidesPerView: 2,
          },
          1024: {
            spaceBetween: 20,
          },
          1200: {
            slidesPerView: 3,
            spaceBetween: 40,
          },
        },
      });
    }
    // service-ca__slider End
  }

  function brandSliderActive(){

  // slientLA 
  const clientsLaItems = document.querySelector(".clients-la__items");
  if (clientsLaItems) {
    var swiper = new Swiper(clientsLaItems, {
      slidesPerView: 1,
      speed: 3000,
      autoplay: {
        delay: 1,
      },
      loop: true,
      disableOnInteraction: true,
      breakpoints: {
        425: {
          slidesPerView: 2,
        },
        768: {
          slidesPerView: 3,
        },
        992: {
          slidesPerView: 4,
        },
        1200: {
          slidesPerView: 5,
        },
        1300: {
          slidesPerView: 6,
        },
      },
    });
  }

  // hero-sa__slider End
  const brandHealth__slider = document.querySelector(".brand-health__slider");
  if (brandHealth__slider) {
    var swiper = new Swiper(brandHealth__slider, {
      slidesPerView: 1.5,
      spaceBetween: 32,
      centeredSlides: true,
      speed: 5000,
      autoplay: {
        delay: 1,
      },
      loop: true,
      allowTouchMove: false,
      breakpoints: {
        576: {
          slidesPerView: 2,
        },
        768: {
          slidesPerView: 3,
          spaceBetween: 50,
        },
        992: {
          slidesPerView: 4,
          spaceBetween: 100,
        },
        1200: {
          slidesPerView: 5,
          spaceBetween: 135,
        },
      },
    });
  }

   // hero-sa__slider start
    const brand__slider = document.querySelector(".brand__slider");
    if (brand__slider) {
      var swiper = new Swiper(brand__slider, {
        spaceBetween: 100,
        centeredSlides: true,
        speed: 5000,
        autoplay: {
          delay: 1,
        },
        loop: true,
        slidesPerView: "auto",
        allowTouchMove: false,
        breakpoints: {
          320: {
            spaceBetween: 50,
          },
          992: {
            spaceBetween: 70,
          },
        },
      });
    }

    const brand__slider__extend = document.querySelector(
      ".brand__slider--extend"
    );
    
    if (brand__slider__extend) {
      var swiper = new Swiper(brand__slider__extend, {
        slidesPerView: 1.5,
        spaceBetween: 32,
        centeredSlides: true,
        speed: 5000,
        autoplay: {
          delay: 1,
        },
        loop: true,
        allowTouchMove: false,
        breakpoints: {
          575: {
            slidesPerView: 2.5,
          },
          768: {
            slidesPerView: 3.5,
          },
          992: {
            slidesPerView: 4.5,
          },
          1200: {
            slidesPerView: 5.5,
          },
          1400: {                
            slidesPerView: 6.5,
          },
        },
      });
    }
  }

  function testiSliderActive(){

    //testimonial-digital__slider start
    const testimonialDigitalSlider = document.querySelector(
      ".testimonial-digital__slider"
    );
    if (testimonialDigitalSlider) {
      var swiper = new Swiper(testimonialDigitalSlider, {
        slidesPerView: 1,
        spaceBetween: 96,
        speed: 1500,
        loop: true,
        disableOnInteraction: true,
        unlock: true,
        pagination: {
          el: ".testimonial-digital__slider-pagination",
          clickable: true,
        },
        breakpoints: {
          768: {
            slidesPerView: 2,
            centeredSlides: false,
          },
          1200: {
            slidesPerView: 3,
            centeredSlides: true,
          },
        },
      });
    }
    //testimonial-digital__slider End

    // testimonial-mar__slider start
    const testimonialMarSlider = document.querySelector(
      ".testimonial-mar__slider"
    );
    if (testimonialMarSlider) {
      var swiper = new Swiper(testimonialMarSlider, {
        slidesPerView: 1,
        speed: 5000,
        autoplay: {
          delay: 1,
        },
        loop: true,
        disableOnInteraction: true,
        unlock: true,
        breakpoints: {
          992: {
            slidesPerView: 2,
          },
          1200: {
            slidesPerView: 2.5,
          },
        },
      });
    }
    // testimonial-mar__slider End


    // testimonial-health__slider start
    const testimonialHealthSlider = document.querySelector(
      ".testimonial-health__slider"
    );
    if (testimonialHealthSlider) {
      var swiper = new Swiper(testimonialHealthSlider, {
        slidesPerView: 1,
        spaceBetween: 20,
        speed: 5000,
        autoplay: {
          delay: 1,
        },
        loop: true,
        disableOnInteraction: true,
        unlock: true,
        navigation: {
          nextEl: ".testimonial-health-next",
          prevEl: ".testimonial-health-prev",
          isLocked: false,
        },
        breakpoints: {
          992: {
            slidesPerView: 2,
            spaceBetween: 36,
          },
        },
      });
    }
    // testimonial-health__slider End


    // testimonial-fin__slider start
    const testimonialFinSlider = document.querySelector(
      ".testimonial-fin__slider"
    );
    if (testimonialFinSlider) {
      var swiper = new Swiper(testimonialFinSlider, {
        slidesPerView: 1,
        spaceBetween: 15,
        speed: 1500,
        loop: true,
        disableOnInteraction: true,
        unlock: true,
        navigation: {
          nextEl: ".testimonial-fin-next",
          prevEl: ".testimonial-fin-prev",
          isLocked: false,
        },
        breakpoints: {
          992: {
            slidesPerView: 2,
            spaceBetween: 25,
          },
          1200: {
            slidesPerView: 3,
            spaceBetween: 32,
          },
        },
      });
    }
    // testimonial-fin__slider End


// testimonial-sa__slider Start
    const testimonialSlider = document.querySelector(".testimonial-sa__slider");

    const testimonialSliderNext = document.querySelector(
      ".testimonial-sa__slider-controller-next"
    );
    const testimonialSliderPrev = document.querySelector(
      ".testimonial-sa__slider-controller-prev"
    );
    console.log(testimonialSlider);
    if (testimonialSlider) {
      var swiper = new Swiper(testimonialSlider, {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        navigation: {
          nextEl: testimonialSliderNext,
          prevEl: testimonialSliderPrev,
        },
        breakpoints: {
          1500: {
            slidesPerView: 1.5,
            spaceBetween: 30,
          },
          1700: {
            slidesPerView: 1.8,
            spaceBetween: 30,
          },
          2000: {
            slidesPerView: 2,
            spaceBetween: 30,
          },
        },
      });
    }
    // testimonial-sa__slider End

    // testimonial-ab__slider Start
    const testimonialSlider2 = document.querySelector(".testimonial-ab__slider");
    if (testimonialSlider2) {
      var swiper = new Swiper(testimonialSlider2, {
        slidesPerView: 1,
        loop: true,
        speed: 3000,
         autoplay: {
          delay: 1,
         },
        breakpoints: {
          992: {
            slidesPerView: 2,
          },
          1400: {
            slidesPerView: 2.5,
          },
        },
      });
    }
    // testimonial-ab__slider End
  }

  // team-health__slider start
  const teamHealthSlider = document.querySelector(".team-health__slider");
  if (teamHealthSlider) {
    var swiper = new Swiper(teamHealthSlider, {
      slidesPerView: 2,
      centeredSlides: true,
      clickable: true,
      spaceBetween: 5,
      loop: true,
      disableOnInteraction: false, // Make sure interaction doesn't disable functionality
      unlock: true,
      navigation: {
        nextEl: ".team-health-next",
        prevEl: ".team-health-prev",
        isLocked: false,
      },
      breakpoints: {
        576: {
          spaceBetween: 1,
          slidesPerView: 3,
        },
        768: {
          spaceBetween: 1,
          slidesPerView: 4,
        },
        1200: {
          slidesPerView: 5,
          spaceBetween: 10,
        },
        1300: {
          slidesPerView: 6,
          spaceBetween: 10,
        },
        1400: {
          slidesPerView: 7,
          spaceBetween: 10,
        },
        1500: {
          slidesPerView: 10,
          spaceBetween: 10,
        },
      },
    });
  }

  document.addEventListener("DOMContentLoaded", function () {
    function updateActiveContent() {
      document
        .querySelectorAll(".team-health__slider-content .content")
        .forEach((el) => {
          el.classList.remove("active");

        });
      const prevSlideIndex = swiper.slides[swiper.activeIndex]
        .previousElementSibling
        ? swiper.slides[swiper.activeIndex].previousElementSibling.dataset
            .swiperSlideIndex
        : null;

      if (prevSlideIndex !== null) {
        const contentToActivate = document.querySelector(
          `.team-health__slider-content .content:nth-child(${
            parseInt(prevSlideIndex) + 1
          })`
        );
        if (contentToActivate) {
          contentToActivate.classList.add("active");
        }
      }
    }

    if (teamHealthSlider) {
      updateActiveContent();
    }

    if (teamHealthSlider) {
      swiper.on("slideChange", function () {
        updateActiveContent();
      });
    }
  });
  // team-health__slider End

    // team-la__slider start
    const landmarkSlider = document.querySelector(".landmark__slider");
    if (landmarkSlider) {
      var swiper = new Swiper(landmarkSlider, {
        slidesPerView: 1,
        spaceBetween: 24,
        speed: 1500,
        loop: false,
        disableOnInteraction: true,
        unlock: true,
        navigation: {
          nextEl: ".landmark__slider-next",
          prevEl: ".landmark__slider-prev",
          isLocked: false,
        },
        breakpoints: {
          575: {
            slidesPerView: 2,
          },
          768: {
            slidesPerView: 3,
          },
          1200: {
            slidesPerView: 4,
          },
        },
      });
    }
    // team-la__slider End

  function teamSliderActive(){
    // team-digital__slider start
    const teamDigitalSlider = document.querySelector(".team-digital__slider");
    if (teamDigitalSlider) {
      var swiper = new Swiper(teamDigitalSlider, {
        slidesPerView: 1,
        spaceBetween: 20,
        speed: 1500,
        loop: true,
        disableOnInteraction: true,
        navigation: {
          nextEl: ".team-digital__slider-next",
          prevEl: ".team-digital__slider-prev",
        },
        breakpoints: {
          576: {
            slidesPerView: 2,
          },
          768: {
            slidesPerView: 3,
          },
          1024: {
            slidesPerView: 4,
          },
        },
      });
    }
    // team-digital__slider end

    // team-la__slider start
    const teamLaSlider = document.querySelector(".team-la__slider");
    if (teamLaSlider) {
      var swiper = new Swiper(teamLaSlider, {
        slidesPerView: 1,
        spaceBetween: 10,
        speed: 2000,
        loop: true,
        disableOnInteraction: true,
        unlock: true,
        navigation: {
          nextEl: ".team-la__slider-next",
          prevEl: ".team-la__slider-prev",
          isLocked: false,
        },
        breakpoints: {
          640: {
            slidesPerView: 1.5,
            spaceBetween: 20,
          },
          768: {
            slidesPerView: 2,
            spaceBetween: 15,
          },
          1200: {
            slidesPerView: 3,
          },

          1400: {
            spaceBetween: 30,
            slidesPerView: 4,
          },
        },
      });
    }
    // team-la__slider End

    // team-fin__slider start
    const teamFinSlider = document.querySelector(".team-fin__slider");
    if (teamFinSlider) {
      var swiper = new Swiper(teamFinSlider, {
        slidesPerView: 1,
        spaceBetween: 20,
        speed: 4000,
         autoplay: {
          delay: 1,
         },
        loop: true,
        disableOnInteraction: true,
        // unlock: true,
        navigation: {
          nextEl: ".team-fin-next",
          prevEl: ".team-fin-prev",
          // isLocked: false,
        },
        breakpoints: {
          576: {
            slidesPerView: 2,
          },
          992: {
            slidesPerView: 3,
          },
          1200: {
            spaceBetween: 40,
            slidesPerView: 4,
          },
        },
      });
    }
    // team-fin__slider end
  }

  // hero-travel__slider start
  const heroTravelSlider = document.querySelector(".hero-travel__slider");
  if (heroTravelSlider) {
    var swiper = new Swiper(heroTravelSlider, {
      slidesPerView: 4,
      centeredSlides: false,
      spaceBetween: 20,
      navigation: {
        nextEl: ".hero-travel__slider-next",
        prevEl: ".hero-travel__slider-prev",
      },
      scrollbar: {
        el: ".hero-travel__slider-scrollbar",
        hide: false,
      },
      pagination: {
        el: ".hero-travel__slider-pagination",
        type: "fraction",
      },
    });
  }
  // hero-travel__slider End

  // active services-mar Item start
  const services = document.querySelectorAll(".services-mar__services li");
  if (services?.length > 0) {
    let lastActiveItem = services[0];

    lastActiveItem.classList.add("active");

    services.forEach((item) => {
      const serviceName = item.querySelector(".service-name");

      serviceName.addEventListener("mouseenter", () => {
        if (lastActiveItem) {
          lastActiveItem.classList.remove("active");
        }
        item.classList.add("active");
        lastActiveItem = item;
      });
    });
  }
  // active services-mar Item end

  // counter up start
  $(
    ".funfacts__item, .hero-ca__kits, .about-ad__funfacts, .total-doctors, .funfacts-health__item, .about-fit__counters-item, .experience, .funfact-mar__item, .funfact-digital__counter, .funfact__item, .fun-fact__item, .hero-sa__projects"
  ).each(function () {
    var parentSection = $(this);
    parentSection.isInViewport(function (status) {
      if (status === "entered") {
        parentSection.find(".odometer").each(function () {
          var odometerElement = $(this);
          if (!odometerElement.hasClass("odometer-updated")) {
            odometerElement.html(odometerElement.attr("data-odometer-final"));
            odometerElement.addClass("odometer-updated");
          }
        });
      }
    });
  });
  // counter up end


  /* gallery Popup*/
  $(document).ready(function () {
    $(".gallery-sa__magnific-link").magnificPopup({
      type: "image",
      mainClass: "mfp-with-zoom",
      gallery: {
        enabled: true,
      },

      zoom: {
        enabled: true,

        duration: 300, // duration of the effect, in milliseconds
        easing: "ease-in-out", // CSS transition easing function

        opener: function (openerElement) {
          return openerElement.is("img")
            ? openerElement
            : openerElement.find("img");
        },
      },
    });
  });

  $(document).ready(function () {
    $(".popup-youtube").magnificPopup({
      type: "iframe",
      mainClass: "mfp-fade",
      removalDelay: 160,
      preloader: false,
      fixedContentPos: false,
    });
  });


  // showcase JS Start
  document.querySelectorAll(".showcase-v2__link").forEach(function (link) {
    link.addEventListener("mouseover", function () {
      const wrapper = document.querySelector(".showcase-v2__wrapper");
      const showcaseItem = document.querySelectorAll(".showcase-v2__item");

      if (wrapper && showcaseItem) {
        wrapper.classList.add("hover");
        showcaseItem.forEach(function (item) {
          item.classList.remove("active");
        });
        link.parentElement.classList.add("active");
      }
    });

    link.addEventListener("mouseleave", function () {
      const wrapper = document.querySelector(".showcase-v2__wrapper");
      if (wrapper) {
        wrapper.classList.remove("hover");
      }
    });
  });
  // showcase js end

  // accordion js  start
  const accordionButtons = document.querySelectorAll(".accordion-button");
  const imageElements = document.querySelectorAll(
    ".services-la__accordion-thumb img"
  );

  if (accordionButtons.length > 0 && imageElements.length > 0) {
    accordionButtons.forEach((button) => {
      button.addEventListener("click", () => {
        const id = button.getAttribute("data-bs-id").split("-").pop();
        imageElements.forEach((img) => img.classList.remove("active"));

        if (imageElements[id - 1]) {
          imageElements[id - 1].classList.add("active");
        }
      });
    });
  }
  // accordion js  end

  // curcular-text js start
  const texts = document.querySelectorAll(
      ".circular-text-content, .circular-video-text, .circleNextText"
  );

  texts.forEach((text) => {
    const str = text.getAttribute("data-content");
    createCircularText(text, str, 3);
  });

  function createCircularText(element, content, repeatCount) {
    element.innerHTML = "";

    const fullText = `${content} ${" ".repeat(2)} `.repeat(repeatCount);
    for (let i = 0; i < fullText.length; i++) {
      let span = document.createElement("span");
      span.classList.add("rotate");
      span.innerHTML = fullText[i] === " " ? "&nbsp;" : fullText[i];
      span.style.transform = `rotate(${(360 / fullText.length) * i}deg)`;
      element.appendChild(span);
    }
  }

  // curcular-text js end

  // team-card-rotate js start

  const items = document.querySelectorAll(".team-la__item");
  if (items) {
    if (window.innerWidth > 1319) {
      items.forEach((item) => {
        const before = item.querySelector(".team-la__item-before");
        const after = item.querySelector(".team-la__item-after");

        before.addEventListener("mouseenter", () => {
          item.classList.add("rotate-item-anticlockwise");
          after.classList.add("rotate-item-clockwise");
        });

        before.addEventListener("mouseleave", () => {
          item.classList.remove("rotate-item-anticlockwise");
          after.classList.remove("rotate-item-clockwise");
        });
      });
    }
  }

  // team-card-rotate js end

  // award__item js Start
  const awardItems = document.querySelectorAll(".award__item");

  let currentActiveItem = document.querySelector(".award__item.active");

  awardItems.forEach((item) => {
    item.addEventListener("click", function () {
      if (currentActiveItem) {
        currentActiveItem.classList.remove("active");
      }

      this.classList.add("active");

      currentActiveItem = this;
    });
  });

  // award__item js End

  // nice select js Start
  $(document).ready(function () {
    if ($.fn.niceSelect) {
      $("select").niceSelect();
    }
  });

  // nice select js End

  // select current Date & time js Start
  const getCurrentTime = () => {
    const now = new Date();
    let hours = now.getHours();
    let minutes = now.getMinutes();
    if (hours < 10) hours = "0" + hours;
    if (minutes < 10) minutes = "0" + minutes;
    return `${hours}:${minutes}`;
  };

  const getCurrentDate = () => {
    const now = new Date();
    const year = now.getFullYear();
    const month = String(now.getMonth() + 1).padStart(2, "0");
    const day = String(now.getDate()).padStart(2, "0");
    return `${year}-${month}-${day}`;
  };

  const timeInput = document.getElementById("timeInput");
  const dateInput = document.getElementById("dateInput");
  if (timeInput) {
    timeInput.value = getCurrentTime();
    timeInput.addEventListener("click", function () {
      this.showPicker();
    });
  }
  if (dateInput) {
    dateInput.value = getCurrentDate();
    dateInput.addEventListener("click", function () {
      this.showPicker();
    });
  }
  // select current Date & time js End

  // img-moveement js start

  if ($(".img-move").length > 0) {
    $(".img-move").css("transition", "transform .12s linear");
    $(".img-move").mousemove(function (event) {
      var mousex = event.pageX - $(this).offset().left;
      var mousey = event.pageY - $(this).offset().top;

      var imgx = (mousex - 300) / 30;
      var imgy = (mousey - 200) / 30;

      $(this).css(
        "transform",
        "translate(" + imgx + "px," + imgy + "px) scale(1.1)"
      );
    });

    $(".img-move").mouseout(function () {
      $(this).css("transform", "translate(0px, 0px) scale(1)");
    });
  }
  // img-moveement js End

  // btn-moveement Animation Start
  $(".btn-hover").on("mouseenter", function (e) {
    var x = e.pageX - $(this).offset().left;
    var y = e.pageY - $(this).offset().top;

    $(this).find("span").css({
      top: y,
      left: x,
    });
  });

  $(".btn-hover").on("mouseout", function (e) {
    var x = e.pageX - $(this).offset().left;
    var y = e.pageY - $(this).offset().top;

    $(this).find("span").css({
      top: y,
      left: x,
    });
  });

  const all_btns = gsap.utils.toArray(".btn-hover");
  if (all_btns.length > 0) {
    var all_btn = gsap.utils.toArray(".btn-hover");
  } else {
    var all_btn = gsap.utils.toArray("#btn-hover");
  }
  const all_btn_cirlce = gsap.utils.toArray(".btn-item");
  all_btn.forEach((btn, i) => {
    $(btn).mousemove(function (e) {
      callParallax(e);
    });
    function callParallax(e) {
      parallaxIt(e, all_btn_cirlce[i], 80);
    }

    function parallaxIt(e, target, movement) {
      var $this = $(btn);
      var relX = e.pageX - $this.offset().left;
      var relY = e.pageY - $this.offset().top;

      gsap.to(target, 0.5, {
        x: ((relX - $this.width() / 2) / $this.width()) * movement,
        y: ((relY - $this.height() / 2) / $this.height()) * movement,
        ease: Power2.easeOut,
      });
    }
    $(btn).mouseleave(function (e) {
      gsap.to(all_btn_cirlce[i], 0.5, {
        x: 0,
        y: 0,
        ease: Power2.easeOut,
      });
    });
  });
  // btn-moveement Animation End

  // Image Animation start
  const imgCursor = document.querySelector(".img-cursor");
  if (imgCursor) {
    gsap.set(imgCursor, { yPercent: -50, xPercent: -50 });

    gsap.utils
      .toArray(".hero-fin__title, .work-digital__item-thumb")
      .forEach((el) => {
        const image = el.querySelector(".img-cursor"),
          setX = gsap.quickSetter(image, "x", "px"),
          setY = gsap.quickSetter(image, "y", "px"),
          align = (e) => {
            setX(e.clientX);
            setY(e.clientY);
          },
          startFollow = () => document.addEventListener("mousemove", align),
          stopFollow = () => document.removeEventListener("mousemove", align),
          fade = gsap.to(image, {
            autoAlpha: 1,
            ease: "none",
            paused: true,
            onReverseComplete: stopFollow,
          });

        el.addEventListener("mouseenter", (e) => {
          fade.play();
          startFollow();
          align(e);
        });

        el.addEventListener("mouseleave", () => fade.reverse());
      });
  }
  // Image Animation end

  // Marquee text Start

  const marquee = (parentSelector, speed) => {
    const clone = parentSelector.innerHTML;
    const firstElement = parentSelector.children[0];
    let i = 0;
    parentSelector.insertAdjacentHTML("beforeend", clone);
    parentSelector.insertAdjacentHTML("beforeend", clone);

    setInterval(function () {
      firstElement.style.marginLeft = `-${i}px`;
      if (i > firstElement.clientWidth) {
        i = 0;
      }
      i = i + speed;
    }, 0);
  };

  const marqueeSelector = document.querySelector(".text-slide .h2");

  window.addEventListener("load", () => {
    if (marqueeSelector) {
      marquee(marqueeSelector, 0.3);
    }
  });

  // Marquee text End

  const circleTypeTextElement = document.querySelector(".circle-type-text");
  if (circleTypeTextElement) {
    const circleTypeText = new CircleType(circleTypeTextElement);
    circleTypeText.radius(50);
  }

  gsap.registerPlugin(
    ScrollTrigger,
    SplitText,
    ScrollTrigger,
    ScrollSmoother,
    ScrollToPlugin
  );
  let device_width = window.innerWidth;

  // hero title GSAP animation start
  const words = document.querySelectorAll(".word-animation");

  if (words?.length > 0) {
    words.forEach((word) => {
      const characters = word.innerHTML
        .split("")
        .map((char) => {
          if (char === " ") {
            return `<span class="char">&nbsp;</span>`;
          }
          return `<span class="char">${char}</span>`;
        })
        .join("");
      word.innerHTML = characters;
    });
  }

  const charAnimi = document.querySelectorAll(".char");
  // const
  if (charAnimi && charAnimi.length > 0) {
    gsap.from(".char", {
      duration: 1,
      opacity: 0,
      y: 100,
      ease: "power3.out",
      stagger: 0.05,
      delay: 2,
    });
  }
  // hero title GSAP animation end

// text-reveal GSAP start
  const textRevealSection = document.querySelectorAll(".text-reveal-section");

  textRevealSection.forEach((textRevealSection) => {
    const text = textRevealSection.querySelector(".text-reveal");

    if (text) {
      const split = new SplitText(text, {
        type: "chars",
      });

      gsap
        .timeline({
          scrollTrigger: {
            trigger: textRevealSection,
            // end: "+=200%",
            // start: "top top",
            start: "-30% top",
            end: "bottom",
            pin: true,
            scrub: 0.75,
            markers: true,
          },
        })
        .set(
          split.chars,
          {
            color: "#0f0f0f",
            stagger: 0.1,
          },
          0.1
        );
    }
  });
  // text-reveal GSAP end

  // work section sub-title animation start
  const workDigital = document.querySelector(".work-digital");
  const workDigitalTitle = document.querySelector(
    ".work-digital .section__header-sub-title-v12"
  );
  if (workDigitalTitle && workDigital) {
    if (device_width > 992) {
      gsap.from(".work-digital .section__header-sub-title-v12", {
        x: -200,
        opacity: 0,
        duration: 1,
        scrollTrigger: {
          trigger: workDigital,
          start: "top center",
          toggleActions: "play none none none",
        },
      });
    }
  }
  // work section sub-title animation end

  // Define breakpoints and corresponding animations
  const breakpoints = {
    small: {
      scaleStart: 0,
      xStart: -150,
      yStart: -100,
      scaleMiddle: 0.5,
      xMiddle: -100,
      yMiddle: -50,
      scaleEnd: 1,
      xEnd: 0,
      yEnd: 0,
    },
    large: {
      scaleStart: 0,
      xStart: -300,
      yStart: -200,
      scaleMiddle: 0.5,
      xMiddle: -250,
      yMiddle: -100,
      scaleEnd: 1,
      xEnd: 0,
      yEnd: 0,
    },
  };

  // Function to determine which breakpoint to use
  function getBreakpoint() {
    if (window.innerWidth < 768) {
      return breakpoints.small;
    } else {
      return breakpoints.large;
    }
  }

  // Apply the animation based on the current breakpoint
  function applyAnimation() {
    const bp = getBreakpoint();

    if (workDigital && workDigitalTitle) {
      if (device_width > 992) {
        gsap.fromTo(
          ".work-digital .section__header-title-v12",
          { scale: bp.scaleStart, x: bp.xStart, y: bp.yStart },
          {
            scale: bp.scaleMiddle,
            x: bp.xMiddle,
            y: bp.yMiddle,
            duration: 1,
            scrollTrigger: {
              trigger: ".work-digital",
              start: "top center",
              toggleActions: "play none none none",
            },
            onComplete: () => {
              gsap.to(".work-digital .section__header-title-v12", {
                scale: bp.scaleEnd,
                x: bp.xEnd,
                y: bp.yEnd,
                scrollTrigger: {
                  trigger: ".work-digital",
                  start: "top center",
                  end: "bottom center",
                  scrub: true,
                },
              });
            },
          }
        );
      }
    }
  }

  // Initial animation application
  applyAnimation();

  // work-digital horizontal Slider
  function animateItems({
    containerSelector,
    itemSelector,
    childCount,
    xOffset,
    opacity,
    duration,
    stagger,
    startTrigger,
    deviceWidth = 992,
  }) {
    const container = document.querySelector(containerSelector);
    const items = document.querySelector(
      `${itemSelector}:nth-child(-n+${childCount})`
    );

    if (container && items) {
      if (window.innerWidth > deviceWidth) {
        gsap.from(items, {
          x: xOffset,
          opacity: opacity,
          duration: duration,
          stagger: stagger,
          scrollTrigger: {
            trigger: container,
            start: startTrigger,
            toggleActions: "play none none none",
          },
        });
      }
    }
  }

  animateItems({
    containerSelector: ".work-digital__items",
    itemSelector: ".work-digital__item",
    childCount: 3,
    xOffset: 200,
    opacity: 0,
    duration: 1,
    stagger: 0.2,
    startTrigger: "top center",
  });

  animateItems({
    containerSelector: ".service-sa__items",
    itemSelector: ".service-sa__item",
    childCount: 4,
    xOffset: 200,
    opacity: 0,
    duration: 1,
    stagger: 0.2,
    startTrigger: "top center",
  });

  function setupScrollAnimation({
    triggerSelector,
    itemsSelector,
    scrollDuration = 2.5,
    deviceWidthThreshold = 991,
    xPercentMultiplier = 100,
    snapMultiplier = 1,
    num = 2,
  }) {
    let triggerElement = document.querySelector(triggerSelector);
    let items = gsap.utils.toArray(itemsSelector);

    if (triggerElement && items.length) {
      if (window.innerWidth > deviceWidthThreshold) {
        gsap.to(items, {
          xPercent: -xPercentMultiplier * (items.length - num),
          scrollTrigger: {
            trigger: triggerElement,
            pin: true,
            start: "center center",
            end: `+=${scrollDuration * 1000}`,
            scrub: true,
            snap: snapMultiplier / (items.length - 2),
            markers: false,

            onToggle: (self) => {
              const parentElement = triggerElement.parentElement;
              console.log(parentElement);
              if (self.isActive) {
                parentElement.classList.add("pinned");
              } else {
                parentElement.classList.remove("pinned");
              }
            },
          },
        });
      }
    }
  }

  setupScrollAnimation({
    triggerSelector: ".work-digital",
    itemsSelector: ".work-digital__item",
    scrollDuration: 3,
    deviceWidthThreshold: 991,
    num: 2,
  });

  setupScrollAnimation({
    triggerSelector: ".service-sa__area",
    itemsSelector: ".service-sa__item",
    scrollDuration: 2.8,
    deviceWidthThreshold: 991,
    num: 4,
  });
  // work-digital horizontal Slider End

  // section reveal & stack also vanish animation Start
  const pineVanish = gsap.utils.toArray(".an-pine-vanish");
  if (pineVanish.length > 0) {
    if (device_width > 767) {
      pineVanish.forEach((item) => {
        gsap.to(item, {
          opacity: 0,
          scale: 0.9,
          y: 50,
          scrollTrigger: {
            trigger: item,
            scrub: true,
            start: "bottom bottom",
            pin: true,
            pinSpacing: false,
            markers: false,
          },
        });
      });
    }
  }
  // section reveal & stack also vanish animation End

  // fade up animation start
  var fadeArray_items = document.querySelectorAll(".fade_up_anim");
  if (fadeArray_items.length > 0) {
    var fadeArray = gsap.utils.toArray(".fade_up_anim");
    fadeArray.forEach(function (item) {
      var fade_direction = "bottom";
      var onscroll_value = 1;
      var duration_value = 0.75;
      var fade_offset = 40;
      var delay_value = 0.15;
      var ease_value = "power2.out";

      if (item.getAttribute("data-duration")) {
        duration_value = item.getAttribute("data-duration");
      }
      if (item.getAttribute("data-fade-from")) {
        fade_direction = item.getAttribute("data-fade-from");
      }
      if (item.getAttribute("data-delay")) {
        delay_value = item.getAttribute("data-delay");
      }

      var animation_settings = {
        opacity: 0,
        ease: ease_value,
        duration: parseFloat(duration_value), // Ensure duration is a number
        delay: parseFloat(delay_value), // Ensure delay is a number
      };

      if (fade_direction === "top") {
        animation_settings.y = -fade_offset;
      }
      if (fade_direction === "left") {
        animation_settings.x = -fade_offset;
      }

      if (fade_direction === "bottom") {
        animation_settings.y = fade_offset;
      }

      if (fade_direction === "right") {
        animation_settings.x = fade_offset;
      }

      if (onscroll_value === 1) {
        animation_settings.scrollTrigger = {
          trigger: item,
          start: "top bottom",
          markers: false,
        };
      }

      gsap.from(item, animation_settings);
    });
  }
  // fade up animation end

  // Preloader start
  function preloader() {
    const svg = document.getElementById("svg");
    const tl = gsap.timeline();
    const curve = "M0 502S175 272 500 272s500 230 500 230V0H0Z";
    const flat = "M0 2S175 1 500 1s500 1 500 1V0H0Z";

    tl.to(".preloader-text", {
      delay: 0.5,
      y: -100,
      opacity: 0,
    });

    tl.to(svg, {
      duration: 0.5,
      attr: { d: curve },
      ease: "power2.easeIn",
    }).to(svg, {
      duration: 0.5,
      attr: { d: flat },
      ease: "power2.easeOut",
    });

    tl.to(".preloader", {
      duration: 0.8,
      y: -1500,
      ease: "power2.easeInOut",
    });

    tl.set(".preloader", {
      zIndex: -1,
      display: "none",
    });
  }

  window.onload = function () {
    preloader();
  };

  // Preloader End

  // Section Jump start
  const links = document.querySelectorAll(".section-link");

  if (links && links.length > 0) {
    links.forEach((link) => {
      link.addEventListener("click", function (event) {
        event.preventDefault();

        // Get the target section's ID from the href attribute
        const targetID = this.getAttribute("href");
        const targetSection = document.querySelector(targetID);

        if (targetSection) {
          gsap.to(window, {
            duration: 1,
            scrollTo: {
              y: targetSection,
              offsetY: 50, // optional offset for header or fixed elements
            },
          });
        } else {
          console.error(`Section with ID ${targetID} does not exist.`);
        }
      });
    });
  }
  // Section Jump End

  // Image revel start
  document.querySelectorAll(".item-popup").forEach((item, index) => {
    const delay = item.getAttribute("data-delay") || 0; // Get the data-delay attribute or default to 0

    gsap.from(item, {
      scrollTrigger: {
        trigger: item,
        start: "top bottom",
      },
      y: 200,
      opacity: 0,
      duration: 1.5,
      ease: "power4.out",
      delay: index * 0.3 + parseFloat(delay), // Sequential delay for each item
    });
  });
  // Image revel End

  ////////////////////////////////////////////////////
  //  Wow Js
  new WOW().init();

// Define your variables
var y = '';  // Replace with your text content
var i = '16px';  // Replace with your font size value

// Append the HTML string using jQuery
$('.side-panel__mobile-menu .wprealizer-megamenu-width-1').append('<a class="mean-expand" href="#" style="font-size: ' + i + '">' + y + "</a>");



$(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/wpr-counter.default', counterSliderActive);
    elementorFrontend.hooks.addAction('frontend/element_ready/wpr-blog-post.default', blogSliderActive);
    elementorFrontend.hooks.addAction('frontend/element_ready/wpr-services.default', serviceSliderActive);
    elementorFrontend.hooks.addAction('frontend/element_ready/wpr-brand-slider.default', brandSliderActive);
    elementorFrontend.hooks.addAction('frontend/element_ready/wpr-team.default', teamSliderActive);
    elementorFrontend.hooks.addAction('frontend/element_ready/wpr-testimonial-slider.default', testiSliderActive);
});


})(jQuery);
