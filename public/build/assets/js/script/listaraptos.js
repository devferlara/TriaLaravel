$("#zona").change(event => {

    $.get(`/aptos/${event.target.value}`, function(res, zona){

        $("#apartamento").empty();
	$("#apartamento").append('<option value=0>Por favor seleccione una opcion</option>');

        res.forEach(element => {

            $("#apartamento").append(`<option value=${element.id}> ${element.apartamento} </option>`);

        });

    });

});