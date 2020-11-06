<h1 class=" text-center">Espectaculares</h1>
<?php var_dump($espectaculares)?>
<hr>
<div class="d-flex justify-content-between my-4">
    <div class="d-flex">
        <input type="text" class="form-control mr-2" id="buscadorespactacular" name="buscadorespactacular" value=""
            placeholder="Busca espectacular">
        <a class="btn btn-info " href="Javascript:BuscaEspectacular();" role="button">Buscar</a>&nbsp;
    </div>
    <div class="d-flex">
        <a class="btn btn-warning btn" href="<?php echo base_url('admin/espectaculares/agregarEspectacular')?>" role="button">+ Nuevo Espectacular +</a>
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
      <th>ver</th>
      <th>editar</th>
      <th>eliminar</th>
    </tr>
  </thead>
  <tbody>
      
      <?php 
      $index = 1;
      foreach($espectaculares as $espectacular):?>
    <tr>
      <th><?= $index?></th>
      <th><?= $espectacular['nocontrol']?></th>
      <td><?= $espectacular['nombre']?></td>
      <td><?= $espectacular['municipio']?></td>
      <td><?= $espectacular['localidad']?></td>
      <td><?= $espectacular['monto']?></td>
      <td><button class="btn btn-info"  data-toggle="modal" data-target="#imagenes">ver</button></td>
      <td><a href="<?= base_url('admin/espectaculares/editarEspectacular/'.$espectacular['id'])?>" class="btn btn-warning">editar</button></td>
      <td><button value="<?=$espectacular['id']?>" class="btn btn-danger eliminar" >eliminar</button></td>
    </tr>
    <?php
    $index++;
    endforeach?>
  </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="imagenes" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Fotografías del espectacular <?=$espectacular['nocontrol']?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="">
        <div class="owl-carousel">
          <div><img src="<?= base_url('assets/images/espectaculares/'.$espectacular['vista_corta'])?>" alt=""></div>
          <div><img src="<?= base_url('assets/images/espectaculares/'.$espectacular['vista_media'])?>" alt=""></div>
          <div><img src="<?= base_url('assets/images/espectaculares/'.$espectacular['vista_larga'])?>" alt=""></div>
        </div>
        
      </div>
    </div>
  </div>
</div>
</div>
<script src="<?= base_url('assets/js/espectaculares.js')?>"></script>

<script>
$(document).ready(function(){
  $("#table").DataTable()
})

$('.owl-carousel').owlCarousel({
    loop:true,
    margin:0,
    responsiveClass:true,
    center: true,
    nav: true,
    responsive:{
        0:{
            items:1,
            nav:true,
            center: true
        },
        600:{
            items:1,
            nav:false
        },
        1000:{
            items:1,
            nav:true,
            loop:false,
            center: true

        }
    }
})
</script>