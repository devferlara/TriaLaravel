$(document).ready(function() {
    // Initializes search overlay plugin.
    // Replace onSearchSubmit() and onKeyEnter() with
    // your logic to perform a search and display results

    function initialize() {
        var latitud = $("#map_latitud").val();
        var longitud= $("#map_longitud").val();

        var myLatlng = new google.maps.LatLng(latitud,longitud);
        var mapOptions = {
            zoom: 16,
            center: myLatlng
        }
        var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

        var panorama = new google.maps.StreetViewPanorama(document.getElementById('pano'), {
        position: myLatlng,
        pov: {
          heading: 34,
          pitch: 10
        }
        });
        map.setStreetView(panorama);
    }

    setTimeout(function(){
        initialize();
    }, 1000);
});

