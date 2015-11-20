<?php

include_once '../../model/Clientes/funcionesClientes.php';
require_once '../../libs/ChromePhp.php';
if ($_POST) {
    extract($_POST);
    if (isset($accion) && !empty($accion)) {
        $clientes = new Clientes;
        switch ($accion) {
            case 'getClientes':
                $resp = $clientes->getClientes();
                echo json_encode($resp);
                break;
            case 'guardarClientes':
                $resp=$clientes->saveClientes($_POST);
                echo json_encode($resp);
                break;

            default:
                break;
        }
    }
} else {
    echo 'PEticion invalida';
}
