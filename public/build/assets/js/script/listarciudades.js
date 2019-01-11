$("#pais").change(event => {

    $.get(`/ciudades/${event.target.value}`, function(res, pais){

    $("#ciudad").empty();
	$("#ciudad").append('<option value="">Por favor seleccione una ciudad</option>');

        res.forEach(element => {

            $("#ciudad").append(`<option value=${element.Ciudad}> ${element.Ciudad} </option>`);

        });

    });

});