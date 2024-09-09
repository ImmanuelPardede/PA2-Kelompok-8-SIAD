(function ($) {
    "use strict";
    $(function () {
        var body = $("body");
        var contentWrapper = $(".content-wrapper");
        var scroller = $(".container-scroller");
        var footer = $(".footer");
        var sidebar = $(".sidebar");

        //Add active class to nav-link based on url dynamically
        //Active class can be hard coded directly in html file also as required

        function addActiveClass(element) {
            var href = element.attr("href");
            console.log("Element Href:", href, "Current:", current);

            // Close all collapses initially
            $(".collapse").removeClass("show");

            if (href === current) {
                element.parents(".nav-item").last().addClass("active");
                if (element.parents(".sub-menu").length) {
                    element.closest(".collapse").addClass("show");
                    element.addClass("active");
                }
            } else {
                element.parents(".nav-item").last().removeClass("active");
                if (element.parents(".sub-menu").length) {
                    element.closest(".collapse").removeClass("show");
                }
            }
        }

        $(document).ready(function () {
            var current = location.pathname;
            console.log("Current Path:", current);

            $(".nav li a").each(function () {
                var $this = $(this);
                addActiveClass($this);
            });

            // Close other collapses when a new one is opened
            sidebar.on("show.bs.collapse", ".collapse", function () {
                sidebar.find(".collapse.show").not(this).collapse("hide");
            });
        });

        var current = location.pathname
            .split("/")
            .slice(-1)[0]
            .replace(/^\/|\/$/g, "");
        $(".nav li a", sidebar).each(function () {
            var $this = $(this);
            addActiveClass($this);
        });

        $(".horizontal-menu .nav li a").each(function () {
            var $this = $(this);
            addActiveClass($this);
        });

        //Close other submenu in sidebar on opening any

        sidebar.on("show.bs.collapse", ".collapse", function () {
            sidebar.find(".collapse.show").collapse("hide");
        });

        //Change sidebar and content-wrapper height
        applyStyles();

        function applyStyles() {
            //Applying perfect scrollbar
            if (!body.hasClass("rtl")) {
                if (
                    $(".settings-panel .tab-content .tab-pane.scroll-wrapper")
                        .length
                ) {
                    const settingsPanelScroll = new PerfectScrollbar(
                        ".settings-panel .tab-content .tab-pane.scroll-wrapper"
                    );
                }
                if ($(".chats").length) {
                    const chatsScroll = new PerfectScrollbar(".chats");
                }
                if (body.hasClass("sidebar-fixed")) {
                    if ($("#sidebar").length) {
                        var fixedSidebarScroll = new PerfectScrollbar(
                            "#sidebar .nav"
                        );
                    }
                }
            }
        }

        $('[data-toggle="minimize"]').on("click", function () {
            if (
                body.hasClass("sidebar-toggle-display") ||
                body.hasClass("sidebar-absolute")
            ) {
                body.toggleClass("sidebar-hidden");
            } else {
                body.toggleClass("sidebar-icon-only");
            }
        });

        //checkbox and radios
        $(".form-check label,.form-radio label").append(
            '<i class="input-helper"></i>'
        );

        //Horizontal menu in mobile
        $('[data-toggle="horizontal-menu-toggle"]').on("click", function () {
            $(".horizontal-menu .bottom-navbar").toggleClass("header-toggled");
        });
        // Horizontal menu navigation in mobile menu on click
        var navItemClicked = $(".horizontal-menu .page-navigation >.nav-item");
        navItemClicked.on("click", function (event) {
            if (window.matchMedia("(max-width: 991px)").matches) {
                if (!$(this).hasClass("show-submenu")) {
                    navItemClicked.removeClass("show-submenu");
                }
                $(this).toggleClass("show-submenu");
            }
        });

        $(window).scroll(function () {
            if (window.matchMedia("(min-width: 992px)").matches) {
                var header = $(".horizontal-menu");
                if ($(window).scrollTop() >= 70) {
                    $(header).addClass("fixed-on-scroll");
                } else {
                    $(header).removeClass("fixed-on-scroll");
                }
            }
        });

        $(document).ready(function() {
            $('.nav-link[data-toggle="collapse"]').on('click', function() {
                var $this = $(this);
                var target = $this.attr('href');

                // Close other dropdowns
                $('.collapse').not(target).collapse('hide').each(function() {
                    var $this = $(this);
                    var $link = $(`a[href="#${$this.attr('id')}"]`);
                    $link.attr('aria-expanded', 'false');
                });

                // Toggle current dropdown
                var isExpanded = $this.attr('aria-expanded') === 'true';
                $this.attr('aria-expanded', !isExpanded);
            });
        });

    });

    // focus input when clicking on search icon
    $("#navbar-search-icon").click(function () {
        $("#navbar-search-input").focus();
    });
})(jQuery);

