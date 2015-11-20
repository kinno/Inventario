<?php

include_once '../../model/Promociones/funcionesPromociones.php';
if ($_POST) {
    extract($_POST);
    if (isset($accion) && !empty($accion)) {

        $promociones = new Promociones();
        
        switch ($accion) {
            case 'getPromociones':
                $data = $promociones->getPromociones();
                echo json_encode($data);
                break;
            
            case 'buscaProducto':
                $data = $promociones->buscaProductos($CveProducto);
                echo json_encode($data);
                break;
            
            case 'guardarPromocion':
                $data = $promociones->mergeProductos($_POST);
                echo json_encode($data);
                break;

            default:
                break;
        }
    } else {
        echo 'error';
    }
} else {
    echo "Peticion Invalida";
}

