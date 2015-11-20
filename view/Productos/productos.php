
<link rel="stylesheet" type="text/css" href="/Inventario/view/css/datatables.css">
<link rel="stylesheet" type="text/css" href="/Inventario/view/css/dataTables.bootstrap.min.css">
<!--<link rel="stylesheet" type="text/css" href="/Inventario/view/css/bootstrap-datepicker.min.css">-->
<script type="text/javascript" src="/Inventario/view/js/datatables.js"></script>
<script type="text/javascript" src="/Inventario/view/js/bootstrap-modal.js"></script>
<script type="text/javascript" src="/Inventario/view/js/autoNumeric.js"></script>
<!--<script type="text/javascript" src="/Inventario/view/js/bootstrap-datepicker.min.js"></script>-->
<script type="text/javascript" src="/Inventario/view/js/Productos/funcionesProductos.js"></script>
<!--<div id="pleaseWait" class="modal-backdrop fade in">
</div>
<div class="progress modal-dialog" id="progressWait" style="z-index: 99999;height: 40px;">
        <p style="height: 40px;display: table;width: 100%;">
            <span style="display: table-cell;vertical-align: middle;font-size:18px;">Cargando informacin necesaria...</span>
        </p>
</div>-->

<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><strong>Catálogo de Productos</strong></h3>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-md-12">
            <div class="input-group ">
                <span class="btn btn-default" id="abreModal">Agregar producto</span>
            </div>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-sm-12">
            <div class="input-group col-sm-12">
                <table id="tablaProductos" class="table table-bordered" width="100%">
                    <thead>
                        <tr ><td >idProducto</td><td style="width: 71px">Clave de producto</td><td style="width: 133px;">Nombre</td><td>idSeccion</td><td style="width: 133px;">Secci&oacute;n</td><td>idCategoria</td><td style="width: 149px;">Categor&iacute;a</td><td style="width: 31px;">Precio</td><td style="width:20px;">Existencias</td><td style="width: 1px;"></td><td style="width: 1px;"></td></tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-sm-2 col-md-offset-10">
            <div class="input-group ">
                <span class="btn btn-default" id="guardarProductos" onclick="guardarProductos();">Guardar</span>
            </div>
        </div>
    </div>

</div>
<div id="modalProductos" class="modal fade modal-wideP" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></span>
                <h4 class="modal-title" id="myModalLabel">Registro de producto</h4>
            </div>		  
            <div class="modal-body" style="max-height: 477px;">
                <div class="row form-group">
                    <div class="col-md-6">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon1">Clave del producto:</span>
                            <input type="hidden" class="form-control" aria-describedby="sizing-addon1" id="idProducto" name="idProducto" value="">
                            <input type="text" class="form-control" aria-describedby="sizing-addon1" id="cveProducto" name="cveProducto" value="">
                            
                        </div>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-lg-12">
                        <div class="input-group ">
                            <span class="input-group-addon" id="sizing-addon2">Producto:</span>
                            <input type="text" class="form-control" id="nomProducto" name="nomProducto" aria-describedby="sizing-addon2">
                        </div>
                    </div>
                </div>    

                <div class="row form-group">
                    <div class="col-lg-6">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon4">L&iacute;nea:</span>
                            <select class="form-control" id="idLinea">
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon4">Categor&iacute;a:</span>
                            <select class="form-control" id="idCategoria">
                            </select>
                        </div>
                    </div>    
                </div><!-- /.row -->

                <div class="row form-group">
                    <div class="col-md-5">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon5">Precio:</span>
                            <input type="text" class="form-control number" placeholder="" id="precio" name="precio" aria-describedby="sizing-addon5">
                        </div>
                    </div>
                    <div class="col-md-3 col-md-offset-4">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon6">Piezas:</span>
                            <input type="text" class="form-control" placeholder="" id="piezas" name="piezas" aria-describedby="sizing-addon6">
                        </div>
                    </div>
                </div><!-- /.row -->

                <div class="modal-footer">
                    <div class="form-group">
                        <div class="col-xs-18 col-md-12">
                            <div class="col-md-2 col-md-offset-10">
                                <span id="agregaProducto" name="agregaProducto" onclick="agregarProducto();" class="btn btn-primary " style="display: none;">Agregar</span>
                                <span id="actualizarProducto" name="agregaProducto" onclick="modificarProducto();" class="btn btn-primary" style="">Actualizar</span>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
