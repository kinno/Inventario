var tablaClientes;
var indiceEditar;
var arrayEliminados = [];
$(document).ready(function () {
    tablaClientes = $("#tablaClientes").DataTable({"retrieve": true, "ordering": true,
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
    tablaClientes.column(0).visible(false);
    tablaClientes.column(9).visible(false);

    $("input [type=date]").datepicker({
        format: "dd-mm-yyyy",
        language: "es"
    });

    $("#abreModal").click(function () {
        limpiar("modalCliente");
        $("#actualizarCliente").hide();
        $("#agregaCliente").show();
        $("#modalCliente").modal("show");
    });

    $("#guardarClientes").click(function () {
        guardarCliente();
    });

    $(".modal-wide").on("show.bs.modal", function () {
        var height = $(window).height() - 200;
        $(this).find(".modal-body").css("max-height", height);
    });

    buscaClientes();

});

function generaClaveUsuario(funcion) {
    var nombre = $("#nombre").val().split("");
    var apaterno = $("#apPaterno").val().split("");
    var amaterno = $("#apMaterno").val().split("");
    var fechaN = $("#fechaNacimiento").val().split("-");
    console.log(fechaN);
    $("#cveCliente").val(nombre[0] + "" + apaterno[0] + "" + amaterno[0] + "" + fechaN[0]);

    funcion();
}

function agregarCliente() {
    generaClaveUsuario(function () {
        tablaClientes.row.add(["", $("#cveCliente").val(), $("#nombre").val(), $("#apPaterno").val(), $("#apMaterno").val(), $("#direccion").val(), $("#fechaNacimiento").val(), $("#telefono").val(), $("#email").val(), $("#idTipCliente").val(), $("#idTipCliente option:selected").text(), '<span  class="glyphicon glyphicon-pencil" style="cursor:hand;" onClick="editar(this);"></span>', '<span  class="glyphicon glyphicon-remove" style="cursor:hand;" onClick="eliminar(this);"></span>']).draw();
        $("#modalCliente").modal("hide");
        limpiar("modalCliente");
    });
}

function editar(elem) {
    indiceEditar = tablaClientes.row($(elem).parent().parent()).index();
    var datosFila = tablaClientes.row(indiceEditar).data();
    $("#cveCliente").val(datosFila[1]);
    $("#nombre").val(datosFila[2]);
    $("#apPaterno").val(datosFila[3]);
    $("#apMaterno").val(datosFila[4]);
    $("#direccion").val(datosFila[5]);
    $("#fechaNacimiento").val(datosFila[6]);
    $("#telefono").val(datosFila[7]);
    $("#email").val(datosFila[8]);
    $("#idTipCliente").val(datosFila[9]);
    $("#actualizarCliente").show();
    $("#agregaCliente").hide();
    $("#modalCliente").modal("show");
}

function modificarCliente() {
    generaClaveUsuario(function () {
        var id = tablaClientes.cell(indiceEditar, 0).data();

        if (id != "") {
            id = id;
        } else {
            id = ("");
        }

        tablaClientes.row(indiceEditar).data([id, $("#cveCliente").val(), $("#nombre").val(), $("#apPaterno").val(), $("#apMaterno").val(), $("#direccion").val(), $("#fechaNacimiento").val(), $("#telefono").val(), $("#email").val(), $("#idTipCliente").val(), $("#idTipCliente option:selected").text(), '<span  class="glyphicon glyphicon-pencil" style="cursor:hand;" onClick="editar(this);"></span>', '<span  class="glyphicon glyphicon-remove" style="cursor:hand;" onClick="eliminar(this);"></span>']).draw();

        limpiar("modalCliente");
        $("#modalCliente").modal("hide");
        guardado = false; //OBLIGAMOS AL USUARIO A GUARDAR LA HOJA
    });
}

function eliminar(elem) {
    bootbox.confirm("Se eliminar\u00e1 el(la) cliente(a), \u00BFDesea Continuar?", function (response) {
        if (response) {
            var indiceEliminar = tablaClientes.row($(elem).parent().parent()).index();
            var datosFila = tablaClientes.row(indiceEliminar).data();
            if (datosFila[0] > 0) {
                arrayEliminados.push(datosFila[0]);
            }
            tablaClientes.row(indiceEliminar).remove().draw();
        }
    });
}

function buscaClientes() {
    colocaWaitGeneral();
    $.ajax({
        data: {'accion': 'getClientes'},
        url: '../controller/Clientes/funcionesClienteController.php',
        type: 'post',
        success: function (response) {
            var data = jQuery.parseJSON(response);
            for (var i = 0; i < data.length; i++) {
                tablaClientes.row.add([data[i].idCliente, data[i].cveCliente, data[i].nombreCliente, data[i].apCliente, data[i].amCliente, data[i].direccionCliente, data[i].fechaNCliente, data[i].telefonoCliente, data[i].mailCliente, data[i].idTipoCliente, data[i].dscTipoCliente, '<span  class="glyphicon glyphicon-pencil" style="cursor:pointer;" title="Editar producto" onClick="editar(this);"></span>', '<span  class="glyphicon glyphicon-remove" style="cursor:pointer;" title="Eliminar producto" onClick="eliminar(this);"></span>']).draw();
//                tablaProductos.columns.adjust().draw();
            }
            eliminaWaitGeneral();
        },
        error: {}
    });
}

function guardarCliente() {
    var arrayClientes = [];
    var clientes = tablaClientes.rows().data();

    for (var i = 0; i < clientes.length; i++) {

        clientes[i].push(tablaClientes.row(i).index());
        arrayClientes.push(clientes[i]);
    }

    var objClientes = {
        clientes: arrayClientes,
        clientesEliminados: arrayEliminados,
        accion: 'guardarClientes',
    }
    console.log(objClientes);

    $.ajax({
        data: objClientes,
        url: '../controller/Clientes/funcionesClienteController.php',
        type: 'post',
        success: function (response) {
            var data = jQuery.parseJSON(response);
            console.log(data);

            if (data.mesaje == "ok") {
                bootbox.alert({
                    size: 'small',
                    message: successDatos,
                    callback: function () {
                        console.log(data.nuevosIds);
                        if (typeof data.nuevosIds !== 'undefined') {
                            if (data.nuevosIds.length > 0) {
                                tablaClientes.clear().draw();
                                buscaClientes();
                            }
                        }
                    }
                });
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