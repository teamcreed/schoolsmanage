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
            <td>Cédula</td>
            <td>Teléfono</td>
            <td>Email</td>
        </tr>
        <?
        foreach ($representantes as $representante){
            ?>
        <tr class="item" callback="detarepresent" nombre="<?=$representante[nombre].' '.$representante[apellido]?>" id="<?=$representante[id]?>">
                <td><?=$representante[nombre].' '.$representante[apellido]?></td>
                <td><?=$representante[cedula]?></td>
                <td><?=$representante[telefono]?></td>
                <td><?=$representante[email]?></td>
                <!--<td>
                    <span class="fui-windows"></span>
                    <span class="fui-folder"></span>
                </td>-->
            </tr>   
            <?
        }?>
    </table>
</div> 