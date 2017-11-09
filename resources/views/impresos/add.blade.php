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
                    <div class="panel panel-default fileList">
                        <ul class="panel-body parent">
                            <li class="child">
                                <div class="hidden preview">
                                    <img class="prevImage"/>
                                </div>
                                <div class="fileName" editable>FileName</div>
                                <div class="open btn btn-default btn-sm">
                                    <i class="fa fa-plus-square" aria-hidden="true"></i>
                                </div>
                                <div class="delete btn btn-danger btn-sm">
                                    <i class="fa fa-window-close" aria-hidden="true"></i>
                                </div>
                                <ul class="content"></ul>
                            </li>
                        </ul>
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