/* =================================================================================================================================================

                                                            VERSION 2

====================================================================================================================================================*/

// (function($) {
//     'use strict';
//     $(function() {
//       var body = $('body');
//       var contentWrapper = $('.content-wrapper');
//       var scroller = $('.container-scroller');
//       var footer = $('.footer');
//       var sidebar = $('.sidebar');

//       //Add active class to nav-link based on url dynamically
//       //Active class can be hard coded directly in html file also as required

//       function addActiveClass(element) {
//           var target = element.attr('href').split('/').pop(); // Ambil bagian akhir dari href untuk dibandingkan dengan current

//           if (target === current) {
//             element.parents('.nav-item').last().addClass('active');
//             if (element.parents('.sub-menu').length) {
//               element.closest('.collapse').addClass('show');
//               element.addClass('active');
//             }
//             if (element.parents('.submenu-item').length) {
//               element.addClass('active');
//             }
//           }
//         }

//         $(document).ready(function() {
//           var current = location.pathname.split("/").pop();
//           $('.nav li a', sidebar).each(function() {
//             var $this = $(this);
//             addActiveClass($this);
//           });

//           // Close other collapses
//           sidebar.on('show.bs.collapse', '.collapse', function() {
//             sidebar.find('.collapse.show').not(this).collapse('hide');
//           });
//         });

//         var current = location.pathname.split("/").pop().replace(/^\/|\/$/g, '');
//   console.log('Current URL segment:', current);

//       var current = location.pathname.split("/").slice(-1)[0].replace(/^\/|\/$/g, '');
//       $('.nav li a', sidebar).each(function() {
//         var $this = $(this);
//         addActiveClass($this);
//       })

//       $('.horizontal-menu .nav li a').each(function() {
//         var $this = $(this);
//         addActiveClass($this);
//       })

//       //Close other submenu in sidebar on opening any

//       sidebar.on('show.bs.collapse', '.collapse', function() {
//         sidebar.find('.collapse.show').collapse('hide');
//       });

//       //Change sidebar and content-wrapper height
//       applyStyles();

//       function applyStyles() {
//         //Applying perfect scrollbar
//         if (!body.hasClass("rtl")) {
//           if ($('.settings-panel .tab-content .tab-pane.scroll-wrapper').length) {
//             const settingsPanelScroll = new PerfectScrollbar('.settings-panel .tab-content .tab-pane.scroll-wrapper');
//           }
//           if ($('.chats').length) {
//             const chatsScroll = new PerfectScrollbar('.chats');
//           }
//           if (body.hasClass("sidebar-fixed")) {
//             if($('#sidebar').length) {
//               var fixedSidebarScroll = new PerfectScrollbar('#sidebar .nav');
//             }
//           }
//         }
//       }

//       $('[data-toggle="minimize"]').on("click", function() {
//         if ((body.hasClass('sidebar-toggle-display')) || (body.hasClass('sidebar-absolute'))) {
//           body.toggleClass('sidebar-hidden');
//         } else {
//           body.toggleClass('sidebar-icon-only');
//         }
//       });

//       //checkbox and radios
//       $(".form-check label,.form-radio label").append('<i class="input-helper"></i>');

//       //Horizontal menu in mobile
//       $('[data-toggle="horizontal-menu-toggle"]').on("click", function() {
//         $(".horizontal-menu .bottom-navbar").toggleClass("header-toggled");
//       });
//       // Horizontal menu navigation in mobile menu on click
//       var navItemClicked = $('.horizontal-menu .page-navigation >.nav-item');
//       navItemClicked.on("click", function(event) {
//         if(window.matchMedia('(max-width: 991px)').matches) {
//           if(!($(this).hasClass('show-submenu'))) {
//             navItemClicked.removeClass('show-submenu');
//           }
//           $(this).toggleClass('show-submenu');
//         }
//       })

//       $(window).scroll(function() {
//         if(window.matchMedia('(min-width: 992px)').matches) {
//           var header = $('.horizontal-menu');
//           if ($(window).scrollTop() >= 70) {
//             $(header).addClass('fixed-on-scroll');
//           } else {
//             $(header).removeClass('fixed-on-scroll');
//           }
//         }
//       });
//     });

//     // focus input when clicking on search icon
//     $('#navbar-search-icon').click(function() {
//       $("#navbar-search-input").focus();
//     });

//   })(jQuery);
