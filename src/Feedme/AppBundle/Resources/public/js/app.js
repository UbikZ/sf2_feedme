var handleSlimScroll = function() {
    "use strict";
    $("[data-scrollbar=true]").each(function() {
        generateSlimScroll($(this))
    })
};

var handleToastrConf = function() {
    "use strict";
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
};

var generateSlimScroll = function(e) {
    var t = $(e).attr("data-height");
    t = !t ? $(e).height() : t;
    var n = {height: t,alwaysVisible: true};
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        n.wheelStep = 3;
        n.touchScrollStep = 100
    }
    $(e).slimScroll(n)
};

var handleSidebarMenu = function() {
    "use strict";
    $(".sidebar .nav > .has-sub > a").click(function() {
        var e = $(this).next(".sub-menu");
        var t = ".sidebar .nav > li.has-sub > .sub-menu";
        if ($(".page-sidebar-minified").length === 0) {
            $(t).not(e).slideUp(250, function() {
                $(this).closest("li").removeClass("expand")
            });
            $(e).slideToggle(250, function() {
                var e = $(this).closest("li");
                if ($(e).hasClass("expand")) {
                    $(e).removeClass("expand")
                } else {
                    $(e).addClass("expand")
                }
            })
        }
    });
    $(".sidebar .nav > .has-sub .sub-menu li.has-sub > a").click(function() {
        if ($(".page-sidebar-minified").length === 0) {
            var e = $(this).next(".sub-menu");
            $(e).slideToggle(250)
        }
    })
};

var handleMobileSidebarToggle = function() {
    var e = false;
    $(".sidebar").on("click touchstart", function(t) {
        if ($(t.target).closest(".sidebar").length !== 0) {
            e = true
        } else {
            e = false;
            t.stopPropagation()
        }
    });
    $(document).on("click touchstart", function(t) {
        if ($(t.target).closest(".sidebar").length === 0) {
            e = false
        }
        if (!t.isPropagationStopped() && e !== true) {
            if ($("#page-container").hasClass("page-sidebar-toggled")) {
                e = true;
                $("#page-container").removeClass("page-sidebar-toggled")
            }
            if ($(window).width() < 979) {
                if ($("#page-container").hasClass("page-with-two-sidebar")) {
                    e = true;
                    $("#page-container").removeClass("page-right-sidebar-toggled")
                }
            }
        }
    });
    $("[data-click=right-sidebar-toggled]").click(function(t) {
        t.stopPropagation();
        var n = "#page-container";
        var r = "page-right-sidebar-collapsed";
        r = $(window).width() < 979 ? "page-right-sidebar-toggled" : r;
        if ($(n).hasClass(r)) {
            $(n).removeClass(r)
        } else if (e !== true) {
            $(n).addClass(r)
        } else {
            e = false
        }
        if ($(window).width() < 480) {
            $("#page-container").removeClass("page-sidebar-toggled")
        }
    });
    $("[data-click=sidebar-toggled]").click(function(t) {
        t.stopPropagation();
        var n = "page-sidebar-toggled";
        var r = "#page-container";
        if ($(r).hasClass(n)) {
            $(r).removeClass(n)
        } else if (e !== true) {
            $(r).addClass(n)
        } else {
            e = false
        }
        if ($(window).width() < 480) {
            $("#page-container").removeClass("page-right-sidebar-toggled")
        }
    })
};

var handleSidebarMinify = function() {
    $("[data-click=sidebar-minify]").click(function(e) {
        e.preventDefault();
        var t = "page-sidebar-minified";
        var n = "#page-container";
        if ($(n).hasClass(t)) {
            $(n).removeClass(t);
            if ($(n).hasClass("page-sidebar-fixed")) {
                generateSlimScroll($('#sidebar [data-scrollbar="true"]'))
            }
        } else {
            $(n).addClass(t);
            if ($(n).hasClass("page-sidebar-fixed")) {
                $('#sidebar [data-scrollbar="true"]').slimScroll({destroy: true});
                $('#sidebar [data-scrollbar="true"]').removeAttr("style")
            }
            $("#sidebar [data-scrollbar=true]").trigger("mouseover")
        }
        $(window).trigger("resize")
    })
};

