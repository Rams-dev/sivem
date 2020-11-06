<h1 class=" text-center">Ventas</h1>
<hr>
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
<div class="" id="espectacularesContainer">
<table class="table" id="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">No control</th>
      <th scope="col">Estado</th>
      <th scope="col">Municipio</th>
      <th scope="col">localidad</th>
      <th scope="col">precio</th>
      <th>editar</th>
      <th>eliminar</th>
    </tr>
  </thead>
  <tbody>
 
    <tr>
  
      <td><a href="" class="btn btn-warning">editar</button></td>
      <td><button class="btn btn-danger" >eliminar</button></td>
    </tr>
  </tbody>
</table>
</div>