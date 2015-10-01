<?php

/* 
 * Copyright (C) 2015 Divergente Soluciones
 *
 * Aplicacion destinada a la gention y control de unidades educativas
 * Desarrollada por un grupo de emprendedores 100% Venezolanos,
 * desarrollada en Maracay Estado Aragua
 *
 */

class Template{
    public $db;
    public $uchip;
    public $template;
    public $ruta;
    public $param;
    function __construct($uchip){
        $this->db = $uchip->db;
        $this->uchip = $uchip;
        $this->template = TEMPLATE;
        $this->ruta='templates/'.TEMPLATE;
    }
    public function menu($nivel){
        
        $where['uchip_menu.padre']=$nivel;
        $where['uchip_menu_roles.rol']=$this->uchip->usuario->getInfo('rol');
        $cols='uchip_menu.id,
                uchip_menu.titulo,
                uchip_menu.clase,
                uchip_menu.idhtml,
                uchip_menu.ruta,
                uchip_menu.icono,
                uchip_menu.js,
                uchip_menu.padre';
        $menus = $this->db->select('uchip_menu INNER JOIN uchip_menu_roles ON uchip_menu.id = uchip_menu_roles.menu',$where,'orden','','','AND',$cols);
        foreach($menus as $menu){
            if(!empty($menu[ruta]) || !$this->menuHijos($menu[id])){
                if($menu[padre]!=0){
                    $padre = 'padre="#'.$menu[idhtml].'"';
                    $id = '';
                }else{
                    $id = 'padre="#'.$menu[idhtml].'"';
                    $padre='';
                }
                (!empty($menu[js])) ? $js = 'javascript="'.$menu[js].'"' : $js='javascript=""';
                echo '<li enlace="'.$menu[ruta].'" '.$id.' '.$padre.' '.$js.'>
                        <div>
                            <span class="glyphicon '.$menu[icono]. '"></span>
                            <span>'.$menu[titulo]. '</span>
                        </div>
                     </li>';
            }else{
                echo '<li class="dropdown" id="'.$menu[idhtml].'">
                        <div>
                            <span class="glyphicon '.$menu[icono]. '"></span>
                            <span>'.$menu[titulo]. '</span>
                            <span class="fui-triangle-down-small"></span>
                        </div>
                        <ul>';
                        $this->menu($menu[id]);
                echo '</ul>
                    </li>';
            }
        }
    }
    public function paginado($total_paginas,$pagina,$url){
        echo '
                <div class="paginado">
                <div class="pagination">
                    <input type="hidden" value="'.$pagina.'" id="pagina">
                    <ul>
                ';
        if ($total_paginas > 1) {
            if ($pagina != 1){
               echo '<li class="previous"><a href="'.$url.'&pag='.($pagina-1).'" class="fui-arrow-left paginacion"></a></li>';
            }else{
               echo '<li class="previous"><a href="#" class="fui-arrow-left"></a></li>';
            }
            for ($i=1;$i<=$total_paginas;$i++) {
                if ($pagina == $i){
                   //si muestro el índice de la página actuatl, no coloco enlace
                    echo '<li class="active"><a href="javascript:void(0)">'.$pagina.'</a></li>';
                }else
                   //si el índice no corresponde con la página mostrada actualmente,
                   //coloco el enlace para ir a esa página
                   echo '<li><a href="'.$url.'&pag='.$i.'" class="paginacion">'.$i.'</a></li>';
            }
            if ($pagina != $total_paginas)
                echo '<li class="next"><a href="'.$url.'&pag='.($pagina+1).'" class="fui-arrow-right paginacion"></a></li>';
            else {
                echo '<li class="next"><a href="#" class="fui-arrow-right"></a></li>';
            }
        }
        echo '</ul>
                </div></div>';
    }
    private function menuHijos($nivel){
        $where['uchip_menu.padre']=$nivel;
        $where['uchip_menu_roles.rol']=$this->uchip->usuario->getInfo('rol');
        if($this->db->countRows('uchip_menu INNER JOIN uchip_menu_roles ON uchip_menu.id = uchip_menu_roles.menu',$where)>0){
            return true;
        }else {
            return false;
        }
    }
    function componente(){
        switch($this->param){
            case '404':
                echo 'Componente no encontrado';
                break;
            case '500':
                echo 'NECESITA PERMISOS';
                break;
            default:
                require_once MODSDIR.$this->param.DS.'index.php';
                break;
        }
    }
    function render($param){
        $this->param = $param;
        if(isset($_REQUEST[ajax]))
            $this->componente();
        else
           require_once TEMPLATESDIR.TEMPLATE.DS.'index.php'; 
    }
    function defecto(){
        require_once TEMPLATESDIR.TEMPLATE.DS.'default.php';
    }
}