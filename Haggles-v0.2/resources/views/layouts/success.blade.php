@if($flash = session('message'))

    <div id="flash-message" class="alert alert-success" role="alert" style="position: fixed;z-index: 10; top: 20px;right: 20px;">

        <h4>{{$flash}}</h4>
    </div>
@endif
