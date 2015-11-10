$(document).ready(function () {
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
            break;
    }
}