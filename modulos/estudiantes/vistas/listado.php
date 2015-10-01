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
<div class="panel panel-default centrado">
    <!-- Default panel contents -->
    <div class="panel-heading"><?=$this->actor?> registrados</div>

    <!-- Table -->
    <table class="table">
        <tr>
            <td>Nombre</td>
            <td>Representante</td>
            <td>Curso</td>
            <td>Docente</td>
        </tr>
        <?
        foreach ($listados as $listado){
            ?>
        <tr class="item" callback="<?=$this->detalles?>" nombre="<?=$listado[ESTUDIANTE]?>" id="<?=$listado[id]?>">
                <td><?=$listado[ESTUDIANTE]?></td>
                <td><?=$listado[REPRESENTANTE]?></td>
                <td><?=$listado[CURSO]?></td>
                <td><?=$listado[DOCENTE]?></td>
                <!--<td>
                    <span class="fui-windows"></span>
                    <span class="fui-folder"></span>
                </td>-->
            </tr>   
            <?
        }?>
    </table>
</div> 