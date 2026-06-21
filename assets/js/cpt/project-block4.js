(function($) {
    'use strict';

    var WidgetProjectsBlock4Handler = function ($scope) {
        var $items = $('.projects-current-theme4');
        
        // Set the first item active by default
        $items.first().addClass('active');
        
        $items.hover(
            function () {
                // On mouse enter: remove active from all, then add to hovered item
                $items.removeClass('active');
                $(this).addClass('active');
            }
        );
    };

    //elementor front start
    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/tm-ele-cpt-projects.skin-style-current-theme4",
            WidgetProjectsBlock4Handler
        );
    });


})(jQuery);
