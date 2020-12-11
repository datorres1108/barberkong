// Funcionn general de paginacion de tabla 
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

        //Funciones menu ppal  
          function clientes(num)
          {
            if(num==1){
              $("#detallecliente").show();
              $("#desplegarcliente").hide();
              $("#replegarcliente").show();
            }else{
              $("#detallecliente").fadeOut(100);
              $("#replegarcliente").hide();
              $("#desplegarcliente").show();
            }
          }

          function citas(num)
          {
            if(num==1){
              $("#detallecita").show();
              $("#desplegarcita").hide();
              $("#replegarcita").show();
            }else{
              $("#detallecita").fadeOut(100);
              $("#replegarcita").hide();
              $("#desplegarcita").show();
            }
          }

          function visitas(num)
          {
            if(num==1){
              $("#detalleconfig").show();
              $("#desplegarconfig").hide();
              $("#replegarconfig").show();
            }else{
              $("#detalleconfig").fadeOut(100);
              $("#replegarconfig").hide();
              $("#desplegarconfig").show();
            }
          }
function whatsapp(ruta)
{
  window.open(ruta);
}