<!DOCTYPE html>
<html>
<head>
    <title>TRIA</title>
    @yield('meta')

    
    {!!Html::style('build/assets/plugins/pace/pace-theme-flash.css')!!}
    {!!Html::style('build/assets/plugins/boostrapv3/css/bootstrap.min.css')!!}
    {!!Html::style('build/assets/plugins/font-awesome/css/font-awesome.css')!!}
    {!!Html::style('build/assets/plugins/jquery-scrollbar/jquery.scrollbar.css')!!}
    {!!Html::style('build/assets/plugins/bootstrap-select2/select2.css')!!}
    {!!Html::style('build/assets/plugins/switchery/css/switchery.min.css')!!}
    {!!Html::style('build/pages/css/pages-icons.css')!!}
    {!!Html::style('build/pages/css/pages.css')!!}
    {!!Html::style('build/assets/plugins/bootstrap3-wysihtml5/bootstrap3-wysihtml5.min.css')!!}
    {!!Html::style('build/assets/plugins/jquery-menuclipper/jquery.menuclipper.css')!!}
    {!!Html::style('build/assets/plugins/bootstrap-tag/bootstrap-tagsinput.css')!!}


    @yield('css')
    <!--[if lte IE 9]>
    <link href="pages/css/ie9.css') }}" rel="stylesheet" type="text/css" />
    <![endif]-->
    <script type="text/javascript">
        window.onload = function()
        {
            // fix for windows 8
            if (navigator.appVersion.indexOf("Windows NT 6.2") != -1)
                document.head.innerHTML += '<link rel="stylesheet" type="text/css" href="pages/css/windows.chrome.fix.css" />'
        }
    </script>

</head>
<body class="fixed-header">
<!-- START PAGE-CONTAINER -->

@yield('sidebar')

<div class="page-container">


    @yield('head')

    @yield('content')
    
    @yield('footer')

</div>

{!!Html::script('build/assets/plugins/pace/pace.min.js')!!}
{!!Html::script('build/assets/js/script/jquery-2.1.0.min.js')!!}
{!!Html::script('build/assets/plugins/modernizr.custom.js')!!}
{!!Html::script('build/assets/plugins/jquery-ui/jquery-ui.min.js')!!}
{!!Html::script('build/assets/plugins/boostrapv3/js/bootstrap.min.js')!!}
{!!Html::script('build/assets/plugins/jquery/jquery-easy.js')!!}
{!!Html::script('build/assets/plugins/jquery-unveil/jquery.unveil.min.js')!!}
{!!Html::script('build/assets/plugins/jquery-bez/jquery.bez.min.js')!!}
{!!Html::script('build/assets/plugins/jquery-ios-list/jquery.ioslist.min.js')!!}
{!!Html::script('build/assets/plugins/jquery-actual/jquery.actual.min.js')!!}
{!!Html::script('build/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js')!!}
{!!Html::script('build/assets/plugins/bootstrap-select2/select2.min.js')!!}
{!!Html::script('build/assets/plugins/classie/classie.js')!!}
{!!Html::script('build/assets/plugins/switchery/js/switchery.min.js')!!}
{!!Html::script('build/assets/plugins/bootstrap3-wysihtml5/bootstrap3-wysihtml5.all.min.js')!!}
{!!Html::script('build/assets/plugins/jquery-menuclipper/jquery.menuclipper.js')!!}
{!!Html::script('build/assets/plugins/bootstrap-tag/bootstrap-tagsinput.min.js')!!}


@yield('js_library')

<!-- END VENDOR JS -->
<!-- BEGIN CORE TEMPLATE JS -->
{!!Html::script('build/pages/js/pages.min.js')!!}
{!!Html::script('build/pages/js/pages.email.js')!!}

<!-- BEGIN PAGE LEVEL JS -->


@yield('specific_js')

{!!Html::script('build/assets/js/scripts.js')!!}


</body>
</html>