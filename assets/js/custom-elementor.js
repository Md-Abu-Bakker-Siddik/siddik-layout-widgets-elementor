(function ($) {
  "use strict";

  var UNIQUE_ADDONS = window.UNIQUE_ADDONS || {};

  UNIQUE_ADDONS.isRTL = {
    check: function () {
      return document.documentElement.getAttribute("dir") === "rtl";
    },
  };

  function attrBool($el, name, fallback) {
    var val = $el.attr(name);
    if (val === undefined || val === null || val === "") {
      return fallback;
    }
    val = String(val).toLowerCase();
    return val === "true" || val === "1" || val === "yes";
  }

  function attrYes($el, name) {
    return attrBool($el, name, false);
  }

  function attrYesAny($el, names) {
    for (var i = 0; i < names.length; i++) {
      if (attrYes($el, names[i])) {
        return true;
      }
    }
    return false;
  }

  function parseAutoplayDelay($el) {
    var delay = parseInt($el.attr("data-autoplay-delay"), 10);

    if (isNaN(delay)) {
      delay = parseInt($el.attr("data-delay"), 10);
    }

    if (isNaN(delay) || delay < 0) {
      delay = 3000;
    }

    return delay;
  }

  function buildAutoplayConfig($container) {
    if (!attrYesAny($container, ["data-autoplay"])) {
      return false;
    }

    return {
      delay: parseAutoplayDelay($container),
      disableOnInteraction: false,
      pauseOnMouseEnter: attrYesAny($container, [
        "data-autoplay-pause-on-hover",
        "data-pause-on-hover",
        "data-pauseonmouseenter",
      ]),
      reverseDirection: attrYes($container, "data-reversedir"),
    };
  }

  function parseCenteredSlides($container) {
    return attrYesAny($container, ["data-centered-slides", "data-centered"]);
  }

  function attrNumber($el, name, fallback) {
    var val = parseFloat($el.attr(name));
    return isNaN(val) ? fallback : val;
  }

  function getScope($scope) {
    if ($scope && $scope.length) {
      return $scope;
    }
    return $(document);
  }

  function initIsotopeLayouts($scope) {
    if (typeof $.fn.isotope !== "function") {
      return;
    }

    getScope($scope)
      .find(".isotope-layout")
      .each(function () {
        var $container = $(this);

        if ($container.data("uae-isotope-init")) {
          return;
        }

        var $inner = $container.children(".isotope-layout-inner");
        if (!$inner.length) {
          return;
        }

        var layoutMode = $container.hasClass("masonry") ? "masonry" : "fitRows";
        var isotopeOptions = {
          itemSelector: ".isotope-item",
          layoutMode: layoutMode,
          percentPosition: true,
        };

        if (layoutMode === "masonry") {
          isotopeOptions.masonry = {
            columnWidth: $inner.find(".isotope-item-sizer").length
              ? ".isotope-item-sizer"
              : ".isotope-item",
          };
        }

        var runIsotope = function () {
          $inner.isotope(isotopeOptions);
          $container.data("uae-isotope-init", true);
          $inner.isotope("layout");
        };

        if (typeof imagesLoaded === "function") {
          imagesLoaded($inner[0], runIsotope);
        } else {
          runIsotope();
        }
      });
  }

  function relayoutIsotopeLayouts($scope) {
    if (typeof $.fn.isotope !== "function") {
      return;
    }

    getScope($scope)
      .find(".isotope-layout .isotope-layout-inner")
      .each(function () {
        var $inner = $(this);
        if ($inner.data("isotope")) {
          $inner.isotope("layout");
        }
      });
  }

  function initIsotopeFilters($scope) {
    getScope($scope)
      .find(".isotope-layout-filter")
      .each(function () {
        var $filter = $(this);

        if ($filter.data("uae-filter-init")) {
          return;
        }

        var holderId = $filter.attr("data-link-with");
        if (!holderId) {
          return;
        }

        $filter.on("click", "a", function (e) {
          e.preventDefault();

          var $link = $(this);
          var filterValue = $link.attr("data-filter") || "*";
          var $inner = $("#" + holderId).find(".isotope-layout-inner");

          $filter.find("a").removeClass("active");
          $link.addClass("active");

          if ($inner.length && $inner.data("isotope")) {
            $inner.isotope({ filter: filterValue });
          }
        });

        $filter.data("uae-filter-init", true);
      });
  }

  function refreshSwiperInstance($container) {
    var swiper = $container.data("uae-swiper-instance");
    var $swiperEl = $container.find("> .swiper-container-inner").first();

    if (!$swiperEl.length) {
      $swiperEl = $container.find(".swiper-container-inner").first();
    }

    if (!swiper && $swiperEl.length && $swiperEl[0].swiper) {
      swiper = $swiperEl[0].swiper;
    }

    if (swiper && typeof swiper.update === "function") {
      swiper.update();
    }
  }

  function initSwiperCarousels($scope, refreshOnly) {
    if (typeof Swiper !== "function") {
      return;
    }

    getScope($scope)
      .find(".tm-swiper-container")
      .each(function () {
        var $container = $(this);

        if ($container.data("uae-swiper-init")) {
          if (refreshOnly) {
            refreshSwiperInstance($container);
          }
          return;
        }

        if (refreshOnly) {
          return;
        }

        var $swiperEl = $container.find("> .swiper-container-inner").first();
        if (!$swiperEl.length) {
          $swiperEl = $container.find(".swiper-container-inner").first();
        }

        if (!$swiperEl.length) {
          return;
        }

        if ($swiperEl[0].swiper) {
          $container.data("uae-swiper-init", true);
          $container.data("uae-swiper-instance", $swiperEl[0].swiper);
          return;
        }

        $swiperEl.addClass("swiper");

        var autoplayConfig = buildAutoplayConfig($container);
        var centeredSlides = parseCenteredSlides($container);

        var swiperConfig = {
          slidesPerView: attrNumber($container, "data-items", 3),
          spaceBetween: attrNumber($container, "data-space", 15),
          loop: attrBool($container, "data-loop", false),
          centeredSlides: centeredSlides,
          speed: attrNumber($container, "data-speed", 600),
          freeMode: attrBool($container, "data-freemod", false),
          effect: $container.attr("data-effect") || "slide",
          autoplay: autoplayConfig,
          observer: true,
          observeParents: true,
          observeSlideChildren: true,
          resizeObserver: true,
          breakpoints: {
            0: {
              slidesPerView: attrNumber($container, "data-xs-items", 1),
            },
            576: {
              slidesPerView: attrNumber($container, "data-sm-items", 1),
            },
            768: {
              slidesPerView: attrNumber($container, "data-md-items", 2),
            },
            992: {
              slidesPerView: attrNumber($container, "data-lg-items", 3),
            },
            1200: {
              slidesPerView: attrNumber($container, "data-items", 3),
            },
            1400: {
              slidesPerView: attrNumber($container, "data-xxl-items", attrNumber($container, "data-items", 3)),
            },
          },
        };

        if (centeredSlides) {
          swiperConfig.centeredSlidesBounds = true;
        }

        var $prev = $container.find(".tm-swiper-button-prev").first();
        var $next = $container.find(".tm-swiper-button-next").first();
        if ($prev.length && $next.length && attrBool($container, "data-arrow", true)) {
          swiperConfig.navigation = {
            nextEl: $next[0],
            prevEl: $prev[0],
          };
        }

        var $pagination = $container.find(".swiper-pagination").first();
        if ($pagination.length && attrBool($container, "data-bullets", false)) {
          swiperConfig.pagination = {
            el: $pagination[0],
            type: $container.attr("data-pagination-type") || "bullets",
            clickable: true,
          };
        }

        if (UNIQUE_ADDONS.isRTL.check()) {
          swiperConfig.rtl = true;
        }

        var swiper = new Swiper($swiperEl[0], swiperConfig);

        if (typeof swiper.update === "function") {
          swiper.update();
        }

        $container.data("uae-swiper-init", true);
        $container.data("uae-swiper-instance", swiper);
      });
  }

  UNIQUE_ADDONS.documentOnReady = {
    init: function ($scope) {
      initIsotopeFilters($scope);
      initIsotopeLayouts($scope);
      initSwiperCarousels($scope);
    },
  };

  UNIQUE_ADDONS.windowOnLoad = {
    init: function ($scope) {
      relayoutIsotopeLayouts($scope);
      initSwiperCarousels($scope, true);
    },
  };

  window.UNIQUE_ADDONS = UNIQUE_ADDONS;

  function bindElementorHooks() {
    if (typeof elementorFrontend === "undefined") {
      return;
    }

    elementorFrontend.hooks.addAction("frontend/element_ready/widget", function ($scope) {
      UNIQUE_ADDONS.documentOnReady.init($scope);
    });
  }

  $(function () {
    UNIQUE_ADDONS.documentOnReady.init();
  });

  $(window).on("load", function () {
    UNIQUE_ADDONS.windowOnLoad.init();
  });

  $(window).on("elementor/frontend/init", bindElementorHooks);

  if (typeof elementorFrontend !== "undefined") {
    bindElementorHooks();
  }
})(jQuery);
