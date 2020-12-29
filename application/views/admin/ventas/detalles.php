<?php 
//  var_dump($ventas);
?>

<h1 class="text-center my-2">Detalles de venta</h1>


<?php
    foreach ($ventas as $venta){

    }
?>

<div class="table-responsive mb-5 text-sm">
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th colspan="5" scope="col">Folio</th>
      <th colspan="5"  class=" text-right" scope="col">Fecha de venta</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th colspan="5"><?= $venta["id_venta"]?></th>
      <th colspan="5" class="text-right"><?= $venta["fecha_venta"]?></th>
     
    </tr>
  </tbody>
  <thead class="thead-dark">
    <tr>
      <th colspan="10" class="text-center" scope="col">Datos del Cliente</th>
    </tr>
  </thead>
  <tbody>
        <tr>
            <th colspan ="5" class="text-center">Datos de la empresa</th>
            <th colspan ="5" class="text-center">Datos del Encargado</th>
        </tr>  
        <tr>
            <td colspan="5">
                <p>Razon social: <span><?= $venta["razon_social"]?></span></p> 
                <p>RFC: <span><?= $venta["rfc"]?></span></p> 
                <p>Domicilio: <span><?= $venta["domicilio"]?></span></p> 
                <p>Colonia: <span><?= $venta["colonia"]?></span></p> 
                <p>Poblacion: <span><?= $venta["poblacion"]?></span></p> 
                <p>Estado: <span><?= $venta["nombre_estado"]?></span></p> 
            
            </td>
            <td colspan="5">
                <p>Nombre: <span><?= $venta["nombre_encargado"]?></span></p>
                <p>Puesto: <span><?= $venta["puesto"]?></span></p>
                <p>Teléfono: <span><?= $venta["telefono"]?></span></p>
                <p>Correo: <span><?= $venta["correo"]?></span></p>
            </td>
          
        
        </tr>

  </tbody>

  <thead class="thead-dark">
    <tr>
      <th colspan="10" class="text-center" scope="col">Datos de la venta</th>
    </tr>
  </thead>
  <tbody>
      
        <tr d-flex>
            <th>Clave master</th>
            <th>Dirección</th>
            <th>Municipio</th>
            <th>Estado</th>
            <th>Tipo de medio</th>
            <th>Fecha inicio</th>
            <th>Fecha termino</th>
            <th>Hora inicio</th>
            <th>Hora termino</th>
            <th>Chofer</th>
        </tr>
        <?php foreach($ventas as $medios):?>
        <tr>
            <td><?=$medios["id_medio"]["nocontrol"]?></td>
            <td><?=isset($medios["id_medio"]["calle"]) ? $medios["id_medio"]["calle"] : "No aplica" ?></td>
            <td><?=isset($medios["id_medio"]["municipio"]) ? $medios["id_medio"]["municipio"] : "No aplica" ?></td>
            <td><?=isset($medios["id_medio"]["nombre_estado"]) ? $medios["id_medio"]["nombre_estado"] : "No aplica" ?></td>
            <td><?=$medios["id_medio"]["tipo_medio"]?></td>
            <td><?=$medios["id_medio"]["fecha_inicio_contrato"]?></td>
            <td><?=$medios["id_medio"]["fecha_termino_contrato"]?></td>
            <td><?=$medios["id_medio"]["hora_inicio"]?></td>
            <td><?=$medios["id_medio"]["hora_termino"]?></td>
            <td><?=isset($medios["id_medio"]["chofer"]) ? $medios["id_medio"]["chofer"]: "No aplica" ?></td>
        </tr>
       <?php endforeach?>

  </tbody>
</table>


</div>


<script>ventasit.classList.add("selected");</script>
