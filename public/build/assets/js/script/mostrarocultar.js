

$(document).ready(function () {
    toggleFields();
    $("#rol").change(function () {
        toggleFields();
    });

});
//this toggles the visibility of our parent permission fields depending on the current selected value of the underAge field
function toggleFields() {
    if ($("#rol").val() == 'ResidenteUsuario')
    	$("#mostrarzonayapartamento").show();
    else
        $("#mostrarzonayapartamento").hide();
}