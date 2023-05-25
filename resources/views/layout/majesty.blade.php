<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>SIBAMI</title>
        <link rel="stylesheet" href="{{url('/majesty/vendors/mdi/css/materialdesignicons.min.css')}}">
        <link rel="stylesheet" href="{{url('/majesty/vendors/base/vendor.bundle.base.css')}}">
        <link rel="stylesheet" href="{{url('/majesty/css/style.css')}}">
        <link rel="icon" type="image/png" href="{{url('img/icon.png')}}">
    </head>
    <body>
        <div class="container-scroller">
            <div class="container-fluid page-body-wrapper full-page-wrapper">
                <div class="content-wrapper d-flex align-items-center auth px-0">
                    <div class="row w-100 mx-0">
                        <div class="col-lg-4 mx-auto">
                            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                                <!-- <div class="brand-logo text-center">
                                    <img src="{{url('/img/logo-sd-2023.png')}}" alt="logo">
                                </div> -->
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{url('/majesty/vendors/base/vendor.bundle.base.js')}}"></script>
        <script src="{{url('/majesty/js/off-canvas.js')}}"></script>
        <script src="{{url('/majesty/js/hoverable-collapse.js')}}"></script>
        <script src="{{url('/majesty/js/template.js')}}"></script>
    </body>
</html>