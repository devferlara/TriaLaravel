$(document).ready(function() {

    $("select").multipleSelect({
            width: '100%',
            filter: true,
        });
   $('select').multipleSelect('refresh');

    $("#attach").hide();
    $("#adjuntar").click(function() {
    if($(this).is(":checked")) {
        $("#attach").show();
    } else {
        $("#attach").hide();
    }
    });

    function sendFile(file, editor, welEditable) 
    {
        data = new FormData();
        data.append("file", file);
        $.ajax({
        data: data,
        type: 'POST',
        xhr: function() {
            var myXhr = $.ajaxSettings.xhr();
            if (myXhr.upload) myXhr.upload.addEventListener('progress',progressHandlingFunction, false);
            return myXhr;
        },
        url: '../mensajes/loadImage',
        cache: false,
        contentType: false,
        processData: false,
        success: function(url) {
            console.log(url);
            editor.insertImage(welEditable, url);
        }
        });
    }

// update progress bar
    function progressHandlingFunction(e){
        if(e.lengthComputable){
            $('progress').attr({value:e.loaded, max:e.total});
            // reset progress on complete
        if (e.loaded == e.total) {
            $('progress').attr('value','0.0');
            }
        }
    }

});
