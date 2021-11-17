@if(Session::get('success', false))
    <div class="alert alert-success" role="alert">
        <i class="fa fa-check"></i>
        {{ \Session::get('success') }}
    </div>
    @php(Session::forget('success'))
@endif
@if(Session::get('error', false))
    <div class="alert alert-success" role="alert">
        <i class="fa fa-check"></i>
        {{ \Session::get('error') }}
    </div>
    @php(Session::forget('error'))
@endif