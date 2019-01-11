@extends('layout.admin')

@section ('meta')
    <meta name="viewport" content="width=device-width, initial-scale=1">
@stop
<!-- Create General Section Sidebar -->
@section('sidebar')
    <!-- Include the menu -->
    @include('backend.menu.administrador')
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
                        <h3 class="p-b-5 text-primary" style="text-align:center;"><span class="semi-bold"> Crear </span> Banco </h3>
                        </br>
                        <h5 class="text-info">Crea la entidad bancaria que permita recibir los pagos através de sus portales virtuales o convenios.</h5>
                    </div>
                <div class="panel panel-body" style="padding:20px;">

                    {!!Form::model($banco,['route'=> ['administrador.bancos.update',$banco[0]->id],'method'=>'PUT', 'files'=>'true'])!!}
                    <div class="form-group">
                        {!!Form::label('nombre', 'Nombre', ['class'=>'form-control'])!!}
                        {!!Form::text ('nombre',$banco[0]->nombre ,['class'=>'form-control', 'placeholder'=>'Ingresa el Nombre del Banco'])!!}
                    </div>
                    <div class="form-inline">
                        <div class="form-group col-xs-12 col-md-6">
                            {!!Form::label('pais', 'Pais' , ['class'=>'form-control' , 'style'=>'width:100%'])!!}
                            <select class="form-group" data-init-plugin="select2" id="pais" name="pais" style="width:100%;">
                                <optgroup label="Escoge un Pais">
                                    <option value="Colombia">Colombia</option>
                                    <option value="Ecuador" <?= $banco[0]->pais == 'Ecuador'?'selected':''?>>Ecuador</option>
                                    <option value="Peru" <?= $banco[0]->pais == 'Peru'?'selected':''?>>Perú</option>
                                    <option value="Argentina" <?= $banco[0]->pais == 'Argentina'?'selected':''?>>Argentina</option>
                                    <option value="Espana" <?= $banco[0]->pais == 'Espana'?'selected':''?>>España</option>
                                    <option value="USA" <?= $banco[0]->pais == 'USA'?'selected':''?>>Estados Unidos</option>
                                    <option value="Venezuela" <?= $banco[0]->pais == 'Venezuela'?'selected':''?>>Venezuela</option>
                                </optgroup>
                            </select>
                        </div>
                        <div class="form-group col-xs-12 col-md-6" >
                            {!!Form::label('link', 'Link Portal de Pagos', ['class'=>'form-control' , 'style'=>'width:100%'])!!}
                            {!!Form::text('link', $banco[0]->link, ['class'=>'form-control', 'style'=>'width:100%', 'placeholder'=>'Indique la página web de pagos del banco'])!!}
                        </div>
                    </div>
                    <div class="col-md-6 form-group" style="margin-top:20px;">
                        {!!Form::label('enabled','Habilitar', ['class'=>'form-label'])!!}
                        <input type="checkbox" value="1" name="enabled" <?= $banco[0]->enabled == 1?'checked':''?>>
                    </div>
                    <div class="col-md-6 form-group" style="margin-top:20px;">
                        {!!Form::label('img_banco','Cargar logo banco', ['class'=>'form-control', 'style'=>'width:100%'])!!}
                        {!!Form::file('img_banco', null, ['class'=>'btn btn-success', 'style'=>'width:100%'])!!}
                    </div>
                    <div class="form-group col-md-6">
                            {!!Form::label('tipo_cuenta', 'Tipo de Cuenta', ['class'=>'form-control'])!!}
                            <select class="form-group" data-init-plugin="select2" id="tipo_cuenta" name="tipo_cuenta" style="width:100%;">
                                <optgroup label="Escoge un tipo de cuenta">
                                    <option value="Ahorros">Cuenta de Ahorros</option>
                                    <option value="Corriente" <?= $banco[0]->tipo_cuenta == 'Corriente'?'selected':''?>>Cuenta Corriente</option>
                                </optgroup>
                            </select>
                    </div>
                    <div class="form-inline">
                        <div class="form-group col-xs-12 col-md-6" >
                            {!!Form::label('No_cuenta', 'Número de Cuenta', ['class'=>'form-control' , 'style'=>'width:100%'])!!}
                            {!!Form::text('No_cuenta', $banco[0]->No_cuenta, ['class'=>'form-control', 'style'=>'width:100%', 'placeholder'=>'Indique el Número de cuenta'])!!}
                        </div>
                        <div class="form-group col-xs-12 col-md-6" >
                            {!!Form::label('No_convenio', 'No de Convenio Bancario', ['class'=>'form-control' , 'style'=>'width:100%'])!!}
                            {!!Form::text('No_convenio', $banco[0]->No_convenio, ['class'=>'form-control', 'style'=>'width:100%', 'placeholder'=>'Indique el Número de convenio'])!!}
                        </div>
                    </div>
                </div>
                <div class="form-group" style="margin: 20px;">
                    {!!Form::submit('Editar', ['class'=>'btn btn-primary'])!!}
                    {!!link_to_route('administrador.bancos.index', $title = 'Cancelar', $parameters = '', $attributes = ['class'=>'btn btn-danger'])!!}
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