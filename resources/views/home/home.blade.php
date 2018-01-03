@extends('header.header')
@section('title','critica | Escritorio')
@section('content')
<div class="col-lg-12">
                    <div class="text-center m-t-lg" >
                        <center>
                            <div class='logo'></div>
                        <h2>Grafica del Mes</h2>
                        <canvas id="myChart"  style='max-height:400px;'></canvas>
                        </center>
                    </div>
                    <div class="panel panel-default col-md-3">
                        <div class="panel-heading">Post Más leido</div>
                          
                        <div class="panel-body">
                          </div>
                    </div>
                    <div class="panel panel-default col-md-3">
                        <div class="panel-heading">Categoria más visitada</div>
                          
                        <div class="panel-body">
                          </div>
                    </div>
                    <div class="panel panel-default col-md-3">
                        <div class="panel-heading">Nota preferida por el publico</div>
                          
                        <div class="panel-body">
                          </div>
                    </div>
                    <div class="panel panel-default col-md-3">
                        <div class="panel-heading">Más Buscado</div>
                          
                        <div class="panel-body">
                          </div>
                    </div>
                    <div class="panel panel-default col-md-12">
                      <div class="panel-heading">Bitacora</div>
                      <div class="panel-body">
                          
                      </div>
                    </div>
                    <div class="panel panel-default col-md-12">
                      <div class="panel-heading">Reporte ciudadano</div>
                      <div class="panel-body">
                          
                      </div>
                    </div>
</div>

    
@endsection
@section('footerScripts')
@endsection