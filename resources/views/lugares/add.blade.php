@extends('header.header')
@section('title','critica| Editar Lugares')
@section('css')
<link href="/themes/inspina/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="col-lg-12">
                    <div class='panel panel-default transparent'>
                        <div class='panel-heading'>
                            <h1>Lugares</h1>
                        </div>
                        <div class='panel-body'>
                            <form class='col-sm-8 col-md-offset-2 panel' action="/api/places" method='post'>
                                <div class='placesForm'></div>
                                <input type="text" name="_token" class='hidden' value="{{csrf_token()}}"/>
                                <button class='btn btn-success pull-right'>OK</button>
                            </form>
                        </div>
                    </div>
</div>
@endsection
@section('footerScripts')
<script type="text/javascript" src="/custom/controller/Places.js"></script>
<script type="text/javascript" src="/custom/views/places/place.js"></script>
<script>
    let place=new Place();
    place.printForm(
        "/json/places.Form.json",
        document.querySelector(".placesForm"));
</script>
@endsection