(function($) {
    'use strict';
    $(function () {
        //Scrollbar for Email app
        var ps = new PerfectScrollbar('.email-list-scroll-container', {
            wheelPropagation: false,
            wheelSpeed: 0.5,
            swipeEasing: true,
            minScrollbarLength: 50,
            maxScrollbarLength: 250,
        });

        //Scrollbar for Email Body app
        var ps = new PerfectScrollbar('.email-body-wrapper', {
            wheelPropagation: false,
            wheelSpeed: 0.5,
            swipeEasing: true,
            minScrollbarLength: 50,
            maxScrollbarLength: 250,
        });
    });
})(jQuery);