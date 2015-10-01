<?php

/* 
 * Copyright (C) 2015 Divergente Soluciones
 *
 * Aplicacion destinada a la gention y control de unidades educativas
 * Desarrollada por un grupo de emprendedores 100% Venezolanos,
 * desarrollada en Maracay Estado Aragua
 *
 */

class Usuario{
    public $db;
    public $usuario;
    public $func;
    public $componentes;
    function __construct($db,$func){
        $this->db = $db;
        $this->func = $func;
        $this->componentes = array();
        session_start();
        if($this->logeado()){
            $this->usuario = $_SESSION[usuario];
            $this->permisos();
        }
    }
    function logeado(){
        if(isset($_SESSION[usuario]))
            return true;
        else
            return false;
    }
    function logout(){
        unset($_SESSION[usuario]);
        unset($_SESSION[componentes]);
        $this->usuario='';
        $this->componentes = array();
    }
    public function hashClave($clave,$digito){
        $opciones = [
        'cost' => 12,
        ];
        return password_hash($clave, PASSWORD_BCRYPT, $opciones);
    }
    public function getInfo($campo){
        switch($campo){
            case 'VehiculosState':
                return $_SESSION[VehiculosState];
                break;
            case 'lugares':
                return $_SESSION[lugares];
                break;
            default:
                return $_SESSION[usuario][$campo];
                break;
        }
    }
    private function permisos(){
        $permisos = array();
        $where[rol] = $this->usuario[rol];
        $permisos = $this->db->select('uchip_roles_componentes',$where);
        
        foreach ($permisos as $permiso){
            $this->componentes[]=$permiso[modulo];
            $_SESSION[componentes][]=$permiso[modulo];
        }
        //print_r($this->componentes);
    }
    private function generarSesiones(){
        foreach($this->usuario as $key=>$value){
            $_SESSION[usuario][$key] = $value;
        }
    }
    public function mklogin(){
        $where[email] = $_REQUEST[correo];
        if($usuario = $this->db->select('uchip_usuarios',$where)){
            if(password_verify($_REQUEST[clave], $usuario[0][clave])){
                $this->usuario = $usuario[0];
                $this->permisos();
                $this->generarSesiones();
                return true; 
            }else
                return false;
        }else
            return false;
    }
    function permiso($component){
        if(!$this->logeado() || !in_array($component, $this->componentes)){
            return false;
        }else
            return true;
    }
}