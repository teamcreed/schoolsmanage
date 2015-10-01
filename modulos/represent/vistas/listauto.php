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
<table class="table">
    <tr>
        <td>Autorizado</td>
        <td>Cédula</td>
        <td>Teléfono</td>
    </tr>
    <?
    if($autorizados){
        foreach($autorizados as $autorizado){
            ?>
            <tr class="item">
                <td><?=$autorizado[nombre]?></td>
                <td><?=$autorizado[cedula]?></td>
                <td><?=$autorizado[telefono]?></td>
            </tr>
            <?
        }
    }
    ?>
</table>