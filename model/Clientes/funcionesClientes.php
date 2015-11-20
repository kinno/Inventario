<?php

include 'funcionesClientesModel.php';
require_once '../../libs/ChromePhp.php';
class Clientes{
    
    var $insClientesModel;
    
    function __construct() {
        $this->insClientesModel = new clientesModel();
    }
    
    function getClientes(){
        $resp = $this->insClientesModel->getClientes();
        return $resp;
    }
    
    function saveClientes($post){
        extract($post);
        
        if(count($clientesEliminados)>0){
            $resp=$this->insClientesModel->removeClientes($clientesEliminados);
        }
        if (count($clientes) > 0) {
            $resp = $this->insClientesModel->mergeClientes($clientes);
        }
        return $resp;
    }
}

