var tablaClientes;
var indiceEditar;
var arrayEliminados =[];
$(document).ready(function () {
    tablaClientes = $("#tablaClientes").DataTable({"retrieve": true, "ordering": false, "sPaginationType": "full_numbers",
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

});

function agregarCliente() {
    tablaClientes.row.add(["", $("#nombre").val(), $("#apPaterno").val(), $("#apMaterno").val(), $("#direccion").val(), $("#fechaNacimiento").val(), $("#telefono").val(), $("#email").val(), $("#idTipCliente").val(), $("#idTipCliente option:selected").text(), '<span  class="glyphicon glyphicon-pencil" style="cursor:hand;" onClick="editar(this);"></span>', '<span  class="glyphicon glyphicon-remove" style="cursor:hand;" onClick="eliminar(this);"></span>']).draw();
    $("#modalCliente").modal("hide");
    limpiar("modalCliente");
}

function editar(elem) {
    indiceEditar = tablaClientes.row($(elem).parent().parent()).index();
    var datosFila = tablaClientes.row(indiceEditar).data();
    $("#nombre").val(datosFila[1]);
    $("#apPaterno").val(datosFila[2]);
    $("#apMaterno").val(datosFila[3]);
    $("#direccion").val(datosFila[4]);
    $("#fechaNacimiento").val(datosFila[5]);
    $("#telefono").val(datosFila[6]);
    $("#email").val(datosFila[7]);
    $("#idTipCliente").val(datosFila[8]);
    $("#actualizarCliente").show();
    $("#agregaCliente").hide();
    $("#modalCliente").modal("show");
}

function modificarCliente() {
    var id = tablaClientes.cell(indiceEditar, 0).data();

    if (id != "") {
        id = id;
    } else {
        id = ("");
    }

    tablaClientes.row(indiceEditar).data([id, $("#nombre").val(), $("#apPaterno").val(), $("#apMaterno").val(), $("#direccion").val(), $("#fechaNacimiento").val(), $("#telefono").val(), $("#email").val(), $("#idTipCliente").val(), $("#idTipCliente option:selected").text(), '<span  class="glyphicon glyphicon-pencil" style="cursor:hand;" onClick="editar(this);"></span>', '<span  class="glyphicon glyphicon-remove" style="cursor:hand;" onClick="eliminar(this);"></span>']).draw();
//        tablaClientes.column(0).visible(false); //ID CONCEPTO
////        tablaConceptos.column(9).visible(false); //ID CONCEPTO
//        tablaConceptos.column(10).visible(false); // ID CONTRATO
    limpiar("modalCliente");
    $("#modalCliente").modal("hide");
    guardado = false; //OBLIGAMOS AL USUARIO A GUARDAR LA HOJA

}

function eliminar(elem) {
    bootbox.confirm("Se eliminar\u00e1 el concepto, \u00BFDesea Continuar?", function (response) {
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

function guardarCliente() {

}

function limpiar(limformularios) {
    $("#" + limformularios + " :input").each(function () {
        $(this).val('');
    });

}