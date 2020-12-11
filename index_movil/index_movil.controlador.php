<?php 
# declaracion del objeto global que responde (objResponse)
$objResponse = new xajaxResponse();
$BD = new BD();

function consulcitas()
{
	global $objResponse;	
	global $BD;    
	$tabla='
	<div class="container-fluid">	
		<div class="row">
		<!-- Panel citas dia **********************************************-->
			<div class="col-md-6">
				<div class="panel panel-success">
					<div class="panel-heading"><h3><strong><li class="glyphicon glyphicon-calendar"></li> Citas Asignadas en el Dia Hoy</strong></h3></div>
					<div class="panel-body">
						<table class="table table-dark">
							  <thead>
							    <tr>
							      <th scope="col" bgcolor="#99E7BA">CITAS OK!</th>
							      <th scope="col" bgcolor="#ECA1A7">CITAS PENDIENTES!</th>
							    </tr>
							  </thead>
						 </table> 
						<table id="tabla_informe1" class="table table-sm table-inverse table-hover responsive" style="font-size: 10px;" width="100%" align="center" border="1" bordercolor="#CCCCCC" cellpadding="4" cellspacing="1">
							<thead>
							<tr>
								<th>CLIENTE</th>
								<th>HORA</th>
								<th>ESTADO</th>
							</tr>     
							</thead>
						<tbody>';
						$time1 = date("H:i");
						$CitasDelDia = citasdeldia();
						while(!$CitasDelDia->EOF)
					    {
						    $cliente1 = trim($CitasDelDia->fields["nombre"]);
						    $hora1 = trim($CitasDelDia->fields["hora"]);
						    if($hora1>trim($time1))
						    {
						    	$estado1 = "<b>Cita Pendiente</b>";
						    	$tr1='bgcolor="#ECA1A7"';
						    }else{
						    	$estado1 = "<b>Cita ok!</b>";
						    	$tr1='bgcolor="#99E7BA"';
						    }

							$tabla.='
								<tr '.$tr1.'>
									<td>'.$cliente1.'</td>
									<td>'.$hora1.'</td>
									<td>'.$estado1.'</td>
								</tr> 
							';
							$CitasDelDia->MoveNext();   
						}	
						$tabla.='
					        </body>
					        <tfoot>
					            <tr>
					                <td></td>
					                <td></td>
					                <td></td>
					            </tr>
					        </tfoot>
					    </table>	
					</div>
				</div>
			</div>';

			$tabla.='
			<!-- Panel citas programdas **********************************************-->
			<div class="col-md-6">
				<div class="panel panel-info">
					<div class="panel-heading"><h3><strong><li class="glyphicon glyphicon-calendar"></li> Citas Programadas en otra fecha</strong></h3></div>
					<div class="panel-body">
						<table class="table table-dark">
							  <thead>
							    <tr>
							      <th scope="col" bgcolor="#99E7BA">CITAS OK!</th>
							      <th scope="col" bgcolor="#ECA1A7">CITAS PENDIENTES!</th>
							    </tr>
							  </thead>
						 </table> 
						<table id="tabla_informe2" class="table table-sm table-inverse table-hover responsive" style="font-size: 10px;" width="100%" align="center" border="1" bordercolor="#CCCCCC" cellpadding="4" cellspacing="1">
							<thead>
							<tr>
								<th>CLIENTE</th>
								<th>HORA</th>
								<th>FECHA</th>
								<th>ESTADO</th>
							</tr>     
							</thead>
						<tbody>
						';
						$time2 = date("H:i");
						$CitasPro = CitasPro();
						while(!$CitasPro->EOF)
					    {
						    $cliente2 = trim($CitasPro->fields["nombre"]);
						    $hora2 = trim($CitasPro->fields["hora"]);
						    $fecha = trim($CitasPro->fields["fecha"]);
						   	$sistemfecha = date("Y-m-d");

							if($sistemfecha==$fecha)
						   	{
						   		if($hora2>trim($time2))
							    {
							    	$estado2 = "<b>Cita Pendiente</b>";
							    	$tr2='bgcolor="#ECA1A7"';
							    }else{
							    	$estado2 = "<b>Cita ok!</b>";
							    	$tr2='bgcolor="#99E7BA"';
							    }
						   	}else{
						   		$estado2 = "<b>Cita Pendiente</b>";
							    $tr2='bgcolor="#ECA1A7"';
						   	}	


							$tabla.='
								<tr '.$tr2.'>
									<td>'.$cliente2.'</td>
									<td>'.$hora2.'</td>
									<td>'.$fecha.'</td>
									<td>'.$estado2.'</td>
								</tr> 
							';
							$CitasPro->MoveNext();   
						}	
						
						$tabla.='
					        </body>
					        <tfoot>
					            <tr>
					                <td></td>
					                <td></td>
					                <td></td>
					                 <td></td>
					            </tr>
					        </tfoot>
					    </table>
					</div>
				</div>
			</div>
		</div>	
	</div>';
	 $objResponse->Assign("citas", "innerHTML", utf8_decode($tabla));
	 $objResponse->Script("renderizatablaAyudas('tabla_informe1',[],false,'Bfrtilp');"); 
	 $objResponse->Script("renderizatablaAyudas('tabla_informe2',[],false,'Bfrtilp');"); 			
	
 return $objResponse;

}
$xajax->registerFunction('consulcitas');

