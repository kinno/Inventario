var successVenta = "<div class='row form-group'><div class='col-md-8 col-md-offset-3'><img src='/Inventario/view/images/doll.png' /></div></div><div class='row form-group'><div class='col-md-12 col-md-offset-1'><h4 class='text-danger'>Venta generada con \u00e9xito.</h4></div></div>";
var successDatos = "<div class='row form-group'><div class='col-md-8 col-md-offset-3'><img src='/Inventario/view/images/doll.png' /></div></div><div class='row form-group'><div class='col-md-12 col-md-offset-1'><h4 class='text-danger'>Datos guardados con \u00e9xito.</h4></div></div>";
var work = "<div id='pleaseWait' class='modal-backdrop fade in'></div>"+
        "<div id='progressWait' class='modal fade bs-example-modal-sm in' tabindex='-1' role='dialog' aria-labelledby='mySmallModalLabel' style='display: block; padding-right: 17px;'>"+
            "<div class='modal-dialog modal-sm'>"+
                "<div class='modal-content'>"+
                    "<div class='modal-body'>"+
                        "<div class='row form-group'>"+
                            "<div class='col-md-12'>"+
                                "<img style='width:100%' src='/Inventario/view/images/dollWork.png' />"+
                            "</div>"+
                        "</div>"+
                        "<div class='row form-group'>"+
                            "<div class='col-md-12'>"+
                                "<div class='progress'>"+
                                    "<div class='progress-bar progress-bar-danger progress-bar-striped active' role='progressbar' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100' style='width: 100%'>"+
                                        "<span >Cargando informacion...</span>"+
                                    "</div>"+
                                "</div>"+
                            "</div>"+
                        "</div>"+
                    "</div>"+
                "</div>"+
            "</div>"+
        "</div>";

$(document).ready(function () {
//    bootbox.alert({
//        size: 'small',
//        message: work
//    });
});

function cambiaMenu(elem, page) {
    $("#navBar").find(".active").each(function () {
        $(this).removeClass("active");
    });
    $(elem).addClass("active");
    switch (page) {
        case 1:
            $("#submenu:visible").toggle("slow");
            break;
        case 2:
            $("#submenu:visible").toggle("slow");
            $("#mainContainer").load("/Inventario/view/Productos/productos.php");
            break;
        case 3:
            $("#submenu:hidden").toggle("slow");
            break;
        case 4:
            $("#mainContainer").load("/Inventario/view/Promociones/listadoPromociones.php");
            break;
        case 5:
            $("#mainContainer").load("/Inventario/view/Promociones/promociones.php");
            break;
        case 6:
            $("#submenu:visible").toggle("slow");
            $("#mainContainer").load("/Inventario/view/Clientes/clientes.php");
            break;
        case 7:
            $("#submenu:visible").toggle("slow");
            $("#mainContainer").load("/Inventario/view/Ventas/ventas.php");
            break;
    }
}
function colocaWaitGeneral() {
    var divWait = $(work).appendTo('#mainContainer');
    divWait.show();
}

function eliminaWaitGeneral() {
    $("#pleaseWait").remove();
    $("#progressWait").remove();
}