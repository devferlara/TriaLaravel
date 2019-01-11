(function($) {

    $('#mark-email').click(function() {
        $('.item .checkbox').toggle();
    });
    
    listarmensajes();
    // lista de mensajes en inbox
    function listarmensajes(){
        $('.email-list').length && $.ajax({
        async:true,
        dataType: "json",
        url: "listarmensajes",
        success: function(data) {

            $.each(data.emails, function(i) {

                var obj = data.emails[i];

                var listViewGroupCont = $('<div/>', {
                    "class": "list-view-group-container"
                });
                listViewGroupCont.append('<div class="list-view-group-header"><span>' + obj.importancia + '</span></div>');
                var ul = $('<ul/>', {
                    "class": "no-padding"
                });
                    var mensajeid = obj.id;
                    var subject = obj.asunto;
                    var read= obj.leido;
                    var ansread = obj.resleido;
                    var time = obj.fecha;
                    var remitentea = obj.nombres;
                    var remitenteb = obj.apellidos;
                    var apartamento = obj.apartamento;
                    var zona = obj.zona;
                    var colors = ['b-success', 'b-primary', 'b-warning', 'b-info', 'b-complete', 'b-danger'];
                    var color = colors[Math.floor(Math.random() * (6))];
                    if (read == '0' || ansread == '0') {
                    var li ='<li class="item padding-15" data-email-id="' + mensajeid + '" data-mensaje-id="'+obj.id_mensaje_usuario+'"> \
                                <div class="thumbnail-wrapper d32 circular bordered ' + color + '"> \
                                    <img width="40" height="40" alt="/build/assets/img/profiles/user.png" data-src-retina="/build/assets/img/profiles/user.png" data-src="/build/assets/img/profiles/user.png" src="/build/assets/img/profiles/user.png"> \
                                </div> \
                               \
                                <div class="inline m-l-15"> \
                                    <p class="recipients no-margin hint-text small bold">Asunto:</p> \
                                    <p class="subject no-margin bold" style="font-size:16px;">' + subject + '</p> \
                                    <p class="recipients no-margin hint-text small bold">Remitente:</p> \
                                    <p class="subject no-margin bold" style="font-size:13px;">' + remitentea + ' ' + remitenteb + '</p>';
                    if(zona != undefined)
                    {
                        li+=        '<p class="subject no-margin bold" style="font-size:13px;">Unidad: ' + zona + ' Apartamento: ' + apartamento + '</p>';
                    }   

                    li+=        '</div> \
                                <div class="datetime" style="font-size:13px;">' + time + '</div> \
                                <div class="clearfix"></div> \
                            </li>'}
                            else{
                    var li ='<li class="item padding-15" data-email-id="' + mensajeid + '" data-mensaje-id="'+obj.id_mensaje_usuario+'"> \
                                <div class="thumbnail-wrapper d48 circular bordered ' + color + '"> \
                                    <img width="40" height="40" alt="/build/assets/img/profiles/user.png" data-src-retina="/build/assets/img/profiles/user.png" data-src="/build/assets/img/profiles/user.png" src="/build/assets/img/profiles/user.png"> \
                                </div> \
                               \
                                <div class="inline m-l-15"> \
                                    <p class="recipients no-margin hint-text small">Asunto:</p> \
                                    <p class="subject no-margin" style="font-size:14px;">' + subject + '</p> \
                                    <p class="recipients no-margin hint-text small">Remitente:</p> \
                                    <p class="subject no-margin" style="font-size:13px;">' + remitentea + ' ' + remitenteb + '</p>';
                  
                    if(zona != undefined)
                    {
                        li+=        '<p class="subject no-margin" style="font-size:13px;">Unidad: ' + zona + ' Apartamento: ' + apartamento + '</p>';
                    }

                    li+=        '</div> \
                                <div class="datetime" style="font-size:11px;">' + time + '</div> \
                                <div class="clearfix"></div> \
                            </li>'
                            };
                    ul.append(li);

                listViewGroupCont.append(ul);
                $('#emailList').append(listViewGroupCont);
            });
            $("#emailList").ioslist();
        }
    });
    };

    // lista de enviados en inbox
        function listarenviados(){
        $('.email-list').length && $.ajax({
        dataType: "json",
        url: "listarenviados",
        success: function(data) {

            $.each(data.emails, function(i) {

                var obj = data.emails[i];

                var listViewGroupCont = $('<div/>', {
                    "class": "list-view-group-container"
                });
                listViewGroupCont.append('<div class="list-view-group-header"><span>' + obj.importancia + '</span></div>');
                var ul = $('<ul/>', {
                    "class": "no-padding"
                });
                    var mensajeid = obj.id;
                    var subject = obj.asunto;
                    var read= obj.leido;
                    var time = obj.fecha;
                    var tipozona = obj.tipo;
                    var enviadozona = obj.zona;
                    var enviadoapto = obj.apartamento;
                    var administrador = obj.nombres+' '+obj.apellidos;
                    var colors = ['b-success', 'b-primary', 'b-warning', 'b-info', 'b-complete', 'b-danger'];
                    var color = colors[Math.floor(Math.random() * (6))];
                    if (read == '0') {
                    var li ='<li class="item padding-15" data-email-id="' + mensajeid + '" data-mensaje-id="'+obj.id_mensaje_usuario+'"> \
                                <div class="thumbnail-wrapper d32 circular bordered ' + color + '"> \
                                    <img width="40" height="40" alt="/build/assets/img/profiles/user.png" data-src-retina="/build/assets/img/profiles/user.png" data-src="/build/assets/img/profiles/user.png" src="/build/assets/img/profiles/user.png"> \
                                </div> \
                               \
                                <div class="inline m-l-15"> \
                                    <p class="recipients no-margin hint-text small bold">Asunto:</p> \
                                    <p class="subject no-margin bold" style="font-size:16px;">' + subject + '</p> \
                                    <p class="recipients no-margin hint-text small bold">Enviado a:</p>';
                    if(administrador != 'undefined undefined')
                    {
                        li +=        '<p class="subject no-margin bold" style="font-size:14px;">Administrador: '+administrador+'</p>';
                    }
                    else
                    {
                        li +=       '<p class="subject no-margin bold" style="font-size:14px;">'+ tipozona +': '+ enviadozona +' Apartamento:'+ enviadoapto +'</p>';
                    }
                    li +=             '</div> \
                                <div class="datetime" style="font-size:13px;">' + time + '</div> \
                                <div class="clearfix"></div> \
                            </li>'}
                            else{
                    var li ='<li class="item padding-15" data-email-id="' + mensajeid + '" data-mensaje-id="'+obj.id_mensaje_usuario+'"> \
                                <div class="thumbnail-wrapper d48 circular bordered ' + color + '"> \
                                    <img width="40" height="40" alt="/build/assets/img/profiles/user.png" data-src-retina="/build/assets/img/profiles/user.png" data-src="/build/assets/img/profiles/user.png" src="/build/assets/img/profiles/user.png"> \
                                </div> \
                               \
                                <div class="inline m-l-15"> \
                                    <p class="recipients no-margin hint-text small">Asunto:</p> \
                                    <p class="subject no-margin" style="font-size:14px;">' + subject + '</p> \
                                    <p class="recipients no-margin hint-text small">Enviado a:</p>';
                    if(administrador != 'undefined undefined')
                    {
                        li +=        '<p class="subject no-margin bold" style="font-size:14px;">Administrador: '+administrador+'</p>';
                    }
                    else
                    {
                        li +=       '<p class="subject no-margin" style="font-size:14px;">'+ tipozona +': '+ enviadozona +' Apartamento:'+ enviadoapto +'</p>';
                    }
                                    
                    li+=             '<p class="subject no-margin" style="font-size:11px;"><i class="fa fa-eye" aria-hidden="true"></i> Este Mensaje fue leido por el usuario</p> \
                                </div> \
                                <div class="datetime" style="font-size:11px;">' + time + '</div> \
                                <div class="clearfix"></div> \
                            </li>'
                            };
                    ul.append(li);

                listViewGroupCont.append(ul);
                $('#emailList1').append(listViewGroupCont);
            });
            $("#emailList1").ioslist();
        }
    });
    }

     listarenviados();
    // lista de filtrados por importantes en inbox
        $('.email-list').length && $.ajax({
        dataType: "json",
        url: "listarimportantes",
        success: function(data) {

            $.each(data.emails, function(i) {

                var obj = data.emails[i];

                var listViewGroupCont = $('<div/>', {
                    "class": "list-view-group-container"
                });
                listViewGroupCont.append('<div class="list-view-group-header"><span>' + obj.importancia + '</span></div>');
                var ul = $('<ul/>', {
                    "class": "no-padding"
                });
                    var mensajeid = obj.id;
                    var subject = obj.asunto;
                    var read= obj.leido;
                    var ansread = obj.resleido;
                    var time = obj.fecha;
                    var remitente = obj.nombres +' '+obj.apellidos;
                    var apartamento = obj.apartamento;
                    var zona = obj.zona;


                    var colors = ['b-success', 'b-primary', 'b-warning', 'b-info', 'b-complete', 'b-danger'];
                    var color = colors[Math.floor(Math.random() * (6))];
                    if (read == '0' || ansread == '0') {
                    var li ='<li class="item padding-15" data-email-id="' + mensajeid + '" data-mensaje-id="'+obj.id_mensaje_usuario+'"> \
                                <div class="thumbnail-wrapper d32 circular bordered ' + color + '"> \
                                    <img width="40" height="40" alt="/build/assets/img/profiles/user.png" data-src-retina="/build/assets/img/profiles/user.png" data-src="/build/assets/img/profiles/user.png" src="/build/assets/img/profiles/user.png"> \
                                </div> \
                               \
                                <div class="inline m-l-15"> \
                                    <p class="recipients no-margin hint-text small bold">Asunto:</p> \
                                    <p class="subject no-margin bold" style="font-size:16px;">' + subject + '</p> \
                                    <p class="recipients no-margin hint-text small bold">Remitente:</p> \
                                    <p class="subject no-margin bold" style="font-size:16px;">' + remitente + '</p>';
                    if(zona != undefined)
                    {
                        li+=        '<p class="subject no-margin bold" style="font-size:13px;">Unidad: ' + zona + ' Apartamento: ' + apartamento + '</p>';
                    }    

                    li+=        '</div> \
                                <div class="datetime" style="font-size:13px;">' + time + '</div> \
                                <div class="clearfix"></div> \
                            </li>'}
                            else{
                    var li ='<li class="item padding-15" data-email-id="' + mensajeid + '" data-mensaje-id="'+obj.id_mensaje_usuario+'"> \
                                <div class="thumbnail-wrapper d48 circular bordered ' + color + '"> \
                                    <img width="40" height="40" alt="/build/assets/img/profiles/user.png" data-src-retina="/build/assets/img/profiles/user.png" data-src="/build/assets/img/profiles/user.png" src="/build/assets/img/profiles/user.png"> \
                                </div> \
                               \
                                <div class="inline m-l-15"> \
                                    <p class="recipients no-margin hint-text small">Asunto:</p> \
                                    <p class="subject no-margin" style="font-size:14px;">' + subject + '</p> \
                                    <p class="recipients no-margin hint-text small">Remitente:</p> \
                                    <p class="subject no-margin" style="font-size:14px;">' + remitente + ' </p>';
                    if(zona != undefined)
                    {
                        li+=        '<p class="subject no-margin bold" style="font-size:13px;">Unidad: ' + zona + ' Apartamento: ' + apartamento + '</p>';
                    }    
                            
                    li+=        '</div> \
                                <div class="datetime" style="font-size:11px;">' + time + '</div> \
                                <div class="clearfix"></div> \
                            </li>'
                            };       
                    ul.append(li);

                listViewGroupCont.append(ul);
                $('#emailList2').append(listViewGroupCont);
            });
            $("#emailList2").ioslist();
        }
    });

    // lista de filtro relevantes en inbox
        $('.email-list').length && $.ajax({
        async:true,
        dataType: "json",
        url: "listarelevantes",
        success: function(data) {

            $.each(data.emails, function(i) {

                var obj = data.emails[i];

                var listViewGroupCont = $('<div/>', {
                    "class": "list-view-group-container"
                });
                listViewGroupCont.append('<div class="list-view-group-header"><span>' + obj.importancia + '</span></div>');
                var ul = $('<ul/>', {
                    "class": "no-padding"
                });
                    var mensajeid = obj.id;
                    var subject = obj.asunto;
                    var read= obj.leido;
                    var ansread = obj.resleido;
                    var time = obj.fecha;
                    var remitentenombre = obj.nombres;
                    var remitenteapellido = obj.apellidos;
                    var apartamento = obj.apartamento;
                    var zona = obj.zona;
                    var colors = ['b-success', 'b-primary', 'b-warning', 'b-info', 'b-complete', 'b-danger'];
                    var color = colors[Math.floor(Math.random() * (6))];
                    if (read == '0' || ansread == '0') {
                    var li ='<li class="item padding-15" data-email-id="' + mensajeid + '" data-mensaje-id="'+obj.id_mensaje_usuario+'"> \
                                <div class="thumbnail-wrapper d32 circular bordered ' + color + '"> \
                                    <img width="40" height="40" alt="/build/assets/img/profiles/user.png" data-src-retina="/build/assets/img/profiles/user.png" data-src="/build/assets/img/profiles/user.png" src="/build/assets/img/profiles/user.png"> \
                                </div> \
                               \
                                <div class="inline m-l-15"> \
                                    <p class="recipients no-margin hint-text small bold">Asunto:</p> \
                                    <p class="subject no-margin bold" style="font-size:16px;">' + subject + '</p> \
                                    <p class="recipients no-margin hint-text small bold">Remitente:</p> \
                                    <p class="subject no-margin bold" style="font-size:16px;">' + remitentenombre + ' ' + remitenteapellido + '</p>';
                    if(zona != undefined)
                    {
                        li+=        '<p class="subject no-margin bold" style="font-size:13px;">Unidad: ' + zona + ' Apartamento: ' + apartamento + '</p>';
                    }    

                    li+=        '</div> \
                                <div class="datetime" style="font-size:13px;">' + time + '</div> \
                                <div class="clearfix"></div> \
                            </li>'}
                            else{
                    var li ='<li class="item padding-15" data-email-id="' + mensajeid + '" data-mensaje-id="'+obj.id_mensaje_usuario+'"> \
                                <div class="thumbnail-wrapper d48 circular bordered ' + color + '"> \
                                    <img width="40" height="40" alt="/build/assets/img/profiles/user.png" data-src-retina="/build/assets/img/profiles/user.png" data-src="/build/assets/img/profiles/user.png" src="/build/assets/img/profiles/user.png"> \
                                </div> \
                               \
                                <div class="inline m-l-15"> \
                                    <p class="recipients no-margin hint-text small">Asunto:</p> \
                                    <p class="subject no-margin" style="font-size:14px;">' + subject + '</p> \
                                    <p class="recipients no-margin hint-text small">Remitente:</p> \
                                    <p class="subject no-margin" style="font-size:14px;">' + remitentenombre + ' ' + remitenteapellido + '</p>';
                    if(zona != undefined)
                    {
                        li+=        '<p class="subject no-margin bold" style="font-size:13px;">Unidad: ' + zona + ' Apartamento: ' + apartamento + '</p>';
                    }    

                    li+=        '</div> \
                                <div class="datetime" style="font-size:11px;">' + time + '</div> \
                                <div class="clearfix"></div> \
                            </li>'
                            };
                    ul.append(li);

                listViewGroupCont.append(ul);
                $('#emailList3').append(listViewGroupCont);
            });
            $("#emailList3").ioslist();
        }
    });
    
    // lista de enviados en inbox
        $('.email-list').length && $.ajax({
        dataType: "json",
        url: "listarnormales",
        success: function(data) {

            $.each(data.emails, function(i) {

                var obj = data.emails[i];

                var listViewGroupCont = $('<div/>', {
                    "class": "list-view-group-container"
                });
                listViewGroupCont.append('<div class="list-view-group-header"><span>' + obj.importancia + '</span></div>');
                var ul = $('<ul/>', {
                    "class": "no-padding"
                });
                    var mensajeid = obj.id;
                    var subject = obj.asunto;
                    var read= obj.leido;
                    var ansread = obj.resleido;
                    var time = obj.fecha;
                    var remitentea = obj.nombres;
                    var remitenteb = obj.apellidos;
                    var apartamento = obj.apartamento;
                    var zona = obj.zona;
                    var colors = ['b-success', 'b-primary', 'b-warning', 'b-info', 'b-complete', 'b-danger'];
                    var color = colors[Math.floor(Math.random() * (6))];
                    if (read == '0' || ansread =='0') {
                    var li ='<li class="item padding-15" data-email-id="' + mensajeid + '" data-mensaje-id="'+obj.id_mensaje_usuario+'"> \
                                <div class="thumbnail-wrapper d32 circular bordered ' + color + '"> \
                                    <img width="40" height="40" alt="/build/assets/img/profiles/user.png" data-src-retina="/build/assets/img/profiles/user.png" data-src="/build/assets/img/profiles/user.png" src="/build/assets/img/profiles/user.png"> \
                                </div> \
                               \
                                <div class="inline m-l-15"> \
                                    <p class="recipients no-margin hint-text small bold">Asunto:</p> \
                                    <p class="subject no-margin bold" style="font-size:16px;">' + subject + '</p> \
                                    <p class="recipients no-margin hint-text small bold">Remitente:</p> \
                                    <p class="subject no-margin bold" style="font-size:16px;">' + remitentea + ' ' + remitenteb + '</p>';
                    if(zona != undefined)
                    {
                        li+=        '<p class="subject no-margin bold" style="font-size:13px;">Unidad: ' + zona + ' Apartamento: ' + apartamento + '</p>';
                    }    

                    li+=        '</div> \
                                <div class="datetime" style="font-size:13px;">' + time + '</div> \
                                <div class="clearfix"></div> \
                            </li>'}
                            else{
                    var li ='<li class="item padding-15" data-email-id="' + mensajeid + '" data-mensaje-id="'+obj.id_mensaje_usuario+'"> \
                                <div class="thumbnail-wrapper d48 circular bordered ' + color + '"> \
                                    <img width="40" height="40" alt="/build/assets/img/profiles/user.png" data-src-retina="/build/assets/img/profiles/user.png" data-src="/build/assets/img/profiles/user.png" src="/build/assets/img/profiles/user.png"> \
                                </div> \
                               \
                                <div class="inline m-l-15" data-read="'+read+'"> \
                                    <p class="recipients no-margin hint-text small">Asunto:</p> \
                                    <p class="subject no-margin" style="font-size:14px;">' + subject + '</p> \
                                    <p class="recipients no-margin hint-text small">Remitente:</p> \
                                    <p class="subject no-margin" style="font-size:14px;">' + remitentea + ' ' + remitenteb + '</p>';
                    if(zona != undefined)
                    {
                        li+=        '<p class="subject no-margin bold" style="font-size:13px;">Unidad: ' + zona + ' Apartamento: ' + apartamento + '</p>';
                    }    

                    li+=        '</div> \
                                <div class="datetime" style="font-size:11px;">' + time + '</div> \
                                <div class="clearfix"></div> \
                            </li>'
                            };
                    ul.append(li);

                listViewGroupCont.append(ul);
                $('#emailList4').append(listViewGroupCont);
            });
            $("#emailList4").ioslist();
        }
    });

    $('body').on('click', '.item .checkbox', function(e) {
        e.stopPropagation();
    });

    $('body').on('click', '.item', function(e) {
        e.stopPropagation();
        var id_mensaje_usuario = $(this).attr('data-mensaje-id');
        
        var mensajeid = $(this).attr('data-email-id');
       
        var email = null;
        var thumbnailWrapper = $(this).find('.thumbnail-wrapper');

        $.ajax({
            dataType: "json",
            url: "vermensajes/"+mensajeid,
            success: function(data) {

                $.each(data.email, function(i) {
                var obj = data.email[i];

                var id = obj.id;
                var emailOpened = $('.email-opened').val(obj.mensaje_id);
                emailOpened.find('.sender .name').text(obj.nombres + obj.apellidos);
                emailOpened.find('.sender .datetime').text(obj.fecha);
                emailOpened.find('.subject').text(obj.asunto);
                emailOpened.find('.email-content-body').html(obj.mensaje);

                var thumbnailClasses = thumbnailWrapper.attr('class').replace('d32', 'd48');
                emailOpened.find('.thumbnail-wrapper').html(thumbnailWrapper.html()).attr('class', thumbnailClasses);

                $('.no-email').hide();
                $('.actions-dropdown').toggle();
                $('.actions, .email-content-wrapper').show();
                if ($.Pages.isVisibleSm() || $.Pages.isVisibleXs()) {
                    $('.email-list').toggleClass('slideLeft');
                }

                $(".email-content-wrapper").scrollTop(0);

                // Initialize email action menu
                $('.menuclipper').menuclipper({
                    bufferWidth: 20
                });
        if(obj.adjunto == "0"){
            $(".email-attachment").fadeOut();
        }else{$(".email-attachment").fadeIn();
            listarAdjuntos(mensajeid);
        }

        $("#btnresponder").on('click', function(){
            $("#editrespuesta").fadeIn();
        });

        if(obj.respuesta == "1"){
            $("#respuesta").fadeIn();
            $("#respuesta-content").fadeIn();
            listarRespuestas(mensajeid,id_mensaje_usuario);
        }else if(obj.respuesta == "0") {
            $(".content-respuesta-data" ).empty();
            $("#respuesta").fadeOut();
            $("#respuesta-content").fadeOut();
        }

        $("#idmensajeusuario").val(id_mensaje_usuario);
        $("#idmensaje").val(mensajeid);
        $("#borrarmsg").val(id);
         
    });
    actualizarLeidos(mensajeid);
       } 

      
    });
    $.ajax({
            dataType: "json",
            url: "verenviados/"+mensajeid,
            success: function(data) {

                $.each(data.email, function(i) {
                var obj = data.email[i];

                var id = obj.id;
                var emailOpened = $('.email-opened').val(obj.mensaje_id);
                emailOpened.find('.sender .name').text(obj.remitente);
                emailOpened.find('.sender .datetime').text(obj.fecha);
                emailOpened.find('.subject').text(obj.asunto);
                emailOpened.find('.email-content-body').html(obj.mensaje);

                var thumbnailClasses = thumbnailWrapper.attr('class').replace('d32', 'd48');
                emailOpened.find('.thumbnail-wrapper').html(thumbnailWrapper.html()).attr('class', thumbnailClasses);

                $('.no-email').hide();
                $('.actions-dropdown').toggle();
                $('.actions, .email-content-wrapper').show();
                if ($.Pages.isVisibleSm() || $.Pages.isVisibleXs()) {
                    $('.email-list').toggleClass('slideLeft');
                }

                $(".email-content-wrapper").scrollTop(0);

                // Initialize email action menu
                $('.menuclipper').menuclipper({
                    bufferWidth: 20
                });

        if(obj.adjunto == "0"){
            $(".email-attachment").fadeOut();
        }else{$(".email-attachment").fadeIn();
            listarAdjuntos(mensajeid);
        }

        $("#btnresponder").on('click', function(){
            $("#editrespuesta").fadeIn();
        });

        if(obj.respuesta == "1"){
            $("#respuesta").fadeIn();
            $("#respuesta-content").fadeIn();
            listarRespuestas(mensajeid,id_mensaje_usuario);
        }else if(obj.respuesta == "0") {
            $(".content-respuesta-data" ).empty();
            $("#respuesta").fadeOut();
            $("#respuesta-content").fadeOut();
        }
        $("#idmensajeusuario").val(id_mensaje_usuario);
        $("#idmensaje").val(mensajeid);
        $("#borrarenviado").val(id);
    });
       } 
    });

    $('.item').removeClass('active');
        $(this).addClass('active');
        $("#editrespuesta").fadeOut();
    });

    // Toggle email sidebar on mobile view
    $('.toggle-email-sidebar').click(function(e) {
        e.stopPropagation();
        $('.email-sidebar').toggle();
    });

    $('.email-list-toggle').click(function() {
        $('.email-list').toggleClass('slideLeft');
    });

    $('.email-sidebar').click(function(e) {
        e.stopPropagation();
    })

    $(window).resize(function() {

        if ($(window).width() <= 1024) {
            $('.email-sidebar').hide();

        } else {
            $('.email-list').length && $('.email-list').removeClass('slideLeft');
            $('.email-sidebar').show();
        }
    });

    function listarAdjuntos(mensajeid){
        $.ajax({
            cache: false,
            type:'GET',
            dataType: "json",
            url: "mensajes/adjunto/"+mensajeid,
            success: function(data) {
                $.each(data, function(idx, obj) {
                    var link = '/uploads/data/'+obj.nombre+'.'+obj.tipo;
                    var listarchivos = $('#archivos');
                    var li ='<li><a href="'+link+'" target="_blank">Ver Archivo Adjunto</a></li>';
                    listarchivos.html(li);
                });
            }
        });
    }

    function listarRespuestas(mensajeid,id_mensaje_usuario){
        $.ajax({
            dataType: "json",
            url: "mensajes/respuestas/"+mensajeid+"/"+id_mensaje_usuario,
            success: function(data) {
                $(".content-respuesta-data" ).empty();
                $(".content-respuesta-data").fadeIn();
                $.each(data, function(idx, obj) {
                    $(".content-respuesta-data").append("<div>Enviado por:<div class='answer-msj'><div class='date-response'>"+obj.nombres+" "+obj.apellidos+"</div>"+obj.created_at+"</div>"+obj.mensaje+"</div>");
                });
            }
        });
    }

    function actualizarLeidos(mensajeid){
    var token= $("#token").val();

        $.ajax({
        url: 'mensajes/marcarleidos/'+mensajeid,
        headers: {'X-CSRF-TOKEN':token},
        dataType: 'json',
        type: 'POST',
        success: function(data) {
        }
        });
    }

    // mostrar badges
    (function($) {
    $(document).ready(function() {
      $.ajaxSetup({cache: false});
       setTimeout(function () {
           $.getJSON('mostrarbadges', function (data) {
                var obj = data;
                $("#badges").append("<span>"+obj+"</span>");
           });
        },2000);
        });
    })(jQuery);

function limpiaritems(){
    document.getElementById("archivos").innerHTML="";
}

})(window.jQuery);

