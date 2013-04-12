$(document).ready(function () {
    var theme = getDemoTheme();
    $("#jqxWidget").jqxCalendar({ width: 220, height: 220, theme: theme, selectionMode: 'range' });
    $("#jqxWidget").on('change', function (event) {
        var selection = event.args.range;
        $("#selection").html("<div>From: " + selection.from.toLocaleDateString() + " <br/>To: " + selection.to.toLocaleDateString() + "</div>");
    });

    var date1 = new Date();
    date1.setFullYear(2012, 7, 7);
    var date2 = new Date();
    date2.setFullYear(2012, 7, 15);
    $("#jqxWidget").jqxCalendar('setRange', date1, date2);
});
