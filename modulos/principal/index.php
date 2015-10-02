<?php

/* 
 * Copyright (C) 2015 Divergente Soluciones
 *
 * Aplicacion destinada a la gention y control de unidades educativas
 * Desarrollada por un grupo de emprendedores 100% Venezolanos,
 * desarrollada en Maracay Estado Aragua
 *
 */
$framework = $this->uchip;
//$framework->func->hola();
?>
<div id="pantalla">
    <div id="botonera" class="panelcontent panelizquierdo">
        <div>
            <div id="menulateral">
                <ul id="accordion">
                    <?
                    $framework->template->menu(0);
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <div id="contenido" class="panelcontent panelderecho">
        <div class="contenidopanel">
             <div id="AddRep" class="btn btn-block btn-inverse ">
                    
                </div>
        </div>
    </div>
</div>
