<?php
# declaracion del objeto global que responde (objResponse)
$objResponse = new xajaxResponse();
$BD = new BD();
//funcion ppal que carga el programa inicial con los pedidos asignados al usuario de sesion
function TraeListaCitas()
{

	 global $objResponse;	
     global $BD;    
	$tabla='
	<div class="col-md-12 col-xs-12 col-lg-12" >
		<table class="table table-dark">
			<thead>
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Hora Cita</th>
					<th scope="col">Cliente Registrado</th>
					<th scope="col">Cliente No Registrado</th>
					<th scope="col"></th>
				</tr>
			</thead>
			<tbody>';
			$TraeCitas = Listadocitas();
			while(!$TraeCitas->EOF)
        	{
	            $id = trim($TraeCitas->fields["id"]);
	            $descri = trim($TraeCitas->fields["descri"]);
				$tabla.='
					<tr>
						<td>'.$id.'</td>
						<td><h3>'.$descri.'</h3></td>
						<td>
							<input type="text"  name="cel'.$id.'" id="cel'.$id.'" class="form-control"  placeholder="Nro celular" onchange="xajax_Traenom(this.value,'.$id.')">
						</td>
						<td> 
							<input type="text"  name="nombres'.$id.'" id="nombres'.$id.'" class="form-control"  placeholder=" Nombre y apellidos" style="text-transform:uppercase;" size="50%"> 
						</td>
						<td>
							 <span class="btn btn-success" id="btn-crear" onClick="btn_asigcita('.$id.')" >
	                        	<i class="glyphicon glyphicon-ok" ></i><strong> Asignar Cita</strong>
	                        </span>   
						</td>
					</tr>
				';
				 $TraeCitas->MoveNext();   
			}	

	$tabla.='
		  	</tbody>
		</table>
	</div>';

	 $objResponse->Assign("tbl_asicitas", "innerHTML", utf8_decode($tabla));
 return $objResponse;

}
$xajax->registerFunction('TraeListaCitas');

function asignarcitas($cel,$nombres,$id)
{
    global $objResponse;
    global $BD; 
    $error ="";
    if(trim($nombres)==""){
        $error .= "<li>Debe ingresar un nombre,apellido o apodo como minimo para asignar la cita</li>";
    }

    if($error =="")
    {
        $AsignarCitas = asigna_cita($cel,$nombres,$id);
        if(count($AsignarCitas)>0)
        { 
            $objResponse->Script("msjcitaok()");      

        }else
        {
          $objResponse->Script("alerta('<h5 class=text-danger><strong>Atencion! Hubo un error al guardar</strong></h5>')");
        } 

    }else
    {
        $objResponse->Script("alerta('<h5 class=text-danger><strong>Atencion! Hubo el siguiente error:</strong><br>$error</h5>')");
    }



 	return $objResponse;

}
$xajax->registerFunction('asignarcitas');

function asignarcitaspro($celular,$nomape,$fechacita,$hora)
{
    global $objResponse;
    global $BD; 
    $error ="";
    if(trim($nomape)==""){
        $error .= "<li>Debe ingresar un nombre,apellido o apodo como minimo para asignar la cita</li>";
    }
    if(trim($fechacita)==""){
        $error .= "<li>Debe ingresar fecha programda como minimo para asignar la cita</li>";
    }
    if(trim($hora)==""){
        $error .= "<li>Debe ingresar una hora programda como minimo para asignar la cita</li>";
    }

    if($error =="")
    {
        $AsignarCitaspro = asigna_citapro($celular,$nomape,$fechacita,$hora);
        if(count($AsignarCitaspro)>0)
        { 
           $objResponse->Script("msjcitaprook()");      

        }else
        {
          $objResponse->Script("alerta('<h5 class=text-danger><strong>Atencion! Hubo un error al guardar</strong></h5>')");
        } 

    }else
    {
        $objResponse->Script("alerta('<h5 class=text-danger><strong>Atencion! Hubo el siguiente error:</strong><br>$error</h5>')");
    }



 	return $objResponse;

}
$xajax->registerFunction('asignarcitaspro');


function Traenom($cel,$id)
{
    global $objResponse;
    global $BD; 
    $consultar = Consultar_cliente($cel);
        if($BD->numreg($consultar)>0)
        {   
            while(!$consultar->EOF)
            {
                $nombres = trim($consultar->fields["nombres"]);
                $objResponse->Assign("nombres".$id,"value",$nombres);
            $consultar->MoveNext();   
            }
        }else{
        	$objResponse->Assign("nombres".$id,"value","");
        }

 return $objResponse;
}
$xajax->registerFunction('Traenom');

