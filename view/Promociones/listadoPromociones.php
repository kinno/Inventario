
<!--<link rel="stylesheet" type="text/css" href="/Inventario/view/css/datatables.css">-->
<link rel="stylesheet" type="text/css" href="/Inventario/view/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/Inventario/view/css/bootstrap-datepicker.min.css">
<script type="text/javascript" src="/Inventario/view/js/datatables.js"></script>
<script type="text/javascript" src="/Inventario/view/js/bootstrap-modal.js"></script>
<script type="text/javascript" src="/Inventario/view/js/autoNumeric.js"></script>
<script type="text/javascript" src="/Inventario/view/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="/Inventario/view/js/Promociones/funcionesPromociones.js"></script>

<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><strong>Registro de Promociones</strong></h3>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-md-6">
            <div class="panel panel-default panel-body inputsPrincipales">
                <div class="row form-group">
                    <div class="col-md-7">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon1">Clave de producto:</span>
                            <input type="text" class="form-control" aria-describedby="sizing-addon1" id="cveProducto" name="cveProducto">
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <div class="input-group input-group-sm">
                            <div class="input-group input-daterange">
                                <span class="input-group-addon">Del</span>
                                <input type="text" id="fechaInicial" class="form-control" >
                                <span class="input-group-addon">al</span>
                                <input type="text" id="fechaFinal" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <div class="well">
                            <div class="row form-group">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon" id="sizing-addon1">Producto:</span>
                                    <input type="text" class="form-control" aria-describedby="sizing-addon1" id="idProducto" name="producto" readonly="true">
                                    <input type="text" class="form-control" aria-describedby="sizing-addon1" id="producto" name="producto" readonly="true">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-addon" id="sizing-addon1">Secci&oacute;n:</span>
                                        <input type="text" class="form-control" aria-describedby="sizing-addon1" id="seccion" name="seccion" readonly="true">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-addon" id="sizing-addon1">Categor&iacute;a:</span>
                                        <input type="text" class="form-control" aria-describedby="sizing-addon1" id="categoria" name="categoria" readonly="true">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-6">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon1">Precio: $</span>
                            <input type="text" class="form-control number" aria-describedby="sizing-addon1" id="precioPromocion" name="precioPromocion" value="0.00">
                        </div>
                    </div>
                    <div class="col-md-2 col-md-offset-3">
                        <div class="input-group input-group-sm">
                            <span class="btn btn-primary" id="agregar">Agregar</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-2 col-md-offset-7">
                    <div class="input-group input-group-sm">
                        <span class="btn btn-primary" id="agregar">Guardar promociones</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <table id="tablaPromociones" class="table table-bordered table-striped">
                <thead>
                    <tr><td>idProducto</td><td>Producto</td><td>Precio</td><td>Del</td><td>Al</td><td></td></tr>
                </thead>
            </table>
        </div>
    </div>
</div>


