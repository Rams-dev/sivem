<h1 class=" text-center">Materiales</h1>
<hr>

<div class="d-flex justify-content-between my-4">
    <div class="d-flex">
        <input type="text" class="form-control mr-2" id="buscadorMateriales" name="buscadorMateriales" value=""
            placeholder="Busca material">
        <a class="btn btn-info " href="" role="button">Buscar</a>&nbsp;
    </div>
    <div class="d-flex">
        <button class="btn btn-warning btn" data-toggle="modal" data-target="#agregarMaterial" type="button">+ Nuevo Material +</button>
    </div>
</div>
<div class="" id="espectacularesContainer">
    <table class="table table-hover">
        <thead>
            <tr>
            <th scope="col">Id</th>
            <th scope="col">Nombre</th>
            <th scope="col">Precio</th>
            <th scope="col">Observaciones</th>
            <th scope="col"></th>
            <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($materiales as $material):?>
                <tr>
                    <th scope="row"><?=$material['id']?></th>
                    <td><?=$material['material']?></td>
                    <td><?=$material['precio']?></td>
                    <td><?=$material['observaciones']?></td>
                    <td><button class="btn btn-warning" onclick="editarMaterial(<?= $material['id']?>)" >editar</button></td>
                    <td><button class="btn btn-danger" onclick="eliminarMaterial(<?= $material['id']?>)" >eliminar</button></td>
                </tr>
            <?php endforeach?>
        </tbody>
    </table>

</div>


<!-- Modal -->
<div class="modal fade" id="agregarMaterial" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document"">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar material</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('admin/materiales/agregarMaterial')?>" method="POST" name="formguardarmaterial" id="formguardarmaterial">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombrematerial">Material </label>
                            <input type="text" class="form-control" id="nombrematerial" name="nombrematerial" value="" required placeholder="Tipo de material">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="preciomaterial">Precio </label>
                            <input type="text" class="form-control" id="preciomaterial" name="preciomaterial" value="" required step="any">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="descripcionmaterial">Obsercación</label>
                            <input type="text" class="form-control" id="observacionmaterial" name="observacionmaterial" value="" required placeholder="Descripción del material">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </form> 
    </div>
  </div>
</div>

<script src="<?= base_url('assets/js/materiales.js')?>"></script>
