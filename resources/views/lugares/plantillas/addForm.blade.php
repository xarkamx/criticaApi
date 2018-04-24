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