/* ============================================================
 * Gallery
 * Showcase your portfolio or even use it for an online store!
 * For DEMO purposes only. Extract what you need.
 * ============================================================ */

$(function() {

    /* GRID
     -------------------------------------------------------------*/

    /*
     Wait for the images to be loaded before applying
     Isotope plugin.
     */
    var $gallery = $('.gallery');
    $gallery.imagesLoaded(function() {
        applyIsotope();
    });

    /*  Apply Isotope plugin
     isotope.metafizzy.co
     */
    var applyIsotope = function() {
        $gallery.isotope({
            itemSelector: '.gallery-item',
            masonry: {
                columnWidth: 280,
                gutter: 10,
                isFitWidth: true
            }
        });
    }

    /*
     Show a sliding item using MetroJS
     http://www.drewgreenwell.com/projects/metrojs
     */
    $(".live-tile,.flip-list").liveTile();


    /* DETAIL VIEW
     -------------------------------------------------------------*/

    /*
     Toggle detail view using DialogFx
     http://tympanus.net/Development/DialogEffects/
     */
    $('body').on('click', '.gallery-item', function() {
        var id =$(this).attr('value');

        $.get( '../usuario/publicidad/'+id,
            function(data) {

                $('#descripcion_p').html(data[0].descripcion)
                $('#title_p').html(data[0].titulo)
                $('#valor_p').html(data[0].valor)
                $('#tienda_p').html(data[0].tienda)
                $('#local_p').html(data[0].local)



                if(data[0].logo == ""){
                    $("#logo_t").attr("src",window.location.protocol + "//" + window.location.host + "/home/images/publicidad_none.jpg");

                }else{
                    $("#logo_t").attr("src",window.location.protocol + "//" + window.location.host + "/uploads/publicidad/"+data[0].logo);

                }

                if(data[0].img_publicidad == ""){
                    $("#data-img").attr("src",window.location.protocol + "//" + window.location.host + "/home/images/publicidad.jpg");
                    $("#data-img").attr("data-image",window.location.protocol + "//" + window.location.host + "/home/images/publicidad.jpg");
                }else{
                    $("#data-img").attr("src",window.location.protocol + "//" + window.location.host + "/uploads/publicidad/"+data[0].img_publicidad);
                    $("#data-img").attr("data-image",window.location.protocol + "//" + window.location.host + "/uploads/publicidad/"+data[0].img_publicidad);
                }



            })
            .done(function() {


            })
            .fail(function() {
                console.log('error')
            })
            .always(function() {

            });


        var dlg = new DialogFx($('#itemDetails').get(0));
        dlg.toggle();
    });

    /*
     Look for data-image attribute and apply those
     images as CSS background-image
     */
    $('.item-slideshow > div').each(function() {
        var img = $(this).data('image');
        $(this).css({
            'background-image': 'url(' + img + ')',
            'background-size': 'cover'
        })
    });

    /*
     Touch enabled slideshow for gallery item images using owlCarousel
     www.owlcarousel.owlgraphic.com
     */
    $(".item-slideshow").owlCarousel({
        items: 1,
        nav: true,
        navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
        dots: true
    });


    /* FILTERS OVERLAY
     -------------------------------------------------------------*/

    $('[data-toggle="filters"]').click(function() {
        $('#filters').toggleClass('open');
    });




});