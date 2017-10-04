@extends('header.header')
@section('title','Notificaciones| Notificar usuarios')
@section('css')
<link href="/themes/inspina/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="col-lg-12">
                    <div class='panel panel-default transparent'>
                        <div class='panel-heading'>
                            <h1>Notificaciones</h1>
                        </div>
                        <div class='panel-body'>
                            
                        </div>
                    </div>
</div>
@endsection
@section('footerScripts')
<script src="https://www.gstatic.com/firebasejs/4.1.2/firebase.js"></script>
<script src="/custom/views/notificaciones/notificaciones.js"></script>
<script>
    let noti=new CloudMessaging();
    noti.requestPermission();
</script>
@endsection