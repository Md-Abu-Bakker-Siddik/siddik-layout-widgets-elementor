(function ($) {
  "use strict";
  $(document).on("click", ".sl-button", function () {
    var button = $(this);
    var post_id = button.attr("data-post-id");
    var security = button.attr("data-nonce");
    var iscomment = button.attr("data-iscomment");
    var allbuttons;
    if (iscomment === "1") {
      /* Comments can have same id */
      allbuttons = $(".sl-comment-button-" + post_id);
    } else {
      allbuttons = $(".sl-button-" + post_id);
    }
    var loader = allbuttons.next(".sl-loader");
    if (post_id !== "") {
      $.ajax({
        type: "POST",
        url: slweLikes.ajaxurl,
        data: {
          action: "unique_addons_sl_process_simple_like",
          post_id: post_id,
          nonce: security,
          is_comment: iscomment,
        },
        beforeSend: function () {
          loader.html('&nbsp;<div class="loader">Loading...</div>');
        },
        success: function (response) {
          if (!response || !response.success || !response.data) {
            loader.empty();
            return;
          }
          var data = response.data;
          var icon = data.icon;
          var count = data.count;
          allbuttons.html(icon + count);
          if (data.status === "unliked") {
            var like_text = slweLikes.like;
            allbuttons.prop("title", like_text);
            allbuttons.removeClass("liked");
          } else {
            var unlike_text = slweLikes.unlike;
            allbuttons.prop("title", unlike_text);
            allbuttons.addClass("liked");
          }
          loader.empty();
        },
      });
    }
    return false;
  });
})(jQuery);