function Traenom2($cel)
{
    global $objResponse;
    global $BD; 
    $consultar = Consultar_cliente($cel);
        if($BD->numreg($consultar)>0)
        {   
            while(!$consultar->EOF)
            {
                $nombres = trim($consultar->fields["nombres"]);
                $objResponse->Assign("nomape","value",$nombres);
            $consultar->MoveNext();   
            }
        }else{
        	$objResponse->Assign("nomape","value","");
        }

 return $objResponse;
}
$xajax->registerFunction('Traenom2');

function hora($fecha)
{
    global $objResponse;
    global $BD; 
    $consultar = Listadohoras($fecha);
    $option='';
    while(!$consultar->EOF)
    {
            $hora = trim($consultar->fields["descri"]);
            $idhora = trim($consultar->fields["id"]);
           	$option .= '<option value="'.$idhora.'">'.$hora.'</option>';	
       $consultar->MoveNext();   
    }
    $objResponse->Assign("hora","innerHTML",$option);
 return $objResponse;
}
$xajax->registerFunction('hora');

function consulcitas()
{

	global $objResponse;	
	global $BD;    
	$tabla='
	

	<div class="container-fluid">	
		<div class="row">
		<!-- Panel citas dia **********************************************-->
			<div class="col-md-6">
				<div class="btn-group"> 
		            <span class="btn btn-success pull-left" id="regremenu" onclick="xajax_citasDia()">
		            	<i class="glyphicon glyphicon-resize-full" ></i>  <b>Citas Dia</b>
		            </span>
			    </div>
				<div class="panel panel-success">
					<div class="panel-heading"><h3><strong><li class="glyphicon glyphicon-calendar"></li> Citas Asignadas en el Dia</strong></h3></div>
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
						$CitasDelDia = citasdeldia();
						$time1 = date("H:i");
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
				<div class="btn-group"> 
		            <span class="btn btn-info pull-left" id="regremenu" onclick="xajax_citaPrograma()">
		            	<i class="glyphicon glyphicon-resize-full" ></i><b>Citas Programadas</b>
		            </span>
			    </div>
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
						$CitasPro = CitasPro();
						$time2 = date("H:i");
						while(!$CitasPro->EOF)
					    {
						    $client2 = trim($CitasPro->fields["nombre"]);
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
									<td>'.$client2.'</td>
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

function citasDia()
{
	global $objResponse;	
	global $BD;    
	$tabla='
		<div class="btn-group"> 
            <span class="btn btn-success pull-left" id="regremenu" onclick="xajax_consulcitas()">
            	<i class="glyphicon glyphicon-resize-small" ></i> <b>Citas Dia</b>
            </span>
		 </div>
		<div class="panel panel-success">
			<div class="panel-heading"><h3><strong><li class="glyphicon glyphicon-calendar"></li> Citas Asignadas en el Dia</strong></h3></div>
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
						<th></th>
					</tr>     
					</thead>
				<tbody>';
				$CitasDelDia = citasdeldia();
				$time1 = date("H:i");
				while(!$CitasDelDia->EOF)
			    {
			    	$id = trim($CitasDelDia->fields["id"]);
				    $cliente1 = trim($CitasDelDia->fields["nombre"]);
				    $hora1 = trim($CitasDelDia->fields["hora"]);
				   
				    if($hora1>trim($time1))
				    {
				    	$estado1 = "<b>Cita Pendiente</b>";
				    	$tr1='bgcolor="#ECA1A7"';
				    	$buton = '
						<span class="btn btn-primary pull-left" id="regremenu" onclick="ConfirCancelCitDia('.$id.')">
							<i class="glyphicon glyphicon-remove-sign" ></i> <b>Cancelar Cita</b>
						</span>
				    	';
				    }else{
				    	$estado1 = "<b>Cita ok!</b>";
				    	$tr1='bgcolor="#99E7BA"';
				    	$buton = '
						<span class="btn btn-primary pull-left" disabled="disable">
							<i class="glyphicon glyphicon-remove-sign" ></i> <b>Cancelar Cita</b>
						</span>
				    	';
				    }
					$tabla.='
						<tr >
							<td '.$tr1.'>'.$cliente1.'</td>
							<td '.$tr1.'>'.$hora1.'</td>
							<td '.$tr1.'>'.$estado1.'</td>
							<td>'.$buton.'</td>
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
			                <td></td>
			            </tr>
			        </tfoot>
			    </table>	
			</div>
		</div>';


	 $objResponse->Assign("citas", "innerHTML", utf8_decode($tabla));
	 $objResponse->Script("renderizatablaAyudas('tabla_informe3',[],false,'Bfrtilp');"); 

 return $objResponse;

}
$xajax->registerFunction('citasDia');

function CancelCitaDia($id)
{
	global $objResponse;	
	global $BD;    
	$CanceCitaDia = Cancela_CitaDia($id);
	if(count($CanceCitaDia)>0)
	{ 
		$objResponse->Script("msjcancelacita()");      
	}else
	{
		$objResponse->Script("alerta('<h5 class=text-danger><strong>Atencion! Hubo un error al guardar</strong></h5>')");
	} 

	return $objResponse;
}
$xajax->registerFunction('CancelCitaDia');

function citaPrograma()
{
	global $objResponse;	
	global $BD;    
	$tabla='
				<div class="btn-group"> 
		            <span class="btn btn-info pull-left" id="regremenu" onclick="xajax_consulcitas()">
		            	<i class="glyphicon glyphicon-resize-small" ></i><b>Citas Programadas</b>
		            </span>
			    </div>
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
								<th></th>
							</tr>     
							</thead>
						<tbody>
						';
						$CitasPro = CitasPro();
						$time2 = date("H:i");
						while(!$CitasPro->EOF)
					    {
					    	$id = trim($CitasPro->fields["id"]);
						    $client2 = trim($CitasPro->fields["nombre"]);
						    $hora2 = trim($CitasPro->fields["hora"]);
						    $fecha = trim($CitasPro->fields["fecha"]);
						   	$sistemfecha = date("Y-m-d");

						   	if($sistemfecha==$fecha)
						   	{
						   		if($hora2>trim($time2))
							    {
							    	$estado2 = "<b>Cita Pendiente</b>";
							    	$tr2='bgcolor="#ECA1A7"';
							    	$buton = '
									<span class="btn btn-primary pull-left" id="regremenu" onclick="ConfirCancelCitPro('.$id.')">
										<i class="glyphicon glyphicon-remove-sign" ></i> <b>Cancelar Cita</b>
									</span>
							    	';
							    }else{
							    	$estado2 = "<b>Cita ok!</b>";
							    	$tr2='bgcolor="#99E7BA"';
							    	$buton = '
									<span class="btn btn-primary pull-left" disabled="disabled">
										<i class="glyphicon glyphicon-remove-sign" ></i> <b>Cancelar Cita</b>
									</span>
							    	';
							    }
						   	}else{
						   		$estado2 = "<b>Cita Pendiente</b>";
							    $tr2='bgcolor="#ECA1A7"';
							    $buton = '
									<span class="btn btn-primary pull-left" id="regremenu" onclick="ConfirCancelCitPro('.$id.')">
										<i class="glyphicon glyphicon-remove-sign" ></i> <b>Cancelar Cita</b>
									</span>
							    	';
						   	}

							$tabla.='
								<tr >
									<td '.$tr2.'>'.$client2.'</td>
									<td '.$tr2.'>'.$hora2.'</td>
									<td '.$tr2.'>'.$fecha.'</td>
									<td '.$tr2.'>'.$estado2.'</td>
									<td>'.$buton.'</td>
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
					                <td></td>
					            </tr>
					        </tfoot>
					    </table>
					</div>
				</div>
			</div>';


	 $objResponse->Assign("citas", "innerHTML", utf8_decode($tabla));
	 $objResponse->Script("renderizatablaAyudas('tabla_informe3',[],false,'Bfrtilp');"); 

 return $objResponse;

}
$xajax->registerFunction('citaPrograma');

function CancelCitaPro($id)
{
	global $objResponse;	
	global $BD;    
	$CanceCitaPro = Cancela_CitaPro($id);
	if(count($CanceCitaPro)>0)
	{ 
		$objResponse->Script("msjcancelacita()");      
	}else
	{
		$objResponse->Script("alerta('<h5 class=text-danger><strong>Atencion! Hubo un error al guardar</strong></h5>')");
	} 

	return $objResponse;
}
$xajax->registerFunction('CancelCitaPro');

?>