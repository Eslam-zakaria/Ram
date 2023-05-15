(function($) {
    'use strict';
    $(function () {
        Popper.Defaults.modifiers.computeStyle.gpuAcceleration = false;
        feather.replace();

        window.onscroll = function() {stickyNav()};

        var navbar = $(".secondary-navbar");
        var sticky = navbar.offset().top;

        function stickyNav() {
            if ($(window).scrollTop() >= sticky && $("body").hasClass("sticky-top")) {
                navbar.addClass("sticky-nav")
            } else {
                navbar.removeClass("sticky-nav");
            }
        }

        //Sidebar Toggle
        $('[data-toggle="msb-overlay"]').on("click", function() {
            $('#navbar').toggleClass('active');
            if($('.sidebar-overlay').hasClass("active")){
                $('.sidebar-overlay').removeClass('active');
            }else{
                $('.sidebar-overlay').addClass('active');
            }
        });

        function addActiveClass(element) {
            if (element.attr('href').indexOf(current) !== -1) {
                element.parents('.nav-item').last().addClass('active');
                if (element.parents('.sub-menu').length) {
                    element.closest('.collapse').addClass('show');
                    element.addClass('active');
                }
                if (element.parents('.submenu-item').length) {
                    element.addClass('active');
                }
            }
        }

        var current = location.pathname.split("/").slice(-1)[0].replace(/^\/|\/$/g, '');
        $('.horizontal-navbar .nav li a').each(function() {
            var $this = $(this);
            addActiveClass($this);
        });

        //Scrollbar for Overlay Profile Toolbar
        var ps = new PerfectScrollbar('.profile-body', {
            wheelPropagation: false,
            wheelSpeed: 0.5,
            swipeEasing: true,
            minScrollbarLength: 50,
            maxScrollbarLength: 250,
        });

        //Scrollbar for Overlay TaskList
        var ps = new PerfectScrollbar('.task-list-container', {
            wheelPropagation: false,
            wheelSpeed: 0.5,
            swipeEasing: true,
            minScrollbarLength: 50,
            maxScrollbarLength: 250,
        });

        //Open Profile Toolbar Overlay
        $('#profileToolbar').on('click', function () {
            $('.profile-overlay').addClass('active');
            $('.sidebar-overlay').addClass('active');
        });

        $('#settingsConf').on('click', function () {
            $('.settings-overlay').addClass('active');
            $('.sidebar-overlay').addClass('active');
        });

        $('.setting-close, .profile-close, .sidebar-overlay').on('click', function () {
            $('.profile-overlay').removeClass('active');
            $('.settings-overlay').removeClass('active');
            $('.sidebar-overlay').removeClass('active');
            $('#navbar').removeClass('active');
        });

        //Enable or Disabled configurations on setting panel
        $('.config-icon').on('click', function(){
            if($(this).parent().hasClass("enable")){
                $(this).parent().removeClass("enable");
                $(this).parent().addClass("disable");
            }else{
                $(this).parent().removeClass("disable");
                $(this).parent().addClass("enable");
            }
        });

        //Enable all popovers
        $('[data-toggle="popover"]').popover();
        $('.popover-dismiss').popover({
            trigger: 'focus'
        })
    });
})(jQuery);