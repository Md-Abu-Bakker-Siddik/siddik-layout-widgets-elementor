(function($) {
    'use strict';
    var WidgetProjectBlock3BgImg = function ($scope) {
        var $project_block3 = $('.projects-current-theme3');
        if ($project_block3.length > 1) {
          $project_block3.each(function(index) {
            var current_item = $(this);

            //by default set bg image with the first item
            if (index == 0) {
              let newBackground = current_item.data("bg");
              current_item.parents(".tm-sc-projects")
                .attr("data-background", newBackground)
                .css("background-image", "url(" + newBackground + ")");
            }

            //on mouse over change image
            current_item.on("mouseover", function () {
              let newBackground = current_item.data("bg");
              current_item.parents(".tm-sc-projects")
                .attr("data-background", newBackground)
                .css("background-image", "url(" + newBackground + ")");
            });
          });
        }
    };

    //elementor front start
    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.elementsHandler.attachHandler( 'tm-ele-cpt-projects', WidgetProjectBlock3BgImg, 'skin-style-current-theme3' );
    });
})(jQuery);

(function($) {
  'use strict';

  var WidgetProjectBlock6Handler = function($scope) {
    var $items = $('.projects-current-theme3 .inner-box');

    if ($items.length) {
      // Set the 2nd item active by default
      $items.eq(1).addClass('active');

      // Hover or click to activate
      $items.on('mouseenter click', function() {
        $items.removeClass('active');
        $(this).addClass('active');
      });
    }
  };

  $(window).on('elementor/frontend/init', function() {
    elementorFrontend.hooks.addAction(
      'frontend/element_ready/tm-ele-cpt-projects.skin-style-current-theme3',
      WidgetProjectBlock6Handler
    );
  });

})(jQuery);
