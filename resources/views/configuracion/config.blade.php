@extends('header.header')
@section('title','critica| Agregar '.$type)
@section('css')
<link href="/themes/inspina/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="col-lg-12 config" data-type="{{$type}}">
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <h1>{{$type}}</h1>
                        </div>
                        <div class='panel-body'>
                            <form class='col-sm-12 panel' method='post'>
                                <div class='form'></div>
                                <input type="text" name="_token" class='hidden' value="{{csrf_token()}}"/>
                                <button class='btn btn-success pull-right'>OK</button>
                            </form>
                        </div>
                    </div>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <h1>Vista</h1>
                        </div>
                        <div class='panel-body'>
                            <div class='view'></div>
                        </div>
                    </div>
</div>
@endsection
@section('footerScripts')
<script type="text/javascript" src="/custom/views/tables/tables.js"></script>
<script type="text/javascript" src="/custom/views/config/configViews.js"></script>
<script type="text/javascript" src="/custom/views/config/Empresas.js"></script>
<script type="text/javascript" src="/custom/views/config/Services.js"></script>
<script type="text/javascript" src="/custom/views/config/Estados.js"></script>
<script type="text/javascript" src="/custom/views/config/Checkpoints.js"></script>
<script type="text/javascript" src="/custom/views/config/Utilidades.js"></script>
<script>
    (function(){
        let type=document.querySelector('.config').dataset.type;
        let view=document.querySelector('.config');
        let config=new ConfigViews(view,type);
    })();
</script>
@endsection