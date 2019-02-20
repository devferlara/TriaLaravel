<!DOCTYPE html>
<html>
<head>
 
    <title>HGV</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{asset('build/assets/img/logo_login.png')}}"/>
    @yield('meta')

    {!!Html::style('build/assets/font/iconsmind/style.css')!!}
    {!!Html::style('build/assets/font/simple-line-icons/css/simple-line-icons.css')!!}
    {!!Html::style('build/assets/css_new/vendor/bootstrap.min.css')!!}
    {!!Html::style('build/assets/css_new/estilos.css')!!}
    {!!Html::style('build/assets/css_new/vendor/perfect-scrollbar.css')!!}
    {!!Html::style('build/assets/css_new/vendor/bootstrap-float-label.min.css')!!}
    {!!Html::style('build/assets/css_new/vendor/dataTables.bootstrap4.min.css')!!}
    {!!Html::style('build/assets/css_new/vendor/quill.bubble.css')!!}
    {!!Html::style('build/assets/css_new/vendor/datatables.responsive.bootstrap4.min.css')!!}
    {!!Html::style('build/assets/css_new/vendor/quill.snow.css')!!}
    {!!Html::style('build/assets/css_new/vendor/quill.bubble.css')!!}
    {!!Html::style('build/assets/css_new/main.css')!!}
    

  
</head>
<body id="app-container" class="menu-default show-spinner latouy_mensaje">
<!-- START PAGE-CONTAINER -->
    @yield('sidebar')
    @yield('head')
<main>

    

    @yield('content')

    @yield('footer')
</main>
<!-- END PAGE CONTAINER -->
<!-- BEGIN VENDOR JS -->
{!!Html::script('build/assets/js_new/vendor/jquery-3.3.1.min.js')!!}
{!!Html::script('build/assets/js_new/vendor/bootstrap.bundle.min.js')!!}
{!!Html::script('build/assets/js_new/vendor/perfect-scrollbar.min.js')!!}
{!!Html::script('build/assets/js_new/vendor/datatables.min.js')!!}
{!!Html::script('build/assets/js_new/vendor/mousetrap.min.js')!!}
{!!Html::script('build/assets/js/scripts.js')!!}
{!!Html::script('build/assets/js_new/vendor/ckeditor5-build-classic/ckeditor.js')!!}
{!!Html::script('build/assets/js_new/vendor/select2.full.js')!!}
{!!Html::script('build/assets/js_new/dore.script.js')!!}
{!!Html::script('build/assets/js/init.js')!!}
{!!Html::script('build/assets/js/perfil_socio.js')!!}
{!!Html::script('build/assets/js/script/listarciudades.js?v=1')!!}
{!!Html::script('build/assets/js/script/pagos.js')!!}
{!!Html::script('build/assets/js_new/scripts.js')!!}



</body>
</html>