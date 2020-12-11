<?php 

$BD = new BD();
function RegiVisi($fecha_visita,$celular)
{
	global $BD;	
	$BD->conectar(); 
	$id = trim($celular);
	$fecha_visita = trim($fecha_visita);
	$sql = "INSERT INTO visitas(id_cliente,visita,fecha) VALUES ('$id','1','$fecha_visita')";
	$crearcliente = $BD->consultar($sql);	
		
	return $crearcliente;
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

function Consultar_visita($cel)
{
	global $BD;	
	$BD->conectar(); 
	$id = trim($cel);
	$sql="SELECT * FROM visitas WHERE id_cliente='$cel'";
	$clientes = $BD->consultar($sql);	
	return $clientes;
}


?>