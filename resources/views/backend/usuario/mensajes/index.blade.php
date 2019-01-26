@extends('layout.mensajes')

<!-- Create General Section Sidebar -->
@section('sidebar')
<!-- Include the menu -->
@include('backend.menu.usuario')
@stop

<!-- Create General Section Header -->
@section('head')
<!-- Include the profile header -->
@include('layout.head')

@stop

@section('css')

@stop

@section ('content')

<div class="container-fluid">
  <div class="row">
    <div class="app-menu">
      <ul class="nav nav-tabs card-header-tabs ml-0 mr-0 mb-1" role="tablist">
        <li class="nav-item w-50 text-center">
          <a class="nav-link active" id="first-tab" data-toggle="tab" href="#firstFull" role="tab"
          aria-selected="true">Messages</a>
        </li>
        <li class="nav-item w-50 text-center">
          <a class="nav-link" id="second-tab" data-toggle="tab" href="#secondFull" role="tab" aria-selected="false">Contacts</a>
        </li>
      </ul>

      <div class="p-4">
        <div class="form-group">
          <input type="text" class="form-control rounded" placeholder="Search">
        </div>
        <div class="tab-content">
          <div class="tab-pane fade show active" id="firstFull" role="tabpanel" aria-labelledby="first-tab">

            <div class="scroll">

              <div class="d-flex flex-row mb-1 border-bottom pb-3 mb-3">
                <a class="d-flex" href="#">
                  <img alt="Profile Picture" src="img/profile-pic-l.jpg" class="img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall">
                </a>
                <div class="d-flex flex-grow-1 min-width-zero">
                  <div class="pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                    <div class="min-width-zero">
                      <a href="#">
                        <p class=" mb-0 truncate">Sarah Kortney</p>
                      </a>
                      <p class="mb-1 text-muted text-small">14:20</p>
                    </div>
                  </div>
                </div>
              </div>


              <div class="d-flex flex-row mb-1 border-bottom pb-3 mb-3">
                <a class="d-flex" href="#">
                  <img alt="Profile Picture" src="img/profile-pic-l-2.jpg" class="img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall">
                </a>
                <div class="d-flex flex-grow-1 min-width-zero">
                  <div class="pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                    <div class="min-width-zero">
                      <a href="#">
                        <p class=" mb-0 truncate">Rasheeda Vaquera</p>
                      </a>
                      <p class="mb-1 text-muted text-small">11:10</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="d-flex flex-row mb-1 border-bottom pb-3 mb-3">
                <a class="d-flex" href="#">
                  <img alt="Profile Picture" src="img/profile-pic-l-3.jpg" class="img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall">
                </a>
                <div class="d-flex flex-grow-1 min-width-zero">
                  <div class="pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                    <div class="min-width-zero">
                      <a href="#">
                        <p class=" mb-0 truncate">Shelia Otterson</p>
                      </a>
                      <p class="mb-1 text-muted text-small">09:50</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="d-flex flex-row mb-1  pb-3 mb-3">
                <a class="d-flex" href="#">
                  <img alt="Profile Picture" src="img/profile-pic-l-4.jpg" class="img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall">
                </a>
                <div class="d-flex flex-grow-1 min-width-zero">
                  <div class="pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                    <div class="min-width-zero">
                      <a href="#">
                        <p class=" mb-0 truncate">Latarsha Gama</p>
                      </a>
                      <p class="mb-1 text-muted text-small">09:10</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="tab-pane fade" id="secondFull" role="tabpanel" aria-labelledby="second-tab">
            <div class="scroll">

              <div class="d-flex flex-row mb-3 border-bottom pb-3">
                <a class="d-flex" href="#">
                  <img alt="Profile Picture" src="img/profile-pic-l.jpg" class="img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall">
                </a>
                <div class="d-flex flex-grow-1 min-width-zero">
                  <div class="m-2 pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                    <div class="min-width-zero">
                      <a href="#">
                        <p class="mb-0 truncate">Sarah Kortney</p>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="d-flex flex-row mb-3 border-bottom pb-3">
                <a class="d-flex" href="#">
                  <img alt="Profile Picture" src="img/profile-pic-l-2.jpg" class="img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall">
                </a>
                <div class="d-flex flex-grow-1 min-width-zero">
                  <div class="m-2 pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                    <div class="min-width-zero">
                      <a href="#">
                        <p class="mb-0 truncate">Williemae Lagasse</p>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="d-flex flex-row mb-3 border-bottom pb-3">
                <a class="d-flex" href="#">
                  <img alt="Profile Picture" src="img/profile-pic-l-3.jpg" class="img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall">
                </a>
                <div class="d-flex flex-grow-1 min-width-zero">
                  <div class="m-2 pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                    <div class="min-width-zero">
                      <a href="#">
                        <p class="mb-0 truncate">Tommy Nash</p>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="d-flex flex-row mb-3 border-bottom pb-3">
                <a class="d-flex" href="#">
                  <img alt="Profile Picture" src="img/profile-pic-l-4.jpg" class="img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall">
                </a>
                <div class="d-flex flex-grow-1 min-width-zero">
                  <div class="m-2 pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                    <div class="min-width-zero">
                      <a href="#">
                        <p class="mb-0 truncate">Mayra Sibley</p>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="d-flex flex-row mb-3 border-bottom pb-3">
                <a class="d-flex" href="#">
                  <img alt="Profile Picture" src="img/profile-pic-l-5.jpg" class="img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall">
                </a>
                <div class="d-flex flex-grow-1 min-width-zero">
                  <div class="m-2 pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                    <div class="min-width-zero">
                      <a href="#">
                        <p class="mb-0 truncate">Kathryn Mengel</p>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="d-flex flex-row mb-3 border-bottom pb-3">
                <a class="d-flex" href="#">
                  <img alt="Profile Picture" src="img/profile-pic-l-2.jpg" class="img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall">
                </a>
                <div class="d-flex flex-grow-1 min-width-zero">
                  <div class="m-2 pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                    <div class="min-width-zero">
                      <a href="#">
                        <p class="mb-0 truncate">Williemae Lagasse</p>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="d-flex flex-row mb-3 border-bottom pb-3">
                <a class="d-flex" href="#">
                  <img alt="Profile Picture" src="img/profile-pic-l-3.jpg" class="img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall">
                </a>
                <div class="d-flex flex-grow-1 min-width-zero">
                  <div class="m-2 pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                    <div class="min-width-zero">
                      <a href="#">
                        <p class="mb-0 truncate">Tommy Nash</p>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="d-flex flex-row mb-3 border-bottom pb-3">
                <a class="d-flex" href="#">
                  <img alt="Profile Picture" src="img/profile-pic-l-4.jpg" class="img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall">
                </a>
                <div class="d-flex flex-grow-1 min-width-zero">
                  <div class="m-2 pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                    <div class="min-width-zero">
                      <a href="#">
                        <p class="mb-0 truncate">Mayra Sibley</p>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="d-flex flex-row mb-3 border-bottom pb-3">
                <a class="d-flex" href="#">
                  <img alt="Profile Picture" src="img/profile-pic-l-3.jpg" class="img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall">
                </a>
                <div class="d-flex flex-grow-1 min-width-zero">
                  <div class="m-2 pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                    <div class="min-width-zero">
                      <a href="#">
                        <p class="mb-0 truncate">Tommy Nash</p>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="d-flex flex-row mb-3 border-bottom pb-3">
                <a class="d-flex" href="#">
                  <img alt="Profile Picture" src="img/profile-pic-l-4.jpg" class="img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall">
                </a>
                <div class="d-flex flex-grow-1 min-width-zero">
                  <div class="m-2 pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                    <div class="min-width-zero">
                      <a href="#">
                        <p class="mb-0 truncate">Mayra Sibley</p>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="d-flex flex-row mb-3 border-bottom pb-3">
                <a class="d-flex" href="#">
                  <img alt="Profile Picture" src="img/profile-pic-l-5.jpg" class="img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall">
                </a>
                <div class="d-flex flex-grow-1 min-width-zero">
                  <div class="m-2 pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                    <div class="min-width-zero">
                      <a href="#">
                        <p class="mb-0 truncate">Kathryn Mengel</p>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="d-flex flex-row mb-3 border-bottom pb-3">
                <a class="d-flex" href="#">
                  <img alt="Profile Picture" src="img/profile-pic-l-2.jpg" class="img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall">
                </a>
                <div class="d-flex flex-grow-1 min-width-zero">
                  <div class="m-2 pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                    <div class="min-width-zero">
                      <a href="#">
                        <p class="mb-0 truncate">Williemae Lagasse</p>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="d-flex flex-row mb-3 border-bottom pb-3">
                <a class="d-flex" href="#">
                  <img alt="Profile Picture" src="img/profile-pic-l-3.jpg" class="img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall">
                </a>
                <div class="d-flex flex-grow-1 min-width-zero">
                  <div class="m-2 pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                    <div class="min-width-zero">
                      <a href="#">
                        <p class="mb-0 truncate">Tommy Nash</p>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="d-flex flex-row mb-3 pb-3">
                <a class="d-flex" href="#">
                  <img alt="Profile Picture" src="img/profile-pic-l-4.jpg" class="img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall">
                </a>
                <div class="d-flex flex-grow-1 min-width-zero">
                  <div class="m-2 pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                    <div class="min-width-zero">
                      <a href="#">
                        <p class="mb-0 truncate">Mayra Sibley</p>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

      <a class="app-menu-button d-inline-block d-xl-none" href="#">
        <i class="simple-icon-refresh"></i>
      </a>
    </div>
  </div>
