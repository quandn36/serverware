<!--=====================================
=         nofification message          =
======================================-->
    @if(session('status_login') == 'success')
    <div class="alert alert-success" role="alert">
        <div>{{ session('message') }}</div>
    </div>
    @elseif(session('status_login') == 'danger')
    <div class="alert alert-danger" role="alert">
        <div>{{ session('message') }}</div>
    </div>
    @endif

    <style>
        .alert {
            border-radius: 0;
            text-align:center;
            float:right;
            z-index: 9999;
            position: fixed;
            left: 26px;
            bottom: 3px;
        }
    </style>