function datas()
{
	global $objResponse;	
	global $BD;    
	$tabla='
	<div class="container-fluid">	
		<div class="row">
		<!-- Panel citas dia **********************************************-->
			<div class="col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading"><h3><strong><li class="glyphicon glyphicon-gift"></li> Nuestros clientes de cumplea&ntilde;os hoy!</strong></h3></div>
					<div class="panel-body">
						<table id="tabla_informe3" class="table table-sm table-inverse table-hover responsive" style="font-size: 10px;" width="100%" align="center" border="1" bordercolor="#CCCCCC" cellpadding="4" cellspacing="1">
							<thead>
							<tr>
								<th>FELICITACIONES EN SU DIA A</th>
							</tr>     
							</thead>
						<tbody>';
						$CumpleDia = Cumpledia();

				
						while(!$CumpleDia->EOF)
					    {
						    $cliente = trim($CumpleDia->fields["nombres"]);
						    $id = trim($CumpleDia->fields["id"]);
						    //Mensajes de whatsapp----------------------------------------------------------------------------------------------
						    $celular = $id;
						    $mensaje = "Hola%20".$cliente."%20Hoy%20en%20tu%20dia%20BarberKong%20quiere%20felicitarte%20y%20desearte%20un%20feliz%20cumple%20y%20te%20invita%20a%20que%20nos%20visites%20para%20darte%20grandes%20sorpresas!";
						    $ruta = "'https://api.whatsapp.com/send?phone=57".$celular."&text=".$mensaje."'";
						    //Fin---------------------------------------------------------------------------------------------------------------
							$tabla.='
								<tr>
									<td><a href="javascript:void(0);" onclick="whatsapp('.$ruta .')">'.$cliente.'</a></td>
								</tr> 
							';
							$CumpleDia->MoveNext();   
						}	
						$tabla.='
					        </body>
					        <tfoot>
					            <tr>
					                <td></td>
					            </tr>
					        </tfoot>
					    </table>	
					</div>
				</div>
			</div>';
			
			$ConfigVisitas = ConfiguVisitas();
            while(!$ConfigVisitas->EOF)
            {
				$nroconfivisitas = trim($ConfigVisitas->fields["configuracion"]);
				$ConfigVisitas->MoveNext();   
            }
   
			$tabla.='
			<!-- Panel citas programdas **********************************************-->
			<div class="col-md-6">
				<div class="panel panel-warning">
					<div class="panel-heading"><h3><strong><li class="glyphicon glyphicon-book"></li> Nuestros clientes y visitas</strong></h3></div>
					<div class="panel-body">
						<table class="table table-dark">
							  <thead>
							    <tr>
							      <th scope="col" bgcolor="#99E7BA">Clientes con visitias superiores o iguales a '.$nroconfivisitas.'</th>
							    </tr>
							  </thead>
						 </table> 
						<table id="tabla_informe4" class="table table-sm table-inverse table-hover responsive" style="font-size: 10px;" width="100%" align="center" border="1" bordercolor="#CCCCCC" cellpadding="4" cellspacing="1">
							<thead>
							<tr>
								<th>CLIENTE</th>
								<th>Nro VISITAS</th>
							</tr>     
							</thead>
						<tbody>
						';
						//$time = date("H:i:s");
						$VisitasVer = Visitas();
						while(!$VisitasVer->EOF)
					    {
						    $cliente = trim($VisitasVer->fields["nombres"]);
						    $visitas = trim($VisitasVer->fields["visitas"]);
						    $visitas_confi = trim($VisitasVer->fields["visitas_confi"]);
						    if($visitas_confi>0)
						    {
						    	$tr = 'bgcolor="#99E7BA"';
						    }else{
						    	$tr = '';
						    }	
							$tabla.='
								<tr '.$tr.'>
									<td>'.$cliente.'</td>
									<td>'.$visitas.'</td>

								</tr> 
							';
							$VisitasVer->MoveNext();   
						}	
						
						$tabla.='
					        </body>
					        <tfoot>
					            <tr>
					                <td></td>
					                <td></td>

					            </tr>
					        </tfoot>
					    </table>
					</div>
				</div>
			</div>
		</div>	
	</div>';
	 $objResponse->Assign("datos", "innerHTML", utf8_decode($tabla));
	 $objResponse->Script("renderizatablaAyudas('tabla_informe3',[],false,'Bfrtilp');"); 
	 $objResponse->Script("renderizatablaAyudas('tabla_informe4',[],false,'Bfrtilp');"); 			
	
 return $objResponse;

}
$xajax->registerFunction('datas');


?>