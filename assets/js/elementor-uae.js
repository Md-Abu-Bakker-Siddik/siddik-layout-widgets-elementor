(function ($) {
  "use strict";

  /**
   * Legacy Elementor bridge — layout init lives in custom-elementor.js (unique-addons-elementor).
   * Kept for backward compatibility with the uae-elementor-init handle.
   */
  function UAEElementorInitScript() {
    if (typeof window.UNIQUE_ADDONS === "undefined") {
      return;
    }

    if (typeof elementorFrontend === "undefined") {
      return;
    }

    elementorFrontend.hooks.addAction("frontend/element_ready/widget", function ($scope) {
      window.UNIQUE_ADDONS.documentOnReady.init($scope);
      window.UNIQUE_ADDONS.windowOnLoad.init($scope);
    });
  }

  $(window).on("elementor/frontend/init", UAEElementorInitScript);

  if (typeof elementorFrontend !== "undefined") {
    UAEElementorInitScript();
  }
})(jQuery);
