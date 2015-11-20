<?php

require_once '../../libs/adodb/adodb.inc.php';
require_once '../../libs/conexionBd.php';

class productoModel {

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

    public function getProductos() {
        global $cnx;
        $query = "select * from producto 
                    left join catcategoria using(idCategoria)
                    left join catlinea using(idLinea)
                    Order by idCategoria";
        $rs = $cnx->Execute($query);
        $data = array();
        while (!$rs->EOF) {
            $rs->fields['nomProducto'] = utf8_encode($rs->fields['nomProducto']);
            array_push($data, $rs->fields);
            $rs->movenext();
        }

        return $data;
    }

    public function mergeProductos($productos) {
        global $cnx;
        $idProductosAdd = array();
        $idProductos = array();
        $ind =0;
        foreach ($productos as $producto) {
            $idProducto = $producto[0];
            $cveProducto = $producto[1];
            $nomProducto = utf8_decode($producto[2]);
            $precio = str_replace(",", "", $producto[7]);
            $idCategoria = $producto[5];
            $idLinea = $producto[3];
            $items = $producto[8];
            $ind =$producto[11];

            if ($idProducto == "") { // NUEVO REGRISTRO
                $query = "INSERT INTO producto(cveProducto,nomProducto,precio,idCategoria,idLinea,items) VALUES($cveProducto,'$nomProducto',$precio,$idCategoria,$idLinea,$items)";
                try {
                    $rs = $cnx->Execute($query);
                array_push($idProductos, array($cnx->Insert_ID(), $ind));
                 $idProductosAdd['mesaje']="ok";
                } catch (Exception $exc) {
                $idProductosAdd['mesaje']= $exc->getTraceAsString();
                    return $idProductosAdd;
                }
            } else { //ACTUALIZACION DE PRODUCTO
                $query = "UPDATE producto set cveProducto = $cveProducto, nomProducto='$nomProducto',precio = $precio,idCategoria=$idCategoria,idLinea=$idLinea,items=$items WHERE idProducto = $idProducto";
                try {
                    $rs = $cnx->Execute($query);
                    $idProductosAdd['mesaje']="ok";
                } catch (Exception $exc) {
                   $idProductosAdd['mesaje']= $exc->getTraceAsString();
                   return $idProductosAdd;
                }
            }
        }
        $idProductosAdd['nuevosIds']=$idProductos;
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
        $idProductosAdd['mesaje']="ok";
        return $idProductosAdd;
    }
}
