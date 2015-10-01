<?php

/* 
 * Copyright (C) 2015 Divergente Soluciones
 *
 * Aplicacion destinada a la gention y control de unidades educativas
 * Desarrollada por un grupo de emprendedores 100% Venezolanos,
 * desarrollada en Maracay Estado Aragua
 *
 */


class Estudiantes extends Componente{
    public $form = 'mkalumno';
    public $detalles = 'detaestudiante';
    
    public function mkactor(){
        $data[nombre]=$_REQUEST[nombre];
        $data[apellido]=$_REQUEST[apellido];
        $data[tiposangre]=$_REQUEST[tiposangre];
        $data[nacimiento]=$this->func->fechasql($_REQUEST[fechanacimineto]);
        $data[curso]=$_REQUEST[cursoid];
        $data[representante]=$_REQUEST[repid];
        $this->uchip->db->insert($this->tablamain,$data);
        $this->verListado();
    }
    public function listarDocentes($idalumno){
        $where3[idrep]=$idalumno;
        $cols="CONCAT(aux2.nombre,' ',aux2.apellido) AS AUXILIAR2,
                CONCAT(aux.nombre,' ',aux.apellido) AS AUXILIAR,
                CONCAT(docente.nombre,' ',docente.apellido) AS DOCENTE";
        $from="estudiantes
                INNER JOIN cursos ON estudiantes.curso = cursos.id
                INNER JOIN docentes AS docente ON cursos.profesor = docente.id
                LEFT JOIN docentes AS aux ON cursos.profesoraux1 = aux.id
                LEFT JOIN docentes AS aux2 ON cursos.profesoraux2 = aux2.id";
        $where['estudiantes.id'] = $idalumno;
        $docentes = $this->uchip->db->select($from,$where,'','','','',$cols);
        $docentes=$docentes[0];
        include (MODSDIR.$this->vistas.'listadocentes.php');
    }
    public function detalles(){
        /*$where[id]=$_REQUEST[id];
        $representante = $this->uchip->db->select($this->tablamain,$where);
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
        */
        $where[id]=$_REQUEST[id];
        $alumno=$this->uchip->db->select($this->tablamain,$where);
        $alumno=$alumno[0];
        $where[id]=$alumno[representante];
        $representante = $this->uchip->db->select('representantes',$where);
        $representante=$representante[0];
        include (MODSDIR.$this->vistas.DS.'detalles.php');
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
        $having='';
        if(isset($_REQUEST[nombrefiltro]) && !empty($_REQUEST[nombrefiltro])){
            $having="ESTUDIANTE LIKE '%".$_REQUEST[nombrefiltro]."%'";
        }
        $cols="estudiantes.id,
                CONCAT(estudiantes.nombre,' ',estudiantes.apellido) AS ESTUDIANTE,
                CONCAT(niveles.nombre,' ',cursos.seccion) AS CURSO,
                CONCAT(docentes.nombre,' ',docentes.apellido) AS DOCENTE,
                CONCAT(representantes.nombre,' ',representantes.apellido) AS REPRESENTANTE";
        $from="estudiantes
                LEFT JOIN cursos ON estudiantes.curso = cursos.id
                LEFT JOIN niveles ON cursos.nivel = niveles.id
                LEFT JOIN docentes ON cursos.profesor = docentes.id
                INNER JOIN representantes ON estudiantes.representante = representantes.id";
        $this->uchip->db->select($from,'','','','','',$cols,'',$having);
        $totales = $this->uchip->db->records;
        $totales = ceil($totales / PAGINADO);
        $listados = $this->uchip->db->select($from,'','cursos.id, estudiantes.nombre',$inicio.','.PAGINADO,'','',$cols,'',$having);
        $this->listado($listados);
        $this->uchip->template->paginado($totales,$pagina,'index.php?com='.$this->ruta.'&task=listado');
    }
    public function editar(){
        $data[nombre]=$_REQUEST[nombre];
        $data[apellido]=$_REQUEST[apellido];
        $data[nacimiento]=$_REQUEST[nacimiento];
        $where[id]=$_REQUEST[id];
        $this->uchip->db->update($this->tablamain,$data,$where);
        $this->detalles();
        echo SEPARADOR;
        $this->verListado();
    }
    public function Router(){
        switch($_REQUEST[task]){
            case 'insertar':
                $this->mkactor();
                break;
            case 'listado':
                $this->verListado();
                break;
            case 'formulario':
                $this->formulario();
                break;
            case 'autocompleterep':
                $this->func->Autocompletar('representantes');
                break;
            case 'filtrar':
                $this->verListado();
                break;
            case 'detalles':
                $this->detalles();
                break;
            case 'mkeditar':
                $this->editar();
                break;
            default:
                $this->principal();
                break;
        }
    }
}
$estudiante = new Estudiantes($this->uchip,"estudiantes",'estudiantes','estudiantes','vistas');
?>