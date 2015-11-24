<?php

require_once '../../libs/adodb/adodb.inc.php';
require_once '../../libs/conexionBd.php';

class promocionModel {

    var $cnx;

    function __construct() {
        
    }

    function __destruct() {
        
    }

    public function getLinea() {
        global $cnx;
        $query = "select * from catlinea";
        $rs = $cnx->Execute($query);
        $data = array();
        while (!$rs->EOF) {
            array_push($data, $rs->fields);
            $rs->movenext();
        }
        return $data;
    }

    public function getCategoria() {
        global $cnx;
        $query = "select * from catCategoria";
        $rs = $cnx->Execute($query);
        $data = array();
        while (!$rs->EOF) {
            array_push($data, $rs->fields);
            $rs->movenext();
        }
        return $data;
    }

    public function buscaProductos($cveProducto) {
        global $cnx;
        $query = "select * from producto
                    left join catcategoria using(idCategoria)
                    left join catlinea using(idLinea)
                    where cveProducto = $cveProducto";
//        ChromePhp::log($query);
        $rs = $cnx->Execute($query);
        $data = array();
        while (!$rs->EOF) {
            $rs->fields['nomProducto'] = utf8_encode($rs->fields['nomProducto']);
            array_push($data, $rs->fields);
            $rs->movenext();
        }

        return $data;
    }

    public function getPromociones() {
        global $cnx;
        $query = "select * from promocion
                    left join producto using(idProducto)
                    left join catcategoria using(idCategoria)
                    left join catlinea using(idLinea)
                    order by fechaFinal";
        $rs = $cnx->Execute($query);
        $data = array();
        while (!$rs->EOF) {
            $rs->fields['nomProducto'] = utf8_encode($rs->fields['nomProducto']);
            array_push($data, $rs->fields);
            $rs->movenext();
        }

        return $data;
    }

    public function mergePromociones($promociones) {
        global $cnx;
        $idProductosAdd = array();
        $idProductos = array();
        $ind = 0;
        $idPromocion = $promociones['idPromocion'];
        $idProducto = $promociones['idProducto'];
        $precioPromocion = $promociones['precioPromocion'];
        $fechaInicio = $promociones['fechaInicial'];
        $fechaFinal = $promociones['fechaFinal'];

        if ($idPromocion == "") { // NUEVO REGRISTRO
            $query = "INSERT INTO promocion(idProducto,precioPromocion,fechaInicio,fechaFinal) VALUES($idProducto,$precioPromocion,STR_TO_DATE('$fechaInicio','%d/%m/%Y'),STR_TO_DATE('$fechaFinal','%d/%m/%Y'))";
            ChromePhp::log($query);
            try {
                $rs = $cnx->Execute($query);
//                array_push($idProductos, array($cnx->Insert_ID(), $ind));
                $idProductosAdd['mesaje'] = "ok";
            } catch (Exception $exc) {
                $idProductosAdd['mesaje'] = $exc->getTraceAsString();
                return $idProductosAdd;
            }
        } else { //ACTUALIZACION DE PRODUCTO
            $query = "UPDATE promocion set idProducto = $idProducto, precioPromocion=$precioPromocion,fechaInicio = STR_TO_DATE('$fechaInicio','%d/%m/%Y'),fechaFinal=STR_TO_DATE('$fechaFinal','%d/%m/%Y') WHERE idPromocion = $idPromocion";
            try {
                $rs = $cnx->Execute($query);
                $idProductosAdd['mesaje'] = "ok";
            } catch (Exception $exc) {
                $idProductosAdd['mesaje'] = $exc->getTraceAsString();
                return $idProductosAdd;
            }
        }

//        print_r($idProductosAdd);
//        
        return $idProductosAdd;
    }

    public function removeProductos($productos) {
        global $cnx;
        foreach ($productos as $producto) {
            $sSql = "DELETE FROM producto WHERE idProducto = $producto";
            $rs = $cnx->Execute($sSql);
        }
        $idProductosAdd['mesaje'] = "ok";
        return $idProductosAdd;
    }

}
