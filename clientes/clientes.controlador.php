<?php
# declaracion del objeto global que responde (objResponse)
$objResponse = new xajaxResponse();
$BD = new BD();
//funcion ppal que carga el programa inicial con los pedidos asignados al usuario de sesion
function Cliente()
{

	 global $objResponse;	
     global $BD;    
	$tabla='
	<div class="col-md-12 col-xs-12 col-lg-12" >
		<div class="panel panel-default">
			<div class="panel-heading">
				<h2><i class="glyphicon glyphicon-user" ></i> <strong>Creaci&oacute;n de clientes</strong>  </h2>
			</div>
			<form method="post" name="frmcreacliente" id="frmcreacliente">
				<div class="panel-body form-inline">
					<div class="form-group">
						<b>Nro Celular:</b><br>
						<input type="number"  name="celular" id="celular"  class="form-control" style="border: 2px solid #ff6666;" onKeyPress="return SoloNumeros(event);" onchange="ValidoDocu(this.value)"   placeholder="Documento del cliente" size="100%">
					</div>
					 <div id="MensajeDocu"></div> 
					<div class="form-group">
                        <b>Nombres:</b><br>
                        <input type="text"  name="nomape" id="nomape" class="form-control"  placeholder=" Nombre y apellidos del cliente" style="border: 2px solid #ff6666;text-transform:uppercase;" size="100%"> 
                     </div> 
                    
                    <div class="form-group">
                        <b>Correo Electronico:</b><br>
                        <input type="text"  name="email" id="email"  class="form-control" placeholder="Correo electronico del cliente" onBlur="return validar_mail(this)" size="100%">
                    </div>
                     <div id="Mensajes"></div> 

                    <div class="form-group">
                        <b>Cumplea&ntilde;os:</b><br>
                        <input type="number"  name="fcdia" id="fcdia"  class="form-control"  onKeyPress="return SoloNumeros(event);" onchange="ValidoDocu(this.value)"   placeholder="Dia cumple" size="20%" maxlength="2" >
                        <input type="number"  name="fcmes" id="fcmes"  class="form-control"  onKeyPress="return SoloNumeros(event);" onchange="ValidoDocu(this.value)"   placeholder="Mes cumple" size="20%" maxlength="2" >
                    </div>

			</form>
                    <br><br>  
                    <div class="form-group">
                        <span class="btn btn-success" id="btn-crear" onClick="BtnGuardarCli()" >
                        	<i class="glyphicon glyphicon-floppy-disk" ></i><strong> Guardar Cliente</strong>
                        </span>                    
                    </div>
                    <div class="form-group">
                        <h4><font color="red"><strong> (*)Los campos resaltados de color rojo son obligatorios para la creaci&oacute;n del cliente</strong></font></h4>
                    </div>

				</div>
				<div class="panel-footer">
			          <div class="btn-group"> 
			            <span class="btn btn-default pull-left" id="regremenu" onclick="regresarmenu()">
			            	<i class="glyphicon glyphicon-home" ></i> Regresar al Menu
			            </span>
			          </div>
	     		</div>
		</div>
	</div>';

	 $objResponse->Assign("diclientes", "innerHTML", utf8_decode($tabla));
 return $objResponse;

}
$xajax->registerFunction('Cliente');

//Valido que el cliente ya no exista
function ValidoDocu($cel)
{
    global $objResponse;
    global $BD; 
    $consultar = Consultar_cliente($cel);
        if($BD->numreg($consultar)>0)
        {   
            while(!$consultar->EOF)
            {
                $nombres = trim($consultar->fields["nombres"]);

                 $tabla ="<div class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span><span class='sr-only'>Error:</span> El documento ingresado ya se encuentra registrado a nombre de $nombres</div>";
                 $objResponse->Assign("identifica","value","");
            $consultar->MoveNext();   
            }
        }else
        {
             $tabla ="";
        }
 $objResponse->Assign("MensajeDocu", "innerHTML", utf8_decode($tabla));
 return $objResponse;
}
$xajax->registerFunction('ValidoDocu');

