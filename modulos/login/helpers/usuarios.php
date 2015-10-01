<?

class Usuarios{
    public $uchip;
    public $func;
    function __construct($uchip){
        $this->uchip=$uchip;
        $this->func = new Funciones($uchip->db);
    }
    function mklogin(){
        return $this->uchip->usuario->mklogin();
    }
}
$usuario = new Usuarios($this->uchip);
?>