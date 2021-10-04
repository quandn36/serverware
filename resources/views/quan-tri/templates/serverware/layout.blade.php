<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Serverware - CMS Dashboard</title>
    <meta content="Golf - Content Management System" name="description" />
    <meta content="TRIEUDO.NET" name="author" />
    <link rel="shortcut icon" href="{{ asset(config('template.cmsTemplateURL'). 'assets/images/favicon.ico') }}">
    <link href="{{ asset(config('template.cmsTemplateURL'). 'assets/css/custom-other.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset(config('template.cmsTemplateURL'). 'assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset(config('template.cmsTemplateURL'). 'assets/css/metismenu.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset(config('template.cmsTemplateURL'). 'assets/css/custom-productcategory.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset(config('template.cmsTemplateURL'). 'assets/css/icons.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset(config('template.cmsTemplateURL'). 'assets/css/style.css') }}" rel="stylesheet" type="text/css">

    @yield('page-css')
    <style>
        span.required {
            color: #fc5454;
        }
        .form-error {
            border: 1px solid red;
        }
  </style>
</head>

<body class="" style="min-height: 720px;">

    <!-- Begin page -->
    <div id="wrapper">

        @include(config('template.cmsTemplateBladeURL') . 'includes.topbar')

        @include(config('template.cmsTemplateBladeURL') . 'includes.left-sidebar')

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container-fluid">
                    @include(config('template.cmsTemplateBladeURL') . 'includes.page-title')

                    @yield('main-content')

                </div>
                <!-- container-fluid -->

            </div>
            <!-- content -->

            <footer class="footer">
                © 2021 Serverware <span class="d-none d-sm-inline-block"> - Developed <i class="mdi mdi-heart text-danger"></i> by TRIEUDO</span>.
            </footer>

        </div>
        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    <!-- jQuery  -->
    <script src="{{ asset(config('template.cmsTemplateURL'). 'assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset(config('template.cmsTemplateURL'). 'assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset(config('template.cmsTemplateURL'). 'assets/js/metismenu.min.js') }}"></script>
    <script src="{{ asset(config('template.cmsTemplateURL'). 'assets/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset(config('template.cmsTemplateURL'). 'assets/js/waves.min.js') }}"></script>

    @yield('page-js')

    <!-- App js -->
    <script src="{{ asset(config('template.cmsTemplateURL'). 'assets/js/app.js') }}"></script>

    <!--custom notification message-->
    <script src="{{ asset(config('template.cmsTemplateURL'). 'assets/js/custom-noti.js') }}"></script>

    @yield('page-custom-js')
</body>

</html>
