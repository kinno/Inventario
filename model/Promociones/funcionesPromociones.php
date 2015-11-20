<?php

include 'funcionesPromocionesModel.php';
include_once '../../libs/ChromePhp.php';
class Promociones {

    var $insPromocionesModel;

    function __construct() {
        $this->insPromocionesModel = new promocionModel();
    }

    public function buscaProductos($cveProducto) {
        $producto = $this->insPromocionesModel->buscaProductos($cveProducto);
        return $producto;
    }
    
    public function getPromociones() {
        $promociones = $this->insPromocionesModel->getPromociones();
        return $promociones;
    }

    public function mergeProductos($post) {
//        extract($post);
//        if (count($productosEliminados) > 0) {
//            $resp=$this->insProductosModel->removeProductos($productosEliminados);
//        }

//        if (count($productos) > 0) {
        $resp = $this->insPromocionesModel->mergePromociones($post);
        return $resp;
    }

}
