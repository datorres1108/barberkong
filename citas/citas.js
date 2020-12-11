function regresarmenu()
{
    document.location='index_movil.php';
}

function renderizatablaAyudas(tabla,columnasSumar,aplicar_filtros,opciones_mostrar){
  var columnasSumar = columnasSumar || null;
  var aplicar_filtros = aplicar_filtros || false;
  var opciones_mostrar = opciones_mostrar || 'Brltip';

  var oTable;
  var nCells = $('#'+tabla).find('tfoot').find('tr').find('td');

  oTable=$('#'+tabla).dataTable({
      responsive: true,
      destroy: true,
    dom: opciones_mostrar,
      buttons: [
          'copy','excel'
        ],
      language: {
            buttons: {
              copyTitle: 'A&ntilde;adido al portapapeles',
                copyKeys: 'Pulse <i> Ctrl </i> o <i> \ u2318 </ i> <i> C </i> para copiar los datos de la tabla en el portapapeles. <br>para cancelar, haga clic en este mensaje o pulse Esc.',
                copySuccess: {
                    _: '%d lineas copiadas',
                    1: '1 linea copiada'
                }
            },
            search: "_INPUT_",
          searchPlaceholder: "Buscar...",
          paginate: {
           "last": "Ultimo",
           "first": "Primero",
           "next": "Siguiente",
           "previous": "Anterior"
        },
        "emptyTable": "No se encontraron datos!",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "lengthMenu": "_MENU_ registros por p&aacute;gina",
      "zeroRecords": "No hay registros",
      "info": "P&aacute;gina _PAGE_ de _PAGES_ (_TOTAL_ registros)&nbsp; ",
      "infoEmpty": "0 registros",
      "infoFiltered": "<small>(_TOTAL_ de _MAX_ encontrados)</small>",
      "decimal": ".",
      "thousands": ",",
      "aria": {
            "sortAscending":  ": Ordenar ascendente",
            "sortDescending": ": Ordenar descendente"
        }

        },
      lengthMenu: [[-1,15,50, 100, 200,500], ["todos",15,50, 100, 200,500]],
      displayLength: 5,
      paginationType: "simple_numbers",
      "footerCallback": function(row, data, start, end, display)  {
        if(columnasSumar.length > 0){
          
          if(aplicar_filtros == true){
            if($("#"+tabla+" tfoot input").length == 0){
              for (var i = 0; i < data[0].length; i++) {
                var datos = data[0][i];
                if(datos.substr(0,2) == '<a'){
                datos = $(datos).text(); // ... or .text()
              } else {
                datos = data[0][i].trim();
              }
              var size = datos.length>0?datos.length:5;
              size = size>30?30:size;
                nCells[i].innerHTML = "<input type='text' class='search_init' index='"+i+"' tabla='"+tabla+"' size='"+size+"'>";
              }
            }
            filtro_buscar(tabla);         
          }

        for(var j=0; j<columnasSumar.length; j++){
          var sumaColumna = 0;
          for ( var i=start ; i<display.length ; i++ ){
            var datos = data[ display[i] ][ columnasSumar[j] ];
            if(datos.substr(0,2) == '<a'){
              datos = $(datos).text(); // ... or .text()
            }           
            sumaColumna += datos.replace(/,/g, "") * 1;
          }
          sumaColumna = sumaColumna.toFixed(2).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
          nCells[columnasSumar[j]].innerHTML = sumaColumna.replace(/\.00$/,'');
          nCells[columnasSumar[j]].style.fontWeight = "bolder";
          nCells[columnasSumar[j]].style.textAlign  = "right";
        }
        if(nCells[columnasSumar[0]-1] && aplicar_filtros == false){
          nCells[columnasSumar[0]-1].innerHTML = "Totales";
          nCells[columnasSumar[0]-1].style.fontWeight = "bolder";
          nCells[columnasSumar[0]-1].style.textAlign  = "right";
        }
      }
    }
  });

  $("#"+tabla+"_wrapper .dt-buttons").css('width','auto').addClass('pull-left');
  //$("#"+tabla+"_filter").addClass('pull-right');
  $("#"+tabla+"_length").addClass('pull-right');
  $("#"+tabla+"_info").addClass('pull-left');
  $("#"+tabla+"_paginate").addClass('pull-right');

}

function filtro_buscar(tabla){
  $("#"+tabla+"_wrapper tfoot input").keyup( function () {
        var oTable = $("#"+tabla).dataTable();
        oTable.fnFilter( $(this).val(), $(this).attr("index") );
    } );
}


function alerta(mensaje,titulo,tipo){
    var titulo = titulo || "Alerta";
    if(mensaje != ""){
        BootstrapDialog.show({
        type: tipo || BootstrapDialog.TYPE_ERROR,
        title: titulo,
        message: mensaje,
        buttons: [{
            label: 'Aceptar',
            action: function(dialogRef){
                dialogRef.close();
            }
        }],
        closable: true
        });
    }
}

