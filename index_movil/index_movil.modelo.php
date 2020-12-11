<?php 
function citasdeldia()
{
	global $BD;	
	$BD->conectar(); 
	$fecha =  date("Y-m-d");
	$sql="
	SELECT a.id,a.id_confcita,a.nombre,c.descri as hora FROM asig_citas as a 
	INNER JOIN config_citas c On (c.id=a.id_confcita)
	WHERE a.fecha='$fecha' and a.tipo='Dia'";
	$res = $BD->consultar($sql);	
	return $res;
}

function CitasPro()
{
	global $BD;	
	$BD->conectar(); 
	$fecha =  date("Y-m-d");
	$sql="
	SELECT a.id,a.id_confcita,a.nombre,c.descri as hora,a.fecha FROM asig_citas as a 
	INNER JOIN config_citas c On (c.id=a.id_confcita)
	WHERE a.fecha>='$fecha' and a.tipo='Pro'";
	$res = $BD->consultar($sql);	
	return $res;
}

function Cumpledia()
{
	global $BD;	
	$BD->conectar(); 
	$fi = date("Y-m-d");
	$fechav =  explode("-",$fi);
	$mes = $fechav[1];
	$dia = $fechav[2];
	$sql="SELECT id,nombres FROM clientes WHERE fcumplemes='$mes' and fcumpledia='$dia'";
	$res = $BD->consultar($sql);	
	return $res;
}

function Visitas()
{
	global $BD;	
	$BD->conectar(); 
	$sql="
	SELECT  sum(v.visita) as visitas,c.nombres,(sum(v.visita) >= (SELECT configuracion FROM config_visitas) ) as visitas_confi
	FROM visitas v
	INNER JOIN clientes c ON (c.id=v.id_cliente)
	GROUP BY V.id_cliente";
	$res = $BD->consultar($sql);	
	return $res;
}

function ConfiguVisitas(){
	global $BD;	
	$BD->conectar(); 
	$sql="SELECT configuracion FROM config_visitas WHERE 1";
	$res = $BD->consultar($sql);	
	return $res;
}

?>