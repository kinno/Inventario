
<link rel="stylesheet" type="text/css" href="/Inventario/view/css/datatables.css">
<link rel="stylesheet" type="text/css" href="/Inventario/view/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/Inventario/view/css/bootstrap-datepicker.min.css">
<script type="text/javascript" src="/Inventario/view/js/datatables.js"></script>
<script type="text/javascript" src="/Inventario/view/js/bootstrap-modal.js"></script>
<script type="text/javascript" src="/Inventario/view/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="/Inventario/view/js/Clientes/funcionesClientes.js"></script>

<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><strong>Catálogo de Clientes</strong></h3>
        </div>
        <div class="panel-body">
            <div class="row form-group">
                <div class="col-md-12">
                    <div class="input-group ">
                        <span class="btn btn-default" id="abreModal">Agregar cliente</span>
                    </div>
                </div>
            </div>

            <div class="row form-group">
                <div class="col-sm-12">
                    <div class="input-group col-sm-12">
                        <table id="tablaClientes" class="table table-bordered hover" width="100%">
                            <thead>
                                <tr ><td >idCliente</td><td >Clave de cliente</td><td >Nombre</td><td >Apellido paterno</td><td >Apellido materno</td><td >Dirección</td><td >Fecha de nacimiento</td><td >Teléfono</td><td >E-mail</td><td >idTipoCliente</td><td>Tipo de cliente</td><td></td><td ></td></tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row form-group">
                <div class="col-sm-2 col-md-offset-10">
                    <div class="input-group ">
                        <span class="btn btn-default" id="guardarClientes">Guardar</span>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <div id="modalCliente" class="modal fade modal-wide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></span>
                    <h4 class="modal-title" id="myModalLabel">Registro de clientes</h4>
                </div>		  
                <div class="modal-body" style="max-height: 477px;">
                    <div class="row form-group">
                        <div class="col-md-4">
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon" id="sizing-addon1">Nombre:</span>
                                <input type="text" class="form-control" aria-describedby="sizing-addon1" id="nombre" name="nombre" value="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon" id="sizing-addon1">Apellido paterno:</span>
                                <input type="text" class="form-control" aria-describedby="sizing-addon1" id="apPaterno" name="apPaterno" value="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon" id="sizing-addon1">Apellido materno:</span>
                                <input type="text" class="form-control" aria-describedby="sizing-addon1" id="apMaterno" name="apMaterno" value="">
                            </div>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-lg-11">
                            <div class="input-group ">
                                <span class="input-group-addon" id="sizing-addon2">Dirección:</span>
                                <input type="text" class="form-control" id="direccion" name="direccion" aria-describedby="sizing-addon2">
                            </div>
                        </div>
                    </div>    

                    <div class="row form-group">
                        <div class="col-lg-5">
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon" id="sizing-addon4">Fecha de naciemiento:</span>
                                <input type="date" class="form-control number" placeholder="" id="fechaNacimiento" name="fechaNacimiento" aria-describedby="sizing-addon4">
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon" id="sizing-addon3">Teléfono:</span>
                                <input type="text" class="form-control" placeholder="" id="telefono" name="telefono" aria-describedby="sizing-addon3">
                            </div>
                        </div>    
                    </div><!-- /.row -->

                    <div class="row form-group">
                        <div class="col-lg-5">
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon" id="sizing-addon5">E-mail:</span>
                                <input type="text" class="form-control number" placeholder="" id="email" name="email" value="" aria-describedby="sizing-addon3">
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon" id="sizing-addon6">Tipo de cliente:</span>
                                <select class="form-control" id="idTipCliente">
                                    <!--                                    <option value="-1" selected="true">Seleccione...</option>-->
                                    <option value="1">Consultora de unidad</option>
                                    <option value="2">Consultora externa</option>
                                    <option value="3">Cliente ordinario</option>
                                </select>
                            </div>
                        </div>
                    </div><!-- /.row -->
                    <div class="row form-group">
                        <div class="col-md-4">
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon" id="sizing-addon5">Clave de cliente:</span>
                                <input type="text" class="form-control number" placeholder="" id="cveCliente" name="cveCliente" readonly="true" aria-describedby="sizing-addon3">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="form-group">
                            <div class="col-md-12">

                                <div class="col-md-6">
                                    <span id="agregaCliente" name="agregaCliente" onclick="agregarCliente();" class="btn btn-primary " style="display: none;">Agregar</span>
                                    <span id="actualizarCliente" name="actualizarCliente" onclick="modificarCliente();" class="btn btn-primary" style="">Actualizar</span>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
