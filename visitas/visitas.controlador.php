<?php
# declaracion del objeto global que responde (objResponse)
$objResponse = new xajaxResponse();
$BD = new BD();
//funcion ppal que carga el programa inicial con los pedidos asignados al usuario de sesion
function TraeClienVisita($celular)
{

	global $objResponse;	
    global $BD;  
    $Consultoclie = Consultar_cliente($celular); 
    $tabla=''; 
    if($BD->numreg($Consultoclie)>0)
    {   
		$id = trim($Consultoclie->fields["id"]);
		$nombres = trim($Consultoclie->fields["nombres"]);
		$fechavis = date("Y-m-d");
		$tabla.='
		<hr>
		<div class="col-md-12 col-xs-12 col-lg-12" >
				<div class="form-group">
					<b>Cliente:</b><br>
					<input type="text"  name="nom" id="nom"  class="form-control" value="'.$nombres.'" disabled="disabled" size="50%">
				</div>
				<div class="form-group">
	                <b>Fecha para registro:</b><br>
	                 <input type="date"  name="fecha_visita" id="fecha_visita"  value="'.$fechavis.'" class="form-control"> 
		        </div> 
		        <div class="form-group">
	                <br>
	                 <span class="btn btn-default pull-left" id="regremenu" onclick="regivisita('.$celular.')">
		            	<i class="glyphicon glyphicon-home" ></i> Registrar Visita
		            </span>
		        </div> 
	    		<br><hr>
				<table id="tabla_informe1" class="table table-sm table-inverse table-hover responsive" style="font-size: 10px;" width="100%" align="center" border="1" bordercolor="#CCCCCC" cellpadding="4" cellspacing="1">
					<thead>
					<tr>
						<th>NUMERO VISITA</th>
						<th>FECHA VISITA</th>
					</tr>     
					</thead>
				<tbody>
	    		';  
	    		 $Consultovis = Consultar_visita($celular);  
	    		while(!$Consultovis->EOF)
        		{ 
					$visita = trim($Consultovis->fields["visita"]);
					$fecha = trim($Consultovis->fields["fecha"]);
					$tabla.='
					<tr>
						<td>'.$visita.'</td>
						<td>'.$fecha.'</td>
					</tr> ';
					$Consultovis->MoveNext();   
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

		</div>';
	 }else{
             $tabla.="
             <br>
             <div class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span><span class='sr-only'>Error:</span><strong> El documento ingresado $celular no se encuentra registrado por favor valida e intenta de nuevo</strong></div>";
    }    	

	 $objResponse->Assign("clientevisita", "innerHTML", utf8_decode($tabla));
	  $objResponse->Script("renderizatablaAyudas('tabla_informe1',[0],false,'Bfrtilp');"); 
 return $objResponse;

}
$xajax->registerFunction('TraeClienVisita');

function RegistrarVisita($fecha_visita,$celular)
{
    global $objResponse;
    global $BD; 
    $error ="";
    if(trim($fecha_visita)==""){
        $error .= "<li>Debe ingresar una fecha de registro de visita</li>";
    }
    if(trim($celular)==""){
        $error .= "<li>Parece que el campo Nro celular esta vacio</li>";
    }
    if($error =="")
    {
        $RegisVisitas = RegiVisi($fecha_visita,$celular);
        if(count($RegisVisitas)>0)
        { 
            $objResponse->Script("msjcitaok($celular)");
            $objResponse->Assign("cel","value",$celular);      

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
$xajax->registerFunction('RegistrarVisita');


?>