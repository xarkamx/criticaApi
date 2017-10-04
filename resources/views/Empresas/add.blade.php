@extends('header.header')
@section('title','critica | Agregar Empresas')
@section('css')
<link href="/themes/inspina/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="col-lg-12">
                    <div class='panel panel-default transparent'>
                        <div class='panel-heading'>
                            <h1>Empresas/Representantes</h1>
                        </div>
                        <div class='panel-body'>
                            <form class='col-sm-8 col-md-offset-2 panel' action='/api/users' method='post' data-id="{{$id}}">
                                <div class='empresaForm'></div>
                                <input type="text" name="_token" class='hidden' value="{{csrf_token()}}"/>
                                <button class='btn btn-success pull-right'>OK</button>
                            </form>
                        </div>
                    </div>
</div>
@endsection
@section('footerScripts')
<script type="text/javascript" src="/custom/views/empresas/empresas.js"></script>
<script>
    let empresa=new Empresas();
    let target=document.querySelector('.empresaForm');
    empresa.printForm('/json/Empresa.Form.json',target);
</script>
@endsection