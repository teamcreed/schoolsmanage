<?php

/* 
 * Copyright (C) 2015 Divergente Soluciones
 *
 * Aplicacion destinada a la gention y control de unidades educativas
 * Desarrollada por un grupo de emprendedores 100% Venezolanos,
 * desarrollada en Maracay Estado Aragua
 *
 */
//$this->formulario();
$this->addControl(new Controles('Buscar', 'fui-search', '', 'btn-lg btn-primary '.SEARCHITEM,'',true));
$this->addControl(new Controles('Agregar', 'fui-new', '', 'btn-lg btn-info '.ADDITEM,'',true));
$this->addControl(new Controles('Ver detalles', 'glyphicon glyphicon-zoom-in', '', 'btn-lg btn-inverse '.DETAILITEM,'',true));
$this->addControl(new Controles('Eliminar', 'fui-trash', '', 'btn-lg btn-warning '.DELETEITEM,'',true));
?>
<div>
    <div class="row controlesmod">
        <input type="hidden" id="baseControl" value="index.php?com=estudiantes">
        <?
        $this->printControles();
        ?>
    </div>
    
    <div id="listado">
        <?
        $this->verListado();
        ?>
    </div>
</div>