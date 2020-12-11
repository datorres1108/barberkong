<!DOCTYPE html>
<html> 
  <head>
  	<?php
		$xajax->printJavascript('funciones/');
	?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>.::BarberKong-Citas-Programdas::.</title>
    <script language="JavaScript" type="text/javascript" src="citas/citas.js"></script>
    <script type="text/javascript" src="javascript/jquery.min.js"></script> 
    <link rel="stylesheet" href="jquery-ui/jquery-ui.theme.min.css" type="text/css" media="screen">
    <script type="text/javascript" language="javascript" src="jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" language="javascript" src="jquery-ui/chosen.jquery.js"></script>

    <link rel="stylesheet" href="estilos/bootstrap/css/bootstrap.css" type="text/css" media="screen">
    <link rel="stylesheet" href="estilos/bootstrap/css/bootstrap_dialog.css" type="text/css" media="screen">
    <script type="text/javascript" src="estilos/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="estilos/bootstrap/js/bootstrap_dialog.js"></script>

    <link rel="stylesheet" type="text/css" href="funciones/datatable2/DataTables-1.10.13/css/dataTables.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="funciones/datatable2/Buttons-1.2.3/css/buttons.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="funciones/datatable2/Responsive-2.1.0/css/responsive.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="funciones/datatable2/Scroller-1.4.2/css/scroller.bootstrap.min.css"/>   
    <script type="text/javascript" src="funciones/datatable2/JSZip-2.5.0/jszip.min.js"></script>
    <script type="text/javascript" src="funciones/datatable2/DataTables-1.10.13/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="funciones/datatable2/DataTables-1.10.13/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="funciones/datatable2/Buttons-1.2.3/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="funciones/datatable2/Buttons-1.2.3/js/buttons.bootstrap.min.js"></script>
    <script type="text/javascript" src="funciones/datatable2/Buttons-1.2.3/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="funciones/datatable2/Responsive-2.1.0/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="funciones/datatable2/Responsive-2.1.0/js/responsive.bootstrap.min.js"></script>

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
    <body onload="xajax_cargando();xajax_consulcitas();" >

	<section>
		<div class="col-md-12 col-xs-12 col-lg-12" >
			<br>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2>
					 <span class="btn btn-default pull-left" id="regremenu" onclick="regresarmenu()">
			           	<i class="glyphicon glyphicon-home" ></i> Regresar al Menu
			         </span>&nbsp;&nbsp;
			         	<i class="glyphicon glyphicon-search" ></i> <li class="glyphicon glyphicon-calendar"></li>  <strong>Consulta de citas Asignadas</strong>  
			         </h2>
				</div>
				<div class="panel-body">

						<div id="citas"></div>

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