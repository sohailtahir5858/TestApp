<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <!-- DataTable-->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>



            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('logout') }}" class="nav-link"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('words.Logout') }}</a>
                </li>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>


                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Config::get('languages')[App::getLocale()] }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        @foreach (Config::get('languages') as $lang => $language)
                            @if ($lang != App::getLocale())
                                <a class="dropdown-item" href="{{ route('lang.switch', $lang) }}">
                                    {{ $language }}</a>
                            @endif
                        @endforeach
                    </div>
                </li>
            </ul>


        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('layouts.included.sidebar')
        <!-- /.Main Sidebar Container -->


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->



        <!-- Foooter section.  -->
        @include('layouts.included.footer')
        <!-- /.Footer Section -->


    </div>
    <!-- ./wrapper -->


    <!-- jQuery -->
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('adminlte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte/dist/js/adminlte.js') }}"></script>
    <!-- Datatable -->
    <script src="{{ asset('/adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

    @yield('script')


    {{-- SCript to highlight current active navlink --}}
    <script>
        var url = window.location;
        const allLinks = document.querySelectorAll('.nav-item a');
        const currentLink = [...allLinks].filter(e => {
            return e.href == url;
        });

        currentLink[0].classList.add("active")
        currentLink[0].closest(".nav-treeview").style.display = "block";
        currentLink[0].closest(".has-treeview").classList.add("active");
    </script>
</body>

</html>