var handlePageContentView = function() {
    "use strict";
    $.when($("#page-loader").addClass("hide")).done(function() {
        $("#page-container").addClass("in")
    })
};

var handlePanelAction = function() {
    "use strict";
    $("[data-click=panel-remove]").hover(function() {
        $(this).tooltip({title: "Remove",placement: "bottom",trigger: "hover",container: "body"});
        $(this).tooltip("show")
    });
    $("[data-click=panel-remove]").click(function(e) {
        e.preventDefault();
        $(this).tooltip("destroy");
        $(this).closest(".panel").remove()
    });
    $("[data-click=panel-collapse]").hover(function() {
        $(this).tooltip({title: "Collapse / Expand",placement: "bottom",trigger: "hover",container: "body"});
        $(this).tooltip("show")
    });
    $("[data-click=panel-collapse]").click(function(e) {
        e.preventDefault();
        $(this).closest(".panel").find(".panel-body").slideToggle()
    });
    $("[data-click=panel-reload]").hover(function() {
        $(this).tooltip({title: "Reload",placement: "bottom",trigger: "hover",container: "body"});
        $(this).tooltip("show")
    });
    $("[data-click=panel-reload]").click(function(e) {
        e.preventDefault();
        var t = $(this).closest(".panel");
        if (!$(t).hasClass("panel-loading")) {
            var n = $(t).find(".panel-body");
            var r = '<div class="panel-loader"><span class="spinner-small"></span></div>';
            $(t).addClass("panel-loading");
            $(n).prepend(r);
            setTimeout(function() {
                $(t).removeClass("panel-loading");
                $(t).find(".panel-loader").remove()
            }, 2e3)
        }
    });
    $("[data-click=panel-expand]").hover(function() {
        $(this).tooltip({title: "Expand / Compress",placement: "bottom",trigger: "hover",container: "body"});
        $(this).tooltip("show")
    });
    $("[data-click=panel-expand]").click(function(e) {
        e.preventDefault();
        var t = $(this).closest(".panel");
        var n = $(t).find(".panel-body");
        var r = 40;
        if ($(n).length !== 0) {
            var i = $(t).offset().top;
            var s = $(n).offset().top;
            r = s - i
        }
        if ($("body").hasClass("panel-expand") && $(t).hasClass("panel-expand")) {
            $("body, .panel").removeClass("panel-expand");
            $(".panel").removeAttr("style");
            $(n).removeAttr("style")
        } else {
            $("body").addClass("panel-expand");
            $(this).closest(".panel").addClass("panel-expand");
            if ($(n).length !== 0 && r != 40) {
                var o = 40;
                $(t).find(" > *").each(function() {
                    var e = $(this).attr("class");
                    if (e != "panel-heading" && e != "panel-body") {
                        o += $(this).height() + 30
                    }
                });
                if (o != 40) {
                    $(n).css("top", o + "px")
                }
            }
        }
        $(window).trigger("resize")
    })
};

var handleDraggablePanel = function() {
    "use strict";
    var e = $(".panel").parent("[class*=col]");
    var t = ".panel-heading";
    var n = ".row > [class*=col]";
    $(e).sortable({handle: t,connectWith: n,stop: function(e, t) {
        t.item.find(".panel-title").append('<i class="fa fa-refresh fa-spin m-l-5" data-id="title-spinner"></i>');
        handleSavePanelPosition(t.item)
    }})
};

var handelTooltipPopoverActivation = function() {
    "use strict";
    $("[data-toggle=tooltip]").tooltip();
    $("[data-toggle=popover]").popover()
};

var handleScrollToTopButton = function() {
    "use strict";
    $(document).scroll(function() {
        var e = $(document).scrollTop();
        if (e >= 200) {
            $("[data-click=scroll-top]").addClass("in")
        } else {
            $("[data-click=scroll-top]").removeClass("in")
        }
    });
    $("[data-click=scroll-top]").click(function(e) {
        e.preventDefault();
        $("html, body").animate({scrollTop: $("body").offset().top}, 500)
    })
};

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

