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
        <link rel="shortcut icon" href="img/favicon.ico">
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
        <!--[if lt IE 9]>
          <script src="<?=$this->ruta?>/js/vendor/html5shiv.js"></script>
          <script src="<?=$this->ruta?>/js/vendor/respond.min.js"></script>
        <![endif]-->
        <script src="<?=$this->ruta?>/js/vendor/jquery.min.js"></script>
        <script src="<?=$this->ruta?>/js/vendor/video.js"></script>
        <script src="<?=$this->ruta?>/js/flat-ui.min.js"></script>
        <script src="<?=$this->ruta?>/js/jquery.form.js"></script>
        <script src="<?=$this->ruta?>/js/blockui.js"></script>
        <script src="<?=$this->ruta?>/js/defaults.js"></script>
    </head>
    <body>
        <div class="login-screen">
            <div class="login-icon">
                <img src="<?=$this->ruta?>/img/login/icon.png" alt="Welcome to Mail App" />
                <h4>Welcome to <small>Mail App</small></h4>
            </div>

            <div class="login-form">
                <form action="index.php?com=login&task=mklogin&ajax=true" id="loginform" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control login-field" name="correo" value="" placeholder="Correo electrónico" id="login-name" />
                        <label class="login-field-icon fui-user" for="login-name"></label>
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control login-field" name="clave" value="" placeholder="Contraseña" id="login-pass" />
                        <label class="login-field-icon fui-lock" for="login-pass"></label>
                    </div>

                    <input type="submit" class="btn btn-primary btn-lg btn-block" value="Ingresar">
                    <a class="login-link" href="#">Olvido su contraseña</a>
                    <div class="oculto">
                        <dl class="palette palette-pomegranate">
                            <dd>Usuario o clave incorrectos</dd>
                        </dl>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>