
<h1 class="text-center" style="color:#ba0d0d;">Nueva Venta</h1>
<hr>
<div class="col-md-12">
    <form method="POST" enctype="multipart/form-data" action="<?= base_url('admin/ventas/guardarVenta')?>" name="guardarventa"
        id="guardarventa">
        <div class="row">
            <div class="col-md-12">
                    <div class="form-group">
                            <label for="cliente">Cliente</label>
                            <select name="cliente" id="cliente" class="form-control" required>
                            <option value="">Selecciona un cliente</option>
                            <?php foreach($clientes as $cliente):?>
                            <option value="<?=$cliente['id']?>"><?=$cliente['nombre'] . ' - '. $cliente['nombre_encargado']?></option>
                            <?php endforeach ?>
                            </select>
                    </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                        <label for="tipoDeVenta">Tipo de Venta</label>
                        <select name="tipoVenta" id="tipoVenta" class="form-control">
                                <option value="completa">Venta completa</option>
                                <option value="renta">Solo renta</option>
                        </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="fechaInicio">Fecha de inicio</label>
                    <input type="date" class="form-control" name="fechaInicio" id="fechaInicio">
                 </div>
            </div>
            <div class="col-md-3">
                    <div class="form-group">
                            <label for="fechaTermino">Fecha de termino</label>
                            <input type="date" class="form-control" name="fechaTermino" id="fechaTermino">
                    </div>
            </div>
            <div class="col-md-3">
                    <div class="form-group">
                            <label for="pagos">No pagos</label>
                            <input type="number" class="form-control" name="pagos" id="pagos">
                    </div>
            </div>
            <div class="col-md-4">
                    <div class="form-group">
                            <label for="factura">Requiere factura</label>
                            <select name="factura" id="factura" class="form-control">
                                    <option value="no" selected>No</option>
                                    <option value="si">Si</option>
                            </select>
                    </div>
            </div>
            <div class="col-md-4">
                    <div class="form-group">
                            <label for="tipoDePago">Tipo de pago</label>
                            <select name="tipoDePago" id="tipoDePago" class="form-control">
                                    <option value="efectivo" selected>Efectivo</option>
                                    <option value="Trasnferencia" >Trasnferencia</option>
                                    <option value="Deposito Bancario" >Deposito Bancario</option>
                                    <option value="Targeta debito/Credito" >Targeta debito/Credito</option>
                                    <option value="Oxxo" >Oxxo</option>
                            </select>
                    </div>
            </div>
            
            <div class="col-md-2">
                    <div class="form-group">
                            <label for="descuento">Descuento</label>
                            <select name="descuento" id="descuento" class="form-control">
                                    <option value="no" selected>No</option>
                                    <option value="si" >Si</option>
                            </select>
                    </div>
            </div>
            <div class="col-md-2 d-none" id="descuentoinput">
                    <div class="form-group">
                        <label for="descuentoCantidad">Cantidad %</label>
                        <input type="text" class="form-control" maxlength= 3  name="descuentoCantidad" id="descuentoCantidad" placeholder="%">
                </div>
            </div>

            <div class="col-md-12">
                    <div class="form-group">
                            <label for="tipoMedio">Tipo de Medio</label>
                            <select name="tipoMedio" id="tipoMedio" class="form-control">
                                    <option value="">Seleccione un Tipo de medio</option>
                                    <option value="1">Espectaculares</option>
                                    <option value="2">Vallas fijas</option>
                                    <option value="3"> Vallas Moviles</option>
                            </select>
                    </div>
            </div>

            <div class="col-md-4 d-none" id="horainicio">
                    <div class="form-group">
                        <label for="hinicio">Hora de inicio</label>
                        <input type="time" class="form-control" name="hinicio" id="hinicio">
                     </div>
            </div>

            <div class="col-md-4 d-none" id="horatermino">
                    <div class="form-group">
                        <label for="htermino">Hora de termino</label>
                        <input type="time" class="form-control" name="htermino" id="htermino">
                    </div>
            </div>

            
            <div class="col-md-4 d-none" id="choferdiv">
                <div class="form-group">
                        <label for="descuentoCantidad">Chofer</label>
                        <select name="chofer" id="chofer" class="form-control">
                        <option value="">Select. Chofer</option>
                        
                        </select>
                </div>
            </div>

            <div class="col-md-12">
                    <div class="form-group">
                            <label for="medio">Medio</label>
                            <select name="medio" id="medio" class="form-control">
                                    <option value="">Seleccione un medio</option>
                            </select>
                            <div id="error" class="invalid-feedback">
                            </div>
                    </div>
            </div>
        </div>

        <table class="table table-sm" id="ventaTable">
        <thead>
            <tr>
            <th scope="col"></th>
            <th scope="col">#</th>
            <th scope="col">No de control</th>
            <th scope="col">Ubicación</th>
            <th scope="col">Renta/m</th>
            <th scope="col">Instalacion</th>
            <th scope="col">Impresion</th>
            <th scope="col">total</th>
            </tr>
        </thead>
        <tbody id="bodyTable">
        </tbody>

        <tr class="d-none td" id="iva">
            <td colspan="6"></td>
            <td>Iva</td>
            <td> %16 </td>
        </tr>
         
        <tr >
            <td colspan="6"></td>
            <td>Total</td>
            <td id="preciototal">$ 0</td>
        </tr>
        <tr>
            <td colspan="6"></td>
            <td>Descuento</td>
            <td id="desc" class="text-danger">$ 0</td>
        </tr>

        <tr>
            <td colspan="6"></td>
            <td>precio final</td>
            <td id="precioConDescuento" class="text-success">$ 0</td>
        </tr>
        
        </table>
        <input type="hidden" name="monto" id="monto">


        <div class="row justify-content-end mt-5">
            <button type="button" id="add" class="btn btn-primary mx-4">Agregar</button>
            <button type="submit" class="btn btn-dark">Guardar</button>
        </div>
    </form>
</div>


<script src="<?=base_url('assets/js/ventas.js')?>"></script>
<script>ventasit.classList.add("selected");</script>




