<?php

/* 
 * Copyright (C) 2015 Divergente Soluciones
 *
 * Aplicacion destinada a la gention y control de unidades educativas
 * Desarrollada por un grupo de emprendedores 100% Venezolanos,
 * desarrollada en Maracay Estado Aragua
 *
 */
$this->formulario();
?>
<script src="js/represent.js"></script>
<div id="pantalla">
    
    <div class="centrado boton">
        <div class="col-lg-12">
            <button class="btn btn-block btn-lg btn-primary agregar">Agregar <?=$this->actor?></button>
        </div>
    </div><br><br>
    <div class="filtros centrado contenedor">
        <h6 class="filt"><span class="fui-search"></span>&nbsp;Buscar <?=$this->actor?></h6>
        <div class="oculto" id="filtros">
            <div class="form-group">
                <input type="text" class="form-control login-field" name="nombre" value="" placeholder="Buscar..." id="nombre" />
            </div>
        </div>
    </div>
    <div id="listado">
        <?
        $this->verListado();
        ?>
    </div>
    
</div>