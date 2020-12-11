<!DOCTYPE html>
<html> 
  <head>
  	<?php
		$xajax->printJavascript('funciones/');
	?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>.::BarberKong-ModificarClientes::.</title>
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
    <body onload="xajax_cargando();" >

	<section>
		<div class="col-md-12 col-xs-12 col-lg-12" >
			<br>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2><li class="glyphicon glyphicon-edit"></li> <i class="glyphicon glyphicon-user" ></i> <strong>Editar clientes</strong>  </h2>
				</div>
				<div class="panel-body form-inline">
					<div class="form-group">
						<b>Nro Celular:</b><br>
						<input type="number"  name="cel" id="cel"  class="form-control" placeholder="Documento del cliente">
					</div>
					
                   <div class="form-group">
                   		<br>
                        <span class="btn btn-success" id="btn-crear" onClick="BtnConsultarEditCli()" >
                        	<i class="glyphicon glyphicon-search" ></i><strong> Buscar</strong>
                        </span>                    
                    </div>
                  <div id="edit_clientes"></div>  
				</div>
				<div class="panel-footer">
			          <div class="btn-group"> 
			            <span class="btn btn-default pull-left" id="regremenu" onclick="regresarmenu()">
			            	<i class="glyphicon glyphicon-home" ></i> Regresar al Menu
			            </span>
			          </div>
	     		</div>
			</div>
		</div>	

	</section>	
	</body>
</html>