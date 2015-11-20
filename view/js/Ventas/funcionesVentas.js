var tablaVentas;
$(document).ready(function () {
    tablaVentas = $("#tablaVentas").DataTable({"retrieve": true, "ordering": false,
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
        },
        "fnCreatedRow": function (nRow, aData, iDataIndex) {
            for (var i = 2; i <= 6; i++) {
                var cell = tablaVentas.cell(nRow, i).node();
                $(cell).addClass('number');
            }
        }, "drawCallback": function (settings) {
            $(".number").autoNumeric();
            $(".number").autoNumeric("update");

        }
    });
    tablaVentas.column(0).visible(false);
    var f = new Date();
    $("#fechaActual").val(f.getDate() + "/" + (f.getMonth() + 1) + "/" + f.getFullYear());

    $("#cveCliente").change(function () {
        buscaCliente();
    });

    $("#cveProducto").change(function () {
        if ($("#cveCliente").val() !== "") {
            if ($(this).val() !== "") {
                buscaProducto();
            } else {
                $(this).focus();
            }
        } else {
            $(this).val("");
            $("#cveCliente").focus();
        }
    })
});

function calcularTotalVenta() {
    var arrayTotal = tablaVentas.column(6).data();
    var sumaTotal = 0;
    for (var i = 0; i < arrayTotal.length; i++) {
        sumaTotal += parseFloat(arrayTotal[i].replace(/,/g, ""));
    }
    $("#totalVenta").text(sumaTotal);
    $(".number").autoNumeric("update");
}

function eliminar(elem) {
    var indiceEliminar = tablaVentas.row($(elem).parent().parent()).index();

    var datosFila = tablaVentas.row(indiceEliminar).data();

    tablaVentas.row(indiceEliminar).remove().draw();
    calcularTotalVenta();

}

function buscaCliente() {
    var cveCliente = $("#cveCliente").val();
    $.ajax({
        data: {'accion': 'getCliente', 'cveCliente': cveCliente},
        url: '../controller/Ventas/funcionesVentasController.php',
        type: 'post',
        success: function (response) {
            var data = jQuery.parseJSON(response);
//            console.log(data);
            if (data.length > 0) {
                $("#idCliente").val(data[0].idCliente);
                $("#nomCliente").val(data[0].nombreCliente + " " + data[0].apCliente + " " + data[0].amCliente);
                $("#nomCliente").val(data[0].nombreCliente + " " + data[0].apCliente + " " + data[0].amCliente);
                $("#idTipoCliente").val(data[0].idTipoCliente);
                $("#dscTipoCliente").val(data[0].dscTipoCliente);
                $("#descuento").val(data[0].descuento);
                if (data[0].descuento == "1.00") {
                    tablaVentas.column(5).visible(false);
                } else {
                    tablaVentas.column(5).visible(true);
                }
            } else {
                bootbox.alert('El cliente no existe.');
            }

            eliminaWaitGeneral();
        },
        error: {}
    });
}

function buscaProducto() {
    var cveProducto = $("#cveProducto").val();
    var fechaActual = $("#fechaActual").val();
    $.ajax({
        data: {'accion': 'getProducto', 'cveProducto': cveProducto, 'fechaActual': fechaActual},
        url: '../controller/Ventas/funcionesVentasController.php',
        type: 'post',
        success: function (response) {
            var data = jQuery.parseJSON(response);
//            console.log(data);
            if (data.length > 0) {
                if (data[0].items > 0) {
                    var idProducto = data[0].idProducto;
                    var nomProducto = data[0].nomProducto;
                    var CveProducto = data[0].cveProducto;
                    var precioUnitario = data[0].precio;
                    var descuento = $("#descuento").val();
                    var promoValida = data[0].promoValida;
                    var iva = parseFloat(precioUnitario) * 0.16;
                    var subtotal = parseFloat(precioUnitario) + parseFloat(iva);
                    var precioProducto = parseFloat(subtotal * descuento).toFixed(2);
                    tablaVentas.row.add([idProducto, nomProducto + "(" + CveProducto + ")", precioUnitario, iva, subtotal, descuento, precioProducto, '<span  class="glyphicon glyphicon-remove" style="cursor:pointer;" title="Quitar producto" onClick="eliminar(this);"></span>']).draw()
                    $("#cveProducto").val("").focus();
                    calcularTotalVenta();
                } else {
                    bootbox.alert("No hay existencias del producto.");
                }
            } else {
                bootbox.alert('No existe el producto.');
                $("#cveProducto").focus();
            }

            eliminaWaitGeneral();
        },
        error: {}
    });
}

function guardarVenta() {
    var arrayDetalleVenta = [];
    var detalle = tablaVentas.rows().data();

    for (var i = 0; i < detalle.length; i++) {
        arrayDetalleVenta.push(detalle[i]);
    }

    var objVenta = {
        detalleVenta: arrayDetalleVenta,
        fechaVenta: $("#fechaActual").val(),
        totalVenta: $("#totalVenta").text().replace(/,/g, ""),
        idCliente: $("#idCliente").val(),
        accion: 'guardarVenta',
    }
    console.log(objVenta);
  
    $.ajax({
        data: objVenta,
        url: '../controller/Ventas/funcionesVentasController.php',
        type: 'post',
        success: function (response) {
            var data = jQuery.parseJSON(response);
            console.log(data);
            if (data) {
                bootbox.alert({
                    size: 'small',
                    message: successVenta
                });
            }else{
                bootbox.alert("Ocurrio un error en la venta, intente de nuevo.");
            }

        },
        error: {}
    });
}