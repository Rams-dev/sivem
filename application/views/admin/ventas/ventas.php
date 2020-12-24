<h1 class=" text-center">Ventas</h1>
<hr>

 <!-- <?php var_dump($ventas)?>  -->
<div class="d-flex justify-content-between my-4">
    <div class="d-flex align-items-center">
        <input type="text" class="form-control mr-2" id="buscadorVentas" name="buscadorVentas" value=""
            placeholder="Busca Venta">
        <a class="btn btn-info search" href="" role="button"><i class="fas fa-search"></i><span> Buscar</span></a>&nbsp;
    </div>
    <div class="d-flex align-items-center">
        <a class="btn btn-warning add" href="<?php echo base_url('admin/ventas/agregarVenta')?>" role="button"> <i class="fas fa-plus"></i><span> + Nueva Venta + </span></a>
    </div>
</div>
<div class="table-responsive" id="espectacularesContainer">
<table class="table " id="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Folio</th>
      <th scope="col">Cliente</th>
      <th scope="col">Rfc</th>
      <th scope="col">Encargado</th>
      <th scope="col">Teléfono</th>
      <th scope="col">Vendido por</th>
      <th scope="col">Fecha de venta</th>
      <th scope="col">Monto total</th>
      <th scope="col">Detalles</th>
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
      <td><?=$venta['id_venta']?></td>
      <td><?=$venta['razon_social']?></td>
      <td><?=$venta['rfc']?></td>
      <td><?=$venta['nombre_encargado']?></td>
      <td><?=$venta['telefono_cliente']?></td>
      <td><?=$venta['nombre_vendedor'] ." " .$venta['apellido_vendedor']?></td>
      <td><?=$venta['fecha_venta']?></td>
      <td>$<?=$venta['monto_total']?></td>
      <td><a href="<?=  base_url("admin/ventas/detalles/". $venta["id_venta"])?>" class="btn btn-warning btn-sm"><i class="fas fa-eye"></i></a></td>

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