var handleSavePanelPosition = function(e) {
    "use strict";
    if ($(".ui-sortable").length !== 0) {
        var t = [];
        var n = 0;
        $.when($(".ui-sortable").each(function() {
            var e = $(this).find("[data-sortable-id]");
            if (e.length !== 0) {
                var r = [];
                $(e).each(function() {
                    var e = $(this).attr("data-sortable-id");
                    r.push({id: e})
                });
                t.push(r)
            } else {
                t.push([])
            }
            n++
        })).done(function() {
            var n = window.location.href;
            n = n.split("?");
            n = n[0];
            localStorage.setItem(n, JSON.stringify(t));
            $(e).find('[data-id="title-spinner"]').delay(500).fadeOut(500, function() {
                $(this).remove()
            })
        })
    }
};

var handleLocalStorage = function() {
    "use strict";
    if (typeof Storage !== "undefined") {
        var e = window.location.href;
        e = e.split("?");
        e = e[0];
        var t = localStorage.getItem(e);
        if (t) {
            t = JSON.parse(t);
            var n = 0;
            $(".panel").parent('[class*="col-"]').each(function() {
                var e = t[n];
                var r = $(this);
                $.each(e, function(e, t) {
                    var n = '[data-sortable-id="' + t.id + '"]';
                    if ($(n).length !== 0) {
                        var i = $(n).clone();
                        $(n).remove();
                        $(r).append(i)
                    }
                });
                n++
            })
        }
    } else {
        alert("Your browser is not supported with the local storage")
    }
};

var handleResetLocalStorage = function() {
    "use strict";
    $("[data-click=reset-local-storage]").live("click", function(e) {
        e.preventDefault();
        var t = "" + '<div class="modal fade" data-modal-id="reset-local-storage-confirmation">' + '    <div class="modal-dialog">' + '        <div class="modal-content">' + '            <div class="modal-header">' + '                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>' + '                <h4 class="modal-title"><i class="fa fa-refresh m-r-5"></i> Reset Local Storage Confirmation</h4>' + "            </div>" + '            <div class="modal-body">' + '                <div class="alert alert-info m-b-0">Would you like to RESET all your saved widgets and clear Local Storage?</div>' + "            </div>" + '            <div class="modal-footer">' + '                <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal"><i class="fa fa-close"></i> No</a>' + '                <a href="javascript:;" class="btn btn-sm btn-inverse" data-click="confirm-reset-local-storage"><i class="fa fa-check"></i> Yes</a>' + "            </div>" + "        </div>" + "    </div>" + "</div>";
        $("body").append(t);
        $('[data-modal-id="reset-local-storage-confirmation"]').modal("show")
    });
    $('[data-modal-id="reset-local-storage-confirmation"]').live("hidden.bs.modal", function() {
        $('[data-modal-id="reset-local-storage-confirmation"]').remove()
    });
    $("[data-click=confirm-reset-local-storage]").live("click", function(e) {
        e.preventDefault();
        var t = window.location.href;
        t = t.split("?");
        t = t[0];
        localStorage.removeItem(t);
        window.location.href = document.URL;
        location.reload()
    })
};

var default_content = '<div class="p-t-40 p-b-40 text-center f-s-20 content"><i class="fa fa-warning fa-lg text-muted m-r-5"></i> <span class="f-w-600 text-inverse">Error 404! Page not found.</span></div>';
var handleLoadPage = function(e) {
    if (e != "") {
        Pace.restart();
        var t = e.replace("#", ""),
            hash = window.location.hash;
        $(".jvectormap-label, .jvector-label, .AutoFill_border, #gritter-notice-wrapper, .ui-autocomplete, .colorpicker, .FixedHeader_Header, .FixedHeader_Cloned .lightboxOverlay, .lightbox").remove();
        $.ajax({type: "GET", url: t, dataType: "html", success: function(e) {
            $("#ajax-content").html(e);
            handleSubmitPage(hash);
            handleBreadcrumb(hash);
            $("html, body").animate({scrollTop: $("body").offset().top}, 250)
        }, error: function(e, t, n) {
            $("#ajax-content").html(default_content)
        }});
    }
};

