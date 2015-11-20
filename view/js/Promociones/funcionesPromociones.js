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
    tablaPromociones.column(0).visible(false);



    $('.input-daterange input').each(function () {
        $(this).datepicker({
            format: "yyyy-mm-dd",
        });
    });

    $(".number").autoNumeric();

    $("#cveProducto").change(function () {
        buscarProducto($(this).val());
    });

    $("#agregar").click(function () {
        if (verificarNulos()) {
            guardarPromociones();
        }
    });

    listadoPromociones();
});

function verificarNulos() {
    $(".inputsPrincipales").find("input").each(function () {
        if ($(this).val() === "") {
            $(this).focus();
            return false;
        }
    });
    return true;
}

function listadoPromociones() {
    colocaWaitGeneral();
    $.ajax({
        data: {'accion': 'getPromociones'},
        url: '../controller/Promociones/funcionesPromocionesController.php',
        type: 'post',
        success: function (response) {
            var data = jQuery.parseJSON(response);
            console.log(data);
            if (data.length > 0) {
                for (var i = 0; i < data.length; i++) {
                    tablaPromociones.row.add([data[i].idPromocion, data[i].cveProducto, data[i].precioPromocion, data[i].fechaInicio, data[i].fechaFinal, '<span  class="glyphicon glyphicon-pencil" style="cursor:pointer;" title="Editar promoci\u00f3n" onClick="editar(this);"></span>', '<span  class="glyphicon glyphicon-remove" style="cursor:pointer;" title="Eliminar promoci\u00f3n" onClick="eliminar(this);"></span>']).draw();
                }
            }

            eliminaWaitGeneral();
        },
        error: {}
    });
}

function buscarProducto(CveProducto) {
    if (CveProducto !== "") {
        $.ajax({
            data: {'accion': 'buscaProducto', 'CveProducto': CveProducto},
            url: '../controller/Promociones/funcionesPromocionesController.php',
            type: 'post',
            success: function (response) {
//                console.log(response);
                var data = jQuery.parseJSON(response);
                if (data.length > 0) {
                    for (var i = 0; i < data.length; i++) {
                        $("#idProducto").val(data[i].idProducto);
                        $("#producto").val(data[i].nomProducto);
                        $("#linea").val(data[i].descLinea);
                        $("#categoria").val(data[i].dscCategoria);
                        $("#precioLista").val(data[i].precio);

                    }
                } else {
                    bootbox.alert("No existe el producto seleccionado", function () {
                        $("#cveProducto").focus();
                    });
                }

                eliminaWaitGeneral();
            },
            error: {}
        });
    } else {
        $("#idProducto").val("");
        $("#producto").val("");
        $("#linea").val("");
        $("#categoria").val("");
    }
}

function guardarPromociones() {
    var idPromocion = $("#idPromocion").val();
    var idProducto = $("#idProducto").val();
    var cveProducto = $("#cveProducto").val();
    var precioPromocion = $("#precioPromocion").val();
    var fechaInicial = $("#fechaInicial").val();
    var fechaFinal = $("#fechaFinal").val();



    var objPromociones = {
        idPromocion: idPromocion,
        idProducto: idProducto,
        precioPromocion: precioPromocion,
        fechaInicial: fechaInicial,
        fechaFinal: fechaFinal,
        accion: 'guardarPromocion',
    }


    $.ajax({
        data: objPromociones,
        url: '../controller/Promociones/funcionesPromocionesController.php',
        type: 'post',
        success: function (response) {
            var data = jQuery.parseJSON(response);
            console.log(data);

            if (data.mesaje == "ok") {
                bootbox.alert({
                    size: 'small',
                    message: successDatos,
                    callback: function () {
                        $(".inputsPrincipales").find("input").each(function () {
                            $(this).val("");
                        });
                        tablaPromociones.clear().draw();
                        listadoPromociones();
                    }
                });
            }

        },
        error: {}
    });
}

function agregarPromocion() {
    var idProducto = $("#idProducto").val();
    var cveProducto = $("#cveProducto").val();
    var precioPromocion = $("#precioPromocion").val();
    var fechaInicial = $("#fechaInicial").val();
    var fechaFinal = $("#fechaFinal").val();

    tablaPromociones.row.add([idProducto, cveProducto, precioPromocion, fechaInicial, fechaFinal, '<span  class="glyphicon glyphicon-pencil" style="cursor:pointer;" title="Editar promoci\u00f3n" onClick="editar(this);"></span>', '<span  class="glyphicon glyphicon-remove" style="cursor:pointer;" title="Eliminar promoci\u00f3n" onClick="eliminar(this);"></span>']).draw();
    $(".inputsPrincipales").find("input").each(function () {
        $(this).val("");
    });
}

function editar(elem) {
    var index = tablaPromociones.row($(elem).parent().parent()).index();
    var idPromocion = tablaPromociones.cell(index, 0).data();
    var cveProducto = tablaPromociones.cell(index, 1).data();
    var precioPromocion = tablaPromociones.cell(index, 2).data();
    var fechaInicial = tablaPromociones.cell(index, 3).data();
    var fechaFinal = tablaPromociones.cell(index, 4).data();

    $("#idPromocion").val(idPromocion);
    $("#cveProducto").val(cveProducto).change();
    $("#precioPromocion").val(precioPromocion);
    $("#fechaInicial").val(fechaInicial);
    $("#fechaFinal").val(fechaFinal);
//    $("#agregar").hide();
//    $("#editar").show();

}

function eliminar(elem) {
    bootbox.confirm("Se eliminar\u00e1 la promoci\u00f3n, \u00BFDesea Continuar?", function (response) {
        if (response) {
            var indiceEliminar = tablaPromociones.row($(elem).parent().parent()).index();
            var datosFila = tablaPromociones.row(indiceEliminar).data();
            tablaPromociones.row(indiceEliminar).remove().draw();
        }
    });
}


