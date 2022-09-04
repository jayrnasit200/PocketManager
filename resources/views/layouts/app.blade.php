<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

  
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/buttons.dataTables.min.css')}}">
    
   
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/bootstrap/bootstrap.min.css')}}">
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/bootstrap/bootstrap.bundle.min.js')}}"></script>

  <!-- Scripts -->
  <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery-3.5.1.js')}}"></script>
  <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/dataTables.buttons.min.js')}}"></script>
  <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jszip.min.js')}}"></script>
  <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/pdfmake.min.js')}}"></script>
  <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/vfs_fonts.js')}}"></script>
  <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/buttons.html5.min.js')}}"></script>
  <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/buttons.print.min.js')}}"></script>
  <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/sweetalert.min.js')}}"></script>

  
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                        @else
                            
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <b>({{ Auth::user()->account }}) </b>{{ Auth::user()->name }} 
                                </a>
                                
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('account') }}">
                                        {{ __('Account') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ url('books') }}">
                                        {{ __('Books') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    
    @yield('js')
         
</body>
</html>
