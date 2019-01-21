<?php

/********** Pagina Inicial *************/
Route::get('/getData/{token}', array('uses' => 'UsuarioController@apiData','as' => 'apiData'));

//*Ruta para controlador de vista Home */
Route::get('/', function () {
    return view('home.index');
})->name('home1');

//*Ruta para controlador de vista politicas del home */
Route::get('/politicas', function () {
    return view('home.politicas');
});

Route::get('/prueba', function () {
    return view('backend.administrador.prueba');
});

/* Redirecciona hacia la pagina de contacto*/
Route::post('/contact','HomeController@contact');
//* Redirecciona al correo de comunicando
Route::get('/correo', function()
{
    return Redirect::to('https://webmail.triagroup.co:2096/');
});
/* RUTAS SOCIOS NUEVO */

Route::get('/socio','LoginController@socio')->name('socio');
Route::get('/registroSocio','LoginController@registroSocio');
Route::post('/crearSocio','LoginController@storeSocio')->name('socioStore');
Route::post('/crearDoc','LoginController@crearDoc')->name('crearDoc');

Route::get('/registroAdmin','LoginController@registroAdmin');
Route::post('/crearAdmin','LoginController@storeAdmin')->name('adminStore');

Route::get('/registroPautante','LoginController@registroPautante');
Route::post('/crearPautante','LoginController@storePautante')->name('pautanteStore');

/* FIN RUTAS SOCIOS NUEVO */

//*Ruta para controlador de Acceso o Login */
Route::resource('login','LoginController');
Route::get('logout','LoginController@logout');

Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

/*Backend Rutas
 */
Route::get('/aptos/{id}','UsuarioController@getAptos');
Route::get('/ciudades/{id}','UsuarioController@getCiudades');
Route::post('visitantes','UsuarioController@getUsuariosAnuncios');

Route::get('/zonasconjunto/{id}','UsuarioController@getZonas');
Route::get('/date', array('uses' => 'FilesController@getdategral','as' => 'getdatetime'));

Route::post('pagos/listenerpayu','PagosController@listenerpayu');
Route::post('pagospublicidad/listenerpayu','PagosPublicidadController@listenerpayu');
Route::post('facturas/getDetalles','FacturasController@getDetalles'); 
Route::post('pagosmembresias/getDetalles','PagosMembresiasController@getDetalles'); 
Route::post('pagosanuncios/getDetalles','PagosAnunciosController@getDetalles'); 
   
 // Rutas momentaneas de socio
 
 Route::put('socio/{id}/update','UsuarioController@update');


