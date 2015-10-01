<?
require_once 'helpers'.DS.'usuarios.php';
switch($_REQUEST[task]){
    case 'mklogin':
        ($usuario->mklogin()) ? $log=1 : $log=0;
        echo $log;
        break;
}
?>