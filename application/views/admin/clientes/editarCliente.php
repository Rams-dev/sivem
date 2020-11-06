<h1 class="text-center" style="color:#ba0d0d;">Editar Cliente</h1>
<hr>
<form action="<?= base_url("admin/clientes/guardarClienteEditado")?>" method="post" id="editarCliente" name="editarCliente">
<?php foreach($clientes as $cliente):?>
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label for="razonSocial">Razón social</label>
                <input type="text" name="razonSocial" class="form-control" id="razonSocial" value="<?= $cliente['nombre']?>">
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="rfc">RFC</label>
                <input type="text" name="rfc" class="form-control" id="rfc" value="<?= $cliente['rfc']?>">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="domicilio">Domicilio</label>
                <input type="text" name="domicilio" class="form-control" id="domicilio" value="<?= $cliente['domicilio']?>">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="colonia">Colonia</label>
                <input type="text" name="colonia" class="form-control" id="colonia" value="<?= $cliente['colonia']?>">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="poblacion">Poblacion/Municipio/Delegacion</label>
                <input type="text" name="poblacion" class="form-control" id="poblacion" value="<?= $cliente['poblacion']?>">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="estado">Estado</label>
                <select name="estado" id="estado" class="form-control" value="<?= $cliente['estado']?>">
                    <?php foreach($estados as $estado):?>
                        <option value="<?=$estado['id']?>"><?= $estado['nombre']?></option>
                    <?php endforeach?>
                </select>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="form-group">
                <label for="codigoPostal">Código postal</label>
                <input type="text" name="codigoPostal" class="form-control" id="codigoPostal" value="<?= $cliente['cp']?>">
            </div>
        </div>
        <div class="col-md-12 my-4">
            <h6 class="text-center">Contacto del cliente</h6>
            <hr >
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="nombreCliente">Nombre del cliente</label>
                <input type="text" name="nombreCliente" class="form-control" id="nombreCliente" value="<?= $cliente['nombre_encargado']?>">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="puesto">Puesto</label>
                <input type="text" name="puesto" class="form-control" id="puesto" value="<?= $cliente['puesto']?>">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="telefono">No Teléfono</label>
                <input type="text" name="telefono" class="form-control" id="telefono" value="<?= $cliente['telefono']?>">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="correo">Correo electrónico</label>
                <input type="email" name="correo" class="form-control" id="correo" value="<?= $cliente['correo']?>">
            </div>
        </div>
        <input type="hidden" value="<?= $cliente['id']?>" name="id">
    </div>
    <div class="d-flex justify-content-end mt-5">
        <button type="submit" class="btn btn-dark">Guardar</button>
    </div>
    <?php endforeach ?>
</form>
<script src="<?= base_url('assets/js/clientes.js')?>"></script>