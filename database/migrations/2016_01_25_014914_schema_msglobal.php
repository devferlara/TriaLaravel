<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SchemaMSglobal extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /* #1 Create Table Usuarios */
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('identificacion',30);
            $table->string('nombres',100);
            $table->string('apellidos',100);
            $table->string('genero',50);
            $table->date('fecha_nacimiento');
            $table->string('email',100)->unique();
            $table->string('telefono',20);
            $table->string('celular',20);
            $table->string('rol',20);
            $table->boolean('active');
            $table->string('username',30)->index();
            $table->string('password');
            $table->string('remember_token');
            $table->string('img_perfil');
            $table->timestamps();
            $table->softDeletes();
        });
        /* # 1.5 Create Table Socios */
        Schema::create('socios', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('usuario_id')->unsigned();
            $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade');
            $table->string('tipo',20);
            $table->integer('cuotas');
            $table->softDeletes();
        });

        /* #2 Create Table Configuraciones  Add Device type*/
        Schema::create('configuraciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('usuario_id')->unsigned();
            $table->foreign('usuario_id')
                ->references('id')->on('usuarios')
                ->onDelete('cascade');
            $table->boolean('email_notificaciones');
            $table->string('img_perfil');
            $table->string('img_banner');
            $table->string('notificaciones');
            $table->string('register_device');
            $table->string('device_type');
            $table->string('token');
            $table->timestamps();
            $table->softDeletes();
        });

        /* #3 Create Table Conjuntos */
        Schema::create('conjuntos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nit',50);
            $table->string('tipo',50);
            $table->string('clasificacion',50);
            $table->string('composicion_areas',70);
            $table->string('nombre',100);
            $table->string('pais',50);
            $table->string('ciudad',100);
            $table->string('localidad',100);
            $table->string('barrio',100);
            $table->string('direccion',100);
            $table->string('telefono',30);
            $table->string('estrato',20);
            $table->string('map_latitud');
            $table->string('map_longitud');
            $table->string('telefono_cuadrante',30);
            $table->string('horario_administracion');
            $table->string('img_perfil');
            $table->string('banner_conjunto');
            $table->timestamps();
            $table->softDeletes();
        });

        /* #4 Create Table Zonas */
        Schema::create('zonas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('conjunto_id')->unsigned();
            $table->foreign('conjunto_id')
                ->references('id')->on('conjuntos')
                ->onDelete('cascade');
            $table->string('tipo',50);
            $table->string('zona',30);
            $table->text('descripcion');
            $table->timestamps();
            $table->softDeletes();
        });

        /* #5 Create Table Apartamentos */
        Schema::create('apartamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('apartamento',50);
            $table->string('matricula_inmobiliaria',50);
            $table->text('descripcion');
            $table->integer('zona_id')->unsigned();
            $table->foreign('zona_id')
                ->references('id')->on('zonas')
                ->onDelete('cascade');
            $table->index('zona_id');
            $table->timestamps();
            $table->softDeletes();
        });

        /* #6 Create Table Usuarios Apartamento */
        Schema::create('usuario_apartamentos', function (Blueprint $table) {
            $table->increments('id');
            /* Foreign key usuarios */
            $table->integer('usuario_id')->unsigned();
            $table->foreign('usuario_id')
                ->references('id')->on('usuarios')
                ->onDelete('cascade');
            /* Foreign key apartamentos */
            $table->integer('apartamento_id')->unsigned();
            $table->foreign('apartamento_id')
                ->references('id')->on('apartamentos')
                ->onDelete('cascade');
            $table->boolean('propietario');
            $table->timestamps();
            $table->softDeletes();
        });

        /* #7 Create Table Administradores */
        Schema::create('administradores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('usuario_id')->unsigned();
            $table->foreign('usuario_id')
                ->references('id')->on('usuarios')
                ->onDelete('cascade');
            $table->string('rol',20);
            $table->timestamps();
            $table->softDeletes();
        });

        /* #8 Create Table Administrador Conjunto */
        Schema::create('administrador_conjuntos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('administrador_id')->unsigned();
            $table->foreign('administrador_id')
                ->references('id')->on('administradores')
                ->onDelete('cascade');
            $table->integer('conjunto_id')->unsigned();
            $table->foreign('conjunto_id')
                ->references('id')->on('conjuntos')
                ->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });

        /* #9 Create Table Publicidad */
        Schema::create('publicidad', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tienda',100);
            $table->string('logo');
            $table->string('local',100);
            $table->string('titulo');
            $table->string('descripcion_corta');
            $table->text('descripcion');
            $table->string('valor',50);
            $table->date('fecha');
            $table->date('fecha_desde');
            $table->date('fecha_hasta');
            $table->string('img_publicidad');
            $table->string('link');
            $table->string('categoria',100);
            $table->boolean('enabled');
            $table->timestamps();
            $table->softDeletes();
        });

        /* #10 Create Table Publicidad Conjunto */
        Schema::create('publicidad_conjuntos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('publicidad_id')->unsigned();
            $table->foreign('publicidad_id')
                ->references('id')->on('publicidad')
                ->onDelete('cascade');
            $table->integer('conjunto_id')->unsigned();
            $table->foreign('conjunto_id')
                ->references('id')->on('conjuntos')
                ->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });

        /* #11 Create Table Centro Comercial */
        Schema::create('centros_comerciales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('pais',100);
            $table->string('ciudad',100);
            $table->string('barrio',100);
            $table->string('direccion');
            $table->string('telefono',30);
            $table->text('descripcion');
            $table->string('img_perfil');
            $table->string('img_banner');
            $table->string('map_latitud');
            $table->string('map_longitud');
            $table->timestamps();
            $table->softDeletes();
        });

        /* #12 Create Table Publicidad Centro Comercial */
        Schema::create('publicidad_cc', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('publicidad_id')->unsigned();
            $table->foreign('publicidad_id')
                ->references('id')->on('publicidad')
                ->onDelete('cascade');
            $table->integer('centrocomercial_id')->unsigned();
            $table->foreign('centrocomercial_id')
                ->references('id')->on('centros_comerciales')
                ->onDelete('cascade');
            $table->date('fecha');
            $table->timestamps();
            $table->softDeletes();
        });

        /* #13 Create Table Mensajes */
        Schema::create('mensajes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('enviar_a');
            $table->string('asunto');
            $table->longText('mensaje');
            $table->date('fecha');
            $table->boolean('adjunto');
            $table->string('importancia',20);
            $table->boolean('leido');
            $table->boolean('respuesta');
            $table->string('likes');
            $table->timestamps();
            $table->softDeletes();
        });

        /* #14 Create Table Mensaje Usuarios */
        Schema::create('mensaje_usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('from_id')->unsigned();
            $table->foreign('from_id')
                ->references('id')->on('usuarios')
                ->onDelete('cascade');
            $table->integer('to_id')->unsigned();
            $table->foreign('to_id')
                ->references('id')->on('usuarios')
                ->onDelete('cascade');
            $table->integer('mensaje_id')->unsigned();
            $table->foreign('mensaje_id')
                ->references('id')->on('mensajes')
                ->onDelete('cascade');
            $table->boolean('leido');
            $table->date('fecha_leido');
            $table->timestamps();
            $table->softDeletes();
        });

        /* #15 Create Table Adjuntos */
        Schema::create('adjuntos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('ruta');
            $table->string('tipo');
            $table->string('peso');
            $table->date('fecha');
            $table->timestamps();
            $table->softDeletes();
        });

        /* #16 Create Table Adjunto Mensajes */
        Schema::create('adjunto_mensajes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('adjunto_id')->unsigned();
            $table->foreign('adjunto_id')
                ->references('id')->on('adjuntos')
                ->onDelete('cascade');
            $table->integer('mensaje_id')->unsigned();
            $table->foreign('mensaje_id')
                ->references('id')->on('mensajes')
                ->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });

        /* #17 Create Table Respuestas */
        Schema::create('respuestas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mensaje_id')->unsigned();
            $table->foreign('mensaje_id')
                ->references('id')->on('mensajes')
                ->onDelete('cascade');
            $table->integer('usuario_id')->unsigned();
            $table->foreign('usuario_id')
                ->references('id')->on('usuarios')
                ->onDelete('cascade');
            $table->longText('mensaje');
            $table->date('fecha');
            $table->boolean('leido');
            $table->date('fecha_leido');
            $table->timestamps();
            $table->softDeletes();
        });

        /* #18 Create Table Noticias */
        Schema::create('noticias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->text('descripcion');
            $table->date('fecha');
            $table->string('autor',100);
            $table->string('img_perfil');
            $table->string('img_banner');
            $table->string('valoracion',50);
            $table->integer('conjunto_id')->unsigned();
            $table->foreign('conjunto_id')
                ->references('id')->on('conjuntos')
                ->onDelete('cascade');
            $table->string('categoria',100);
            $table->boolean('enabled');
            $table->timestamps();
            $table->softDeletes();
        });

        /* #19 Create Table Publicacion Centro Comercial */
        Schema::create('publi_comerciales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('descripcion_corta',50);
            $table->text('descripcion');
            $table->string('categoria',100);
            $table->string('img_publicacion');
            $table->string('banner_publicacion');
            $table->date('fecha');
            $table->date('fecha_desde');
            $table->date('fecha_hasta');
            $table->string('link');
            $table->boolean('enabled');
            $table->timestamps();
            $table->softDeletes();
        });

        /* #20 Create Table Publicacion By Centro Comercial (RelationShip) */
        Schema::create('publicacion_comerciales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('publicacion_id')->unsigned();
            $table->foreign('publicacion_id')
                ->references('id')->on('publi_comerciales')
                ->onDelete('cascade');
            $table->integer('centrocomercial_id')->unsigned();
            $table->foreign('centrocomercial_id')
                ->references('id')->on('centros_comerciales')
                ->onDelete('cascade');
            $table->date('fecha');
            $table->timestamps();
            $table->softDeletes();
        });

        /* #21 Create Table Publicacion By Mascotas */
       Schema::create('mascotas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('usuario_id')->unsigned();
            $table->foreign('usuario_id')
                ->references('id')->on('usuarios')
                ->onDelete('cascade');
            $table->string('tipo',30);
            $table->string('nombre',50);
            $table->string('raza');
            $table->string('edad',30);
            $table->string('genero',30);
            $table->boolean('vacunas');
            $table->string('img_mascota');
            $table->boolean('registrado');
            $table->timestamps();
            $table->softDeletes();
        });

        /* #22 Create Table Publicacion By Vehiculos */ 

        Schema::create('vehiculos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('usuario_id')->unsigned();
            $table->foreign('usuario_id')
                ->references('id')->on('usuarios')
                ->onDelete('cascade');
            $table->string('tipo', 50);
            $table->string('placa',15);
            $table->string('cantidad', 5);
            $table->string('modelo',50);
            $table->string('color');
            $table->string('marca');
            $table->boolean('parqueadero');
            $table->string('tipo_parqueadero',30);
            $table->string('numero_parqueadero',30);
            $table->boolean('registrado');
            $table->timestamps();
            $table->softDeletes();
        }); 

        /* #23 Publicacion mascotas*/    
        Schema::create('publimascotas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('categoria',100);
            $table->string('titulo');
            $table->string('emisor');
            $table->string('descripcion_corta',50);
            $table->text('descripcion');
            $table->date('fecha');
            $table->date('fecha_desde');
            $table->date('fecha_hasta');
            $table->string('link');
            $table->boolean('enabled');
            $table->string('img_banner');
            $table->string('valor',50);
            $table->timestamps();
            $table->softDeletes();
        });

        /* #24 Publicacion vehiculos*/ 

        Schema::create('publivehiculos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('categoria',100);
            $table->string('titulo');
            $table->string('emisor');
            $table->string('descripcion_corta',50);
            $table->text('descripcion');
            $table->date('fecha');
            $table->date('fecha_desde');
            $table->date('fecha_hasta');
            $table->string('link');
            $table->boolean('enabled');
            $table->string('img_banner');
            $table->string('valor',50);
            $table->timestamps();
            $table->softDeletes();
        });

          /* #25 tabla pivot para mascotas y Publicacion */

          Schema::create('publicidad_mascotas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('publimascota_id')->unsigned();
            $table->foreign('publimascota_id')
                ->references('id')->on('publimascotas')
                ->onDelete('cascade');
            $table->integer('conjunto_id')->unsigned();
            $table->foreign('conjunto_id')
                ->references('id')->on('conjuntos')
                ->onDelete('cascade');
            $table->date('fecha');
            $table->timestamps();
            $table->softDeletes();
        });

         /* #26 tabla pivot para vehiculos y Publicacion */

         Schema::create('publicidad_vehiculos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('conjunto_id')->unsigned();
            $table->foreign('conjunto_id')
                ->references('id')->on('conjuntos')
                ->onDelete('cascade');
            $table->integer('publivehiculo_id')->unsigned();
            $table->foreign('publivehiculo_id')
                ->references('id')->on('publivehiculos')
                ->onDelete('cascade');
            $table->date('fecha');    
            $table->timestamps();
            $table->softDeletes();
        });

          /* #27 tabla pivot para vehiculos y conjuntos */

          Schema::create('vehiculos_conjuntos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('conjunto_id')->unsigned();
            $table->foreign('conjunto_id')
                ->references('id')->on('conjuntos')
                ->onDelete('cascade');
            $table->integer('vehiculo_id')->unsigned();
            $table->foreign('vehiculo_id')
                ->references('id')->on('vehiculos')
                ->onDelete('cascade');
            $table->date('fecha');    
            $table->timestamps();
            $table->softDeletes();
        });

          /* #28 tabla pivot para mascotas y conjuntos */

          Schema::create('mascotas_conjuntos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mascota_id')->unsigned();
            $table->foreign('mascota_id')
                ->references('id')->on('mascotas')
                ->onDelete('cascade');
            $table->integer('conjunto_id')->unsigned();
            $table->foreign('conjunto_id')
                ->references('id')->on('conjuntos')
                ->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });

        /* #29 tabla pivot para usuarios y bonos */
          Schema::create('usuario_publicidad', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('usuario_id')->unsigned();
            $table->foreign('usuario_id')
                ->references('id')->on('usuarios')
                ->onDelete('cascade');
            $table->integer('publicidad_id')->unsigned();
            $table->foreign('publicidad_id')
                ->references('id')->on('publicidad')
                ->onDelete('cascade');
            $table->boolean('leido');
            $table->date('fecha_leido');
            $table->timestamps();
            $table->softDeletes();
        });

        /* #30 Bancos*/ 

        Schema::create('bancos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',100);
            $table->string('pais');
            $table->string('link');
            $table->boolean('enabled');
            $table->string('img_banco');
            $table->timestamps();
            $table->softDeletes();
        });

        /* #31 tabla pivot bancos y conjuntos*/
          Schema::create('bancos_conjuntos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('banco_id')->unsigned();
            $table->foreign('banco_id')
                ->references('id')->on('bancos')
                ->onDelete('cascade');
            $table->integer('conjunto_id')->unsigned();
            $table->foreign('conjunto_id')
                ->references('id')->on('conjuntos')
                ->onDelete('cascade');
            $table->string('tipo_cuenta');
            $table->string('No_cuenta');
            $table->string('No_convenio');
            $table->boolean('habilitado');
            $table->timestamps();
            $table->softDeletes();
        });

        /* #32 tabla valores admon*/
          Schema::create('valoresadministraciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('conjunto_id')->unsigned();
            $table->foreign('conjunto_id')
                ->references('id')->on('conjuntos')
                ->onDelete('cascade');
            $table->string('valoradmon');
            $table->string('valorparqueadero');
            $table->string('valormultadmon');
            $table->string('valormultaparqueadero');
            $table->string('valorcuotaextraordinaria');
            $table->string('descuentoadmon');
            $table->string('descuentoparqueadero');
            $table->string('descuentocuotaextra');
            $table->date('inicio_cobro');
            $table->date('final_cobro');
            $table->timestamps();
            $table->softDeletes();
        });

        /* #33 tabla pivot valores admon factura por apartamento*/
          Schema::create('factura_apartamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('num_factura');
            $table->string('fecha');
            $table->integer('apartamento_id')->unsigned();
            $table->foreign('apartamento_id')
                ->references('id')->on('apartamentos')
                ->onDelete('cascade');    
            $table->string('valoradmon');
            $table->string('valorparqueadero');
            $table->string('valormultadmon');
            $table->string('valormultaparqueadero');
            $table->string('valorcuotaextraordinaria');
            $table->string('descuentoadmon');
            $table->string('descuentoparqueadero');
            $table->string('descuentocuotaextra');
            $table->string('saldoparqueadero');
            $table->string('saldoadmon');
            $table->string('saldocuotaextra');
            $table->string('saldomultadmon');
            $table->string('saldomultaparqueadero');
            $table->string('saldomultacuotaextra');
            $table->string('meses_mora');
            $table->string('total_a_pagar');
            $table->string('pago_anterior');
            $table->string('linkbanco');
            $table->string('conveniobanco');
            $table->string('cuentabancaria');
            $table->timestamps();
            $table->softDeletes();
        });
   }
 /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        //
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        /* 1 */Schema::dropIfExists('publicidad_vehiculos');
        /* 2 */Schema::dropIfExists('publicidad_mascotas');
        /* 3 */Schema::dropIfExists('publivehiculos');
        /* 4 */Schema::dropIfExists('publimascotas');
        /* 5 */Schema::dropIfExists('mascotas');
        /* 6 */Schema::dropIfExists('vehiculos');
        /* 7 */Schema::dropIfExists('publicacion_comerciales');
        /* 8 */Schema::dropIfExists('publi_comerciales');
        /* 9 */Schema::dropIfExists('noticias');
        /* 10 */Schema::dropIfExists('adjunto_mensajes');
        /* 11 */Schema::dropIfExists('mensaje_usuarios');
        /* 12 */Schema::dropIfExists('publicidad_cc');
        /* 13 */Schema::dropIfExists('publicidad_conjuntos');
        /* 14 */Schema::dropIfExists('administrador_conjuntos');
        /* 15 */Schema::dropIfExists('usuario_apartamentos');
        /* 16 */Schema::dropIfExists('apartamentos');
        /* 17 */Schema::dropIfExists('zonas');
        /* 18 */Schema::dropIfExists('conjuntos');
        /* 19 */Schema::dropIfExists('administradores');
        /* 20 */Schema::dropIfExists('publicidad');
        /* 21 */Schema::dropIfExists('centros_comerciales');
        /* 22 */Schema::dropIfExists('respuestas');
        /* 23 */Schema::dropIfExists('adjuntos');
        /* 24 */Schema::dropIfExists('mensajes');
        /* 25 */Schema::dropIfExists('configuraciones');
        /* 26 */Schema::dropIfExists('usuarios');
        /*26.5*/Schema::dropIfExists('socios');
        /* 27 */Schema::dropIfExists('mascotas_conjuntos');
        /* 28 */Schema::dropIfExists('vehiculos_conjuntos');
        /* 29 */Schema::dropIfExists('usuario_publicidad');
        /* 30 */Schema::dropIfExists('bancos');
        /* 31 */Schema::dropIfExists('bancos_conjuntos');
        /* 32 */Schema::dropIfExists('valoresadministraciones');
        /* 33 */Schema::dropIfExists('facturas_apartamentos');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}