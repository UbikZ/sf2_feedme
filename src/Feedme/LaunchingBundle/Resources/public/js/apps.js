var handleHomeContentHeight = function() {
    $("#home").height($(window).height())
};

var handleHeaderNavigationState = function() {
    $(window).on("scroll load", function() {
        if ($("#header").attr("data-state-change") != "disabled") {
            var e = $(window).scrollTop();
            var t = $("#header").height();
            if (e >= t) {
                $("#header").addClass("navbar-small")
            } else {
                $("#header").removeClass("navbar-small")
            }
        }
    })
};

var handleAddCommasToNumber = function(e) {
    return e.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")
};

var handlePageContainerShow = function() {
    $("#page-container").addClass("in")
};

var handlePaceLoadingPlugins = function() {
    Pace.on("hide", function() {
        $(".pace").addClass("hide")
    })
};

var handlePageScrollContentAnimation = function() {
    $('[data-scrollview="true"]').each(function() {
        var e = $(this);
        var t = scrollMonitor.create(e, 60);
        t.enterViewport(function() {
            $(e).find("[data-animation=true]").each(function() {
                var e = $(this).attr("data-animation-type");
                var t = $(this);
                if (!$(t).hasClass("contentAnimated")) {
                    if (e == "number") {
                        var n = parseInt($(t).attr("data-final-number"));
                        $({animateNumber: 0}).animate({animateNumber: n}, {duration: 1e3,easing: "swing",step: function() {
                            var e = handleAddCommasToNumber(Math.ceil(this.animateNumber));
                            $(t).text(e).addClass("contentAnimated")
                        }})
                    } else {
                        $(this).addClass(e + " contentAnimated")
                    }
                }
            })
        })
    })
};

var handleHeaderScrollToAction = function() {
    $("[data-click=scroll-to-target]").on("click", function(e) {
        e.preventDefault();
        e.stopPropagation();
        var t = $(this).attr("href");
        var n = 50;
        $("html, body").animate({scrollTop: $(t).offset().top - n}, 500);
        if ($(this).attr("data-toggle") == "dropdown") {
            var r = $(this).closest("li.dropdown");
            if ($(r).hasClass("open")) {
                $(r).removeClass("open")
            } else {
                $(r).addClass("open")
            }
        }
    });
    $(document).click(function(e) {
        if (!e.isPropagationStopped()) {
            $(".dropdown.open").removeClass("open")
        }
    })
};

var handleTooltipActivation = function() {
    if ($("[data-toggle=tooltip]").length !== 0) {
        $("[data-toggle=tooltip]").tooltip("hide")
    }
};

var App = function() {
    "use strict";
    return {init: function() {
        handleHomeContentHeight();
        handleHeaderNavigationState();
        handlePageContainerShow();
        handlePaceLoadingPlugins();
        handlePageScrollContentAnimation();
        handleHeaderScrollToAction();
        handleTooltipActivation();
    }}
}();