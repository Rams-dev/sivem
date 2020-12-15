<div class="container">
    <h1 class="text-center">CATÁLOGOS</h1>
    <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
        <h1 class="display-4 text-center">IMPORTANTE <i class="fas fa-exclamation"></i></h1>
            <p class="lead">Los archivos PDF tardan un poco en generarse.</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <hr>
    <h3>filtros</h3>
    <form action="<?=base_url("admin/catalogos/catalogoPdf")?>" method="post" id="ftmPdf">
    <div class="row mt-5">
        <div class="col-md-3">
            <div class="form-group">
                <label for="TipoMedio">Tipo de medio </label>
                <select name="tipoMedio" id="tipoMedio" class="form-control">
                    <option value="">Todos</option>
                    <option value="espectaculares">Espectacular</option>
                    <option value="vallas_fijas">Vallas fijas</option>
                    <option value="vallas_moviles">Vallas moviles</option>
                </select>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group d-none"  id="divEstado">
                <label for="estado">Estado</label>
                <select name="estado" id="estado" class="form-control">
                    <option value="">Todos</option>
                    <?php foreach($estados  as $estado):?>
                    <option value="<?=$estado['id']?>"><?=$estado['nombre']?></option>
                    <?php endforeach?>
                </select>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group d-none"  id="divMunicipio">
                <label for="municipio">Municipio</label>
                <input type="text" id="municipio" name="municipio" class="form-control">
               
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group d-none" id="divStatus">
                <label for="status">Disponiblilidad</label>
                <select name="status" id="status" class="form-control">
                    <option value="">Todos</option>
                    <option value="Disponible">Disponible</option>
                    <option value="Ocupado">Ocupado</option>
                    <option value="Proximo">Proximamente</option>
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <div class="d-flex col-md-3 justify-content-end ml-auto mt-4">
                    <button type="submit"  formtarget="_blank" class="btn btn-info">Imprimir catalogo</button>
            </div>
        </div>
        </form>

    </div>
    <div class="table-responsive mt-2">
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">clave master</th>
              <th scope="col">Medio</th>
              <th scope="col">Estado</th>
              <th scope="col">Municipio</th>
              <th scope="col">Ubicación</th>
              <th scope="col">Medidas</th>
              <th scope="col">Costo mensual</th>
              <th scope="col">Precio material</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody id="mediosdata">
           <!-- <?php foreach($medios  as $medio):?>
            <tr>
              <th scope="row"></th>
              <td><?=$medio['nocontrol']?></td>
              <td><?=$medio['tipo_medio']?></td>
              <td><?=$medio['calle'] .', '.$medio['municipio']. ", " .$medio['nombre_estado'] ?></td>
              <td><?= "$ ".$medio['monto']?></td>
              <td><?=$medio['status']?></td>
            </tr>
           
            <?php endforeach?>          </tbody>  -->
        </table>
    </div>

</div>
<script>catalogosit.classList.add("selected");</script>
<script src="<?= base_url("assets/js/catalogos.js")?>"></script>