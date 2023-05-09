<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>SDC | @yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link href="{{ asset('/images/logo.png') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('adminlte/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('adminlte/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css')}}" rel="stylesheet" />
    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('adminlte/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('adminlte/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
        {{-- Toasrt --}}
    <link href="{{ asset('adminlte/toastr/build/toastr.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('adminlte/toastr/build/toastrall.min.css') }}" rel="stylesheet" />
    {{-- Font-awsesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <script type="text/javascript">
        var root = '{{url("/")}}';
        var mn_selected = '';
    </script>
    @notifyCss
</head>

<body>
<div class="container-fluid position-relative bg-white d-flex p-0">
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Sidebar Start -->
    @include('admin.layouts.main-sidebar')
    <!-- Sidebar End -->


    <!-- Content Start -->
    <div class="content">
        <!-- Navbar Start -->
            @include('admin.layouts.header')
        <!-- Navbar End -->

        <div class="content-wrapper">
            <section class="content-header">
                @yield('breadcrumb')
                <div class="row">
                    <div class="col-xs-12">
                        <div id="flash_message">
                            @if(Session::has('message'))
                                <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissable">
                                    <button data-dismiss="alert" class="close" type="button">
                                        <i class="ace-icon fa fa-times"></i>
                                    </button>
                                    {{Session::get('message')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </section>

            <!-- Main content -->
            <section class="mh-100vh container-fluid mt-2">
                @yield('content')
            </section>
            <!-- /.content -->
        </div>


        <!-- Footer Start -->
            @include('admin.layouts.footer')
        <!-- Footer End -->
        @include('admin.layouts.deleteModal')

    </div>
    <!-- Content End -->
</div>
<x:notify-messages />
@notifyJs
<!-- JavaScript Libraries -->
<script src="{{asset('adminlte/js/jquery-3.4.1.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('adminlte/lib/chart/chart.min.js')}}"></script>
<script src="{{asset('adminlte/lib/easing/easing.min.js')}}"></script>
<script src="{{asset('adminlte/lib/waypoints/waypoints.min.js')}}"></script>
<script src="{{asset('adminlte/lib/owlcarousel/owl.carousel.min.js')}}"></script>
<script src="{{asset('adminlte/lib/tempusdominus/js/moment.min.js')}}"></script>
<script src="{{asset('adminlte/lib/tempusdominus/js/moment-timezone.min.js')}}"></script>
<script src="{{asset('adminlte/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Select2 -->
<script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Template Javascript -->
<script src="{{asset('adminlte/js/main.js')}}"></script>
<!-- notify -->
<script src="{{ asset('adminlte/js/notify.js') }}"></script>
<script src="{{ asset('adminlte/js/notify.min.js') }}"></script>
<!-- ckeditor -->
<script src="{{asset('adminlte\ckeditor\ckeditor.js')}}"></script>
<script src="{{asset('adminlte/dist/js/bootstrap.min.js')}}"></script>
@yield('script')
</body>

</html>