var handleBreadcrumb = function(e) {
    "use strict";
    if (e != "") {
        var $enabled = $('.sidebar [href="' + e + '"][data-toggle=ajax]'),
            $breadcrumb = $("#breadcrumb"),
            $els = $enabled.parents('li');
        $breadcrumb.html('');
        $breadcrumb.append('<li><a href="#">' + $els.eq(0).text() + '</a>');
        $breadcrumb.append('<li class="active"><a href="#">' + $els.eq(1).find('a span').text() + '</a>');
    }
};

var handleSubmitPage = function(e) {
    handleUser();
    if (e != "") {
        var ajaxForms = "form[action^=#]";
        $.each($("#ajax-content " + ajaxForms), function(i, f) {
            $(f).submit(function(event) {
                var hash = window.location.hash;
                event.stopPropagation();
                event.stopImmediatePropagation();
                event.preventDefault();
                $.post($(f).attr('action').replace('#', ''), $(f).serialize(), function(e) {
                    var $toastr;
                    if ($(e).find(ajaxForms).length > 0) {
                        $("#ajax-content").html(e);
                        handleSubmitPage(hash);
                        $("html, body").animate({scrollTop: $("body").offset().top}, 250)
                        $toastr = $("[data-toastrid=error]");
                        toastr['error']($toastr.text());
                    } else {
                        handleLoadPage(hash);
                        $toastr = $("[data-toastrid=success]");
                        toastr['success']($toastr.text());
                    }
                }).fail(function() {
                    $("#ajax-content").html(default_content)
                });
            });
        });
    }

};

var globalHandlers = function() {
    "use strict";
    handleUser();
    handleMessages();
};

var handleUser = function() {
    $.get( "/me", function(data) {
        var user = JSON.parse(data);
        $("[data-ajaxload-user]").each(function() {
            var scope = $(this).data('ajaxload-user');
            switch (scope) {
                case 'fullname':
                    $(this).html(user.firstname + " " + user.lastname);
                    break;
                case 'bg-image':
                    $(this).attr('src', user.backgroundImageUrl);
                    break;
                default:
                    if (user[scope] !== 'undefined') {
                        $(this).html(user[scope]);
                    }
                    break;
            }
        });
        $("[data-ajaxload-gravatar]").each(function() {
            var size = $(this).data('ajaxload-gravatar');
            $(this).attr('src', user.gravatar[size]);
        });
    });
};

var handleMessages = function() {
    /*$.get( "/messages", function(data) {
        // to be implemented
    });*/
};

var handleCheckPageLoadUrl = function(e) {
    e = e ? e : "";
    if (e === "") {
        $("#ajax-content").html(default_content)
        globalHandlers();
    } else {
        $('.sidebar [href="' + e + '"][data-toggle=ajax]').trigger("click");
        handleLoadPage(e)
    }
};

var handleSidebarAjaxClick = function() {
    $(".sidebar [data-toggle=ajax]").click(function() {
        var e = $(this).closest("li");
        var t = $(this).parents();
        $(".sidebar li").not(e).not(t).removeClass("active");
        $(e).addClass("active");
        $(t).addClass("active")
    })
};

var handleHashChange = function() {
    $(window).hashchange(function() {
        handleLoadPage(window.location.hash)
    })
};

var handlePaceLoadingPlugins = function() {
    Pace.on("hide", function() {
        $(".pace").addClass("hide")
    })
};

