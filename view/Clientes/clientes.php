
<link rel="stylesheet" type="text/css" href="/Inventario/view/css/datatables.css">
<script type="text/javascript" src="/Inventario/view/js/datatables.js"></script>
<script type="text/javascript" src="/Inventario/view/js/bootstrap-modal.js"></script>
<script type="text/javascript" src="/Inventario/view/js/Clientes/funcionesClientes.js"></script>

<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><strong>Catálogo de Clientes</strong></h3>
        </div>
    </div>


    <div class="col-sm-12">
        <div class="col-md-5 col-md-offset-5">
            <span class="btn btn-default" onclick="abreModal();">Agregar cliente</span>
        </div>
    </div>
    <div class="row"></div>
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div id="tablaClientes_wrapper" class="dataTables_wrapper no-footer"><div class="dataTables_length" id="tablaClientes_length"><label>Mostrar <select name="tablaClientes_length" aria-controls="tablaClientes" class=""><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> registros</label></div><div id="tablaClientes_filter" class="dataTables_filter"><label>    Buscar:<input type="search" class="" placeholder="" aria-controls="tablaClientes"></label></div><table id="tablaClientes" class="table table-bordered dataTable no-footer" role="grid" aria-describedby="tablaClientes_info" style="width: 999px;">
                <thead>
                    <tr role="row"><td class="sorting_disabled" rowspan="1" colspan="1" style="width: 55px;">idCliente</td><td class="sorting_disabled" rowspan="1" colspan="1" style="width: 51px;">Nombre</td><td class="sorting_disabled" rowspan="1" colspan="1" style="width: 50px;">Apellido paterno</td><td class="sorting_disabled" rowspan="1" colspan="1" style="width: 53px;">Apellido materno</td><td class="sorting_disabled" rowspan="1" colspan="1" style="width: 59px;">Dirección</td><td class="sorting_disabled" rowspan="1" colspan="1" style="width: 69px;">Fecha de nacimiento</td><td class="sorting_disabled" rowspan="1" colspan="1" style="width: 56px;">Teléfono</td><td class="sorting_disabled" rowspan="1" colspan="1" style="width: 26px;">E-mail</td><td class="sorting_disabled" rowspan="1" colspan="1" style="width: 83px;">idTipoCliente</td><td class="sorting_disabled" rowspan="1" colspan="1" style="width: 41px;">Tipo de cliente</td><td class="sorting_disabled" rowspan="1" colspan="1"></td><td class="sorting_disabled" rowspan="1" colspan="1"></td></tr>
                </thead>
                <tbody>
                    
                <tr role="row" class="odd"><td></td><td>te</td><td>te</td><td>trfbhvn</td><td>jhb m,ñ.{</td><td>hjb, m</td><td>{klkjnnhg</td><td>hvghgv hjv</td><td>1</td><td>1</td><td><span class="glyphicon glyphicon glyphicon-pencil" style="cursor:hand;" onclick="editar(this);"></span></td><td><span class="glyphicon glyphicon-remove" style="cursor:hand;" onclick="eliminar(this);"></span></td></tr></tbody>
            </table><div class="dataTables_info" id="tablaClientes_info" role="status" aria-live="polite">&nbsp; &nbsp; &nbsp;    Mostrando registro(s) de la 1 a la 1 de un total de 1 registro(s)</div><div class="dataTables_paginate paging_full_numbers" id="tablaClientes_paginate"><a class="paginate_button first disabled" aria-controls="tablaClientes" data-dt-idx="0" tabindex="0" id="tablaClientes_first">Primero</a><a class="paginate_button previous disabled" aria-controls="tablaClientes" data-dt-idx="1" tabindex="0" id="tablaClientes_previous">Anterior</a><span><a class="paginate_button current" aria-controls="tablaClientes" data-dt-idx="2" tabindex="0">1</a></span><a class="paginate_button next disabled" aria-controls="tablaClientes" data-dt-idx="3" tabindex="0" id="tablaClientes_next">Siguiente</a><a class="paginate_button last disabled" aria-controls="tablaClientes" data-dt-idx="4" tabindex="0" id="tablaClientes_last">Ultimo</a></div></div>
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
                            <input type="text" class="form-control number" placeholder="" id="fechaNacimiento" name="fechaNacimiento" aria-describedby="sizing-addon4">
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
                                <option value="-1">Seleccione...</option>
                                <option value="1">Consultora de unidad</option>
                                <option value="2">Consultora externa</option>
                                <option value="3">Cliente ordinario</option>
                            </select>
                        </div>
                    </div>
                </div><!-- /.row -->

                <div class="modal-footer">
                    <div class="form-group">
                        <div class="col-xs-18 col-md-12">
                            <div class="col-xs-4 col-md-6">
                                <span id="agregaCliente" name="agregaConcepto" onclick="agregarCliente();" class="btn btn-primary " style="display: none;">Agregar</span>
                                <span id="actualizarCliente" name="actualizarConcepto" class="btn btn-primary" style="">Actualizar</span>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
