<!DOCTYPE html>
<html>

<head>
    <link rel="manifest" href="/manifest.json">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <meta http-equiv="Cache-Control" content="no-store" />
    <title>@yield('title')</title>

    <link href="/themes/inspina/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/17fea649d6.js"></script>
    
    <link href="/themes/inspina/css/animate.css" rel="stylesheet">
    <link href="/themes/inspina/css/style.css" rel="stylesheet">
    <link href="/css/alter.css" rel="stylesheet">
    <link href="/plugins/datepicker/datepicker3.css" rel="stylesheet">
    <link href="/plugins/chosen/chosen.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @yield('css')

</head>

<body data-csrf_token={{csrf_token()}}>
<script src="/js/main/helpers.js"></script>
<script src="/js/main/ajax.js"></script>
<script src="/js/main/templates.js"></script>
<script src="/js/main/dom.js"></script>
<script src="/js/main/tools.js"></script>
<script src="/custom/views/global/menu.js"></script>
<script src="/custom/views/global/modal.js"></script>
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    
                    <div class="logo-element">
                        IN+
                    </div>
                </li>
                    <li class='template'>
                        <a href="#" class='url'><i class="fa"></i> 
                        <span class="nav-label name"></span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level submenu collapse">
                            <li class='childs'><a href="#" ></a><li>
                        </ul>
                    </li>
            </ul>

        </div>
    </nav>

    <div id="page-wrapper" class="defaultBackground">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li class="dropdown fnoti">
                    <a href="/logout">
                        <i class="fa fa-sign-out"></i>  <span class="label">Log out</span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="/">
                                <div>
                                    <i class="fa fa-envelope fa-fw "></i> <span class='titulo'></span>
                                    <span class="pull-right text-muted small origen">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
                   
                </ul>

            </nav>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                @yield('content')
            </div>
        </div>
        <div class="footer">
            <div class="pull-right">
                <strong>Grupo Mexico Publica</strong>
            </div>
            <div>
                <strong>Desarrollado por</strong> <a href='http://web-gdl.com'>WEBGDL</a> 2017-2018
            </div>
        </div>

    </div>
</div>
<template id="modal">
            @include('modal.modal')
        </template>
<!-- Mainly scripts -->
<script src="/themes/inspina/js/jquery-2.1.1.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/themes/inspina/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="/themes/inspina/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Custom and plugin javascript -->
<script src="/themes/inspina/js/inspinia.js"></script>
<script src="/themes/inspina/js/plugins/pace/pace.min.js"></script>
<script>
    let tn=document.querySelector('.template');
    new Menu("/json/menu.json").printer(tn);
</script>
@yield('footerScripts')
<script src="/plugins/chosen/chosen.jquery.min.js"></script>
</body>

</html>
