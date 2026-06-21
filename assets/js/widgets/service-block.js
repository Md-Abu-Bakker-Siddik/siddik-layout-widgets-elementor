(function($) {
    'use strict';


    var WidgetServiceBlock2Handler = function ($scope) {
        //Service Block Hover
        if ($('.service-block-style2').length) {
            var $service_block = $('.service-block-style2 .inner-box');
            $($service_block).on('mouseenter', function (e) {
              $(this).find('.content-box .inner .service-details').stop().slideDown(300);
              return false;
            });
            $($service_block).on('mouseleave', function (e) {
              $(this).find('.content-box .inner .service-details').stop().slideUp(300);
              return false;
            });
        }
    };

    //elementor front start
    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/tm-ele-service-block.skin-style2",
            WidgetServiceBlock2Handler
        );
    });


})(jQuery);