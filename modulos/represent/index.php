<?php

/* 
 * Copyright (C) 2015 Divergente Soluciones
 *
 * Aplicacion destinada a la gention y control de unidades educativas
 * Desarrollada por un grupo de emprendedores 100% Venezolanos,
 * desarrollada en Maracay Estado Aragua
 *
 */

require_once 'helpers'.DS.'representantes.php';
switch($_REQUEST[task]){
    case 'mkrepresent':
        $representante->mkrepresent();
        break;
    case 'listado':
        $representante->verListado();
        break;
    case 'addauto':
        $representante->addauto();
        break;
    case 'detalles':
        $representante->detalles();
        break;
    default:
        $representante->principal();
        break;
}