
<h1 class="text-center">Clientes</h1>
    <hr>
    <div class="d-flex justify-content-between my-4 ">
        <div class="d-flex align-items-center">
            <input type="text" class="form-control mr-2" id="buscadorValla" name="buscadorValla" value=""  placeholder="Buscar cliente">
            <a class="btn btn-info search " href="Javascript:BuscaValla();" role="button"><i class="fas fa-search"></i><span> Buscar</span></a>&nbsp;
        </div>
        <div class="d-flex align-items-center">
            <a class="btn btn-warning btn add" href="<?= base_url('admin/clientes/agregarcliente')?>" role="button"><i class="fas fa-plus"></i><span> + Nuevo Cliente +</span></a>
        </div>
    </div>
    <div class="table-responsive" id="clientesContainer">
    <table class="table " id="table">
    <thead class="thead-dark">
        <tr>
        <th>#</th>
        <th>Razon social</th>
        <th>Rfc</th>
        <th>Domicilio</th>
        <th>Colonia</th>
        <th>Población</th>
        <th>Estado</th>
        <th>Cp</th>
        <th>Encargado</th>
        <th>Puesto</th>
        <th>Teléfono</th>
        <th>Correo</th>
        <th>Opciones</th>
        </tr>
    </thead>
    <tbody>
    
        <?php 
        $i = 1;
        foreach($clientes as $cliente ):?>
    <tr>
        <td><?=$i?></td>
        <td><?=$cliente['nombre']?></td>
        <td><?=$cliente['rfc']?></td>
        <td><?=$cliente['domicilio']?></td>
        <td><?=$cliente['colonia']?></td>
        <td><?=$cliente['poblacion']?></td>
        <td><?=$cliente['estado']?></td>
        <td><?=$cliente['cp']?></td>
        <td><?=$cliente['nombre_encargado']?></td>
        <td><?=$cliente['puesto']?></td>
        <td><?=$cliente['telefono']?></td>
        <td><?=$cliente['correo']?></td>
        <td>
        <a href="<?= base_url('admin/clientes/editarCliente/'.$cliente['id'])?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> </a>
        <a value ="<?= $cliente['id']?>" href="<?= base_url('admin/clientes/elimiarCliente/'.$cliente['id'])?>" class="btn btn-danger btn-sm delete" ><i class="fas fa-trash"></i></a></td>
    </tr>
        <?php $i++;
         endforeach?>
    </tbody>
    </table>
    </div>
    <script src="<?= base_url('assets/js/clientes.js')?>"></script>
    <script>clientesit.classList.add("selected");</script>

       
