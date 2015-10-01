<?
class Funciones{
    public $db;
    
    function __construct($db){
        $this->db=$db;
    }
    
    public function reemp($texto1) {

        //Rememplazamos caracteres especiales latinos minusculas
        $find = array('á', 'é', 'í', 'ó', 'ú', 'ñ', '\"', '€', 'ü');
        $repl = array('&aacute;', '&eacute;', '&iacute;', '&oacute;', '&uacute;', '&ntilde;', '&quot;', '&euro;', '&uuml;');
        $texto1 = str_replace ($find, $repl, $texto1);


        //Rememplazamos caracteres especiales latinos mayusculas
        $find = array('Á', 'É', 'Í', 'Ó', 'Ú', 'Ñ', 'Ü', 'ç', 'Ç');
        $repl = array('&Aacute;', '&Eacute;', '&Iacute;', '&Oacute;', '&Uacute;', '&Ntilde;', '&Uuml;', '&ccedil;', '&Ccedil;');
        $texto1 = str_replace ($find, $repl, $texto1);

        return $texto1;

    }
    public function UploadSecure($archivo,$nombre,$directorio,$rw=true,$maximo=2000000,$extensiones=''){
        //$target_dir = $directorio;
        
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($archivo["name"],PATHINFO_EXTENSION));
        $target_file = $directorio.$nombre.'.'.$imageFileType;
        $archivo2 = $nombre.'.'.$imageFileType;
        // Check if image file is a actual image or fake image
        // Check if file already exists
        $mensaje['Error']='';
        if (file_exists($target_file) && !$rw) {
            $mensaje['Error'] .= "Sorry, file already exists.<br>";
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > $maximo) {
            $mensaje['Error'].= "Sorry, your file is too large.<br>";
            $uploadOk = 0;
        }
        
        if(!is_array($extensiones)){
            $extensiones = array("jpg", "gif", "png", "jpeg");
        }
        // Allow certain file formats
        if(!in_array($imageFileType, $extensiones)) {
            $mensaje['Error'] .= "Formato no permitido.<br>";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $mensaje['St']=0;
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($archivo["tmp_name"], $target_file)) {
                $mensaje['St']=1;
                $mensaje['archivo']=$target_file;
                $mensaje['basename']=$archivo2;
            } else {
                $mensaje['St']=0;
            }
            
        }
        return $mensaje;
    }
    public function fechasql($fecha){
	if(strlen($fecha) == 10)
		return substr($fecha,6,4).'-'.substr($fecha,3,2).'-'.substr($fecha,0,2);
	else 
		return substr($fecha,6,4).'-'.substr($fecha,3,2).'-'.substr($fecha,0,2).' '.substr($fecha,11,8);
    }
    public function fechanormal($fecha,$separador='-'){
	if(strlen($fecha) == 10)
		return substr($fecha,8,2).$separador.substr($fecha,5,2).$separador.substr($fecha,0,4);
	else 
		return substr($fecha,8,2).$separador.substr($fecha,5,2).$separador.substr($fecha,0,4).' '.substr($fecha,11,8);
    }
    private function autoCurso(){
        $where['niveles.nombre']=$_REQUEST[query];
        $from = 'cursos
                INNER JOIN niveles ON cursos.nivel = niveles.id
                INNER JOIN docentes ON cursos.profesor = docentes.id';
        $cols="cursos.id,
                CONCAT(niveles.nombre,' ',cursos.seccion,' (',docentes.nombre,' ',docentes.apellido,')') AS CURSO";
        $reps = $this->db->select($from,$where,'niveles.nombre','',true,'',$cols);
        $return = array();
        $cont=0;
        foreach($reps as $rep){
            $return[$cont]['id']=$rep[id];
            $return[$cont]['value']=$rep[CURSO];
            $cont++;
        }
        echo json_encode($return);
    }
    public function Autocompletar($tipo){
        switch($tipo){
            case 'representantes':
                $this->autoRep();
                break;
            case 'curso':
                $this->autoCurso();
                break;
        }
        
    }
    private function autoRep(){
        $where[nombre]=$_REQUEST[query];
        $where[apellido]=$_REQUEST[query];
        $reps = $this->db->select('representantes',$where,'nombre','',true,'OR','id, nombre, apellido, cedula');
        $return = array();
        $cont=0;
        foreach($reps as $rep){
            $return[$cont]['id']=$rep[id];
            $return[$cont]['value']=$rep[nombre].' '.$rep[apellido].' ('.$rep[cedula].')';
            $cont++;
        }
        echo json_encode($return);
    }
    public function Cifras($numero,$formato="NORMAL"){
        switch($formato){
            case 'NORMAL':
                return number_format($numero, 1, ',', '.');
                break;
            case 'EXCEL':
                return number_format($numero, 1, '.', ',');
                break;
        }
    }
    public function distance($lat1, $lon1, $lat2, $lon2, $unit) {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);
        if ($unit == "K") {
            $numero = ($miles * 1.609344);
        } else if ($unit == "N") {
            $numero = ($miles * 0.8684);
        } else {
            $numero = $miles;
        }
        return $numero;
    }
}
?>