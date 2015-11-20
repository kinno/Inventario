<?php

include_once '../../model/Ventas/funcionesVentas.php';
if ($_POST) {
    extract($_POST);
    if (isset($accion) && !empty($accion)) {
        $ventas = new Ventas();
        switch ($accion) {
            case 'getCliente':
                $data = $ventas->getCliente($cveCliente);
                echo json_encode($data);
                break;
            case 'getProducto':
                $data = $ventas->getProducto($cveProducto, $fechaActual);
                echo json_encode($data);
                break;
            case 'guardarVenta':
                $data = $ventas->guardarVenta($_POST);
                echo json_encode($data);
                break;
        }
    }
} else {
    echo 'Petición Inválida';
}

