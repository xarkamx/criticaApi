@extends('header.header')
@section('title','Critica | Crear Impreso')
@section('css')
<link href="/themes/inspina/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="col-lg-12">
                    <div class='panel panel-default transparent'>
                        <div class='panel-heading'>
                            <h1>Impreso</h1>
                        </div>
                        <div class='panel-body'>
                            <form class='col-sm-8 col-md-offset-2 panel' action='/api/media/impresos'  method='post'>
                                <div class='backgroundForm'></div>
                                <input type="text" name="_token" class='hidden' value="{{csrf_token()}}"/>
                                <button class='btn btn-success pull-right'>OK</button>
                            </form>
                        </div>
                    </div>
</div>
@endsection
@section('footerScripts')
<script type="text/javascript" src="/custom/controller/Places.js"></script>
<script type="text/javascript" src="/custom/controller/Impresos.js"></script>
<script type="text/javascript" src="/custom/views/posts/impreso.js"></script>
<script>
    let impresos=new Impreso();
    let target=document.querySelector('.backgroundForm');
    impresos.printForm("/json/impresos.Form.json",target);
</script>
@endsection