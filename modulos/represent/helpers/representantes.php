<?php

/* 
 * Copyright (C) 2015 Divergente Soluciones
 *
 * Aplicacion destinada a la gention y control de unidades educativas
 * Desarrollada por un grupo de emprendedores 100% Venezolanos,
 * desarrollada en Maracay Estado Aragua
 *
 */


class Representante{
    public $uchip;
    public $func;
    public $actor;
    function __construct($uchip){
        $this->uchip=$uchip;
        $this->actor="representantes";
        $this->func = new Funciones($uchip->db);
    }
    public function principal(){
        include (MODSDIR.'represent'.DS.'vistas'.DS.'pantalla.php');
    }
    public function listado($representantes){
        include (MODSDIR.'represent'.DS.'vistas'.DS.'listado.php');
    }
    public function formulario(){
        include (MODSDIR.'represent'.DS.'vistas'.DS.'formulario.php');
    }
    public function mkrepresent(){
        $data[nombre]=$_REQUEST[nombre];
        $data[apellido]=$_REQUEST[apellido];
        $data[telefono]=$_REQUEST[telefono];
        $data[email]=$_REQUEST[email];
        $data[cedula]=$_REQUEST[direccion];
        $data[password]=$this->uchip->usuario->hashClave($_REQUEST[password]);
        $this->uchip->db->insert('representantes',$data);
        echo '<div class="palette palette-emerald centrado boton aviresul oculto">
                <dd>Representante agregado con exito </dd><a class="linkemerald">¿Desea agregar alumno?</a>
            </div>';
    }
    public function listarAutorizados($idrep){
        $where3[idrep]=$idrep;
        $autorizados = $this->uchip->db->select('autorizados',$where3,'nombre');
        include (MODSDIR.'represent'.DS.'vistas'.DS.'listauto.php');
    }
    public function detalles(){
        $where[id]=$_REQUEST[id];
        $representante = $this->uchip->db->select('representantes',$where);
        $representante = $representante[0];
        $where2[representante]=$_REQUEST[id];
        $cols="estudiantes.id,
                estudiantes.nombre,
                estudiantes.apellido,
                CONCAT(niveles.nombre,' ',cursos.seccion) AS CURSO";
        $from='estudiantes
                INNER JOIN cursos ON estudiantes.curso = cursos.id
                INNER JOIN niveles ON cursos.nivel = niveles.id';
        $representados = $this->uchip->db->select($from,$where2,'nombre','','','',$cols);
        
        include (MODSDIR.'represent'.DS.'vistas'.DS.'detallesrep.php');
    }
    public function addauto(){
        $data[nombre]=$_REQUEST[nombre];
        $data[cedula]=$_REQUEST[cedula];
        $data[telefono]=$_REQUEST[telefono];
        $data[idrep]=$_REQUEST[idrep];
        $this->uchip->db->insert('autorizados',$data);
        $this->listarAutorizados($_REQUEST[idrep]);
    }
    public function verListado(){
        (!isset($_REQUEST[inicio])) ? $inicio=0 : $inicio=$_REQUEST[inicio];
        $pagina = $_REQUEST["pag"];
        if (!$pagina) {
            $inicio = 0;
            $pagina = 1;
        }
        else
            $inicio = ($pagina - 1) * PAGINADO;
        $totales = $this->uchip->db->countRows('representantes');
        $totales = ceil($totales / PAGINADO);
        $representantes = $this->uchip->db->select('representantes','','nombre',$inicio.','.PAGINADO);
        $this->listado($representantes);
        $this->uchip->template->paginado($totales,$pagina,'index.php?com=represent&task=listado');
    }
}
$representante = new Representante($this->uchip);
?>