<?php

include 'funcionesProductosModel.php';

class Productos {

    var $insProductosModel;

    function __construct() {
        $this->insProductosModel = new productoModel();
    }

    public function getLinea() {
        $linea = $this->insProductosModel->getLinea();
        return $linea;
    }

    public function getCategoria() {
        $categoria = $this->insProductosModel->getCategoria();
        return $categoria;
    }

    public function getProductos() {
        $producto = $this->insProductosModel->getProductos();
        return $producto;
    }

    public function mergeProductos($post) {
        extract($post);
        if (count($productosEliminados) > 0) {
            $resp=$this->insProductosModel->removeProductos($productosEliminados);
        }

        if (count($productos) > 0) {
            $resp = $this->insProductosModel->mergeProductos($productos);
        }
        return $resp;
    }

}
