<!DOCTYPE html>
<html>
    <head>
    <title>Critica | Iniciar sesión</title>
    <link rel="manifest" href="/manifest.json">
    <link href="/themes/inspina/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/17fea649d6.js"></script>
    <link href="/themes/inspina/css/animate.css" rel="stylesheet">
    <link href="/themes/inspina/css/style.css" rel="stylesheet">
    <link href="/plugins/chosen/chosen.min.css" rel="stylesheet">
    <link href="/css/alter.css" rel="stylesheet">
    </head>
    <body class='defaultBackground'>
        <div class='panel middle loggin col-sm-4 col-md-offset-4'>
            <div class='panel-header'>
                <center>
                    <img src='public/uploads/logos/critica.png'/>
                </center>
            </div>
                <form class='panel-body loginForm' action='/login' >
                    <div class='Login col-sm-12 panel'>
                        <div class='form-group'>
                            <label for="email">Correo electronico</label>
                            <input type="email" name="email" class='col-sm-9 form-control' required/>
                        </div>
                        <div class='form-group'>
                            <label for="password">Contraseña</label>
                            <input type="password" class='col-sm-9 form-control' name="password" required/>
                        </div>
                    </div>
                    <input type="text"  class='hidden' name='_token' value='{{csrf_token()}}'/>
                    <button class='btn btn-success pull-right'>Ingresar</button>
                </form>
        </div>
    </body>
    <script type="text/javascript" src="/js/main/helpers.js"></script>
    <script type="text/javascript" src="/js/main/ajax.js"></script>
    <script type="text/javascript" src="/js/main/dom.js"></script>
    <script type="text/javascript" src="/js/main/templates.js"></script>
    <script type="text/javascript" src="/js/main/tools.js"></script>
    <script type="text/javascript" src="/custom/views/register/register.js"></script>
    <script>
        new AdminRegister().loginEvents(document.querySelector('.loginForm'));
    </script>
</html>