<?php 

$BD = new BD();
function Crear_cliente($celular,$nomape,$email,$celular,$fcdia,$fcmes)
{
	global $BD;	
	$BD->conectar(); 
	$id = trim($celular);
	$nombres =  trim(strtoupper($nomape));
	$correo = trim($email);
	$celular = trim($celular);
	$fcdia = trim($fcdia);
	$fcmes = trim($fcmes);

	$sql = "INSERT INTO clientes(id,nombres,correo,celular,fcumpledia,fcumplemes,estado) 
				VALUES ('$id','$nombres','$correo','$celular','$fcdia','$fcmes','A')";
	$crearcliente = $BD->consultar($sql);	
		
	return $crearcliente;
}

function Modifia_cliente($edit_celular,$edit_nomape,$edit_email,$edit_fcdia,$edit_fcmes,$estado,$documento)
{
	global $BD;	
	$BD->conectar(); 
	$edit_docu = trim($edit_celular);
	$edit_nomape =  trim(strtoupper($edit_nomape));
	$edit_email = trim($edit_email);
	$edit_celular = trim($edit_celular);
	$edit_fcdia = trim($edit_fcdia);
	$edit_fcmes = trim($edit_fcmes);
	$estado = trim($estado);

	$sql ="	
	UPDATE clientes
	SET id='$edit_docu',nombres='$edit_nomape',correo='$edit_email',celular='$edit_celular',fcumpledia='$edit_fcdia',fcumplemes='$edit_fcmes',estado='$estado' 
	WHERE id='$documento'";
	$modificacliente = $BD->consultar($sql);

	return $modificacliente;	
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

function Consulclin()
{
	global $BD;	
	$BD->conectar(); 
	$sql="SELECT * FROM clientes ORDER BY nombres ASC";
	$clientes = $BD->consultar($sql);	
	return $clientes;
}
?>