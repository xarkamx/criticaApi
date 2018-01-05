@extends('header.header')
@section('title','critica | Escritorio')
@section('content')
<div class="col-lg-12">
                    <div class="text-center m-t-lg" >
                        <center>
                            <div class='logo'></div>
                        <h2>Accesos</h2>
                        <canvas id="myChart"  style='max-height:400px;'></canvas>
                        </center>
                    </div>
                    <div class="panel panel-default col-md-12">
                        <div class="panel-heading">Accesos</div>
                        <div class="panel-body">
                            <div class="col-sm-12 center">
                                <div class="col-sm-6">
                                    <h3>Ingresos exitosos</h3>
                                    <ul class='loginParent list-group'>
                                        <li class="target col-sm-12 list-group-item">
                                            <div class="evento col-md-12"></div>
                                            <div class="type col-md-2 badge"></div>
                                            <div class="created_at col-md-4 badge"></div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-sm-6">
                                    <h3>Ingresos fallidos</h3>
                                    <ul class='errorParent list-group'>
                                        <li class="target col-sm-12 list-group-item">
                                            <div class="evento col-md-12"></div>
                                            <div class="type col-md-2 badge"></div>
                                            <div class="created_at col-md-4 badge"></div>
                                        </li>
                                    </ul>
                                </div>
                                </div>
                        </div>
                    </div>
</div>

    
@endsection
@section('footerScripts')
    <script type="text/javascript" src="/custom/controller/Bitacora.js"></script>
    <script type="text/javascript" src="/custom/views/bitacora/bitacora.js"></script>
    <script>
        let bitacoraView=new BitacoraView();
        let dom=document.querySelector(".loginParent");
        let dom2=document.querySelector(".errorParent");
        bitacoraView.printList(dom,"login");
        bitacoraView.printList(dom2,"loginError");
    </script>
@endsection