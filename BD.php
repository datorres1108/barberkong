<?php
/*CLASE BASE DE DATOS PARA REALIZAR LA CONEXION, CONSULTA Y DESCONEXION CON LA BASE DE DATOS */
/*INCLUYE LA LIBRERIA ADODB*/
include('adodb/adodb.inc.php');
class BD{
	var $servidor;
	var $usuario;
	var $password;
	var $dtbs;
	var $conexion;
	var $db;
	var $res;
		
/*CONSTRUCTOR DE LA CLASE BASE DE DATOS QUE INICIALIZA LAS VARIABLES DE LA CLASE*/
 FUNCTION BD(){
	$bd="barberkong";
    $this->servidor="127.0.0.1";
	$this->usuario="root";
	$this->password="";
	$this->dtbs=$bd;}
	
/*FUNCION QUE CUENTA EL NUMERO DE REGISTROS DE UNA CONSULTA DADA*/
 FUNCTION numreg($consulta){
 RETURN $consulta->RecordCount();}

/*FUNCION CONECTAR, QUE REALIZA LA CONEXION A LA BASE DE DATOS Y LA SELECION DE LA MISMA */	 
 FUNCTION conectar(){
    $this->db= NewADOConnection("mysql");
	$this->conexion=$this->db->Connect($this->servidor,$this->usuario,$this->password,$this->dtbs)or die("Unable to connect!");
    RETURN $this->conexion;}

/*FUNCION CONSULTAR QUE PERMITE REALIZAR LAS CONSULTAS A LA BASE DE DATOS Y RETORNA LA RESPUESTA*/
 FUNCTION consultar($sql){
    $this->res=$this->db->Execute($sql);
    RETURN $this->res;}
  
/*FUNCION QUE DEVUELVE EL ID DE LA SECUENCIA*/  
 FUNCTION id($sec){
    RETURN $this->db->GenID($sec);}
  
/* FUNCION PARA EXTRAER LA IMAGEN*/
 FUNCTION ManejoArchivo($img,$TamImag){
   if ($img != "none" ){
   	$fp =fopen($img, "rb");
    $imagen =fread($fp, $TamImag);
    $imagen =addslashes($imagen);
    RETURN $imagen;
    fclose($fp);}}
   
/* FUNCION PARA EVITAR LA INYECCION DE SQL*/ 
 FUNCTION InyeccionSql($cadena){ 
	$invalido=array(";"=>" ","'"=>" ","alter"=>" ","drop"=>" ","select"=>" ","from"=>" ","where"=>" ","insert"=>" ","delete"=>" ","*"=>" ","or"=>"","and" 
	=>" ","%27"=>" ","table"=>" "); 
	$correcto=strtr($cadena,$invalido); 
	$correcto=strip_tags($correcto); 
	RETURN $correcto;} 
      
/*FUNCION DESCONECTAR QUE CIERRA LA CONEXION CON LA BASE DE DATOS*/
 FUNCTION desconectar(){
    $this->db->Close();}
 }
?>