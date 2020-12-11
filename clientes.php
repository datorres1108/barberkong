<?php
# PROGRAMA DE CONTROL (PRINCIPAL) 
ini_set('session.cache_limiter', '');
header('Expires: Fry, 31 Dec 2001 08:52:00 GMT');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: no-cache');
require_once ("BD.php"); //archivo con clase para la conexion a BD
require_once ("funciones/xajax_core/xajax.inc.php");
# programa actual
$programa = explode("/",$_SERVER['PHP_SELF']);
$programa = str_replace(".php", "", $programa[count($programa)-1]);

# registro de xajax y funciones xajax
$xajax = new xajax();
include_once ("$programa/$programa.modelo.php");
include_once ("$programa/$programa.controlador.php");
$xajax->setCharEncoding('ISO-8859-1');
$xajax->processRequest();

# control
$accion = $_GET["accion"];
switch($accion)
{
	case "crear" :
		include_once ("$programa/$programa.vistacrear.php");
	break;
	case "modi" :
		include_once ("$programa/$programa.vistamodi.php");
	break;
	case "consul" :
		include_once ("$programa/$programa.vistaconsul.php");
	break;
    //// aqui se agregan los otros case, pero practicamente con el menu se maneja
}
?>