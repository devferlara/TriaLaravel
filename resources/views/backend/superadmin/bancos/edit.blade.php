@extends('layout.admin')

@section ('meta')
    <meta name="viewport" content="width=device-width, initial-scale=1">
@stop
<!-- Create General Section Sidebar -->
@section('sidebar')
    <!-- Include the menu -->
    @include('backend.menu.superadmin')
@endsection
        <!-- Create General Section Header -->
@section('head')
    <!-- Include the profile header--> 
    @include ('layout.head')
@endsection

@section ('content')

<div class="page-content-wrapper">
        <div class="content">
    @include ('errors.success')
    @include ('errors.request')
    @include ('errors.errors')

        <div class="col-md-1"></div>

            <div class="panel-group col-md-10">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="p-b-5 text-primary" style="text-align:center;"><span class="semi-bold"> Actualizar </span> Banco </h3>
                        </br>
                        <h5 class="text-info">Actualiza la entidad bancaria que permita recibir los pagos através de sus portales virtuales o convenios.</h5>
                    </div>
                <div class="panel panel-body" style="padding:20px;">
                    {!!Form::model($banco,['route'=> ['superadmin.bancos.update',$banco->id],'method'=>'PUT', 'files'=>'true'])!!}
                    <div class="form-group">
                        {!!Form::label('nombre', 'Nombre', ['class'=>'form-control'])!!}
                        {!!Form::text ('nombre', null, ['class'=>'form-control', 'placeholder'=>'Ingresa el Nombre del Banco'])!!}
                    </div>
                    <div class="form-inline">
                        <div class="form-group col-xs-12 col-md-6">
                            {!!Form::label('pais', 'Pais' , ['class'=>'form-control' , 'style'=>'width:100%'])!!}
                            <select class="form-group" data-init-plugin="select2" id="pais" name="pais" style="width:100%;">
                                <optgroup label="Escoge un Pais">
                                    <option value="Colombia">Colombia</option>
                                    <option value="Ecuador">Ecuador</option>
                                    <option value="Peru">Perú</option>
                                    <option value="Argentina">Argentina</option>
                                    <option value="Espana">España</option>
                                    <option value="USA">Estados Unidos</option>
                                    <option value="Venezuela">Venezuela</option>
                                </optgroup>
                            </select>
                        </div>
                        <div class="form-group col-xs-12 col-md-6" >
                            {!!Form::label('link', 'Link Portal de Pagos', ['class'=>'form-control' , 'style'=>'width:100%'])!!}
                            {!!Form::text('link', null, ['class'=>'form-control', 'style'=>'width:100%', 'placeholder'=>'Indique la página web de pagos del banco'])!!}
                        </div>
                    </div>
                    <div class="col-md-6 form-group" style="margin-top:20px;">
                        {!!Form::label('enabled','Habilitar', ['class'=>'form-label'])!!}
                        {!!Form::checkbox('enabled')!!}
                    </div>
                     <div class="col-md-6 form-group" style="margin-top:20px;">
                        {!!Form::label('img_banco','Cargar logo banco', ['class'=>'form-control', 'style'=>'width:100%'])!!}
                        {!!Form::file('img_banco', null, ['class'=>'btn btn-success', 'style'=>'width:100%'])!!}
                    </div>
                </div>
                <div class="form-group" style="margin: 20px;">
                    {!!Form::submit('Actualizar', ['class'=>'btn btn-primary'])!!}
                    {!!link_to_route('superadmin.bancos.index', $title = 'Cancelar', $parameters = '', $attributes = ['class'=>'btn btn-danger'])!!}
                    {!!Form::close()!!}         
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
</div>
@endsection

@section ('footer')
 @include ('layout.footer')
@stop