<div class="container p-0">
    @if(session('error'))
        <div class="col-md-12" role="alert">
            <p class="text-danger"><i class="fas fa-exclamation-circle"></i> {{session('error')}}</p>
        </div>

    @endif
    @if(session('success'))
        <div class=" col-md-12" role="alert">
            <p class="{{FORM_UPDATE_SUCCESS_COLOR}}"><i class="fas fa-check"></i> {{session('success')}}</p>
        </div>
    @endif
</div>