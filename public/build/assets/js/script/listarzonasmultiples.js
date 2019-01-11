$("#conjunto_m").change(event => {

    $.get(`/zonasconjunto/${event.target.value}`, function(res, conjunto){

        $("#zona_m").empty();
	 $("#zona_m").append('<option value=0>Por favor seleccione una opcion</option>');
        res.forEach(element => {

            $("#zona_m").append(`<option value=${element.id}> ${element.tipo} ${element.zona} </option>`);

        });

    });

});