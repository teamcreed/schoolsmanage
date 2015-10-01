<?php

/* 
 * Copyright (C) 2015 Divergente Soluciones
 *
 * Aplicacion destinada a la gention y control de unidades educativas
 * Desarrollada por un grupo de emprendedores 100% Venezolanos,
 * desarrollada en Maracay Estado Aragua
 *
 */
defined('_UCHIP') or die;

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Flat UI - Free Bootstrap Framework and Theme</title>
        <meta name="viewport" content="width=1000, initial-scale=1.0, maximum-scale=1.0">
        <link href="<?=$this->ruta?>/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?=$this->ruta?>/css/default.css" rel="stylesheet">
        <link href="<?=$this->ruta?>/css/flat-ui.css" rel="stylesheet">
        <link href="<?=$this->ruta?>/css/calendar.css" rel="stylesheet">
        <link href="<?=APPDIR?>/css/general.css" rel="stylesheet">
        <link href="<?=$this->ruta?>/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.5/css/bootstrap-dialog.min.css" rel="stylesheet">
        <link rel="shortcut icon" href="img/favicon.ico">
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
        <!--[if lt IE 9]>
          <script src="<?=$this->ruta?>/js/vendor/html5shiv.js"></script>
          <script src="<?=$this->ruta?>/js/vendor/respond.min.js"></script>
        <![endif]-->
        
        <script src="<?=$this->ruta?>/js/vendor/jquery.min.js"></script>
        <script src="<?=$this->ruta?>/js/uchip.js"></script>
        <script src="<?=$this->ruta?>/js/vendor/video.js"></script>
        <script src="<?=$this->ruta?>/js/application.js"></script>
        <script src="<?=$this->ruta?>/js/flat-ui.min.js"></script>
        <script src="<?=$this->ruta?>/js/jquery.form.js"></script>
        <script src="<?=$this->ruta?>/js/blockui.js"></script>
        <script src="<?=$this->ruta?>/js/defaults.js"></script>
        
        <script src="<?=$this->ruta?>/js/inputmask.js"></script>
        <script src="<?=APPDIR?>/js/school.js"></script>
        <script src="<?=$this->ruta?>/js/jquery.inputmask.js"></script>
        <script src="<?=$this->ruta?>/js/moment.js"></script>
        <script src="<?=$this->ruta?>/js/bootstrap-datetimepicker.min.js"></script>
        <script src="<?=$this->ruta?>/js/localeEs.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.5/js/bootstrap-dialog.min.js"></script>
        <script src="<?=$this->ruta?>/js/ui.js"></script>
        <script src="<?=$this->ruta?>/js/datepicker.js"></script>
        <script>
            var separador = '<?=SEPARADOR?>';
        </script>
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-embossed" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-01">
                <span class="sr-only">Toggle navigation</span>
                </button>
                <a class="navbar-brand" href="#">Escuelas</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse-01">
                 <!--<ul class="nav navbar-nav navbar-left">
                    <? //$this->menu(0); ?>
                   <li><a href="#fakelink">Menu Item<span class="navbar-unread">10</span></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Messages <b class="caret"></b></a>
                        <span class="dropdown-arrow"></span>
                        <ul class="dropdown-menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                        </ul>
                    </li>
                    
                </ul>-->
                <form class="navbar-form navbar-right" action="#" role="search">
                    <div class="form-group">
                        <div class="input-group">
                            <input class="form-control" id="navbarInput-01" type="search" placeholder="Buscar">
                            <span class="input-group-btn">
                            <button type="submit" class="btn"><span class="fui-search"></span></button>
                            </span>
                        </div>
                        
                        <input type="hidden" value="<? echo $this->uchip->usuario->getInfo('Lat')?>" id="LatUser">
                        <input type="hidden" value="<? echo $this->uchip->usuario->getInfo('Lng')?>" id="LngUser">
                        <input type="hidden" value="<?=DISPICONOSDIR?>" id="dispicondir">
                        <input type="hidden" value="<? echo $this->uchip->usuario->getInfo('Zoom')?>" id="Zoom">
                    </div>
                </form>
            </div><!-- /.navbar-collapse -->
        </nav>
        
        <? $this->componente() ?>
    </body>
</html>
