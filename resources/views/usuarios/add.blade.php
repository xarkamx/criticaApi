@extends('header.header')
@section('title','critica| Agregar Usuarios')
@section('css')
<link href="/themes/inspina/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="col-lg-12">
                    <div class='panel panel-default transparent'>
                        <div class='panel-heading'>
                            <h1>Usuarios</h1>
                        </div>
                        <div class='panel-body'>
                            <form class='col-sm-8 col-md-offset-2 panel' action='/api/users/all' method='post' data-id="{{$id}}">
                                <div class='userForm'></div>
                                <input type="text" name="_token" class='hidden' value="{{csrf_token()}}"/>
                                <button class='btn btn-success pull-right'>OK</button>
                            </form>
                        </div>
                    </div>
</div>
@endsection
@section('footerScripts')
<script type="text/javascript" src="/custom/views/users/users.js"></script>
<script>
    let users=new Users("/json/users.Form.json");
    users.print(document.querySelector('.userForm'));
    document.querySelector('form').addEventListener('submit',(ev)=>{
        ev.preventDefault();
        users.save(document.querySelector('form'));
    });
    document.querySelector('input[name="email"]').addEventListener('change',
        (ev)=>{
            users.userExistByMail(ev.target,ev.target.value);
        });
    let id=document.querySelector('form').dataset.id;
    if(id!=''){
        
        users.fillById(id,document.querySelector('form'));
    }
</script>
@endsection