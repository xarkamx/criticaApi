@extends('header.header')
@section('title','critica | Organizar Portada');
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
                                
                                 <ul class="listParent">
                                     <li class="listTarget">
                                         <div class='portID'>
                                             <div class="image thumbnail"></div>
                                             <div class="title">Cargando</div>
                                             <div class="form-group">
                                                    <input type="number" placeHolder="Orden" class="orden form-control"/>
                                             </div>
                                             <button class="btn btn-danger delete">x</button>
                                             <div class="place"></div>
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