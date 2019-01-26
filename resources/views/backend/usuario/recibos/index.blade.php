@extends('layout.mensajes')

@section('sidebar')
@include('backend.menu.usuario')
@stop

@section('head')
@include('layout.head')
@stop


@section('content')



<div class="container-fluid">
  <div class="row">

    <div class="col-md-12">
      <h1 class="breadcrumb">Conjunto Residencial: <strong>Recibos de Pago Administración</strong></h1>
    </div>



    <div class="col-lg-12 col-md-12">
      <div class="card mb-4">
        <div class="card-body ">
          <img alt="" width="100%" src="{{ asset('uploads/banners/bannerfacturas.png') }}"/>
        </div>
      </div>
    </div>


    <div class="col-md-12">
      <div class="card mb-4">
        <div class="card-body ">
          <div class="row">
            <div class="col-md-6 ">
              <h3>Lista de recibos de pago <br><br>
                @if(count($banco) > 0)
                nombre del banco: <b style="color: #000;">{{$banco[0]->nombre}}</b> <br><br>
                Link del banco: <a href="{{$banco[0]->link}}" target="_blank" style="color: #076c9a;">{{$banco[0]->link}}</a><br><br>

                @endif
              </h3>
            </div>
            <div class="col-md-6">
              <form>
                <div class="form-group has-float-label mb-4" style="margin:0 !important">
                  <label class= "text-primary" style="font-weight:bold">Busqueda:</label> 
                  <input id="buscar" type="text" onkeyup="busqueda()" class="form-control" style="width:100%;" placeholder="Escriba aquí el valor a buscar" />
                </div>
              </form>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-12 col-md-12">
      <div class="card mb-4">
        <div class="card-body ">
          <div class="table-responsive">
            <table class="data-table responsive nowrap tabla_bonos_estilos" id="datos">
              <thead>
                <tr>
                  <th style="width: auto;">Valor adeudado</th>
                  <th style="width: auto;">Fecha de corte</th>
                  <th style="width: auto;">Fecha de creación</th>
                  <th style="width: auto;">Estado</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>

                @foreach($recibos as $recibo)

                <?php 

                $date = date_create($recibo->created_at);

                $formato_creacion = date_format($date, 'd/m/Y');

                $date = date_create($recibo->fecha_corte);

                $formato_corte = date_format($date, 'd/m/Y');

                $estado = '<span style="color:orange">Por pagar</span>';

                if($recibo->estado == 2)
                { 
                  $estado = '<span style="color:green">pagado</span>';
                }

                if($recibo->estado == 3)
                { 
                  $estado = '<span style="color:red">Anulado</span>';
                }
                ?>
                <tr>
                  <td class="v-align-middle">{{ $recibo->valor_adeudado }} USD</td>
                  <td class="v-align-middle">{{ $formato_corte }}</td>
                  <td class="v-align-middle">{{ $formato_creacion }}</td>
                  <td class="v-align-middle"><?php echo $estado ?></td>
                  <td>
                    <a href="javascript:;" class="btn btn-secondary btn-xs mb-1" onclick="ver_detalles({{$recibo->id}})" role="menu-item">Ver detalles</a>
                  </td>
                </tr>
                @endforeach

              </tbody>
            </table>

          </div>
        </div>
      </div>
    </div>


  </div>
</div>





<div class="modal" tabindex="-1" role="dialog" id="detalles_modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detalles de la factura</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-hover table-bordered" id="detallesTable">
        </table>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

@if(count($banco) > 0)

<div class="modal" tabindex="-1" role="dialog" id="detalles_banco_modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detalles del banco</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        
      </div>
      <div class="modal-body">
        <table class="table table-hover table-bordered">

          <tr>
            <td>Logotipo</td>
            <td><img src="uploads/bancos/{{$banco[0]->img_banco}}" alt="" style="width:150px;height:auto"></td>
          </tr>
          <tr>
            <td>Nombre</td>
            <td>{{$banco[0]->nombre}}</td>
          </tr>
          <tr>
            <td>País</td>
            <td>{{$banco[0]->pais}}</td>
          </tr>
          <tr>
            <td>Link</td>
            <td><a href="{{$banco[0]->link}}" target="_blank" style="color: #076c9a;">{{$banco[0]->link}}</a></td>
          </tr>
          <tr>
            <td>Número de cuenta</td>
            <td>{{$banco[0]->No_cuenta}}</td>
          </tr>
          <tr>
            <td>Número de convenio</td>
            <td>{{$banco[0]->No_convenio}}</td>
          </tr>
          <tr>
            <td>Tipo de cuenta</td>
            <td>{{$banco[0]->tipo_cuenta}}</td>
          </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

@endif


@stop

@section('footer')
@include ('layout.footer')
{!!Html::script('build/pages/js/pages.social.min.js')!!}
@stop


