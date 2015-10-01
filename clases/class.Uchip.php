<?
class Uchip{
    public $db;
    public $func;
    public $usuario;
    public $template;
    function __construct(){
        $this->db = new MySQL(DBNAME,DBUSER,DBPASS,DBHOST);
        $this->template = new Template($this);
        $this->func = new Funciones($this->db);
        $this->usuario = new Usuario($this->db,$this->func);
        //array_walk($_REQUEST, array($this->db, 'limpiar'));
    }
    public function manejarError($error){
        echo 'ERROR&$&'.$error;
    }
    
    public function Router($componente){
        //$this->usuario->logout();
        (empty($componente) && $this->usuario->logeado()) ? $componente = 'principal' : $componente=$componente;
        $where[request]=$componente;
        $where[st]=1;
        if($comp = $this->db->select('uchip_componentes',$where)){
            if($comp[0][logeado]==0)
                $this->template->render($comp[0][ruta]);
            else{
                if($this->usuario->permiso($comp[0][id]))
                    $this->template->render($comp[0][ruta]);
                elseif(!$this->usuario->logeado())
                    $this->template->defecto();
                else
                    $this->template->render(500);
            }
                
        }elseif(!empty($componente)){
            $this->template->render(404);
        }else{
            $this->template->defecto();
        }
    }
}