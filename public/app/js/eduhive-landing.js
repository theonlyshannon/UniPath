(function ($) {
    "use strict";

    if ($(".dynamic-year").length) {
        let currentYear = new Date().getFullYear();
        $(".dynamic-year").html(currentYear);
    }

    if ($(".wow").length) {
        var wow = new WOW({
            boxClass: "wow", // animated element css class (default is wow)
            animateClass: "animated", // animation css class (default is animated)
            mobile: true, // trigger animations on mobile devices (default is true)
            live: true, // act on asynchronously loaded content (default is true)
        });
        wow.init();
    }

})(jQuery);