/* Validacion de credenciales y accesos con privilegio */
Route::group(array('middleware' => 'auth'), function()
{
	
	Route::get('test_sql', 'UsuarioController@test_sql');
	Route::get('conjuntos_json', 'ConjuntoController@conjuntos_json');
	Route::get('conjuntos_lugar_json', 'ConjuntoController@conjuntos_lugar_json');
	
	
	Route::get('perfil','UsuarioController@profile');
	Route::post('perfil/picture','UsuarioController@savePicture');
	Route::post('socio/documento','UsuarioController@saveDocument');
	
	Route::resource('mensajes', 'MensajeController');
    Route::get('mostrarbadges','MensajeController@mostrarBadges'); //muestra los badges
    Route::get('listarmensajes','MensajeController@listarMensajes'); //listado de mensajes en inbox
    Route::get('enviados','MensajeController@sent'); //vista mensajes enviados en inbox
    Route::get('verenviados/{mensajeid}','MensajeController@verEnviados'); //ver por id mensajes enviados en inbox
    Route::get('listarenviados','MensajeController@listarEnviados'); //listado de mensajes enviados en inbox
    Route::get('importantes','MensajeController@importantes'); //vista mensajes enviados en inbox
    Route::get('listarimportantes','MensajeController@listarImportantes'); //listado de mensajes enviados en inbox
    Route::get('relevantes','MensajeController@relevantes'); //vista mensajes enviados en inbox
    Route::get('listarelevantes','MensajeController@listarRelevantes'); //listado de mensajes enviados en inbox
    Route::get('normales','MensajeController@normales'); //vista mensajes enviados en inbox
    Route::get('listarnormales','MensajeController@listarNormales'); //listado de mensajes enviados en inbox
    Route::get('vermensajes/{mensajeid}','MensajeController@verMensajes'); //ver mensajes en inbox
    Route::get('mensajes/adjunto/{id}', 'MensajeController@listarAdjuntos'); //adjuntos por mensaje
    Route::get('mensajes/respuestas/{id}/{id2}', 'MensajeController@listarRespuestas'); //respuestas por mensaje
    Route::post('mensajes/responder','MensajeController@responderMensaje'); //responder mensaje
    Route::get('eliminarmensaje/{id}','MensajeController@destroy'); //eliminar mensajes en inbox
    Route::post('mensajes/marcarleidos/{id}','MensajeController@marcarLeidos'); //marcar mensajes leidos en inbox
    Route::post('mensajes/borrarenviados','MensajeController@destroyEnviados'); //borrado de enviados para admon
	
    /* Visualizacion de archivo adjunto */
    Route::group(array('prefix' => 'files'), function()
    {
        Route::get('/adjunto/{id}', array('uses' => 'FilesController@link_adjunto','as' => 'adjuntoFile'));
    });


     


    //Rutas Super Administrator (admin) => validacion Super administrador


	
    Route::group(['middleware' =>[ 'auth', 'superadmin'], 'prefix' => 'superadmin'], function()
    {
		
		Route::resource('reportes','ReportesController');
		
        //Dirige Hacia el home del super administrador
        Route::get('/', function () {
            return view('backend.superadmin.index');
        });
        // Ruta Restfull usuarios creaci贸n
        Route::resource('usuarios','UsuarioController');
        Route::get('usuarios/{id}/desactivate','UsuarioController@activatesuper');
        Route::get('usuarios/{id}/activate','UsuarioController@desactivatesuper');
        Route::get('buscarusuarios','UsuarioController@buscar'); //busqueda
        Route::get('usuarios/{id}/delete','UsuarioController@deletesuper'); //borrado
        // Ruta restfill para conjuntos CRUD    
        Route::resource('conjuntos','ConjuntoController');
        Route::get('conjuntos/{id}/details','ConjuntoController@detalles'); //detalles
        Route::get('conjuntos/{id}/delete','ConjuntoController@delete'); //borrado
        Route::get('buscarconjuntos','ConjuntoController@buscarconjunto'); //busqueda
         //Ruta Restfull de zonas
        Route::resource('zonas','ZonaController');
        Route::get('zonas/{id}/delete','ZonaController@deletesuper'); //borrado
        Route::get('zonas/listar', 'ZonaController@getZonas');
        Route::post('zonas/buscar', 'ZonaController@buscarzona');
        //Ruta Restfull de Apartamentos
        Route::resource('apartamentos','ApartamentoController');
        Route::get('apartamentos/{id}/delete', 'ApartamentoController@deletesuper');
        Route::post('apartamentos/createmultiple','ApartamentoController@storemultiple1'); //crear multiple
        Route::post('apartamentos/buscar', 'ApartamentoController@buscar');
        //Ruta Restfull de  noticia
        Route::resource('anuncios','AnunciosController');
        Route::get('anuncios/{id}/delete','AnunciosController@deletesuper');
        //Ruta Restfull de mensajes
        Route::resource('mensajes', 'MensajeController');
        Route::get('mostrarbadges','MensajeController@mostrarBadges'); //muestra los badges
        Route::get('listarmensajes','MensajeController@listarMensajes'); //listado de mensajes en inbox
        Route::get('enviados','MensajeController@sent'); //vista mensajes enviados en inbox
        Route::get('verenviados/{mensajeid}','MensajeController@verEnviados'); //ver por id mensajes enviados en inbox
        Route::get('listarenviados','MensajeController@listarEnviados'); //listado de mensajes enviados en inbox
        Route::get('importantes','MensajeController@importantes'); //vista mensajes enviados en inbox
        Route::get('listarimportantes','MensajeController@listarImportantes'); //listado de mensajes enviados en inbox
        Route::get('relevantes','MensajeController@relevantes'); //vista mensajes enviados en inbox
        Route::get('listarelevantes','MensajeController@listarRelevantes'); //listado de mensajes enviados en inbox
        Route::get('normales','MensajeController@normales'); //vista mensajes enviados en inbox
        Route::get('listarnormales','MensajeController@listarNormales'); //listado de mensajes enviados en inbox
        Route::get('vermensajes/{mensajeid}','MensajeController@verMensajes'); //ver mensajes en inbox
        Route::get('mensajes/adjunto/{id}', 'MensajeController@listarAdjuntos'); //adjuntos por mensaje
        Route::get('mensajes/respuestas/{id}/{id2}', 'MensajeController@listarRespuestas'); //respuestas por mensaje
        Route::post('mensajes/responder','MensajeController@responderMensaje')->name('superadmin/mensajes/responer'); //responder mensaje
        Route::get('eliminarmensaje/{id}','MensajeController@destroy'); //eliminar mensajes en inbox
        Route::post('mensajes/marcarleidos/{id}','MensajeController@marcarLeidos'); //marcar mensajes leidos en inbox
        Route::post('mensajes/borrarenviados','MensajeController@destroyEnviados'); //borrado de enviados para admon
        // Ruta Restfull publicidad 
        Route::resource('publicidad/bonos','PublicidadController');
        Route::get('publicidad/bonos/{id}/delete','PublicidadController@delete'); //borrado
        Route::post('publicidad/bonos/borrar','PublicidadController@borramasivos'); //borrado masivo
        Route::resource('publicidad/clubmascotas','PublimascotasController');
        Route::get('publicidad/clubmascotas/{id}/delete','PublimascotasController@delete'); //borrado
        Route::resource('publicidad/clubmotor','PublivehiculosController');
        Route::get('publicidad/clubmotor/{id}/delete','PublivehiculosController@delete'); //borrado
        // Carga Imagen al servidor (Peticion via Ajax)
        Route::post('mensajes/loadImage', array('uses' => 'FilesController@loadImageSource','as' => 'loadImageSource'));
        //Carga Imagen en el servidor mediante ajax
        Route::post('/loadImage', array('uses' => 'MensajeController@loadImageSource','as' => 'loadImageSourceAdmin'));
        //Rutas para la creaci贸n de bancos en el sistema
        Route::resource('bancos', 'BancoController');
        Route::get('bancos/{id}/delete','BancoController@deletesuper');
        //Rutas para la creaci贸n de recibos de pago
        Route::resource('recibosdepago', 'FacturaController');
        Route::post('recibosdepago/buscarecibos','FacturaController@buscar'); //busqueda 
		
		// Ruta Restfull configurador
        Route::resource('conceptos','ConceptoController');
		Route::get('conceptos/{id}/delete','ConceptoController@deleteconcepto'); //borrado
		
		// Ruta Restfull valores
        
        Route::resource('valores','ValoresController');

        //Listado de pagos de membresias
         Route::get('buscarpagos','PagosMembresiasController@buscarpagos'); //busqueda
        Route::resource('pagosmembresias','PagosMembresiasController');


        //Listado de pagos de anuncios
        Route::get('buscarpagosanuncios','PagosAnunciosController@buscarpagos'); //busqueda
        Route::resource('pagosanuncios','PagosAnunciosController');


    });

    //Rutas Administrator para validacion por administrador
    
    Route::group(['middleware' =>[ 'auth', 'administrador'], 'prefix' => 'administrador'], function()
    {   
        //conjuntos restfull
        
        Route::resource('conjuntos','ConjuntoController');

        // Route::get('pagos/returnpayu',function(){
      
        //     return view('backend.administrador.pagos.returnpayu');
        // });

        Route::get('pagos/returnpayu','PagosController@returnpayu'); //return pagos payu

        Route::resource('pagos','PagosController');


        Route::group(['middleware' => 'verificarPago'], function(){

            // Ruta de acceso al home de inicio de la herramienta
            Route::get('/', function () {
                return view('backend.administrador.index');
            });
            // Ruta Restfull usuarios creaci髇 desde el administrador
            Route::resource('usuarios','UsuarioController');
            Route::get('usuarios/{id}/delete','UsuarioController@delete'); //borrado
            //Route::get('buscar','UsuarioController@buscar1'); //busqueda
            
            // Ruta Restfull para zonas
            Route::resource('zonas','ZonaController');
            Route::get('zonas/{id}/delete','ZonaController@delete');
            //Lista las zonas para su uso mediante Ajax
            Route::get('zonas/listar', 'ZonaController@getZonas');
            // Ruta Restfull para apartamentos
            Route::resource('apartamentos','ApartamentoController');
            Route::get('apartamentos/{id}/delete', 'ApartamentoController@delete');
            Route::post('apartamentos/createmultiple','ApartamentoController@storemultiple'); //crear multiple
            // Ruta Restfull usuarios mensajes
            Route::resource('mensajes', 'MensajeController');
            Route::get('mostrarbadges','MensajeController@mostrarBadges'); //muestra los badges
            Route::get('listarmensajes','MensajeController@listarMensajes'); //listado de mensajes en inbox
            Route::get('enviados','MensajeController@sent'); //vista mensajes enviados en inbox
            Route::get('verenviados/{mensajeid}','MensajeController@verEnviados'); //ver por id mensajes enviados en inbox
            Route::get('listarenviados','MensajeController@listarEnviados'); //listado de mensajes enviados en inbox
            Route::get('importantes','MensajeController@importantes'); //vista mensajes enviados en inbox
            Route::get('listarimportantes','MensajeController@listarImportantes'); //listado de mensajes enviados en inbox
            Route::get('relevantes','MensajeController@relevantes'); //vista mensajes enviados en inbox
            Route::get('listarelevantes','MensajeController@listarRelevantes'); //listado de mensajes enviados en inbox
            Route::get('normales','MensajeController@normales'); //vista mensajes enviados en inbox
            Route::get('listarnormales','MensajeController@listarNormales'); //listado de mensajes enviados en inbox
            Route::get('vermensajes/{mensajeid}','MensajeController@verMensajes'); //ver mensajes en inbox
            Route::get('mensajes/adjunto/{id}', 'MensajeController@listarAdjuntos'); //adjuntos por mensaje
            Route::get('mensajes/respuestas/{id}/{id2}', 'MensajeController@listarRespuestas'); //respuestas por mensaje
            Route::post('mensajes/responder','MensajeController@responderMensaje')->name('administrador/mensajes/responder'); //responder mensaje
            Route::get('eliminarmensaje/{id}','MensajeController@destroy'); //eliminar mensajes en inbox
            Route::post('mensajes/marcarleidos/{id}','MensajeController@marcarLeidos'); //marcar mensajes leidos en inbox
            Route::post('mensajes/borrarenviados','MensajeController@destroyEnviados'); //borrado de enviados para admon
            //Carga mensaje adjunto mediante su ID
            Route::get('/pdf/{id}', array('uses' => 'MensajeController@pdfReporte','as' => 'pdfReporte'));                
            //Carga imagen al servidor                
            Route::post('/loadImage', array('uses' => 'MensajeController@loadImageSource','as' => 'loadImageSource'));
            //anuncios restfull administrador
            Route::resource('anuncios','AnunciosController');
            Route::get('anuncios/{id}/delete','AnunciosController@delete');
            //publicidad restfull administrador
            Route::resource('publicidad/bonos','PublicidadController');
            Route::resource('publicidad/clubmascotas','PublimascotasController');
            Route::resource('publicidad/clubmotor','PublivehiculosController');
            // sensos de mascotas y vehiculos por conjunto
            Route::get('censos/mascotas', 'ClubmascotasController@mascotasConjunto');
            Route::get('censos/vehiculos', 'ClubvehiculosController@vehiculosConjunto');
            //Rutas para la creaci髇 de recibos de pago
            //Route::resource('recibosdepago', 'FacturaController'); 
            Route::post('facturas/changeStatus','FacturasController@changeStatus'); 
            Route::get('facturas/{id}/detalles','FacturasController@detalles')->name('administrador.facturas.detalles'); 
            Route::get('facturas/{id}/crearfactura','FacturasController@CrearFactura')->name('administrador.facturas.crearfactura'); 
            Route::post('facturas/storefactura','FacturasController@storefactura')->name('administrador.facturas.storefactura');
            Route::get('facturas/{id}/editfactura','FacturasController@editfactura')->name('administrador.facturas.editfactura');
            Route::put('facturas/{id}/updatefactura','FacturasController@updatefactura')->name('administrador.facturas.updatefactura');
            Route::delete('facturas/{id}/destroyfactura','FacturasController@destroyfactura')->name('administrador.facturas.destroyfactura');
            Route::resource('facturas', 'FacturasController'); 

            //Rutas para la creaci贸n de bancos en el sistema
            Route::resource('bancos', 'BancoController');
            //Listado de pagos de membresias
            Route::get('buscarpagos','PagosMembresiasController@buscarpagos'); //busqueda
            Route::resource('pagosmembresias','PagosMembresiasController');

        });
       
    });   
    //Rutas de Usuario
    Route::group(['middleware' =>[ 'auth', 'residente'], 'prefix' => 'usuario'], function()
    {    
      // Ruta de acceso al home de inicio de la herramienta
      // Ruta Restfull usuarios validaci贸n
      Route::get('/','UsuarioController@index');
      Route::get('/{id}/edit','UsuarioController@edit');
      Route::put('/{id}/update','UsuarioController@update');
      // Ruta Restfull usuarios mensaje
      Route::resource('mensajes', 'MensajeController');
      Route::get('mostrarbadges','MensajeController@mostrarBadges'); //muestra los badges
      Route::get('listarmensajes','MensajeController@listarMensajes'); //listado de mensajes en inbox
      Route::get('enviados','MensajeController@sent'); //vista mensajes enviados en inbox
      Route::get('verenviados/{mensajeid}','MensajeController@verEnviados'); //ver por id mensajes enviados en inbox
      Route::get('listarenviados','MensajeController@listarEnviados'); //listado de mensajes enviados en inbox
      Route::get('importantes','MensajeController@importantes'); //vista mensajes enviados en inbox
      Route::get('listarimportantes','MensajeController@listarImportantes'); //listado de mensajes enviados en inbox
      Route::get('relevantes','MensajeController@relevantes'); //vista mensajes enviados en inbox
      Route::get('listarelevantes','MensajeController@listarRelevantes'); //listado de mensajes enviados en inbox
      Route::get('normales','MensajeController@normales'); //vista mensajes enviados en inbox
      Route::get('listarnormales','MensajeController@listarNormales'); //listado de mensajes enviados en inbox
      Route::get('vermensajes/{mensajeid}','MensajeController@verMensajes'); //ver mensajes en inbox
      Route::get('mensajes/adjunto/{id}', 'MensajeController@listarAdjuntos'); //adjuntos por mensaje
      Route::get('mensajes/respuestas/{id}/{id2}', 'MensajeController@listarRespuestas'); //respuestas por mensaje
      Route::post('mensajes/responder','MensajeController@responderMensaje'); //responder mensaje
      Route::get('eliminarmensaje/{id}','MensajeController@destroy'); //eliminar mensajes en inbox
      Route::post('mensajes/marcarleidos/{id}','MensajeController@marcarLeidos'); //marcar mensajes leidos en inbox
      // Ruta Restfull usuarios anuncios
      Route::resource('noticias', 'AnunciosController');
      // Ruta Restfull usuarios publicidad
      Route::resource('descuentos/bonos', 'PublicidadController');
      // Ruta Restfull Club Mascotas Publicidad
      Route::resource('descuentos/clubmascotas', 'PublimascotasController');
      // Ruta Restfull Club Vehiculos Publicidad
      Route::resource('descuentos/clubmotor', 'PublivehiculosController');
      // Ruta Restfull Club Mascotas crear y editar mascota
      Route::resource('clubmascotas', 'ClubmascotasController');
      Route::get('clubmascotas/{id}/delete','ClubmascotasController@delete');
      // Ruta Restfull Club Motor crear y editar vehiculo
      Route::resource('clubmotor', 'ClubvehiculosController');
      Route::get('clubmotor/{id}/delete','ClubvehiculosController@delete');
      //Rutas para la creaci贸n de recibos de pago
      Route::resource('recibosdepago', 'FacturaController'); 
      Route::resource('facturas', 'FacturasController'); 

    });

    //Rutas de Pautantes
    Route::group(['middleware' =>[ 'auth', 'pautante'], 'prefix' => 'pautante'], function(){    
      
        Route::get('/',function(){
            return view('backend.pautante.index');
        });

        Route::get('pagospublicidad/returnpayu','PagosPublicidadController@returnpayu'); //return pagos payu

        Route::resource('publicidad/bonos','PublicidadController');
        Route::post('publicidad/bonos/changeStatus','PublicidadController@changeStatus'); 

        Route::resource('publicidad/clubmascotas','PublimascotasController');
        Route::post('publicidad/clubmascotas/changeStatus','PublimascotasController@changeStatus'); 

        Route::resource('publicidad/clubmotor','PublivehiculosController');
        Route::post('publicidad/clubmotor/changeStatus','PublivehiculosController@changeStatus'); 

        //Ruta para pagos
        Route::get('pagospublicidad/crearpago/{tipo}','PagosPublicidadController@CrearPago');
        Route::resource('pagospublicidad','PagosPublicidadController');

        //Listado de pagos de anuncios
        Route::get('buscarpagosanuncios','PagosAnunciosController@buscarpagos'); //busqueda
        Route::resource('pagosanuncios','PagosAnunciosController');


    });

  });