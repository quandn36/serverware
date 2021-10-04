<!--=====================================
    =         nofification message          =
    ======================================-->
    @if(session('status') == 'success')
    <div class="alert alert-success" role="alert">
        <div>{{ session('message') }}</div>
    </div>
    @elseif(session('status') == 'danger')
    <div class="alert alert-danger" role="alert">
        <div>{{ session('message') }}</div>
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger" role="alert">
        <div>{{ $errors->first() }}</div>
    </div>
    @endif

    <style>
        .alert {
            text-align:center;
            float:right;
            z-index: 9999;
            position: fixed;
            left: 26px;
            bottom: 3px;
        }
    </style>
