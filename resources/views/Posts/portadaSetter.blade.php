@extends('header.header')
@section('title','critica | Organizar Portada')
@section('css')
<link href="/themes/inspina/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="col-lg-12">
                    <div class='panel panel-default transparent'>
                        <div class='panel-heading'>
                            <h1>Organizar Portada</h1>
                        </div>
                        <div class='panel-body'>
                            <div class='col-sm-8 col-md-offset-2 panel' >
                                <div class="postSearch">
                                    <h2>Añadir nuevo</h2>
                                    <button class='btn btn-success addPosts'>
                                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                    </button>
                                </div>
                                <div class="form-group panel place">
                                    <label>Estados</label>
                                    <select class="form-control">
                                        <option value="0">Global</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class='postList col-sm-8 col-md-offset-2 panel'>
                                
                                 <ul class="listParent list-group col-sm-12">
                                     <li class="listTarget list-group-item col-sm-12">
                                         <div class='portID col-sm-12 portada'>
                                             <div class="listBody col-sm-12">
                                                 <div class="image thumbnail col-sm-2"></div>
                                                 <div class="title col-sm-4">Cargando</div>
                                                 <div class="form-group col-sm-3">
                                                        <input type="number" placeHolder="Orden" class="orden form-control"/>
                                                 </div>
                                                 <button class="btn btn-danger delete col-sm-1">x</button>
                                                <div class="place col-sm-1" title="Global"></div>
                                                <div class="filtro col-sm-1">
                                                    <i class='fa fa-eye' title="Visible" aria-hidden='true'></i>
                                                </div>
                                             </div>
                                         </div>
                                     </li>
                                 </ul>   
                            </div>
                        </div>
                    </div>
</div>
@endsection
@section('footerScripts')
<script type="text/javascript" src="/custom/controller/Posts.js"></script>
<script type="text/javascript" src="/custom/controller/Places.js"></script>
<script type="text/javascript" src="/custom/views/posts/modal.js"></script>
<script type="text/javascript" src="/custom/views/posts/posts.js"></script>
<script>
    let posts=new Posts(".panel-body");
</script>
@endsection