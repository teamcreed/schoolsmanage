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
<div class="container-fluid contenedor" id="formulario">
    <form action="index.php?com=<?=$this->ruta?>&task=insertar&ajax=true" method="post" id="<?=$this->form?>" class="manejaform" binder="BindFormEstudiante" callback="<?=$this->form?>">
        <div class="row">
            <div class="col-lg-2 negrita">Nombres:</div>
            <div class="col-lg-4"><input type="text" class="form-control" mensaje="Nombres del alumno.<br>" name="nombre" requerido="true" value="" placeholder="Nombres..." id="nombre" /></div>
            <div class="col-lg-2 negrita">Apellidos:</div>
            <div class="col-lg-4"><input type="text" class="form-control" mensaje="Apellidos del alumno.<br>" name="apellido" requerido="true" value="" placeholder="Apellidos..." id="apellido" /></div>
        </div>
        <div class="row">
            <div class="col-lg-2 negrita">Fecha nacimiento:</div>
            <div class="col-lg-4">
                
                <div class='input-group date' id='Fechainicial'>
                    <input type="text" class="form-control" mensaje="Introduzca la fecha de nacimiento.<br>" name="fechanacimineto" requerido="true" value="" placeholder="Fecha de nacimiento..." id="fechanacimineto" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar">
                        </span>
                    </span>
                </div>
            </div>
            
            <div class="col-lg-2 negrita">Tipo de sangre:</div>
            <div class="col-lg-4"><input type="text" class="form-control" name="tiposangre" value="" placeholder="Tipo de sangre" id="tiposangre" /></div>
        </div>
        <div class="row">
            <div class="col-lg-2 negrita">Representante:</div>
            <div class="col-lg-6">
                <input type="text" class="form-control tagsinput" mensaje="Seleccione un respresentante valido.<br>" depende="#repid" placeholder="Nombre del representante..." name="representante" id="representante" />
                <input type="hidden" value="" name="repid" id="repid">
            </div>
            <div class="col-lg-4">
                <div id="AddRep" class="btn btn-block btn-lg btn-inverse">
                    <span class="glyphicon glyphicon-plus-sign"></span>
                    <span>Add. Repesentante</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2 negrita">Curso:</div>
            <div class="col-lg-10">
                <input type="text" class="form-control login-field" name="curso" value="" placeholder="Curso..." id="curso" />
                <input type="hidden" value="" name="cursoid" id="cursoid">
            </div>
        </div>
        
    </form>
</div>
