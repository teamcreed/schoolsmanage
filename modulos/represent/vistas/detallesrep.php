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
<ul class="nav nav-tabs" id="tabdet">
    <li><a data-toggle="tab" href="#datgen">Datos Generales</a></li>
    <li><a data-toggle="tab" href="#representados">Representados</a></li>
    <li class="dropdown">
        <a data-toggle="dropdown" class="dropdown-toggle" href="#">Autorizados <b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li><a data-toggle="tab" href="#listaut">Listado</a></li>
            <li><a data-toggle="tab" href="#addauto">Agregar</a></li>
        </ul>
    </li>
</ul>
<div class="tab-content">
    <div id="datgen" class="tab-pane fade in active">
        <div class="container-fluid detalles">
            <div class="row">
                <div class="col-lg-2 negrita">Nombres:</div>
                <div class="col-lg-4"><?=$representante[nombre]?></div>
                <div class="col-lg-2 negrita">Apellidos:</div>
                <div class="col-lg-4"><?=$representante[apellido]?></div>
            </div>
            <div class="row">
                <div class="col-lg-2 negrita">Cédula:</div>
                <div class="col-lg-4"><?=$representante[cedula]?></div>
                <div class="col-lg-2 negrita">Email:</div>
                <div class="col-lg-4">sdd</div>
            </div>
            <div class="row">
                <div class="col-lg-2 negrita">Teléfono:</div>
                <div class="col-lg-4"><?=$representante[telefono]?></div>
                <div class="col-lg-2 negrita">Teléfono2:</div>
                <div class="col-lg-4"><?=$representante[telefono2]?></div>
            </div>
            <div class="row">
                <div class="col-lg-2 negrita">Dirección:</div>
                <div class="col-lg-10"><?=$representante[direccion]?></div>
            </div>
        </div>
    </div>
    <div id="representados" class="tab-pane fade in active">
        <table class="table">
            <tr>
                <td>Estudiante</td>
                <td>Curso</td>
            </tr>
            <?
            if($representados){
                foreach($representados as $representado){
                    ?>
                    <tr class="item" onclick="javascript:detallealumno(<?=$representado[id]?>)" callback="detallealumno" nombre="<?=$representado[nombre].' '.$representado[apellido]?>" id="alumno<?=$representado[id]?>">
                        <td><?=$representado[nombre].' '.$representado[apellido]?></td>
                        <td><?=$representado[CURSO]?></td>
                    </tr>
                    <?
                }
            }
            ?>
        </table>
    </div>
    <div id="listaut" class="tab-pane fade in active">
        <? $this->listarAutorizados($_REQUEST[id]) ?>
    </div>
    <div id="addauto" class="tab-pane fade in active">
        <form action="index.php?com=represent&task=addauto&ajax=true" callback="listauto" method="post" id="addautoform">
            <input type="hidden" name="idrep" value="<?=$_REQUEST[id]?>" id="idrep">
            <div>
                <div class="form-group">
                    <input type="text" class="form-control login-field" name="nombre" requerido="true" value="" placeholder="Nombre completo..." id="nombre" />
                </div>
                <div class="form-group">
                    <input type="text" class="form-control login-field" name="telefono" requerido="true" value="" placeholder="Número telefónico" id="telefono" />
                </div>
                <div class="form-group">
                    <input type="text" class="form-control login-field" name="cedula" requerido="true" value="" placeholder="Cédula..." id="cedula" />
                </div>
                <div class="form-group">
                    <div class="col-lg-6">
                        <button class="btn btn-block btn-lg btn-primary submit">Agregar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>