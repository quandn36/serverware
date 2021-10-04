<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Login | Server Warehouse - CMS Dashboard</title>
    <meta content="Golf - Content Management System" name="description" />
    <meta content="TRIEUDO.NET" name="author" />
    <link rel="shortcut icon" href="{{ asset(config('template.cmsTemplateURL'). 'assets/images/favicon.ico') }}">

    <link href="{{ asset(config('template.cmsTemplateURL'). 'assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset(config('template.cmsTemplateURL'). 'assets/css/metismenu.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset(config('template.cmsTemplateURL'). 'assets/css/icons.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset(config('template.cmsTemplateURL'). 'assets/css/style.css') }}" rel="stylesheet" type="text/css">

</head>
<body>
    <!-- Begin page -->
    <div class="accountbg"></div>
    <div class="wrapper-page">
        <div class="card card-pages shadow-none">

            <div class="card-body">
                <h5 class="font-18 text-center">Sign in to Server Warehouse CMS.</h5>
                
                <form class="form-horizontal m-t-30" action="{{ route('admin.do-login') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <div class="col-12">
                            <label>Username</label>
                            <input id="firstField" class="form-control" type="text" name="username" required="" placeholder="Username">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-12">
                            <label>Password</label>
                            <input class="form-control" type="password" name="password" required="" placeholder="Password">
                        </div>
                    </div>

                    <div class="form-group text-center m-t-20">
                        <div class="col-12" style="padding-top: 10px;">
                            <button class="btn btn-primary btn-block btn-lg waves-effect waves-light" type="submit">Log In</button>
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>
    <!-- END wrapper -->

    <!--include file notification message-->
    @include(config('template.cmsTemplateBladeURL') . 'includes.notification-message')
    
    <!-- jQuery  -->
    <script src="{{ asset(config('template.cmsTemplateURL'). 'assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset(config('template.cmsTemplateURL'). 'assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset(config('template.cmsTemplateURL'). 'assets/js/metismenu.min.js') }}"></script>
    <script src="{{ asset(config('template.cmsTemplateURL'). 'assets/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset(config('template.cmsTemplateURL'). 'assets/js/waves.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset(config('template.cmsTemplateURL'). 'assets/js/app.js') }}"></script>

    <!--custom notification message-->
    <script src="{{ asset(config('template.cmsTemplateURL'). 'assets/js/custom-noti.js') }}"></script>

</body>
</html>


<script>
    $(document).ready(function(){
        // auto focus first input field username
        window.onload = function() {
            document.getElementById("firstField").focus();
        };
    });
</script>