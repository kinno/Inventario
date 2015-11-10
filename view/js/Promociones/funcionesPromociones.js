var tablaPromociones;
$(document).ready(function () {
    tablaPromociones = $("#tablaPromociones").DataTable({"retrieve": true, "ordering": false,
        "info": false,
        "searching": false,
        "paging": false,
        "oLanguage": {
            "sProcessing": "&nbsp; &nbsp; &nbsp;Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "    No se encontraron resultados",
            "sEmptyTable": "    Ning&uacute;n dato disponible en esta tabla",
            "sInfo": "&nbsp; &nbsp; &nbsp;    Mostrando registro(s) de la _START_ a la _END_ de un total de _TOTAL_ registro(s)",
            "sInfoEmpty": " &nbsp; &nbsp; &nbsp;   Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "    (filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "    Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "    Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Ultimo",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },
        }, });

    $('.input-daterange input').each(function () {
        $(this).datepicker({
            format: "dd-mm-yyyy",
        });
    });
    
    $(".number").autoNumeric();
    
    $("#cveProducto").change(function(){
        //buscarProducto();
    });
    
    $("#agregar").click(function(){
//        if(verificarNulos()){
            agregarPromocion();
//        }
    });

});

function verificarNulos(){
   $(".inputsPrincipales").find("input").each(function(){
       if($(this).val()===""){
           $(this).focus().addClass("");
           return false;
       }
   });
}

function agregarPromocion(){
    
}

