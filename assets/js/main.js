jQuery(document).ready(function($) {

  // Smooth scrolling using jQuery easing
  $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function() {
    if (
      location.pathname.replace(/^\//, "") ==
        this.pathname.replace(/^\//, "") &&
      location.hostname == this.hostname
    ) {
      var target = $(this.hash);
      target = target.length ? target : $("[name=" + this.hash.slice(1) + "]");
      if (target.length) {
        $("html, body").animate(
          {
            scrollTop: target.offset().top - 54
          },
          1000,
          "easeInOutExpo"
        );
        return false;
      }
    }
  });

  // Closes responsive menu when a scroll trigger link is clicked
  $(".js-scroll-trigger").click(function() {
    $(".navbar-collapse").collapse("hide");
  });

  // Activate scrollspy to add active class to navbar items on scroll
  $("body").scrollspy({
    target: "#mainNav",
    offset: 56
  });

  //code for Nasted Tab
  $("ul.nav-tabs a").click(function(e) {
    e.preventDefault();
    $(this).tab("show");
  });

  // Collapse Navbar
  var navbarCollapse = function() {
    if ($("#mainNav").offset().top > 100) {
      $("#mainNav").addClass("navbar-shrink");
    } else {
      $("#mainNav").removeClass("navbar-shrink");
    }
  };
  // Collapse now if page is not at top
  navbarCollapse();
  // Collapse the navbar when page is scrolled
  $(window).scroll(navbarCollapse);

  // Hide navbar when modals trigger
  $(".portfolio-modal").on("show.bs.modal", function(e) {
    $(".navbar").addClass("d-none");
  });
  $(".portfolio-modal").on("hidden.bs.modal", function(e) {
    $(".navbar").removeClass("d-none");
  });



//Blog Page Carousel
$(".trending-blog-main").slick({
  nextArrow: '<i class="fa fa-arrow-right"></i>',
  prevArrow: '<i class="fa fa-arrow-left"></i>',
  arrows: true,
  dots: false,
  responsive: [
    {
      breakpoint: 768,
      settings: {
        centerPadding: "40px",
        slidesToShow: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        centerPadding: "40px",
        slidesToShow: 1
      }
    }
  ]
});

//slick single blog post
$(".single-blog-post-small-img").slick({
  nextArrow: '<i class="fa fa-arrow-right"></i>',
  prevArrow: '<i class="fa fa-arrow-left"></i>',
  arrows: true,
  dots: false,
  responsive: [
    {
      breakpoint: 768,
      settings: {
        centerPadding: "40px",
        slidesToShow: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        centerPadding: "40px",
        slidesToShow: 1
      }
    }
  ]
});


// Material Select Initialization
// $(".favorite-select").material_select();

//changing active class
$(".page-link").click(function() {
  $(this)
    .parent()
    .addClass("active")
    .siblings()
    .removeClass("active");
});


//CODE FOR HERO SLIDER
  // Tabbed carousel
  var $indicator = $('.indicator');
  $('.carousel--tabbed').slick({
    slidesToShow: 1,
    arrows: false,
    autoplay: false,
    cssEase: 'linear',
    autoplaySpeed: 0,
    speed:400,
    draggable: true,
    infinite: true,
    pauseOnHover: false,

  });
  $(".menu").on("click", " li", function(e){
        e.preventDefault();
        $('.menu li').removeClass('active');
        slideIndex = $(this).index();
        $indicator.css({ left: $(this).position().left });

    $( '.carousel-container .carousel--tabbed' ).slick('slickGoTo',slideIndex);
    $(this).toggleClass('active');
  });
});

