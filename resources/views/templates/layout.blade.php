<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Teste Componente</title>

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css?v=1.1') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <!-- JS -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    <!-- Fontawesome -->
    <script src="https://kit.fontawesome.com/32145166b6.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">

    <!-- Tiny -->
    <!--<script src="https://cdn.tiny.cloud/1/bvf7u1qahv81zfl22y44kw2bb9ahrnjw2b755pv2dqw8aw44/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/tinymce@5.1.5/tinymce.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/mathlive@0.33.2/dist/mathlive.min.js"></script>


    

    @stack('js')

</head>
<body>
    <br/>
    <div class="container-fluid">
        @stack('alerts')
        <div id="app">
            @yield('body')
        </div>
    </div>
</body>

    <!-- Vue Js -->
    <script src="https://unpkg.com/vue@3"></script>

    <!-- CKEditor5 -->
    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/decoupled-document/ckeditor.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/decoupled-document/translations/pt-br.js"></script>

    <!-- APP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js?v=1.0') }}"></script>

    
</html>