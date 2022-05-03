<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="Ecommerce Controll Dash Board" />
        <meta name="author" content="Ecommerce.com" />
        <title>Dashboard</title>
        <!-- loader-->
        <link href="{{ asset('contents/admin') }}/css/pace.min.css" rel="stylesheet" />
        <script src="{{ asset('contents/admin') }}/js/pace.min.js"></script>
        <!--favicon-->
        <link rel="icon" href="{{ asset('contents/admin') }}/images/favicon.ico" type="image/x-icon" />
        <!-- simplebar CSS-->
        <link href="{{ asset('contents/admin') }}/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
        <!-- Bootstrap core CSS-->
        <link href="{{ asset('contents/admin') }}/css/bootstrap.min.css" rel="stylesheet" />
        <!-- animate CSS-->
        <link href="{{ asset('contents/admin') }}/css/animate.css" rel="stylesheet" type="text/css" />
        <!-- Icons CSS-->
        <link href="{{ asset('contents/admin') }}/css/icons.css" rel="stylesheet" type="text/css" />
        <!-- Metismenu CSS-->
        <link href="{{ asset('contents/admin') }}/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
        @stack('ccss')
        <!-- Custom Style-->
        <link href="{{ asset('contents/admin') }}/css/app-style.css" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('contents/admin') }}/custom.css">
        <script src="{{ asset('contents/admin') }}/js/jquery.min.js"></script>
        {{-- <script src="{{ asset('contents/admin') }}/axios.js"></script> --}}

        <!-- សម្រាប់Alert Succes and Error -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

        <script>
            $.ajaxSetup({
                cache:false,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            });
            $( document ).ajaxSuccess((e,res)=>console.log((res.responseJSON && res.responseJSON) || res));
            $( document ).ajaxError(function( event, res ) {
                console.log(res.responseJSON.errors || res);
            });
            function toaster(icon, message){
                Toast.fire({
                    icon: icon,
                    title: message,
                })
            }
        </script>

        <script src="{{ asset('contents/admin') }}/custom.js"></script>
    </head>

    <body class="bg-theme bg-theme1">
        @include('include.flash')
        <!-- Start wrapper-->
        <div id="wrapper">
            <!--Start sidebar-wrapper-->
            <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
                <div class="brand-logo">
                    <img src="{{ asset('contents/admin') }}/images/logo-icon.png" class="logo-icon" alt="logo icon" />
                    <h5 class="logo-text">Ecommerce</h5>
                    <div class="close-btn"><i class="zmdi zmdi-close"></i></div>
                </div>

                @include('admin.includes.sidebar')
            </div>
            <!--End sidebar-wrapper-->

            <!--Start topbar header-->
            @include('admin.includes.header')
            <!--End topbar header-->

            <div class="clearfix"></div>


            @yield('content')


            <!--Start Back To Top Button-->
            <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
            <!--End Back To Top Button-->

            <!--Start footer-->
            @include('admin.includes.footer')
            <!--End footer-->

            <!--start color switcher-->
            @include('admin.includes.switch_color')
            <!--end color switcher-->
        </div>
        <!--End wrapper-->
    </body>

    {{-- file mananger --}}
    @once
        @include('admin.product.components.file_manager')
    @endonce
    
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    <!-- Bootstrap core JavaScript-->

    <script src="{{ asset('contents/admin') }}/js/popper.min.js"></script>
    <script src="{{ asset('contents/admin') }}/js/bootstrap.min.js"></script>

    <!-- simplebar js -->
    <script src="{{ asset('contents/admin') }}/plugins/simplebar/js/simplebar.js"></script>
    <!-- Metismenu js -->
    <script src="{{ asset('contents/admin') }}/plugins/metismenu/js/metisMenu.min.js"></script>
    <!-- Custom scripts -->
    <script src="{{ asset('contents/admin') }}/js/app-script.js"></script>

    @stack('cjs')
</html>