</div>







<div class="page-content-wrapper full-height">
  <div class="content full-height">
    @include ('errors.errors')
    @include ('errors.success')
    @include ('errors.request')
    <div class="email-wrapper">

      <nav class="email-sidebar padding-30">
        <a href="mensajes/create" class="btn btn-complete btn-block btn-danger m-b-30" style="margin-top:10px;">Crear Mensaje</a>
        <p class="menu-title">NAVEGACION</p>
        <ul class="main-menu">
          <li class="active">
            <a href="{{ url('usuario/mensajes') }}" id="inbox">
              <span class="title"><i class="pg-inbox"></i> Recibidos</span>
              <span class="label label-danger label-as-badge pull-right" id="badges" style="color:white;"></span>
            </a>
          </li>
          <li class="">
            <a href="{{ url('usuario/mensajes') }}">
              <span class="title"><i class="pg-folder"></i> Todos</span>
            </a>
            <ul class="sub-menu no-padding">
              <li>
                <a href="{{ url('usuario/importantes') }}">
                  <span class="title">Importante</span>
                </a>
              </li>
              <li>
                <a href="{{ url('usuario/relevantes') }}">
                  <span class="title">Relevante</span>
                </a>
              </li>
              <li>
                <a href="{{ url('usuario/normales') }}">
                  <span class="title">Normal</span>
                </a>
              </li>
            </ul>
          </li>
          <li>
            <a href="{{ url('usuario/enviados') }}" id="enviados">
              <span class="title"><i class="pg-sent"></i> Enviados</span>
            </a>
          </li>
        </ul>
      </nav>

      <div class="email-list b-r b-grey"> <a class="email-refresh" href="mensajes"><i class="fa fa-refresh"></i></a>
        <div id="emailList">
        </div>
      </div>
      <!-- END EMAILS LIST -->
      <!-- START OPENED EMAIL -->
      <div class="email-opened">
        <div class="no-email">
          <h1>No ha seleccionado ningun mensaje o su bandeja esta vacia</h1>
        </div>
        <div class="email-content-wrapper">
          <div class="actions-wrapper menuclipper bg-master-lightest">
            <ul class="actions menuclipper-menu no-margin p-l-20 ">
              <li class="visible-sm-inline-block visible-xs-inline-block">
                <a href="{{ url('usuario/mensajes') }}" class="email-list-toggle"><i class="fa fa-angle-left"></i> Todos Msg</a>
              </li>
              <li class="no-padding "><a href="#" id="btnresponder" class="text-info"><i class="fa fa-reply"></i> Responder</a></li>
              <li class="no-padding "><a href="{{ url('usuario/mensajes') }}" id="btnleido"><i class="fa fa-thumb-tack"></i> Marcar como leido</a></li>
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
                {!!link_to_route('usuario.mensajes.index',  $title = 'Cancelar', $parameters = null, $attributes = ['class'=>'btn btn-danger'])!!}
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
@stop


@section('footer')

@include('layout.footer')

@stop

@section('js_library')
{!!Html::script('vendor/ckeditor/ckeditor.js')!!}
@stop

@section('specific_js')

@stop