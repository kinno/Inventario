<?php

include_once '../../model/Productos/funcionesProductos.php';
if ($_POST) {
    extract($_POST);
    if (isset($accion) && !empty($accion)) {

        $productos = new Productos();
        switch ($accion) {
            case 'getCombos':
                $arrayCombos = array();
                $dataLinea = $productos->getLinea();
                $dataCategoria = $productos->getCategoria();

                $comboLinea = "<option value='-1'>Seleccione...</option>";
                foreach ($dataLinea as $value) {
                     $comboLinea .= "<option value=" . $value[0] . ">" . $value[1] . "</option>";
                }
                
                $comboCategoria = "<option value='-1'>Seleccione...</option>";
                foreach ($dataCategoria as $value) {
                    $comboCategoria .= "<option value=" . $value[0] . ">" . $value[1] . "</option>";
                }
               
                $arrayCombos['comboLinea']=$comboLinea;
                $arrayCombos['comboCategoria']=$comboCategoria;
                
                echo json_encode($arrayCombos);
                break;

            case 'getProductos':
                $data = $productos->getProductos();
                echo json_encode($data);
                break;
            
            case 'guardarProductos':
                $data = $productos->mergeProductos($_POST);
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

