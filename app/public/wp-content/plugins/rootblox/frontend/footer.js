(($) => {
  window["cthfFooter"] = (e) => {
    const element = $(`#${e}`);

    const attributes = window[e];

    /* Back to Top */
    const $bttBtn = $(`.cthf__back-to-top-wrapper.element-${e}`);
    function scrollFunction() {
      if (
        document.body.scrollTop > 10 ||
        document.documentElement.scrollTop > 10
      ) {
        $bttBtn.addClass("is-visible");
      } else {
        $bttBtn.removeClass("is-visible");
      }
    }
    scrollFunction();
    window.onscroll = function () {
      scrollFunction();
    };
    $bttBtn.on("click", function () {
      jQuery("html, body").animate({ scrollTop: 0 }, 600);
      return false;
    });

    /* Scroll Progress Bar */
    const $progressBar = $(`.cthf__scroll-progress-bar.element-${e} .progress-bar`);
    function updateScrollWidth() {
      var scrollTop = $(window).scrollTop();
      var docHeight = $(document).height();
      var winHeight = $(window).height();
      var scrollPercent = (scrollTop / (docHeight - winHeight)) * 100;

      $progressBar.css("width", scrollPercent + "%");
    }
    updateScrollWidth();
    $(window).on("scroll", function () {
      updateScrollWidth();
    });
  };
})(jQuery);
