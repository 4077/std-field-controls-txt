// head {
var __nodeId__ = "std_fieldControls_txt__eventsDispatcher";
var __nodeNs__ = "std_fieldControls_txt";
// }

(function (__nodeNs__, __nodeId__) {
    $.widget(__nodeNs__ + "." + __nodeId__, $.ewma.node, {
        options: {},

        __create: function () {
            var w = this;
            var o = w.options;
            var $w = w.element;

            w.bindEvents();
        },

        bindEvents: function () {
            var w = this;
            var o = w.options;
            var $w = w.element;

            w.e('std/cell/update', function (data) {
                var $control = $("." + o.nodeId + "[instance='" + data.cell + "']");

                if ($control.length) {
                    w.r('reload', {
                        cell: data.cell
                    });
                }
            })
        }
    });
})(__nodeNs__, __nodeId__);