//Guardo el cliente
function GuardaCliente($celular,$nomape,$email,$fcdia,$fcmes)
{
    global $objResponse;
    global $BD; 
    //Validar datos no nullos
     $error ="";
    if(trim($celular)==""){
        $error .= "<li>Debe ingresar un numero de celular para la identificacion del cliente</li>";
    }
    if(trim($nomape)==""){
        $error .= "<li>Debe ingresar un nombre y apellido para el cliente</li>";
    }

    if($error =="")
    {
        $insertoCliente = Crear_cliente($celular,$nomape,$email,$celular,$fcdia,$fcmes);
        if(count($insertoCliente)>0)
        { 
            $objResponse->Script("alerta('<h5 class=text-info><strong>Muy Bien! Se crea correctamente el cliente</strong></h5>')");
            $objResponse->Assign("celular","value","");               
            $objResponse->Assign("nomape","value","");             
            $objResponse->Assign("email","value","");             
            $objResponse->Assign("fcdia","value","");
            $objResponse->Assign("fcmes","value","");         

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
$xajax->registerFunction('GuardaCliente');

//Consulta todos los clientes
function TraeClientes()
{
    global $objResponse;
    global $BD; 
    //Consulto todos los clientes
    $Consultoclie = Consulclin();

    $tabla ='
    <section>
    <div class="container col-md-12 col-lg-12 col-xs-12">
    <br><hr>
        <table id="tabla_informe2" class="table table-sm table-inverse table-hover responsive" style="font-size: 10px;" width="100%" align="center" border="" bordercolor="#CCCCCC" cellpadding="4" cellspacing="1">
        <thead>
            <tr>
                <th colspan="2"><h5><strong><i class="glyphicon glyphicon-list-alt" > <i class="glyphicon glyphicon-user" ></i> Clientes Creados</strong></h5></th>
            </tr>
            <tr>
                <th>Documento</th>
                <th>Nombres</th>
                <th>Email</th>
                <th>celular</th>
                <th>Cumple<br>Dia-Mes</th>
                <th>Estado</th>
            </tr>     
        </thead>
        <tbody>';
        while(!$Consultoclie->EOF)
        {
            $id = trim($Consultoclie->fields["id"]);
            $nombres = trim($Consultoclie->fields["nombres"]);
            $correo = trim($Consultoclie->fields["correo"]);
            $celular = trim($Consultoclie->fields["celular"]);
            $dia = trim($Consultoclie->fields["fcumpledia"]);
            $mes = trim($Consultoclie->fields["fcumplemes"]);
            $estado = trim($Consultoclie->fields["estado"]);
            switch ($estado){
                case 'A':
                    $descriestado ="Activo";
                    $bgcolor = "";
                break;
                case 'I':
                    $descriestado ="Inactivo";
                    $bgcolor = 'bgcolor="red"';
                break;
            }

            $tabla .='
            <tr '.$bgcolor.'>
                <td>'.$id.'</td>
               <td>'.$nombres.'</td>
               <td>'.$correo.'</td>
               <td>'.$celular.'</td>
               <td>'.$dia.'-'.$mes.'</td>
               <td>'.$descriestado.'</td>
            </tr>
             ';
      
        $Consultoclie->MoveNext();   
        }
  
    $tabla .='
        </body>
        <tfoot>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tfoot>
    </table>
    </div>
    </section>
    ';
    $objResponse->Assign("clientes","innerHTML",utf8_decode($tabla));
    $objResponse->Script("renderizatablaAyudas('tabla_informe2',[],false,'Bfrtilp');"); 
   
    return $objResponse;
}
$xajax->registerFunction('TraeClientes');

//Trae cliente individual
function ConsulCliente($cel)
{
    global $objResponse;
    global $BD; 
    //Consulto todos los clientes
    $Consultoclie = Consultar_cliente($cel);

    $tabla ='
    <section>
    <div class="container col-md-12 col-lg-12 col-xs-12">
    <br><hr>';
        while(!$Consultoclie->EOF)
        {
            $id = trim($Consultoclie->fields["id"]);
            $nombres = trim($Consultoclie->fields["nombres"]);
            $correo = trim($Consultoclie->fields["correo"]);
            $celular = trim($Consultoclie->fields["celular"]);
            $dia = trim($Consultoclie->fields["fcumpledia"]);
            $mes = trim($Consultoclie->fields["fcumplemes"]);
            $estado = trim($Consultoclie->fields["estado"]);

            switch ($estado) {
                case 'A':
                    $descriestado ="Activo";
                break;
                case 'I':
                    $descriestado ="Inactivo";
                break;
            }

            $tabla .='
            <table border="0">
                <tr>
                    <td><h1><i class="glyphicon glyphicon-user" ></i></h1></td>
                    <td>&nbsp;&nbsp;&nbsp;</td>
                    <td>&nbsp;&nbsp;&nbsp;</td>
                    <td>
                    <table>    
                        <tr>
                            <td><strong>Identificacion : </strong></td>
                            <td>&nbsp;&nbsp;&nbsp;</td>
                            <td align="right">'.$cel.'</td>
                        </tr>
                        <tr>
                            <td><strong>Nombres y Apellidos :</strong> </td>
                            <td>&nbsp;&nbsp;&nbsp;</td>
                            <td align="right">'.$nombres.'</td>
                        </tr>
                        <tr>
                            <td><strong>Email :</strong> </td>
                            <td>&nbsp;&nbsp;&nbsp;</td>
                            <td align="right">'.$correo.'</td>
                        </tr>
                        <tr>
                            <td><strong>Celular :</strong> </td>
                            <td>&nbsp;&nbsp;&nbsp;</td>
                            <td align="right">'.$celular.'</td>
                        </tr> 
                        <tr>
                            <td><strong>Dia cumple :</strong> </td>
                            <td>&nbsp;&nbsp;&nbsp;</td>
                            <td align="right">'.$dia.'</td>
                        </tr>  
                        <tr>
                            <td><strong>Mes cumple :</strong> </td>
                            <td>&nbsp;&nbsp;&nbsp;</td>
                            <td align="right">'.$mes.'</td>
                        </tr> 
                        <tr>
                            <td><strong>Estado :</strong> </td>
                            <td>&nbsp;&nbsp;&nbsp;</td>
                            <td align="right">'.$descriestado.'</td>
                        </tr>     
                    </table>
                    </td>
                </tr>    

                    ';
      
        $Consultoclie->MoveNext();   
        }
  
    $tabla .='
    </div>
    </section>
    ';
    $objResponse->Assign("clientes","innerHTML",utf8_decode($tabla));
    $objResponse->Script("renderizatablaAyudas('tabla_informe2',[],false,'Bfrtilp');"); 
   
    return $objResponse;
}
$xajax->registerFunction('ConsulCliente');

//Consultar para editar cliete
function ConsulEditCliente($cel)
{
    global $objResponse;
    global $BD; 
    //Consulto todos los clientes
   $error ="";
    if(trim($cel)==""){
        $error .= "<li>Debe ingresar un numero de celular para actualizar el cliente</li>";
    }
    $tabla ='
    <section>
    <div class="container col-md-12 col-lg-12 col-xs-12">
    <hr>';
    if($error =="")
    {
        $Consultoclie = Consultar_cliente($cel);
        if($BD->numreg($Consultoclie)>0)
        {   
            while(!$Consultoclie->EOF)
            {
                $id = trim($Consultoclie->fields["id"]);
                $nombres = trim($Consultoclie->fields["nombres"]);
                $correo = trim($Consultoclie->fields["correo"]);
                $celular = trim($Consultoclie->fields["celular"]);
                $dia = trim($Consultoclie->fields["fcumpledia"]);
                $mes = trim($Consultoclie->fields["fcumplemes"]);
                $estado = trim($Consultoclie->fields["estado"]);

                if($estado=="A")
                {
                   $selecciona ='
                    <option value="A" selected>Activo</option>
                    <option value="I">Inactivo</option>
                   '; 
                }else{
                    $selecciona ='
                    <option value="A">Activo</option>
                    <option value="I" selected>Inactivo</option>
                   '; 
                }    
                $selecltestate = '
                <select name="estado" id="estado" class="form-control">
                   '.$selecciona.'
                </select>
                ';

                $tabla .='
                <form method="post" name="frmcreacliente" id="frmcreacliente">
                    <input type="hidden" name="cel" id="cel" value="'.$cel.'">
                    <div class="panel-body form-inline">
                        <div class="form-group">
                            <b>Identificacion:</b><br>
                            <input type="number"  name="edit_celular" id="edit_celular"  class="form-control" style="border: 2px solid #ff6666;" onKeyPress="return SoloNumeros(event);"   value="'.$id.'" size="100%">
                        </div>
                      
                        <div class="form-group">
                            <b>Nombres:</b><br>
                            <input type="text"  name="edit_nomape" id="edit_nomape" class="form-control"  value="'.$nombres.'" style="border: 2px solid #ff6666;text-transform:uppercase;" size="100%"> 
                        </div> 

                        <div class="form-group">
                            <b>Correo Electronico:</b><br>
                            <input type="text"  name="edit_email" id="edit_email"  class="form-control" value="'.$correo.'" onBlur="return validar_mail(this)" size="100%">
                        </div>
                        <div id="Mensajes"></div> 
                        

                        <div class="form-group">
                            <b>Cumplea&ntilde;os:</b><br>
                            Dia
                            <input type="number"  name="edit_fcdia" id="edit_fcdia"  class="form-control"  onKeyPress="return SoloNumeros(event);" onchange="ValidoDocu(this.value)"   value="'.$dia.'" maxlength="2" >Mes
                            <input type="number"  name="edit_fcmes" id="edit_fcmes"  class="form-control"  onKeyPress="return SoloNumeros(event);" onchange="ValidoDocu(this.value)"   value="'.$mes.'" size="20%" maxlength="2" >
                        </div>
                        <br>
                        <div class="form-group">
                             <b>Estado:</b><br>
                            '.$selecltestate.'
                        </div>            
                    </div>     
                </form>
                <br><br>  
                <div class="form-group">
                    <span class="btn btn-success" id="btn-crear" onClick="BtnEditGuardarCli()" >
                    <i class="glyphicon glyphicon-floppy-disk" ></i><strong> Actualizar Cliente</strong>
                    </span>                    
                </div>
                <div class="form-group">
                    <h4><font color="red"><strong> (*)Los campos resaltados de color rojo son obligatorios para la creaci&oacute;n del cliente</strong></font></h4>
                </div>';
          
            $Consultoclie->MoveNext();   
            }

        }else{
             $tabla .="
             <br>
             <div class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span><span class='sr-only'>Error:</span><strong> El documento ingresado $docu no se encuentra registrado por favor valida e intenta de nuevo</strong></div>";
        }    
      
       
    }else
    {
           $objResponse->Script("alerta('<h5 class=text-danger><strong>Atencion! Hubo el siguiente error:</strong><br>$error</h5>')");
    } 
     $tabla .='
        </div>
    </section>';  
    $objResponse->Assign("edit_clientes","innerHTML",utf8_decode($tabla));      
    return $objResponse;
}
$xajax->registerFunction('ConsulEditCliente');

function GuardaEditCliente($edit_celular,$edit_nomape,$edit_email,$edit_fcdia,$edit_fcmes,$estado,$documento)
{
    global $objResponse;
    global $BD; 
    //Validar datos no nullos
     $error ="";
    if(trim($edit_celular)==""){
        $error .= "<li>El campo identificacion, se encuntra vacio!</li>";
    }
    if(trim($edit_nomape)==""){
        $error .= "<li>El campo nombres, se encuentra vacio!</li>";
    }

    if($error =="")
    {
        $ModiCliente = Modifia_cliente($edit_celular,$edit_nomape,$edit_email,$edit_fcdia,$edit_fcmes,$estado,$documento);
        if(count($ModiCliente)>0)
        { 
            $objResponse->Script("alerta('<h5 class=text-info><strong>Muy Bien! Se actualiza el cliente</strong></h5>')");
        }else
        {
          $objResponse->Script("alerta('<h5 class=text-danger><strong>Atencion! Hubo un error al actualizar</strong></h5>')");
        } 

    }else
    {
            $objResponse->Script("alerta('<h5 class=text-danger><strong>Atencion! Hubo el siguiente error:</strong><br>$error</h5>')");
    }
    return $objResponse;  
}
$xajax->registerFunction('GuardaEditCliente');
?>