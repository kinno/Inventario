$(document).ready(function () {
});

function cambiaMenu(elem, page) {
    $("#navBar").find(".active").each(function () {
        $(this).removeClass("active");
    });
    $(elem).addClass("active");
    switch (page) {
        case 1:
            break;
        case 2:
            $("#mainContainer").load("/Inventario/view/Inventario/inventario.php");
            break;
        case 3:
            $("#mainContainer").load("/Inventario/view/Clientes/clientes.php");
            break;
        case 4:
            break;
    }
}