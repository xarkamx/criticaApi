<!DOCTYPE html>
<html>
    <head>
    <title>critica| Registro</title>
    <link href="/themes/inspina/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/17fea649d6.js"></script>
    
    <link href="/themes/inspina/css/animate.css" rel="stylesheet">
    <link href="/themes/inspina/css/style.css" rel="stylesheet">
    <link href="/plugins/chosen/chosen.min.css" rel="stylesheet">
    </head>
    <body>
        <div class='panel panel-default col-sm-8 col-md-offset-2'>
            <div class='panel-header'>
                <h2>Registro de Administradores</h2>
            </div>
                <form class='panel-body register'>
                    <div class='registro'>
                        <!-- Registro aqui!-->
                    </div>
                    <input type="text"  class='hidden' name='_token' value='{{csrf_token()}}'/>
                    <button class='btn btn-success'>Registrar</button>
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
        new AdminRegister().printForm(document.querySelector('.registro'),"/json/users.Form.json");
    </script>
</html>