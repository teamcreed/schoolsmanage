<?php

class Miscelanos{
    public $uchip;
    public $func;
    public $vistas;
    public $ruta;
    function __construct($uchip){
        $this->uchip=$uchip;
        $this->func = new Funciones($uchip->db);
        $this->ruta='misc';
        $this->vistas=$this->ruta.DS.'vistas'.DS;
    }
    public function utf8_encode_all($dat){
        if (is_string($dat)) return utf8_encode($dat);
        if (!is_array($dat)) return $dat; 
        $ret = array();
        foreach($dat as $i=>$d) $ret[$i] = $this->utf8_encode_all($d);
        return $ret;
    } 
    public function Router(){
        switch($_REQUEST[task]){
            case 'LatLng':
                $coordenadas = $this->func->RomperCoordenadas($_REQUEST[centro]);
                $this->func->UpdateLatLng($coordenadas[0],$coordenadas[1]);
                break;
            case 'UpZoom':
                $this->func->UpdateZoom($_REQUEST[Zoom]);
                break;
            case 'UpState':
                $this->func->UpdateVehiculosState($_REQUEST[Vehiculos]);
                break;
            case 'mkView':
                $this->func->MkView($_REQUEST[centro],$_REQUEST[Zoom],$_REQUEST[nombre]);
                break;
            case 'SavePlace':
                $this->func->MkPlace($_REQUEST[Nombre],$_REQUEST[LatLng],$_REQUEST[Zoom],$_REQUEST[Icono]);
                break;
            case 'DelView':
                $this->func->DelView($_REQUEST[idVista]);
                break;
            case 'DelPlace':
                $this->func->DelLugar($_REQUEST[idLugar],$_REQUEST[Position]);
                break;
            case 'DelZona':
                $this->func->DelZona($_REQUEST[idZona]);
                break;
            case 'UpdateDispositivos':
                $arr = $this->func->getDispositivos($_SESSION[usuario][ID],$_SESSION[usuario][rol]);
                echo json_encode($this->utf8_encode_all($arr));
                break;
            case 'OpMap':
                $this->func->UpdateMapOP($_REQUEST[Type],$_REQUEST[Mapa]);
                break;
            case 'Historico':
                sleep(2);
                $arr = $this->func->mkHistorico();
                echo json_encode($this->utf8_encode_all($arr));
                break;
            case 'mkSim':
                $this->func->mkSim();
                break;
            case 'SaveZona':
                $this->func->saveZona();
                break;
            case 'UpdateAlarm':
                $this->func->UpdateAlarm($_REQUEST[idZona],$_REQUEST[Tipo],$_REQUEST[Valor]);
                break;
            case 'SendCom':
                //ESTO DEBERIA MODIFICARSE PARA ENVIAR DISTINTOS TIPOS DE COMADOS A DISTINTOS TIPOS DE EQUIPOS
                //POR AHORA SOLO SE ENVIA APAGADO A LOS TK
                sleep(3);
                $comando = $this->func->SendCom($_REQUEST[idDisp]);
                include (MODSDIR.$this->vistas.'rescommand.php');
                break;
        }
    }
}
$misc= new Miscelanos($this->uchip);
?>