@extends('layout.admin')

@section('sidebar')
@include('backend.menu.superadmin')
@stop


@section('head')
@include('layout.head')
@stop


@section('content')
<style>
.table thead tr th, .table tbody tr td {
  text-align: center;
}
#map-canvas  {
  float:left;
  width: 50%;
  height: 400px;
}
#pano  {
  float:left;
  width: 50%;
  height: 400px;
}
</style>
<div class="container-fluid">

  <div class="row">
    <div class="col-md-12">
      <div class="card mb-4">
        <div class="card-body ">
          <img width="100%" src="{{ asset('uploads/banners/conjunto/'.$conjunto->banner_conjunto) }}">
        </div>
      </div>
    </div>

    <div class="col-md-12">
      <div class="card mb-4">
        <div class="card-body ">
          <div style="float: left;margin-right: 20px">
            <img width="130px" class="profile-photo" src="{{ asset('uploads/banners/conjunto/'.$conjunto->img_perfil) }}" />
          </div>
          <div style="float: left">
            <h5 class=" no-margin" style="font-style: italic">Conjunto Residencial</h5>
            <h2 class="no-margin"><span class="semi-bold">{{ $conjunto->nombre}}</span></h2>
            <br>
            {!!link_to_route('superadmin.conjuntos.edit', $title = 'Editar Perfl Conjunto', $parameters = $conjunto->id, $attributes = ['class'=>'btn btn-primary'])!!}
            <input type="hidden" id="map_latitud" value="{{ $conjunto->map_latitud }}">
            <input type="hidden" id="map_longitud" value="{{ $conjunto->map_longitud }}">
          </div>
        </div>
      </div>
    </div>



    <div class="col-md-4 estilos_edit_conjuntos">
      <div class="card mb-4">
        <div class="card-body ">
          <div class="row">
            @foreach ($administrador as $admin)
            <div class="social-user-profile col-xs-height text-center col-top col-md-3">
              <div class="thumbnail-wrapper d48 circular bordered b-white">
                <img alt="Avatar" width="100%" height="auto" data-src-retina="{{ asset('build/assets/img/profiles/user.png') }}" data-src="{{ asset('build/assets/img/profiles/user.png') }}" src="{{ asset('build/assets/img/profiles/user.png') }}">
              </div>
              <br>
              <i class="fa fa-check-circle text-success fs-16 m-t-10"></i>
            </div>
            <div class="col-md-9">
              <p class="hint-text m-t-5">Datos Administrador</p>
              <h3 class="no-margin">{{$admin->usuarios->nombres}} {{$admin->usuarios->apellidos}}</h3>
              <p class="no-margin fs-16">{{$admin->usuarios->rol}}</p>
              <p class="hint-text m-t-5 small">{{$admin->usuarios->email}} / Teléfono: {{$admin->usuarios->telefono}} {{$admin->usuarios->celular}}</p>
              {!!link_to_route('superadmin.usuarios.edit', $title = 'Editar Perfil Admin', $parameters = $admin->usuarios->id , $attributes = ['class'=>'btn btn-success'])!!}
            </div>

            @endforeach
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4 estilos_edit_conjuntos">
      <div class="card mb-4">
        <div class="card-body ">
          <p class="hint-text m-t-5">Datos Conjunto:</p></br>
          <h3 class="no-margin">{{$conjunto->ciudad}} / {{$conjunto->localidad}}</h3>
          <h3 class="no-margin">{{$conjunto->barrio}} / {{$conjunto->direccion}}</h3>
        </div>
      </div>
    </div>

    <div class="col-md-4 estilos_edit_conjuntos">
      <div class="card mb-4">
        <div class="card-body ">
          <p class="hint-text m-t-5">{{$data = $count->contarUsuariosConjunto($conjunto->id)}} Usuarios Activos</p>
          <ul class="list-unstyled ">
            <li class="m-r-10">
              <div class="thumbnail-wrapper d32 circular b-white m-r-5 b-a b-white">
                <img width="35" height="35" data-src-retina="{{ asset('build/assets/img/profiles/user.png') }}" data-src="{{ asset('build/assets/img/profiles/user.png') }}" alt="Profile Image" src="{{ asset('build/assets/img/profiles/user.png') }}">
              </div>
            </li>
            <li>
              <div class="thumbnail-wrapper d32 circular b-white m-r-5 b-a b-white">
                <img width="35" height="35" data-src-retina="{{ asset('build/assets/img/profiles/user.png') }}" data-src="{{ asset('build/assets/img/profiles/user.png') }}" alt="Profile Image" src="{{ asset('build/assets/img/profiles/user.png') }}">
              </div>
            </li>
            <li>
              <div class="thumbnail-wrapper d32 circular b-white m-r-5 b-a b-white">
                <img width="35" height="35" data-src-retina="{{ asset('build/assets/img/profiles/user.png') }}" data-src="{{ asset('build/assets/img/profiles/user.png') }}" alt="Profile Image" src="{{ asset('build/assets/img/profiles/user.png') }}">
              </div>
            </li>
            <li>
              <div class="thumbnail-wrapper d32 circular b-white m-r-5 b-a b-white">
                <img width="35" height="35" data-src-retina="{{ asset('build/assets/img/profiles/user.png') }}" data-src="{{ asset('build/assets/img/profiles/user.png') }}" alt="Profile Image" src="{{ asset('build/assets/img/profiles/user.png') }}">
              </div>
            </li>
            <li>
              <div class="thumbnail-wrapper d32 circular b-white">
                <div class="bg-master text-center text-white"><span>{{$data = ($count->contarUsuariosConjunto($conjunto->id))-4}}</span>
                </div>
              </div>
            </li>
          </ul>
          <br>
          <p class="m-t-5 small">Residentes Conjunto</p>
        </div>
      </div>
    </div>

    <div class="col-md-12">
      <div class="card mb-4">
        <div class="card-body ">
          <div id="map-canvas"></div>
          <div id="pano"></div>
        </div>
      </div>
    </div>


    <div class="col-md-12 ">
      <div class="card mb-4">
        <div class="card-body ">
          <div class="row">
            <div class="col-md-6">
              <h5>Listado de Usuarios:</h5>
              <h2><strong>{!!$conjunto->nombre!!}</strong> </h2>
            </div>
            <div class="col-md-6">
              <form>
                <div class="form-group has-float-label mb-4">
                  <label class= "text-primary" style="font-weight:bold">Busqueda:</label> 
                  <input id="buscar" type="text" onkeyup="busqueda()" class="form-control" style="width:100%;" placeholder="Escriba aquí el valor a buscar" />
                </div>
              </form>
            </div>

          </div>
        </div>
      </div>
    </div>



    <div class="col-md-12 ">
      <div class="card mb-4">
        <div class="card-body">
          <div class="table-responsive">
            <table class="data-table responsive nowrap tabla_bonos_estilos" id= "datos">
              <thead>
                <tr>
                  <th style="width: auto;">Identificacion</th>
                  <th style="width: auto;">Nombres</th>
                  <th style="width: auto;">Apellidos</th>
                  <th style="width: auto;">Email</th>
                  <th style="width: auto;">Tipo Residente</th>
                  <th style="width: auto;">Unidad</th>
                  <th style="width: auto;">Apartamento</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($zonas as $zona)
                @foreach ($zona->apartamentos as $apartamento)
                @foreach ($apartamento->usuarios as $usuario)
                <tr>
                  <td class="v-align-middle">{{ $usuario->identificacion }}</td>
                  <td class="v-align-middle">{{ $usuario->nombres }}</td>
                  <td class="v-align-middle">{{ $usuario->apellidos }}</td>
                  <td class="v-align-middle">{{ $usuario->email }}</td>
                  @if($usuario->propietario = 1)
                  <td class="v-align-middle">Propietario</td>
                  @else <td class="v-align-middle">Arrendatario</td> 
                  @endif
                  <td class="v-align-middle">{{ $zona->tipo }} {{ $zona->zona }}</td>
                  <td class="v-align-middle">{{ $apartamento->apartamento }}</td>
                </tr>
                @endforeach
                @endforeach
                @endforeach
              </tbody>
            </table>
            {!!$zonas->render()!!}
          </div>
          <h6 style="font-weight:bold"> Total de usuarios Registrados: {{$data = $count->contarUsuariosConjunto($conjunto->id)}} </h6>
          <h6 style="font-weight:bold"> Total de usuarios sin actualizar datos: {{$data = $count->contarNoRegistradosConjunto($conjunto->id)}} </h6>
        </div>
      </div>
    </div>


  </div>
</div>

@stop

@section('footer')
@include ('layout.footer')
{!!Html::script('https://maps.googleapis.com/maps/api/js?key=AIzaSyD6tig7C2Lj9bG3BKOko3v06CC6X-QUnaA')!!}
@stop


