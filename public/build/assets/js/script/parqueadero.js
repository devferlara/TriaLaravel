$(document).ready(function () {
    toggleFields();
    $("#parqueadero").change(function () {
        toggleFields();
    });

});
//this toggles the visibility of our parent permission fields depending on the current selected value of the underAge field
function toggleFields() {
    if ($("#parqueadero").val() == '1')
    	$("#mostrardatosparqueadero").show();
    else
        $("#mostrardatosparqueadero").hide();
}