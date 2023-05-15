    (function($) {
        'use strict';
        $(function () {
        //Secondary Sidebar Scroll
        var ps = new PerfectScrollbar('.timeline-container', {
            wheelPropagation: false,
            wheelSpeed: 0.5,
            swipeEasing: true,
            minScrollbarLength: 50,
            maxScrollbarLength: 250,
        });
    });
})(jQuery);