<?php

class Controles{
    public $texto;
    public $icono;
    public $id;
    public $class;
    public $tam;
    public $bindable;
    public $vistas = CLASESDIR.'vistas'.DS;
    function __construct($texto,$icono,$id="",$class='btn-lg btn-primary',$tam='col-lg-2',$bindable=true){
        $this->texto = $texto;
        $this->icono = $icono;
        $this->id = $id;
        $this->class = $class;
        (empty($tam)) ? $this->tam = 'col-lg-2' : $this->tam = $tam;
        $this->bindable = $bindable;
    }
    public function MkBoton(){
        include $this->vistas.'botones.php';
    }
}
class Componente{
    public $uchip;
    public $func;
    public $actor;
    public $vistas;
    public $ruta;
    public $tablamain;
    public $pantalla;
    public $listado;
    public $formulario;
    public $controles;
    function __construct($uchip,$actor,$ruta,$tabla,$vistas,$pantalla='pantalla.php',$listado='listado.php',$formulario='formulario.php'){
        $this->uchip=$uchip;
        $this->actor=$actor;
        $this->ruta=$ruta;
        $this->vistas=MODSDIR.$this->ruta.DS.$vistas.DS;
        $this->pantalla=$this->vistas.$pantalla;
        $this->listado=$this->vistas.$listado;
        $this->formulario=$this->vistas.$formulario;
        $this->tablamain=$tabla;
        $this->vistas=$this->ruta.DS.$vistas.DS;
        $this->func = $this->uchip->func;
        $this->controles = array();
    }
    public function addControl($control){
        $this->controles[] = $control;
    }
    public function printControles(){
        foreach($this->controles as $control){
            $control->MkBoton();
        }
    }
    public function principal(){
        include ($this->pantalla);
    }
    public function listado($listados){
        include ($this->listado);
    }
    public function formulario(){
        include ($this->formulario);
    }
}