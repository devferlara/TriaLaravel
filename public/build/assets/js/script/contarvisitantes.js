function getresultado()
    {
        var url = '/visitantes';

        var ids = $('select').multipleSelect('getSelects');

        $('#posibles_u').html('Calculando...');

        if(ids == '')
        {
            $('#posibles_u').html(0);
            return false;
        }
     
        $.ajax({

            url:url,

            type:'POST',

            dataType:'json',

            data:{'ids':ids},

            cache:false,

            success: function(data){
                   
                   $('#posibles_u').html(data.res);
                
            }
        });
    }