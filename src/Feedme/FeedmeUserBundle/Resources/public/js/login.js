var handleAfterPageLoadAddClass = function() {
    if ($("[data-pageload-addclass]").length !== 0) {
        $(window).load(function() {
            $("[data-pageload-addclass]").each(function() {
                var e = $(this).attr("data-pageload-addclass");
                $(this).addClass(e)
            })
        })
    }
};

var LoginV2 = function() {
    "use strict";
    return {init: function() {
        handleAfterPageLoadAddClass()
    }}
}();