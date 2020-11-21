<h1 class=" text-center">Ventas</h1>
<hr>

<!-- <?php var_dump($ventas)?> -->
<div class="d-flex justify-content-between my-4">
    <div class="d-flex">
        <input type="text" class="form-control mr-2" id="buscadorVentas" name="buscadorVentas" value=""
            placeholder="Busca Venta">
        <a class="btn btn-info " href="" role="button">Buscar</a>&nbsp;
    </div>
    <div class="d-flex">
        <a class="btn btn-warning btn" href="<?php echo base_url('admin/ventas/agregarVenta')?>" role="button">+ Nueva Venta +</a>
    </div>
</div>
<div class="table-responsive" id="espectacularesContainer">
<table class="table " id="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">No control</th>
      <th scope="col">Cliente</th>
      <th scope="col">Rfc</th>
      <th scope="col">Encargado</th>
      <th scope="col">Telefono</th>
      <th scope="col">Vendido por</th>
      <th scope="col">Fecha de venta</th>
      <!-- <th>editar</th>
      <th>eliminar</th> -->
    </tr>
  </thead>
  <tbody>
  <?php
  $i =1;
  foreach($ventas as $venta):?>
    <tr>
      <td><?=$i?></td>
      <td><?=$venta['nocontrol']?></td>
      <td><?=$venta['comprador']?></td>
      <td><?=$venta['rfc']?></td>
      <td><?=$venta['nombre_encargado']?></td>
      <td><?=$venta['telefono']?></td>
      <td><?=$venta['vendedor']?></td>
      <td><?=$venta['fecha_venta']?></td>

      <!-- <td><a href="" class="btn btn-warning">editar</button></td>
      <td><button class="btn btn-danger" >eliminar</button></td> -->
    </tr>
    <?php
      $i++;
    endforeach?>
  </tbody>
</table>
</div>
<script>ventasit.classList.add("selected");</script>

