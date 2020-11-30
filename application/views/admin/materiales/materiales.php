<h1 class=" text-center">Materiales</h1>
<hr>

<div class="d-flex justify-content-between my-4">
    <div class="d-flex">
        <input type="text" class="form-control mr-2" id="buscadorMateriales" name="buscadorMateriales" value=""
            placeholder="Busca material">
        <a class="btn btn-info search " href="" role="button"><i class="fas fa-search"></i> <p> Buscar</p></a>&nbsp;
    </div>
    <div class="d-flex">
        <a class="btn btn-warning add" data-toggle="modal" data-target="#agregarMaterial" type="button"> <i class="fas fa-plus"></i>
<p> + Nuevo Material +</p></a>
    </div>
</div>
<div class="table-responsive-md" id="espectacularesContainer">
    <table class="table table-hover">
        <thead class="thead-dark">
            <tr>
            <th scope="col">Id</th>
            <th scope="col">Nombre</th>
            <th scope="col">Precio</th>
            <th scope="col">Descripción</th>
            <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($materiales as $material):?>
                <tr>
                    <th scope="row"><?=$material['id']?></th>
                    <td><?=$material['material']?></td>
                    <td><?=$material['precio']?></td>
                    <td><?=$material['observaciones']?></td>
                    <td><button class="btn btn-warning" data-toggle="modal" data-target="#editarMaterial" type="button"  onclick="obtenerMaterialPorId(<?= $material['id']?>)" ><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger" onclick="eliminarMaterial(<?= $material['id']?>)" ><i class="fas fa-trash"></i></button></td>
                </tr>
            <?php endforeach?>
        </tbody>
    </table>

</div>


<!---------------------------------------- Modal Agregar ---------------------------------------------->

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
                            <input type="text" class="form-control" id="nombrematerial" name="nombrematerial" required placeholder="Tipo de material">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="preciomaterial">Precio </label>
                            <input type="number" class="form-control" id="preciomaterial" name="preciomaterial" required >
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="descripcionmaterial">Obsercación</label>
                            <input type="text" class="form-control" id="observacionmaterial" name="observacionmaterial" required placeholder="Descripción del material">
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



<!------------------------------------------- E D I T A R   M A T E R I A L  ---------------------------->

<div class="modal fade" id="editarMaterial" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar material</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('admin/materiales/editarMaterial')?>" method="POST" name="frmEditarMaterial" id="frmEditarMaterial">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombre">Material </label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="" required placeholder="Tipo de material">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="precio">Precio </label>
                            <input type="number" class="form-control" id="precio" name="precio" value="" required step="any">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" value="" required placeholder="Descripción del material">
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


<script>materialesit.classList.add("selected");</script>

<script src="<?= base_url('assets/js/materiales.js')?>"></script>
