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
        <td>Nombre</td>
        <td>Docente</td>
    </tr>
    <tr>
        <td><?=$docentes[DOCENTE]?></td><td>Principal</td>
    </tr>
    <?
    if(!empty($docentes[AUXILIAR])){
        ?>
        <tr>
            <td><?=$docentes[AUXILIAR]?></td><td>Auxiliar</td>
        </tr>
        <?
    }
    ?>
</table>