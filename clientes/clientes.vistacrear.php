<!DOCTYPE html>
<html> 
  <head>
  	<?php
		$xajax->printJavascript('funciones/');
	?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>.::BarberKong-CrearClientes::.</title>
    <script language="JavaScript" type="text/javascript" src="clientes/clientes.js"></script>
    <script type="text/javascript" src="javascript/jquery.min.js"></script> 
    <link rel="stylesheet" href="estilos/bootstrap/css/bootstrap.css" type="text/css" media="screen">
    <link rel="stylesheet" href="estilos/bootstrap/css/bootstrap_dialog.css" type="text/css" media="screen">
    <script type="text/javascript" src="estilos/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="estilos/bootstrap/js/bootstrap_dialog.js"></script>

	<style type="text/css">
		#global {
		height: 200px;
		width: 100%;		
		overflow-y: scroll;
		}
		#mensajes {
		height: auto;
		}
		.texto {
		padding:4px;
		background:#fff;
		}
	</style>
    </head>
    <body onload="xajax_cargando();xajax_Cliente();" >

	<section>
		<div class="col-md-12 col-xs-12 col-lg-12" >
			<br>
			<div id="diclientes"></div>
		</div>	

	</section>	
	</body>
</html>