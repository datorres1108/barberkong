<?php 
function Listadocitas()
{
	global $BD;	
	$BD->conectar(); 
	$fecha =  date("Y-m-d");
	$time1 = date("H:i");
	$sql="SELECT * FROM config_citas WHERE id NOT IN (SELECT id_confcita FROM asig_citas WHERE fecha='$fecha' and tipo='Dia') and descri >'$time1'";
	$clientes = $BD->consultar($sql);	
	return $clientes;
}

function Listadohoras($fecha)
{
	global $BD;	
	$BD->conectar(); 
	//$fecha =  date("Y-m-d");
	$sql="SELECT id,descri FROM config_citas WHERE id NOT IN (SELECT id_confcita FROM asig_citas WHERE fecha='$fecha' and tipo='Pro')";
	$clientes = $BD->consultar($sql);	
	return $clientes;
}

function Consultar_cliente($cel)
{
	global $BD;	
	$BD->conectar(); 
	$id = trim($cel);
	$sql="SELECT * FROM clientes WHERE id='$cel'";
	$clientes = $BD->consultar($sql);	
	return $clientes;
}

function asigna_cita($cel,$nombres,$id)
{
	global $BD;	
	$BD->conectar(); 
	$cel = trim($cel);
	$nombres =  trim(strtoupper($nombres));
	$fecha = date("Y-m-d");

	$inset_sql = "INSERT INTO asig_citas(id_confcita,celular,nombre,fecha,tipo) 
				VALUES ('$id','$cel','$nombres','$fecha','Dia')";
	$res_isert = $BD->consultar($inset_sql);

	return $res_isert;
}

function asigna_citapro($celular,$nomape,$fechacita,$hora)
{
	global $BD;	
	$BD->conectar(); 
	$celular = trim($celular);
	$nomape =  trim(strtoupper($nomape));
	$fechacita = trim($fechacita);
	$hora = trim($hora);

	$inset_sql = "INSERT INTO asig_citas(id_confcita,celular,nombre,fecha,tipo) 
				VALUES ('$hora','$celular','$nomape','$fechacita','Pro')";
	$res_isert = $BD->consultar($inset_sql);

	return $res_isert;
}

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

function Cancela_CitaDia($id)
{
	global $BD;	
	$BD->conectar(); 
	$sql="DELETE FROM asig_citas WHERE id = '$id' and tipo='Dia'";
	$res = $BD->consultar($sql);	
	return $res;
}

function Cancela_CitaPro($id)
{
	global $BD;	
	$BD->conectar(); 
	$sql="DELETE FROM asig_citas WHERE id = '$id' and tipo='Pro'";
	$res = $BD->consultar($sql);	
	return $res;
}

?>