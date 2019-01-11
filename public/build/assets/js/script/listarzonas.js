$("#conjunto").change(event => {

    $.get(`/zonasconjunto/${event.target.value}`, function(res, conjunto){


        $("#zona").empty();
	 $("#zona").append('<option value=0>Por favor seleccione una opcion</option>');
        res.forEach(element => {

            $("#zona").append(`<option value=${element.id}> ${element.tipo} ${element.zona} </option>`);

        });

    });

});