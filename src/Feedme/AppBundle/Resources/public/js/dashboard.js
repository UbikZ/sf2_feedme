var handleDashboardDatepicker = function() {
    "use strict";
    $("#datepicker-inline").datepicker({todayHighlight: true})
};

var Dashboard = function() {
    "use strict";
    return {init: function() {
        handleDashboardDatepicker()
    }}
}();