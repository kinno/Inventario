<?php

require_once '../../libs/adodb/adodb.inc.php';
require_once '../../libs/conexionBd.php';
require_once '../../libs/ChromePhp.php';

class ventasModel {

    function __construct() {
        
    }

    function __destruct() {
        
    }

    function getCliente($cveCliente) {
        global $cnx;
        $query = "select * from cliente 
            join cattipocliente using(idTipoCliente)
            where cveCliente = '$cveCliente'";
        $rs = $cnx->Execute($query);
        $data = array();
        while (!$rs->EOF) {
            $rs->fields['nombreCliente'] = utf8_encode($rs->fields['nombreCliente']);
            $rs->fields['apCliente'] = utf8_encode($rs->fields['apCliente']);
            $rs->fields['amCliente'] = utf8_encode($rs->fields['amCliente']);
            $rs->fields['dscTipoCliente'] = utf8_encode($rs->fields['dscTipoCliente']);
            array_push($data, $rs->fields);
            $rs->movenext();
        }
        return $data;
    }

    function getProducto($cveProducto, $fechaActual) {

        global $cnx;
        $query = "select * from producto
                    where cveProducto = $cveProducto";
        $rs = $cnx->Execute($query);
        $data = array();
        while (!$rs->EOF) {

            //QUERY PARFA BUSCAR PROMOCIONES
            $qPromo = "select * from promocion
                        where idProducto =" . $rs->fields['idProducto'] . "
                        and fechaFinal >= STR_TO_DATE('$fechaActual','%d/%m/%Y') 
                        and fechaInicio <= STR_TO_DATE('$fechaActual','%d/%m/%Y')";
            $rs2 = $cnx->Execute($qPromo);
//            ChromePhp::log($qPromo);
            $rs->fields['nomProducto'] = utf8_encode($rs->fields['nomProducto']);
            $rs->fields['promoValida'] = 0;
            while (!$rs2->EOF) {
                $rs->fields['precio'] = $rs2->fields['precioPromocion'];
                $rs->fields['promoValida'] = 1;
                $rs2->movenext();
            }

            array_push($data, $rs->fields);
            $rs->movenext();
        }
        return $data;
    }

    function guardarVenta($venta) {
        global $cnx;
        extract($venta);
        $cnx->StartTrans();
        $query = "INSERT INTO venta(fechaVenta,totalVenta,idCliente) VALUES(STR_TO_DATE('$fechaVenta','%d/%m/%Y'),$totalVenta,$idCliente)";
        $rs = $cnx->Execute($query);
        $idVenta = $cnx->Insert_ID();
        foreach ($detalleVenta as $dventa) {
            $idProducto = $dventa[0];
            $precioUnitario = $dventa[2];
            $iva = $dventa[3];
            $total = $dventa[6];
            $queryDetalle = "INSERT INTO detalleventa(idVenta,idProducto,precioUnitario,iva,total) VALUES($idVenta,$idProducto,$precioUnitario,$iva,$total)";
            $rs2 = $cnx->Execute($queryDetalle);
        }
        
        return $this->actualizarInventario($detalleVenta);
        
    }
    
    function actualizarInventario($detalleVenta){
        global $cnx;
        foreach ($detalleVenta as $dventa) {
            $idProducto = $dventa[0];
            
            $queryU = "UPDATE producto SET items=items-1 WHERE idProducto=$idProducto";
            $rsU = $cnx->Execute($queryU);
        }
        
        $cnx->CompleteTrans();

        if ($cnx->HasFailedTrans()) {
            return false;
        } else {
            return true;
        }
    }

}
