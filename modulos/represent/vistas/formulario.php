<?php

/* 
 * Copyright (C) 2015 Divergente Soluciones
 *
 * Aplicacion destinada a la gention y control de unidades educativas
 * Desarrollada por un grupo de emprendedores 100% Venezolanos,
 * desarrollada en Maracay Estado Aragua
 *
 */
?>
<div id="formrep">
    <form action="index.php?com=represent&task=mkrepresent&ajax=true" method="post" id="mkrepresent" class="manejaform" callback="mkrepresent">
        <div class="centrado contenedor">
            <div class="form-group">
                <input type="text" class="form-control login-field" name="nombre" requerido="true" value="" placeholder="Nombres..." id="nombre" />
            </div>
            <div class="form-group">
                <input type="text" class="form-control login-field" name="apellido" requerido="true" value="" placeholder="Apellidos..." id="apellido" />
            </div>
            <div class="form-group">
                <input type="text" class="form-control login-field" name="telefono" requerido="true" value="" placeholder="Número telefónico" id="telefono" />
            </div>
            <div class="form-group">
                <input type="text" class="form-control login-field" name="email" requerido="email" mensaje="Introduzca una dirección de correo valida" value="" placeholder="Correo electrónico..." id="email" />
            </div>
            <div class="form-group">
                <input type="text" class="form-control login-field" name="cedula" requerido="true" value="" placeholder="Cédula..." id="cedula" />
            </div><div class="form-group">
                <input type="text" class="form-control login-field" name="direccion" requerido="true" value="" placeholder="Dirección..." id="direccion" />
            </div>
            <div class="form-group">
                <input type="password" class="form-control login-field" name="password" requerido="true" value="" placeholder="Contraseña..." id="password" />
            </div>
            <div class="form-group">
                <input type="password" class="form-control login-field" name="confirmar" requerido="true" value="" placeholder="Confirmar contraseña..." id="confirmar" />
            </div>
            <div class="form-group">
                <div class="col-lg-6">
                    <button class="btn btn-block btn-lg btn-primary submit">Agregar <?=$this->actor?></button>
                </div>
                <div class="col-lg-6">
                    <span class="btn btn-block btn-lg btn-danger cancelar">Cancelar</span>
                </div>
            </div>
        </div>
    </form>
</div>
