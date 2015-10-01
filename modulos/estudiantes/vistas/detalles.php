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
    <li class="active"><a data-toggle="tab" href="#datgen">Datos Generales</a></li>
    <li><a data-toggle="tab" href="#representante">Representante</a></li>
    <li><a data-toggle="tab" href="#docentes">Docentes</a></li>
</ul>
<div class="tab-content">
    <div id="representante" class="tab-pane">
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
    <div id="datgen" class="tab-pane fade in active">
        <form action="index.php?com=<?=$this->ruta?>&ajax=true&task=mkeditar" method="post" id="formedit" callback="editresponse">
            <input type="hidden" name="id" value="<?=$alumno[id]?>">
            <div class="container-fluid detalles">
                <div class="row">
                    <div class="col-lg-2 negrita">Nombres:</div>
                    <div class="col-lg-4">
                        <input type="text" class="form-control login-field dato" name="nombre" requerido="true" value="<?=$alumno[nombre]?>" placeholder="Nombres..." id="nombre" />
                        <span class="dato"><?=$alumno[nombre]?></span>
                    </div>
                    <div class="col-lg-2 negrita">Apellidos:</div>
                    <div class="col-lg-4">
                        <input type="text" class="form-control login-field dato" name="apellido" requerido="true" value="<?=$alumno[apellido]?>" placeholder="Apellidos..." id="apellido" />
                        <span class="dato"><?=$alumno[apellido]?></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2 negrita">Cédula:</div>
                    <div class="col-lg-4">
                        <input type="text" class="form-control login-field dato" name="cedula" requerido="true" value="<?=$alumno[cedula]?>" placeholder="Número de cédula..." id="cedula" />
                        <span class="dato"><?=$alumno[cedula]?></span>
                    </div>
                    <div class="col-lg-2 negrita">Nacimiento:</div>
                    <div class="col-lg-4">
                        <input type="text" class="form-control login-field dato" name="nacimiento" requerido="true" value="<?=$alumno[nacimiento]?>" placeholder="Fecha de nacimiento..." id="nacimiento" />
                        <span class="dato"><?=$alumno[nacimiento]?></span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-2 negrita">Dirección:</div>
                    <div class="col-lg-10">
                        <input type="text" class="form-control login-field dato" name="direccion" requerido="true" value="<?=$alumno[direccion]?>" placeholder="Dirección..." id="direccion" />
                        <span class="dato"><?=$alumno[direccion]?></span>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div id="docentes" class="tab-pane">
        <? $this->listarDocentes($_REQUEST[id]) ?>
    </div>
</div>