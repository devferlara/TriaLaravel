@extends('layout.mensajes')

<!-- Create General Section Sidebar -->
@section('sidebar')
<!-- Include the menu -->
@include('backend.menu.superadmin')
@stop

<!-- Create General Section Header -->
@section('head')
<!-- Include the profile header -->
@include('layout.head')

@stop

@section ('content')





<div class="container-fluid">
  <div class="row app-row" >
    @include ('errors.errors')
    @include ('errors.request')
    @include ('errors.success')
    <div class="col-12 chat-app bloques_mensajeria">
      <div class="row">
        <div class="col-md-6 fondo_blanco_mensajeria height_mensajeria">
          <a class="email-refresh" href="mensajes"><i class="simple-icon-refresh"></i></a>
          <div id="emailList2"></div>


        </div>
        <div class="col-md-6 height_mensajeria">

          <div class="email-opened">
            <div class="no-email">
              <h1>No ha seleccionado ningun mensaje o su bandeja esta vacia</h1>
            </div>
            <div class="email-content-wrapper">
              <div class="actions-wrapper menuclipper bg-master-lightest">
                <ul class="actions menuclipper-menu no-margin p-l-20 ">
                  <li class="visible-sm-inline-block visible-xs-inline-block">
                    <a href="{{ url('superadmin/mensajes') }}" class="email-list-toggle"><i class="fa fa-angle-left"></i> Todos Msg</a>
                  </li>
                  <li class="no-padding "><a href="#" id="btnresponder" class="text-info"><i class="fa fa-reply"></i> Responder</a></li>
                  <li class="no-padding "><a href="{{ url('superadmin/mensajes') }}" id="btnleido"><i class="fa fa-thumb-tack"></i> Marcar como leido</a></li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="email-content">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <div class="email-content-header">
                  <div class="thumbnail-wrapper d48 circular bordered">
                    <img width="40" height="40" alt="" data-src-retina="/build/assets/img/profiles/user.png" data-src="/build/assets/img/profiles/user.png" src="/build/assets/img/profiles/user.png">
                  </div>
                  <div class="sender inline m-l-10">
                    <h6>Remite:</h6>
                    <p class="name no-margin bold"></p>
                    <p class="datetime no-margin"></p>
                  </div>
                  <div class="clearfix"></div>
                  <div class="col-md-12">
                    <h6 class="bold">Asunto:</h6>
                    <div class="subject semi-bold"></div>
                  </div>
                </div>
                <div class="clearfix"></div>
                <div style="margin-top:20px;"><hr></div>
                <h6 class="bold">Contenido:</h6>
                <div class="email-content-body"></div>
                <div><hr></div>
                <div class="email-attachment" style="display: none;">
                  <div id="archivos"></div> 
                </div>
                <div class="email-answer-body m-t-20" style="display: none;" id="respuesta-content">
                  <h5>Historial de Mensajes (Respuestas)</h5>
                  <div class="content-respuesta-data" style="display: none;">
                  </div>
                </div>

                <div style="display:none;" id="editrespuesta">
                  {!!Form::open(['action'=>'MensajeController@responderMensaje','method'=>'POST', 'files'=>'true'])!!}

                  <input type="hidden" id="idmensajeusuario" name="idmensajeusuario">
                  <input type="hidden" id="idmensaje" name="idmensaje">
                  <textarea class="ckeditor" name="mensaje" id="mensaje" rows="8" cols="80"></textarea>
                  <div class="form-inline">
                    <div class="col-md-12 form-group" style="margin-top:10px;">   
                      {!!Form::submit('Responder', ['class'=>'btn btn-primary'])!!}
                      {!!link_to_route('superadmin.mensajes.index',  $title = 'Cancelar', $parameters = null, $attributes = ['class'=>'btn btn-danger'])!!}
                    </div>  
                  </div>
                  {!!Form::close()!!}  
                </div>
              </div>
            </div>
          </div>
          <div class="compose-wrapper visible-xs">
            <a class="compose-email text-info pull-right m-r-10 m-t-10" href="mensajes/create"><i class="fa fa-pencil-square-o"></i></a>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

<div class="app-menu">
  <ul class="nav nav-tabs card-header-tabs ml-0 mr-0 mb-1" role="tablist">
    <li class="nav-item text-center" style="width: 100%">
      <a class="nav-link active" id="first-tab" data-toggle="tab" href="#firstFull" role="tab"
      aria-selected="true">Mensajes</a>
    </li>
  </ul>

  <div class="p-4">

    <div class="tab-content link_mensajeria">
      <div class="tab-pane fade show active" id="firstFull" role="tabpanel" aria-labelledby="first-tab">

        <div class="scroll">
          <a href="/mensajes/create" class="btn btn-danger mb-1 boton_crear_mensaje">Crear mensaje</a>
          <h5>NAVEGACION</h5>
          <ul>
            <li><a href="{{ url('superadmin/mensajes') }}">Recibidos </a><span class="label label-danger label-as-badge pull-right" id="badges" style="color:white;"></span></li>
            <li>
              <a href="{{ url('superadmin/mensajes') }}">Todos</a>
              <ul>
                <li>
                  <a href="{{ url('superadmin/importantes') }}">Importante</a>
                </li>
                <li>
                  <a href="{{ url('superadmin/relevantes') }}">Relevante</a>
                </li>
                <li>
                  <a href="{{ url('superadmin/normales') }}">Normal</a>
                </li>
              </ul>
            </li>
            <li><a href="{{ url('superadmin/enviados') }}">Enviados</a></li>
          </ul>    
        </div>
      </div>
    </div>
  </div>

  <a class="app-menu-button d-inline-block d-xl-none" href="#">
    <i class="simple-icon-refresh"></i>
  </a>
</div>

<br>
<br>




@stop

@section('footer')
@include('layout.footer')
{!!Html::script('vendor/ckeditor/ckeditor.js')!!}
@stop