var handleIEFullHeightContent = function() {
    var e = window.navigator.userAgent;
    var t = e.indexOf("MSIE ");
    if (t > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {
        $('.vertical-box-row [data-scrollbar="true"][data-height="100%"]').each(function() {
            var e = $(this).closest(".vertical-box-row");
            var t = $(e).height();
            $(e).find(".vertical-box-cell").height(t)
        })
    }
};

var handleUnlimitedTabsRender = function() {
    function e(e, t) {
        var n = parseInt($(e).css("margin-left"));
        var r = $(e).width();
        var i = $(e).find("li.active").width();
        var s = t > -1 ? t : 150;
        var o = 0;
        $(e).find("li.active").prevAll().each(function() {
            i += $(this).width()
        });
        $(e).find("li").each(function() {
            o += $(this).width()
        });
        if (i >= r) {
            var u = i - r;
            if (o != i) {
                u += 40
            }
            $(e).find(".nav.nav-tabs").animate({marginLeft: "-" + u + "px"}, s)
        }
        if (i != o && o >= r) {
            $(e).addClass("overflow-right")
        } else {
            $(e).removeClass("overflow-right")
        }
        if (i >= r && o >= r) {
            $(e).addClass("overflow-left")
        } else {
            $(e).removeClass("overflow-left")
        }
    }
    function t(e, t) {
        var n = $(e).closest(".tab-overflow");
        var r = parseInt($(n).find(".nav.nav-tabs").css("margin-left"));
        var i = $(n).width();
        var s = 0;
        var o = 0;
        $(n).find("li").each(function() {
            if (!$(this).hasClass("next-button") && !$(this).hasClass("prev-button")) {
                s += $(this).width()
            }
        });
        switch (t) {
            case "next":
                var u = s + r - i;
                if (u <= i) {
                    o = u - r;
                    setTimeout(function() {
                        $(n).removeClass("overflow-right")
                    }, 150)
                } else {
                    o = i - r - 80
                }
                if (o != 0) {
                    $(n).find(".nav.nav-tabs").animate({marginLeft: "-" + o + "px"}, 150, function() {
                        $(n).addClass("overflow-left")
                    })
                }
                break;
            case "prev":
                var u = -r;
                if (u <= i) {
                    $(n).removeClass("overflow-left");
                    o = 0
                } else {
                    o = u - i + 80
                }
                $(n).find(".nav.nav-tabs").animate({marginLeft: "-" + o + "px"}, 150, function() {
                    $(n).addClass("overflow-right")
                });
                break
        }
    }
    function n() {
        $(".tab-overflow").each(function() {
            var t = $(this).width();
            var n = 0;
            var r = $(this);
            var i = t;
            $(r).find("li").each(function() {
                var e = $(this);
                n += $(e).width();
                if ($(e).hasClass("active") && n > t) {
                    i -= n
                }
            });
            e(this, 0)
        })
    }
    $('[data-click="next-tab"]').live("click", function(e) {
        e.preventDefault();
        t(this, "next")
    });
    $('[data-click="prev-tab"]').live("click", function(e) {
        e.preventDefault();
        t(this, "prev")
    });
    $(window).resize(function() {
        $(".tab-overflow .nav.nav-tabs").removeAttr("style");
        n()
    });
    n()
};
var App = function() {
    "use strict";
    return {init: function() {
        handleDraggablePanel();
        handleLocalStorage();
        handleResetLocalStorage();
        handleSlimScroll();
        handlePanelAction();
        handelTooltipPopoverActivation();
        handlePageContentView();
        handleAfterPageLoadAddClass();
        handlePaceLoadingPlugins();
        handleScrollToTopButton();
        handleSidebarMenu();
        handleMobileSidebarToggle();
        handleSidebarMinify();
        handleSidebarAjaxClick();
        handleCheckPageLoadUrl(window.location.hash);
        handleHashChange();
        handleIEFullHeightContent();
        handleUnlimitedTabsRender();
        handleToastrConf();
        $.ajaxSetup({cache: true})
    },
        setPageTitle: function(e) {
        document.title = e
    },
        restartGlobalFunction: function() {
        handleDraggablePanel();
        handleLocalStorage();
        handleSlimScroll();
        handlePanelAction();
        handelTooltipPopoverActivation();
        handleAfterPageLoadAddClass();
        handleUnlimitedTabsRender()
    }}
}();