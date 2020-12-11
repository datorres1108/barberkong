<?
if(isset($_POST)){
	session_start();
	include_once("../configuracion/abrirbdi.php");
	include_once("../lee_basei.php");

	$programa = $_POST['programa'];

	$mat_pro = lee_todo("SELECT distinct lower(trim(p.programa)) programa, lower(trim(p.descripcion)) descripcion
from nue_programa p, nue_perpro p2
where
p.programa = p2.programa
and p2.usuario = '".$_SESSION['usuario']."'
and (lower(p.programa) matches '*".strtolower($programa)."*' or lower(p.descripcion) matches '*".strtolower($programa)."*')
and p2.f_expira_p >= today
order by 1");
	$programas = "";
	for ($i=0; $i < count($mat_pro); $i++) { 
		$programas .= "<li><a href='".$mat_pro[$i]['programa'].".php' target='_parent'><span class='badge'>".$mat_pro[$i]['programa']."</span> ".ucwords($mat_pro[$i]['descripcion'])."</a></li>";
	}
	if(count($mat_pro) == 0){
		$programas = "<li><a href='#'>No se encontraron programas</a></li>";
	}

	$resultado["listado"] = utf8_encode($programas);
	echo json_encode($resultado);
	die;
}
?>