//Se utiliza para que el campo de texto solo acepte letras
function soloLetras(e) {
  key = e.keyCode || e.which;
  tecla = String.fromCharCode(key).toString();
  letras = " áéíóúabcdefghijklmnñopqrstuvwxyzÁÉÍÓÚABCDEFGHIJKLMNÑOPQRSTUVWXYZ";//Se define todo el abecedario que se quiere que se muestre.
  especiales = [8, 37, 39, 46, 6]; //Es la validación del KeyCodes, que teclas recibe el campo de texto.

  tecla_especial = false
  for(var i in especiales) {
      if(key == especiales[i]) {
          tecla_especial = true;
          break;
      }
  }

  if(letras.indexOf(tecla) == -1 && !tecla_especial){
      alert('Un momento!\nEstas ingresando un valor no valido en un campo');
      return false;
  }
}

//Se utiliza para que el campo de texto solo acepte numeros
function SoloNumeros(evt){
  if(window.event){//asignamos el valor de la tecla a keynum
      keynum = evt.keyCode; //IE
  }
  else{
      keynum = evt.which; //FF
  } 
  //comprobamos si se encuentra en el rango numérico y que teclas no recibirá.
  if((keynum > 47 && keynum < 58) || keynum == 8 || keynum == 13 || keynum == 6 ){
      return true;
  }
  else{
      return false;
  }
}


function btn_asigcita(id){
  var celular = document.getElementById('cel'+id).value;
  var nomape = document.getElementById('nombres'+id).value;
  xajax.call('asignarcitas',{parameters:[celular,nomape,id],mode:'synchronous'});
}

function msjcitaok(){
  alert("Muy bien! se agrega la cita correctamente.\nSi la requieres consultar puedes ir al menu citas y buscar el modulo de consultar citas");	
  xajax.call('TraeListaCitas',{parameters:[],mode:'synchronous'});
}				

function btn_asigcitapro(){
  var celular = document.getElementById('celular').value;
  var nomape = document.getElementById('nomape').value;
  var fechacita = document.getElementById('fechacita').value;
  var hora = document.getElementById('hora').value;
  xajax.call('asignarcitaspro',{parameters:[celular,nomape,fechacita,hora],mode:'synchronous'});
}

function msjcitaprook(){
  alert("Muy bien! se agrega la cita programada correctamente.\nSi la requieres consultar puedes ir al menu citas y buscar el modulo de consultar citas"); 
  document.location='citas.php?accion=citaprog';
} 


function ConfirCancelCitDia(id)
{

    var titulo = "Espera un momento......"
    BootstrapDialog.show({
    type: BootstrapDialog.TYPE_ERROR,
    title: titulo,
    message: "Esta Seguro(a) de cancelar esta cita del dia de hoy?",
    buttons: [
            {
                label: 'Si! Estoy seguro(a)',
                cssClass: 'btn-default',
                icon: 'glyphicon glyphicon-ok',
                action: function(dialogRef)
                {
                  //alert(material + " --- " + new_precio);
                 xajax.call('CancelCitaDia',{parameters:[id],mode:'synchronous'});  
                  dialogRef.close();
                }           
            },
            {
                label: 'No! Estoy seguro(a)',
                cssClass: 'btn-default',
                icon: 'glyphicon glyphicon-remove',
                action: function(dialogRef)
                {
                    dialogRef.close();
                }
            }
         ],
    closable: true
    });
}


function ConfirCancelCitPro(id)
{

    var titulo = "Espera un momento......"
    BootstrapDialog.show({
    type: BootstrapDialog.TYPE_ERROR,
    title: titulo,
    message: "Esta Seguro(a) de cancelar esta cita programada?",
    buttons: [
            {
                label: 'Si! Estoy seguro(a)',
                cssClass: 'btn-default',
                icon: 'glyphicon glyphicon-ok',
                action: function(dialogRef)
                {
                  //alert(material + " --- " + new_precio);
                 xajax.call('CancelCitaPro',{parameters:[id],mode:'synchronous'});  
                  dialogRef.close();
                }           
            },
            {
                label: 'No! Estoy seguro(a)',
                cssClass: 'btn-default',
                icon: 'glyphicon glyphicon-remove',
                action: function(dialogRef)
                {
                    dialogRef.close();
                }
            }
         ],
    closable: true
    });
}


function msjcancelacita(){
  alert("Muy bien! Se cancela la cita selecciona correctamente.\nSi requieres agendarla de nuevo puedes ir a Registra una nueva cita"); 
  document.location='citas.php?accion=consulta';
} 