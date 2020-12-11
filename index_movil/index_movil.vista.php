<?php
/*
  @author    David Torres <datorres08@hotmail.com>
  @version   [1]
  @category  registros e inventarios barberia
  @copyright David Torres [2020-07]
 */

?>
<html>
    <head>
    <?php
       $xajax->printJavascript('funciones/');
    ?>
        <title>.::BarberKong V1.0 Menu</title>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
      <title>.::BarberKong::.</title>
      <script type="text/javascript" language="JavaScript" src="index_movil/index_movil.js"></script>
      <script type="text/javascript" language="JavaScript" src="javascript/jquery.min.js"></script> 
      <script type="text/javascript" language="javascript" src="jquery-ui/jquery-ui.min.js"></script>
      <script type="text/javascript" language="javascript" src="jquery-ui/chosen.jquery.js"></script>
      <link rel="stylesheet" href="jquery-ui/jquery-ui.theme.min.css" type="text/css" media="screen">

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


        <style>
            input {
                width: 100%;
                height: 40px;
                font-size: 16px;
                padding: 4px;
            }

        </style>
        <script>



        </script>
    </head>
    <body onload="xajax_cargando();xajax_consulcitas();xajax_datas();">
      <br>
     <section>
        <div class="col-md-12 col-xs-12 col-lg-12" >
            <div class="list-group">
                  <button type="button" class="list-group-item list-group-item-action disabled">
                    <h2><strong>BarberKong V1.0</strong></h2>
                  </button>
                  
                  <!--Modulo de clientes-->
                  <a href="javascript:clientes(1)" class="list-group-item list-group-item-action" id="desplegarcliente" style="cursor:pointer;text-decoration:none;"> <h3> <i class="glyphicon glyphicon-chevron-down"> </i> <li class="glyphicon glyphicon-user"></li><strong> Clientes</strong> </h3></a>
                  <a href="javascript:clientes(2)" class="list-group-item list-group-item-action" id="replegarcliente" style="display:none;cursor:pointer;text-decoration:none;"> <h3> <i class="glyphicon glyphicon-chevron-up"> </i> <li class="glyphicon glyphicon-user"></li><strong> Clientes </strong></h3></a>
                  <div id="detallecliente" style="display:none">
                      <button type="button" class="list-group-item list-group-item-action" onclick="document.location='clientes.php?accion=crear'">
                         <h4><li class="glyphicon glyphicon-pencil"></li> <li class="glyphicon glyphicon-user"></li> RegistrarCliente</h4>
                      </button>
                      <button type="button" class="list-group-item list-group-item-action" onclick="document.location='clientes.php?accion=modi'">
                         <h4><li class="glyphicon glyphicon-edit"></li> <li class="glyphicon glyphicon-user"></li> ModificarCliente</h4>
                      </button>
                      <button type="button" class="list-group-item list-group-item-action" onclick="document.location='clientes.php?accion=consul'">
                         <h4><li class="glyphicon glyphicon-search"></li> <li class="glyphicon glyphicon-user"></li> ConsultarCliente</h4>
                      </button>
                  </div>  
                  <!--Fin modulo de Registros-->

                  <!--Modulo de citas-->
                  <a href="javascript:citas(1)" class="list-group-item list-group-item-action" id="desplegarcita" style="cursor:pointer;text-decoration:none;"> <h3> <i class="glyphicon glyphicon-chevron-down"> </i> <li class="glyphicon glyphicon-calendar"></li><strong> Citas</strong> </h3></a>
                  <a href="javascript:citas(2)" class="list-group-item list-group-item-action" id="replegarcita" style="display:none;cursor:pointer;text-decoration:none;"> <h3> <i class="glyphicon glyphicon-chevron-up"> </i> <li class="glyphicon glyphicon-calendar"></li><strong> Citas </strong></h3></a>
                  <div id="detallecita" style="display:none">
                      <button type="button" class="list-group-item list-group-item-action" onclick="document.location='citas.php'">
                         <h4><li class="glyphicon glyphicon-pencil"></li> <li class="glyphicon glyphicon-calendar"></li> RegistrarCita Dia</h4>
                      </button>
                      <button type="button" class="list-group-item list-group-item-action" onclick="document.location='citas.php?accion=citaprog'">
                         <h4><li class="glyphicon glyphicon-time"></li> <li class="glyphicon glyphicon-calendar"></li> RegistrarCita Programada</h4>
                      </button>
                      <button type="button" class="list-group-item list-group-item-action" onclick="document.location='citas.php?accion=consulta'">
                         <h4><li class="glyphicon glyphicon-search"></li> <li class="glyphicon glyphicon-calendar"></li> ConsultarCitas</h4>
                      </button>

                  </div>
                   <!--Fin modulo de citas-->

                  <!-- Modulo de visitas-->
                  <a href="javascript:visitas(1)" class="list-group-item list-group-item-action" id="desplegarconfig" style="cursor:pointer;text-decoration:none;"> <h3> <i class="glyphicon glyphicon-chevron-down"> </i> <li class="glyphicon glyphicon-pencil"></li><strong> Visitas </strong></h3></a>
                  <a href="javascript:visitas(2)" class="list-group-item list-group-item-action" id="replegarconfig" style="display:none;cursor:pointer;text-decoration:none;"> <h3> <i class="glyphicon glyphicon-chevron-up"> </i> <li class="glyphicon glyphicon-pencil"></li><strong> Visitas</strong> </h3></a>
                 <div id="detalleconfig" style="display:none">
                    <button type="button" class="list-group-item list-group-item-action" onclick="document.location='visitas.php'">
                       <h4><li class="glyphicon glyphicon-pencil"></li> <li class="glyphicon glyphicon-book"></li> Registrar Visitas(Clientes registrados)</h4>
                    </button>
                    <!--
                      <button type="button" class="list-group-item list-group-item-action" onclick="document.location='regi_visitas.php'">
                         <h4><li class="glyphicon glyphicon-cog"></li> <li class="glyphicon glyphicon-book"></li> Configurar Nro Visitas</h4>
                      </button>
                    -->  
                 </div> 
                 <!--Fin modulo de visitas--> 

            </div>
                <hr>
                <br>
                  <div id="citas"></div>
                  <br>
                  <div id="datos"></div>
                <br>
                <hr>
                  <i>Developed By <a href="mailto:datorres08@hotmail.com">@Datorres</a> &copy; 2020</a></i>
                <hr>  
         </div>          
     </section>     
    </body>
</html>
