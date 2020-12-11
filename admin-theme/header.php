<?
if(trim($_SESSION['nombre_usu']) == ""){
	$obj_usuario = json_decode($_COOKIE["obj-usuario"]);
	if($obj_usuario->f_valida != date("mdY")){
		header("index.php?logout=yes&cause=3");
	}
	$nombre_usu = $obj_usuario->nombre;
	$_SESSION['nombre_usu'] = $nombre_usu;
	include_once("lee_basei.php");
}
$theme_adicional = "";
switch ($_SERVER['SERVER_NAME']) {
	case 'capimax.holding': $base='capimax';  break;
	case 'fincacorocora.holding': $base='fincacorocora';  break;
	case 'portacap.holding': $base='portacap';  break;
	case 'margariton.holding': $base='margariton';  break;
	case 'pricap.holding': $base='pricap';  break;
	case 'dev-pricap.holding': $base='pricap';  break;
	case 'ellipse.holding': $base='pricap';  break;
	case 'erp.ellipselingerie.com': $base='pricap'; break;
	case 'erp.inscra.com': $base='pricap';  break;
	case '10.0.2.10': $base='pricap'; $theme_adicional = '<link rel="stylesheet" href="estilos/bootstrap/css/bootstrap-theme.pru.css" type="text/css" media="screen">'; break;
	case 'testerp.pricap.com': $base='pricap'; $theme_adicional = '<link rel="stylesheet" href="estilos/bootstrap/css/bootstrap-theme.pru.css" type="text/css" media="screen">'; break;
	case '10.0.2.13': $base='pricap';  break;
	case '10.0.2.31': $base='pricap dllo'; $theme_adicional = '<link rel="stylesheet" href="estilos/bootstrap/css/bootstrap-theme.dllo.css" type="text/css" media="screen">'; break;
	case 'pruebas.inscra.com'; $base='pricap pru'; $theme_adicional = '<link rel="stylesheet" href="estilos/bootstrap/css/bootstrap-theme.pru.css" type="text/css" media="screen">';  break;
}
$host = $_SESSION['host'];
if($host == "inscra") $text_host = "PROD";
if($host == "inscra_pruebas") $text_host = "TEST";
$pre_header = file_get_contents("admin-theme/pre-header.html");
$pre_header = str_replace("%%theme_adicional%%", $theme_adicional, $pre_header);
echo $pre_header;
$header = file_get_contents("admin-theme/header.html");
$header = str_replace("%%titulo%%", $titulo, $header);
$header = str_replace("%%usuario%%", $_SESSION['nombre_usu']." - ".$_SESSION['usuario'], $header);


$header = str_replace("%%entorno%%", strtoupper($base)." <b>".$text_host."</b>", $header);


$arr_programa = explode("/", $_SERVER['PHP_SELF']);
$programa_actual = strtolower(str_replace(array(".php","#"), "", $arr_programa[count($arr_programa)-1]));

$texto_ayuda = "";
if($programa_actual != "index"){
	$texto_ayuda = "<li><a onclick='window.open(\"ayuda.php?prog=$programa_actual&amp;opcion=\",\"Ayuda\",\"scrollbars=yes, resizable=yes\")' class='navbar-btn' data-container='body' data-toggle='tooltip' data-placement='bottom' title='' data-original-title='Ayuda'><i class='glyphicon glyphicon-info-sign'></i></a></li>";
}
$header = str_replace("%%icono_ayuda%%", $texto_ayuda, $header);

if($programa_actual == "index"){
	echo str_replace("%%ver_favoritos%%", "hidden", $header);
	return;
}
$favoritos = lee_todo("SELECT lower(programa) programa, (select trim(descripcion) from nue_programa where programa = ins_favoritos.programa) descripcion from ins_favoritos where usuario = '".$_SESSION['usuario']."' order by programa");
$txt_favoritos = "";
for ($i=0; $i < count($favoritos); $i++) { 
	$txt_favoritos .= "<li><a href='{$favoritos[$i][programa]}.php' target='_parent' data-container='body' data-toggle='tooltip' data-placement='right' title='".$favoritos[$i]['descripcion']."'>".$favoritos[$i]['programa']."</a></li>\n";
	if($favoritos[$i]['programa'] == $programa_actual || "p".$favoritos[$i]['programa'] == $programa_actual){
		$txt_elim_favorito = "<li><a href='#' id='eliminar-favorito'><i class='glyphicon glyphicon-star-empty'></i> Eliminar de Favoritos</a></li>\n";
	}
}

if($txt_favoritos != "" && $programa_actual != "index"){
	$txt_favoritos .= "<li role='separator' class='divider'></li>";
}


if(count($favoritos) == 0 && $programa_actual == "index") {
	$header = str_replace("%%ver_favoritos%%", "hidden", $header);
}
if($programa_actual != "index" && $txt_elim_favorito == ""){
	$txt_favoritos .= "<li><a href='#' id='agregar-favorito'><i class='glyphicon glyphicon-star'></i> Agregar a Favoritos</a></li>";
}
$header = str_replace("%%favoritos%%", $txt_favoritos, $header);
$header = str_replace("%%eliminar_favorito%%", $txt_elim_favorito, $header);

echo $header;
?>


