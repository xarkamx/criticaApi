@extends('header.header')
@section('title','Critica | Cambiar Background')
@section('css')
<link href="/themes/inspina/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="col-lg-12">
                    <div class='panel panel-default transparent'>
                        <div class='panel-heading'>
                            <h1>Categorias Background</h1>
                        </div>
                        <div class='panel-body'>
                            <form class='col-sm-8 col-md-offset-2 panel' action='/api/users' method='post'>
                                <div class='backgroundForm'></div>
                                <input type="text" name="_token" class='hidden' value="{{csrf_token()}}"/>
                                <button class='btn btn-success pull-right'>OK</button>
                            </form>
                        </div>
                    </div>
</div>
@endsection
@section('footerScripts')
<script type="text/javascript" src="/custom/controller/Categories.js"></script>
<script type="text/javascript" src="/custom/views/categorias/background.js"></script>
<script>
    let background=new Background("/json/background.Form.json");
    let target=document.querySelector('.backgroundForm');
    background.print(target);
</script>
@endsection