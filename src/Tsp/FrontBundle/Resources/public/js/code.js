
$(document).ready(function () {
    $('.dropdown-toggle').dropdown();
    $('.dropdown input, .dropdown label').click(function(e) {
        e.stopPropagation();
    });

    $(".form_datetime").datetimepicker({
        format: "dd/mm/yyyy",
        autoclose: true,
        todayBtn: true,
        pickerPosition: "bottom-left",
        startDate: new Date(),
        minuteStep: 10,
        keyboardNavigation: true
    });
});


