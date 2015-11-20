<?php

include 'funcionesVentasModel.php';
include_once '../../libs/ChromePhp.php';

class Ventas{
    var $insVentasModel;
    function __construct() {
        $this->insVentasModel = new ventasModel();
    }
    
    function getCliente($cveCliente){
        $resp = $this->insVentasModel->getCliente($cveCliente);
        return $resp;
    }
    
    function getProducto($cveProducto, $fechaActual){
        $resp = $this->insVentasModel->getProducto($cveProducto, $fechaActual);
        return $resp;
    }
    
    function guardarVenta($post){
        $resp = $this->insVentasModel->guardarVenta($post);
        return $resp;
    }
}

