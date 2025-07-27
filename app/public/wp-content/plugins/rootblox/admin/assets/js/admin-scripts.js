(($) => {
  const { ajaxURL, welcomeNonce, blockStatusNonce } = scriptObj;

  $(document).ready(function () {
    // Dismiss welcome notice
    $(".notice.rootblox__welcome-notice").on(
      "click",
      ".notice-dismiss",
      function () {
        $.post({
          url: ajaxURL,
          data: {
            action: "rootblox_clear_welcome_notice",
            nonce: welcomeNonce,
          },
          success: function () {
            // console.log("Welcome notice cleared!!");
          },
          error: function () {
            // console.log("!!Failed to clear welcome notice!!");
          },
        });
      }
    );

    /* Tabs content display */
    const $dashboardWrapper = $(".cthf__admin-dashboard");

    function setActiveTab() {
      // const activeTab = parseInt(localStorage.getItem("rootbloxActiveTab"), 10);
      const activeTab = 0;

      if (!isNaN(activeTab)) {
        const $tabs = $dashboardWrapper.find(".toolbar__tab:not(:first-child)");
        const $contents = $dashboardWrapper.find(".content__item");

        $tabs.removeClass("active-tab").eq(activeTab).addClass("active-tab");
        $contents
          .addClass("cthf__display-none")
          .eq(activeTab)
          .removeClass("cthf__display-none");
      }
    }

    setActiveTab();
    $dashboardWrapper.on(
      "click",
      ".toolbar__tab:not(:first-child)",
      function () {
        const $tabs = $dashboardWrapper.find(".toolbar__tab:not(:first-child)");
        const $contents = $dashboardWrapper.find(".content__item");

        $tabs.removeClass("active-tab");

        const $this = $(this);
        const index = $tabs.index($this); // index relative to filtered tabs

        $this.addClass("active-tab");
        // localStorage.setItem("rootbloxActiveTab", index);

        $contents
          .addClass("cthf__display-none")
          .eq(index)
          .removeClass("cthf__display-none");
      }
    );

    /* Handle block enable/disable on input slider */
    $dashboardWrapper
      .find(".blocks__list .block__toggle-switch:not(.disabled) .block__status")
      .on("change", function () {
        const $this = $(this);
        const blockName = $this.data("block-name");
        let status = "active";
        if (!$this.prop("checked")) {
          status = "inactive";
        }

        $.post({
          url: ajaxURL,
          data: {
            action: "rootblox_update_block_status",
            nonce: blockStatusNonce,
            blockName: blockName,
            status: status,
          },
          success: function (res) {
            // console.log(res);
          },
          error: function () {
            // console.log("Unable to update block");
          },
        });
      });
  });
})(jQuery);
