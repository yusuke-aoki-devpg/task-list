<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        Task
    </title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/locale/ja.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-datetimepicker/2.7.1/js/bootstrap-material-datetimepicker.min.js"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@500&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-datetimepicker/2.7.1/css/bootstrap-material-datetimepicker.min.css">

</head>
    <body class="bg-primary">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{-- <!-- {{ config('app.name', 'Laravel') }} --> --}}
                    <span class="text-dark">
                        <i class="far fa-check-circle"></i>
                        タスク管理
                    </span>                    
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">
                                        <!-- {{ __('Login') }} -->
                                        ログイン
                                    </a>
                                </li>
                            @endif
                            
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">
                                        <!-- {{ __('Register') }} -->
                                        新規登録
                                    </a>
                                </li>
                            @endif
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/home') }}" class="btn btn-outline-dark mx-2 col-6 mx-auto">
                                        ホーム
                                    </a>
                                </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div class="mt-5 container">
            <div class="row">
                <div class="col-md-7 p-5">
                    <div class="mb-3">
                            <h1 class="text-dark">Lorem ipsum dolor</h1>
                    </div>
                    <div class="mb-5 text-secondary">    
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam praesentium ipsum quaerat provident! Est sapiente libero odio consequatur, maxime in.
                        </p>                
                    </div>
                    <div> 
                        <a href="{{ url('/home') }}" class="btn btn-info text-dark rounded-pill mx-2 col-6 mx-auto">
                            開始
                        </a>
                    </div>          
                </div>
                <div class="col-md-5 d-flex align-items-center">
                    <img src="{{ asset('img/StickyNotes.png') }}" class="img-fluid pc-only" alt="Sticky Notes">            
                </div>
            </div>

        </div>


    </body>
</html>