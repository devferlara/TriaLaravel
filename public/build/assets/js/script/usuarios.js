$(document).ready(function() {



    function initialize() {
        var latitud = $("#map_latitud").val();
        var longitud= $("#map_longitud").val();

        var myLatlng = new google.maps.LatLng(latitud,longitud);
        var mapOptions = {
            zoom: 16,
            center: myLatlng
        }
        var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            title: 'Conjunto Residencial'
        });
    }

    setTimeout(function(){
        initialize();
    }, 3000);


});

