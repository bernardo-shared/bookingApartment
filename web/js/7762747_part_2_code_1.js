
$(document).ready(function () {
    $('.dropdown-toggle').dropdown();
    $('.dropdown input, .dropdown label').click(function(e) {
        e.stopPropagation();
    });

    $('#signup').onclick(function(){
        $("#signup").modal('toogle');
    });

});
