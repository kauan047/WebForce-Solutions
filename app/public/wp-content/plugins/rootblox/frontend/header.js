(($) => {
  window["cthfHeader"] = (e) => {
    const element = $(`#${e}`);

    const attributes = window[e];

    const $body = $("body");

    const blockWrapper = $(`.cthf-block__wrapper.element-${e}`);

    const responsiveWrapper = $(`.cthf__mobile-layout-wrapper.element-${e}`);
    const sidebarWrapper = responsiveWrapper.find(".cthf__sidebar-panel-wrap");

    const $searchModal = blockWrapper.find(".cthf__search-modal");

    function debounce(func, delay) {
      let timeout;
      return function (...args) {
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(this, args), delay);
      };
    }

    /* Sticky Header */
    let lastScrollTop = 0; // Store the last scroll position
    $(window).on("scroll", function () {
      let scrollPosition = $(this).scrollTop(); // Get current scroll position
      let triggerPoint = 200; // Change this to your desired scroll position

      if (scrollPosition > triggerPoint && attributes.stickyHeader.enabled) {
        element.addClass("on-scroll__sticky");
        responsiveWrapper.addClass("on-scroll__sticky");
      } else {
        element.removeClass("on-scroll__sticky");
        responsiveWrapper.removeClass("on-scroll__sticky");
      }

      if (attributes.stickyHeader.bottomScrollHide) {
        let currentScroll = $(this).scrollTop(); // Get current scroll position

        if (currentScroll > lastScrollTop) {
          // User is scrolling down
          if (lastScrollTop > attributes.stickyHeader.bottomScrollOffset) {
            element
              .removeClass("on-scroll__sticky")
              .addClass("on-scroll__hide");

            responsiveWrapper
              .removeClass("on-scroll__sticky")
              .addClass("on-scroll__hide");
          }
        } else if (currentScroll < lastScrollTop) {
          // User is scrolling up
          element.removeClass("on-scroll__hide");
          responsiveWrapper.removeClass("on-scroll__hide");
        }

        lastScrollTop = currentScroll;
      }
    });

    /* Mobile Navigation */
    if (
      attributes.mobileMenu.status !== "off" &&
      (attributes.mobileMenu.status === "mobile" ||
        attributes.mobileMenu.status === "always")
    ) {
      if (attributes.mobileMenu.layout.length <= 0) {
        return;
      }

      function showSidebarPanel(status) {
        if (status) {
          sidebarWrapper.removeClass("cthf__display-none");
          $body.addClass("cthf__overflow-hidden");
        } else {
          sidebarWrapper.addClass("cthf__close-animation");
          setTimeout(() => {
            sidebarWrapper.addClass("cthf__display-none");
            sidebarWrapper.removeClass("cthf__close-animation");
          }, 300);
          $body.removeClass("cthf__overflow-hidden");
        }
      }

      function showSearchModal(status) {
        if (status) {
          $searchModal.addClass("has-animation__slide-down");
          $body.addClass("cthf__overflow-hidden");

          // Wait until the next paint to focus (to ensure it's in the DOM)
          setTimeout(() => {
            $searchModal.find(".cthf__search").focus();
          }, 300);
        } else {
          $searchModal.removeClass("has-animation__slide-down");
          $body.removeClass("cthf__overflow-hidden");
        }
      }

      // Open Sidebar Panel
      responsiveWrapper
        .find(".cthf__responsive-navigation .nav__icon")
        .on("click", function () {
          showSidebarPanel(true);
        });
      // Close Sidebar Panel
      sidebarWrapper.find(".sidebar-panel__overlay").on("click", function () {
        showSidebarPanel(false);
      });
      sidebarWrapper.find(".close__icon").on("click", function () {
        showSidebarPanel(false);
      });
      $(document).on("keydown", function (event) {
        if (event.key === "Escape") {
          showSidebarPanel(false);
          showSearchModal(false);
        }
      });

      /* Responsive Status Mobile */
      function handleMobileResponsiveView() {
        if (attributes.mobileMenu.status !== "mobile") {
          return;
        }

        if ($(window).width() <= attributes.mobileMenu.breakpoint) {
          /* Check if the layout flex are empty. */
          const allEmpty = attributes.mobileMenu.layout.every(
            (item) => item.length === 0
          );
          /* Don't hide desktop menu if layout flex are empty */
          if (allEmpty) {
            return;
          }

          element.addClass("cthf__display-none");
          responsiveWrapper.removeClass("cthf__display-none");
        } else {
          element.removeClass("cthf__display-none");
          responsiveWrapper.addClass("cthf__display-none");
          showSidebarPanel(false);
          showSearchModal(false);
        }
      }
      $(window).on("resize", handleMobileResponsiveView);
      handleMobileResponsiveView();

      /* Show search on click */
      const $searchIcon = responsiveWrapper.find(
        ".cthf__responsive-navigation .search__icon"
      );
      // core/search block
      const $searchBar = element.find(".is-style-cthf__search-modal-overlay");
      $searchModal
        .find(".close__icon")
        .on("click", () => showSearchModal(false));
      $searchIcon.on("click", function () {
        showSearchModal(true);
      });
      // Open modal when core/search is clicked
      $searchBar.on("click", function (e) {
        e.preventDefault();
        showSearchModal(true);
      });
      // Ajax search
      const $searchInput = $searchModal.find(".cthf__search");
      const $postsWrapper = $searchModal.find(".posts__collection");

      function handleAjaxSearch() {
        if (!attributes.isPremium) {
          return;
        }

        const keyword = $searchInput.val();

        const spinner = $searchModal.find(".spinner");

        if (String(keyword).length > 2) {
          $.post({
            url: attributes.ajaxURL,
            data: {
              action: "rootblox_ajax_search_result",
              nonce: attributes.searchNonce,
              attributes: JSON.stringify(attributes),
              searchKeyword: keyword,
            },
            beforeSend: function () {
              spinner.removeClass("cthf__display-none");
              $postsWrapper.addClass("cthf__opacity-blur");
            },
            success: function (res) {
              if (res.success && res.data) {
                $postsWrapper.html(res.data.render);
              }
            },
            error: function (err) {},
            complete: function () {
              spinner.addClass("cthf__display-none");
              $postsWrapper.removeClass("cthf__opacity-blur");
            },
          });
        }
      }

      const debouncedSearch = debounce(handleAjaxSearch, 300);
      $searchInput.on("input", debouncedSearch);

      /* Submenu Toggle on click */
      sidebarWrapper
        .find(".wp-block-navigation-item.has-child > button")
        .on("click", function (e) {
          const $parentItem = $(this).parent();
          const $submenu = $parentItem.children(
            ".wp-block-navigation__submenu-container"
          );

          // Toggle its own submenu
          $submenu.toggleClass("is-visible");

          // Remove is-visible from all nested submenus inside this submenu
          $submenu
            .find(".wp-block-navigation__submenu-container")
            .removeClass("is-visible");
        });
    }
  };
})(jQuery);
