<?php

require_once '../../libs/adodb/adodb.inc.php';
require_once '../../libs/conexionBd.php';
require_once '../../libs/ChromePhp.php';

class clientesModel{
    var $cnx;
    
    function __construct() {
        
    }
    
    function __destruct() {
        
    }
    
    public function getClientes(){
         global $cnx;
        $query = "select * from cliente 
                    left join catTipoCliente using(idTipoCliente)
                    Order by apCliente";
//        ChromePhp::log($query);
        $rs = $cnx->Execute($query);
        $data = array();
        while (!$rs->EOF) {
            $rs->fields['nombreCliente'] = utf8_encode($rs->fields['nombreCliente']);
            $rs->fields['apCliente'] = utf8_encode($rs->fields['apCliente']);
            $rs->fields['amCliente'] = utf8_encode($rs->fields['amCliente']);
            $rs->fields['direccionCliente'] = utf8_encode($rs->fields['direccionCliente']);
            $rs->fields['dscTipoCliente'] = utf8_encode($rs->fields['dscTipoCliente']);
            array_push($data, $rs->fields);
            $rs->movenext();
        }

        return $data;
    }
    
    public function mergeClientes($clientes) {
        global $cnx;
        $idClientesAdd = array();
        $idClientes = array();
        $ind =0;
        foreach ($clientes as $cliente) {
            $idCliente = $cliente[0];
            $cveCliente = $cliente[1];
            $nomCliente = utf8_decode($cliente[2]);
            $apCliente = utf8_decode($cliente[3]);
            $amCliente = utf8_decode($cliente[4]);
            $direccion = utf8_decode($cliente[5]);
            $fechaNacimiento = $cliente[6];
            $telefono = $cliente[7];
            $correo = $cliente[8];
            $idTipCliente = $cliente[9];
            $ind =$cliente[13];

            if ($idCliente == "") { // NUEVO REGRISTRO
                $query = "INSERT INTO cliente(cveCliente,nombreCliente,apCliente,amCliente,direccionCliente,telefonoCliente,mailCliente,fechaNCliente,idTipoCliente) VALUES('$cveCliente','$nomCliente','$apCliente','$amCliente','$direccion',$telefono,'$correo','$fechaNacimiento',$idTipCliente)";
//                ChromePhp::log($query);
                try {
                    $rs = $cnx->Execute($query);
                array_push($idClientes, array($cnx->Insert_ID(), $ind));
                 $idClientesAdd['mesaje']="ok";
                } catch (Exception $exc) {
                $idClientesAdd['mesaje']= $exc->getTraceAsString();
                    return $idClientesAdd;
                }
            } else { //ACTUALIZACION DE PRODUCTO
                $query = "UPDATE cliente set cveCliente ='$cveCliente', nombreCliente = '$nomCliente', apCliente='$apCliente',amCliente = '$amCliente',direccionCliente='$direccion',telefonoCliente=$telefono,mailCliente='$correo',fechaNCliente='$fechaNacimiento' ,idTipoCliente=$idTipCliente WHERE idCliente = $idCliente";
                ChromePhp::log($query);
                try {
                    $rs = $cnx->Execute($query);
                    $idClientesAdd['mesaje']="ok";
                } catch (Exception $exc) {
                   $idClientesAdd['mesaje']= $exc->getTraceAsString();
                   return $idClientesAdd;
                }
            }
        }
        $idClientesAdd['nuevosIds']=$idClientes;
//        print_r($idProductosAdd);
//        
        return $idClientesAdd;
    }
    
    public function removeClientes($clientes) {
        global $cnx;
        foreach ($clientes as $cliente) {
            $sSql = "DELETE FROM cliente WHERE idCliente = $cliente";
            $rs = $cnx->Execute($sSql);
        }
        $idClientesAdd['mesaje']="ok";
        return $idClientesAdd;
    }
}
