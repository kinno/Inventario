
<link rel="stylesheet" type="text/css" href="/Inventario/view/css/datatables.css">
<link rel="stylesheet" type="text/css" href="/Inventario/view/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/Inventario/view/css/bootstrap-datepicker.min.css">
<script type="text/javascript" src="/Inventario/view/js/datatables.js"></script>
<script type="text/javascript" src="/Inventario/view/js/bootstrap-modal.js"></script>
<script type="text/javascript" src="/Inventario/view/js/autoNumeric.js"></script>
<script type="text/javascript" src="/Inventario/view/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="/Inventario/view/js/Ventas/funcionesVentas.js"></script>

<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><strong>Ventas</strong></h3>
        </div>
        <div class="panel-body">
            <div class="row form-group">
                <div class="col-md-12">
                    <div class="inputsPrincipales">
                        <div class="row form-group">
                            <div class="col-md-3">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon" id="sizing-addon1">Clave de Cliente:</span>
                                    <input type="text" class="form-control" aria-describedby="sizing-addon1" id="cveCliente" name="cveCliente">
                                </div>
                            </div>
                            <div class="col-md-2 col-md-offset-7">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon" id="sizing-addon1">Fecha:</span>
                                    <input type="text" class="form-control" aria-describedby="sizing-addon1" id="fechaActual" name="fechaActual" readonly="true">
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <!--<div class="well">-->
                                <div class="row form-group">
                                    <div class="col-md-7">
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-addon" id="sizing-addon1">Nombre:</span>
                                            <input type="hidden" class="form-control" aria-describedby="sizing-addon1" id="idCliente" name="idCliente" readonly="true">
                                            <input type="text" class="form-control" aria-describedby="sizing-addon1" id="nomCliente" name="nomCliente" readonly="true">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-md-offset-2">
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-addon" id="sizing-addon1">Tipo:</span>
                                            <input type="hidden" class="form-control" aria-describedby="sizing-addon1" id="idTipoCliente" name="idTipoCliente" readonly="true">
                                            <input type="hidden" class="form-control" aria-describedby="sizing-addon1" id="descuento" name="descuento" readonly="true">
                                            <input type="text" class="form-control" aria-describedby="sizing-addon1" id="dscTipoCliente" name="dscTipoCliente" readonly="true">
                                        </div>
                                    </div>
                                </div>
                                <!--</div>-->
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-3">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon" id="sizing-addon1">Clave producto:</span>
                                    <input type="text" class="form-control " aria-describedby="sizing-addon1" id="cveProducto" name="cveProducto">
                                    <input type="hidden" class="form-control " aria-describedby="sizing-addon1" id="idProducto" name="idProducto">
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <table id="tablaVentas" class="table table-bordered hover">
                                    <thead>
                                        <tr><td>idProducto</td><td style="width:50%">Producto</td><td style="width:10%">Precio</td><td style="width:10%">I.V.A.</td><td style="width:10%">Subtotal</td><td style="width:5%">*</td><td style="width:15%">Total</td><td style="width:5%"></td></tr>
                                    </thead>
                                    <tfoot>
                                        <tr><td colspan="6" style="text-align: right;"> Total:</td><td style="text-align:right; font-weight: bold;">$<span class="number" id="totalVenta">0.00</span></td><td style="width:5%"></td></tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-1 col-md-offset-10">
                                <span id="guardarVenta" onclick="guardarVenta();" class="btn btn-primary">Aceptar</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>



</div>
