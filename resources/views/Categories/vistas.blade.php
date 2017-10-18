@extends('header.header')
@section('title','critica| Vista Empresas')
@section('css')
<link href="/themes/inspina/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="col-lg-12">
                    <div class='panel panel-default '>
                        <div class='panel-heading'>
                            <h1>Representante</h1>
                        </div>
                        <div class='panel-body'>
                            <table class='empresas table table-striped table-bordered table-hover dataTables-example dataTable no-footer'>
                                <thead>
                                    <th>Más</th>
                                    <th>Representante</th>
                                    <th>Correo</th>
                                    <th>Direccion</th>
                                    <th>Teléfono</th>
                                    <th>Acciones</th>
                                </thead>
                                <tbody>
                                    <tr class='empresas'>
                                        <td class='extra'>
                                            <center>
                                                <i class="fa fa-plus-square btn" aria-hidden="true"></i>
                                            </center>
                                        </td>
                                        <td class='empresa'>Cliente</td>
                                        <td class='email'>Correo</td>
                                        <td class='direccionFiscal'>Direccion</td>
                                        <td class='tel'>0000000</td>
                                        <td class='acciones id'>
                                                <div class='edit btn btn-xs btn-success'>
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </div>
                                                <div class='delete btn btn-xs btn-danger'>
                                                    <i class="fa fa-window-close" aria-hidden="true"></i>
                                                </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
</div>

    
@endsection
@section('footerScripts')
<script type="text/javascript" src="/themes/inspina/js/plugins/dataTables/datatables.min.js"></script>
<script type="text/javascript" src="/custom/views/tables/tables.js"></script>
<script type="text/javascript" src="/custom/views/empresas/empresas.js"></script>
<script>
(function(){
    let table=document.querySelector('.empresas')
    let data=new Empresas();
    new Tables().createTable('/api/empresas/all',table,data);
})();
</script>
@endsection