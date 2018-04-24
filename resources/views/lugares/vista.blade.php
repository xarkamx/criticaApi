@extends('header.header')
@section('title','critica| Vista Lugares')
@section('css')
<link href="/themes/inspina/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="col-lg-12">
                    <div class='panel panel-default '>
                        <div class='panel-heading'>
                            <h1>Lugares</h1>
                        </div>
                        <div class='panel-body'>
                            <table class='places table table-striped table-bordered table-hover dataTables-example dataTable no-footer'>
                                <thead>
                                    <th>Pais</th>
                                    <th>Estado</th>
                                    <th>Ruta</th>
                                    <th>Alias</th>
                                    <th>Twitter</th>
                                    <th>Acciones</th>
                                </thead>
                                <tbody>
                                    <tr class='place'>
                                        <td class='country'>Cargando</td>
                                        <td class='place'>Cargando</td>
                                        <td class='url'>Cargando</td>
                                        <td class='alias'>Cargando</td>
                                        <td class='twitter'>Cargando</td>
                                        <td class='id'>
                                            <div class="btn btn-success btn-sm editar">
                                                <i class="fa fa-edit"></i>
                                            </div>
                                            <div class="btn btn-danger btn-sm eliminar">
                                                <i class="fa fa-trash"></i>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
</div>
<template id="editPlace">
            @include('lugares.plantillas.addForm');
</template>
    
@endsection
@section('footerScripts')
<script type="text/javascript" src="/themes/inspina/js/plugins/dataTables/datatables.min.js"></script>
<script type="text/javascript" src="/custom/views/tables/tables.js"></script>
<script type="text/javascript" src="/custom/controller/Places.js"></script>
<script type="text/javascript" src="/custom/views/places/place.js"></script>
<script>
(function(){
    let table=document.querySelector('.places')
    new Place().printTable(table);
})();
</script>
@endsection