@extends('header.header')
@section('title','critica| Agregar Clientes')
@section('css')
<link href="/themes/inspina/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="col-lg-12">
                    <div class='panel panel-default transparent'>
                        <div class='panel-heading'>
                            <h1>Clientes</h1>
                        </div>
                        <div class='panel-body'>
                            <form class='col-sm-8 col-md-offset-2 panel' action='/api/clients' method='post' data-id="{{$id}}">
                                <div class='clientForm'></div>
                                <input type="text" name="_token" class='hidden' value="{{csrf_token()}}"/>
                                <button class='btn btn-success pull-right'>OK</button>
                            </form>
                        </div>
                    </div>
</div>
    
@endsection
@section('footerScripts')
<script type="text/javascript" src="/custom/views/clients/clients.js"></script>
<script>
    let clients=new Clients("/json/clients.Form.json");
    clients.print(document.querySelector('.clientForm'));
    document.querySelector('form').addEventListener('submit',(ev)=>{
        ev.preventDefault();
        clients.save(document.querySelector('form'));
    });
    document.querySelector('input[name="email"]').addEventListener('change',
        (ev)=>{
            clients.clientExist(ev.target);
        });
    let id=document.querySelector('form').dataset.id;
    if(id!=''){
        clients.fillById(id,document.querySelector('form'));
    }
</script>
@endsection