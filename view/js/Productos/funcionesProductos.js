var tablaProductos;
var indiceEditar;
var arrayEliminados = [];
$(document).ready(function () {
    tablaProductos = $("#tablaProductos").DataTable({"retrieve": true, "ordering": true,
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
            var cell = tablaProductos.cell(nRow, 7).node();
            $(cell).addClass('number');
            if (tablaProductos.cell(nRow, 8).data() == 0) {
                var row = tablaProductos.row(nRow).node();
                $(row).addClass('text-danger');
            } else {
                var row = tablaProductos.row(nRow).node();
                $(row).removeClass('text-danger');
            }
        }, "drawCallback": function (settings) {
            $(".number").autoNumeric();
            $(".number").autoNumeric("update");
        }
    });
    tablaProductos.column(0).visible(false);
    tablaProductos.column(3).visible(false);
    tablaProductos.column(5).visible(false);

//    $("input [type=date]").datepicker();
    $(".number").autoNumeric();
    
    $("#piezas").TouchSpin({
        min: 0,
        max: 100,
        step: 1,
        decimals: 0,
        maxboostedstep: 10,
        verticalbuttons: true,
        verticalupclass: 'glyphicon glyphicon-plus',
        verticaldownclass: 'glyphicon glyphicon-minus'
    });
    
    $("#abreModal").click(function () {
        limpiar("modalProductos");
        $("#actualizarProducto").hide();
        $("#agregaProducto").show();
        $("#modalProductos").modal("show");
    });

    $("#guardarClientes").click(function () {
        guardarCliente();
    });

    $(".modal-wide").on("show.bs.modal", function () {
        var height = $(window).height() - 200;
        $(this).find(".modal-body").css("max-height", height);
    });

    cargaCombos();
    buscaProductos();

});

function cargaCombos() {
    $.ajax({
        data: {'accion': 'getCombos'},
        url: '../controller/Productos/funcionesProductosController.php',
        type: 'post',
        success: function (response) {
            var combos = jQuery.parseJSON(response);
//             console.log(combos);
            $("#idLinea").html(combos.comboLinea);
            $("#idCategoria").html(combos.comboCategoria);
        },
    });
}

function buscaProductos() {
    colocaWaitGeneral();
    $.ajax({
        data: {'accion': 'getProductos'},
        url: '../controller/Productos/funcionesProductosController.php',
        type: 'post',
        success: function (response) {
            var data = jQuery.parseJSON(response);
            for (var i = 0; i < data.length; i++) {
                tablaProductos.row.add([data[i].idProducto, data[i].cveProducto, data[i].nomProducto, data[i].idLinea, data[i].descLinea, data[i].idCategoria, data[i].dscCategoria, data[i].precio, data[i].items, '<span  class="glyphicon glyphicon-pencil" style="cursor:pointer;" title="Editar producto" onClick="editar(this);"></span>', '<span  class="glyphicon glyphicon-remove" style="cursor:pointer;" title="Eliminar producto" onClick="eliminar(this);"></span>']).draw();
//                tablaProductos.columns.adjust().draw();
            }
            eliminaWaitGeneral();
        },
        error: {}
    });
}

function agregarProducto() {
    tablaProductos.row.add(["", $("#cveProducto").val(), $("#nomProducto").val(), $("#idLinea").val(), $("#idLinea option:selected").text(), $("#idCategoria").val(), $("#idCategoria option:selected").text(), $("#precio").val(), $("#piezas").val(), '<span  class="glyphicon glyphicon-pencil" style="cursor:pointer;" onClick="editar(this);"></span>', '<span  class="glyphicon glyphicon-remove" style="cursor:pointer;" onClick="eliminar(this);"></span>']).draw();
    $("#modalProductos").modal("hide");
    limpiar("modalProductos");
}

function editar(elem) {
    indiceEditar = tablaProductos.row($(elem).parent().parent()).index();
    var datosFila = tablaProductos.row(indiceEditar).data();
    $("#idProducto").val(datosFila[0]);
    $("#cveProducto").val(datosFila[1]);
    $("#nomProducto").val(datosFila[2]);
    $("#idLinea").val(datosFila[3]);
    $("#idCategoria").val(datosFila[5]);
    $("#precio").val(datosFila[7]);
    $("#piezas").val(datosFila[8]);
    $("#actualizarProducto").show();
    $("#agregaProducto").hide();
    $(".number").autoNumeric("update");
    $("#modalProductos").modal("show");
}

function modificarProducto() {
    var id = tablaProductos.cell(indiceEditar, 0).data();

    if (id != "") {
        id = id;
    } else {
        id = ("");
    }

    tablaProductos.row(indiceEditar).data([id, $("#cveProducto").val(), $("#nomProducto").val(), $("#idLinea").val(), $("#idLinea option:selected").text(), $("#idCategoria").val(), $("#idCategoria option:selected").text(), $("#precio").val(), $("#piezas").val(), '<span  class="glyphicon glyphicon-pencil" style="cursor:pointer;" onClick="editar(this);"></span>', '<span  class="glyphicon glyphicon-remove" style="cursor:pointer;" onClick="eliminar(this);"></span>']).draw();
    var row = tablaProductos.row(indiceEditar).node();
    $(row).removeClass('text-danger');
//        tablaClientes.column(0).visible(false); //ID CONCEPTO
////        tablaConceptos.column(9).visible(false); //ID CONCEPTO
//        tablaConceptos.column(10).visible(false); // ID CONTRATO
    limpiar("modalProductos");
    $("#modalProductos").modal("hide");
    guardado = false; //OBLIGAMOS AL USUARIO A GUARDAR LA HOJA

}

function eliminar(elem) {
    bootbox.confirm("Se eliminar\u00e1 el producto, \u00BFDesea Continuar?", function (response) {
        if (response) {
            var indiceEliminar = tablaProductos.row($(elem).parent().parent()).index();
            var datosFila = tablaProductos.row(indiceEliminar).data();
            if (datosFila[0] > 0) {
                arrayEliminados.push(datosFila[0]);
            }
            tablaProductos.row(indiceEliminar).remove().draw();
        }
    });
}

function guardarProductos() {
    var arrayProductos = [];
    var productos = tablaProductos.rows().data();

    for (var i = 0; i < productos.length; i++) {

        productos[i].push(tablaProductos.row(i).index());
        arrayProductos.push(productos[i]);
    }

    var objProductos = {
        productos: arrayProductos,
        productosEliminados: arrayEliminados,
        accion: 'guardarProductos',
    }
    console.log(objProductos);

    $.ajax({
        data: objProductos,
        url: '../controller/Productos/funcionesProductosController.php',
        type: 'post',
        success: function (response) {
            var data = jQuery.parseJSON(response);
            console.log(data);

            if (data.mesaje == "ok") {
                if (data.mesaje == "ok") {
                    bootbox.alert({
                        size: 'small',
                        message: successDatos,
                        callback: function () {
                            console.log(data.nuevosIds);
                            if (typeof data.nuevosIds !== 'undefined') {
                                if (data.nuevosIds.length > 0) {
                                    tablaProductos.clear().draw();
                                    buscaProductos();
                                }
                            }
                        }
                    });
                }
            }

        },
        error: {}
    });
}

function limpiar(limformularios) {
    $("#" + limformularios + " :input").each(function () {
        $(this).val('');
    });

}