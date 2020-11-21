<h1 class=" text-center">Espectaculares</h1>
<!-- <?php var_dump($espectaculares)?> -->
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
<div class="table-responsive-md" id="espectacularesContainer">
<table class="table" id="table">
  <thead class="thead-dark">
    <tr>
      <th>#</th>
      <th>No control</th>
      <th>Estado</th>
      <th>Municipio</th>
      <th>localidad</th>
      <th>Precio</th>
      <th>Status</th>
      <th>Opciones</th>
      
    </tr>
  </thead>
  <tbody>
      
      <?php 
      $index = 1;
      foreach($espectaculares as $espectacular):?>
    <tr>
      <th><?= $index?></th>
      <th><?= $espectacular['nocontrol']?></th>
      <td><?= $espectacular['nombre_estado']?></td>
      <td><?= $espectacular['municipio']?></td>
      <td><?= $espectacular['localidad']?></td>
      <td><?= $espectacular['precio']?></td>
      <td><?= $espectacular['status']?></td>
      <td><button class="btn btn-info btn-sm" onclick="imagesEspecatulares(<?=$espectacular['id']?>)" data-toggle="modal" data-target="#imagenes"><i class="fas fa-eye"></i></button>
      <a href="<?= base_url('admin/espectaculares/editarEspectacular/'.$espectacular['id'])?>" class="btn btn-warning btn-sm"><i class="far fa-edit"></i></a>
      <button class="btn btn-danger btn-sm" onclick="eliminarEspectacular(<?=$espectacular['id']?>)" ><i class="fas fa-trash"></i></button></td>
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
          <div><img id="img1" class="img-responsive" alt=""></div>
          <div><img id="img2" class="img-responsive" alt=""></div>
          <div><img id="img3" class="img-responsive" alt=""></div>
        </div>
        
      </div>
    </div>
  </div>
</div>
</div>
<script src="<?= base_url('assets/js/espectaculares.js')?>"></script>
<script>espectacularesit.classList.add("selected");</script>

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

function imagesEspecatulares(id){
  $.get('espectaculares/obtenerImagenesEspectacularPorId/'+id, function(response){
    console.log(response);
    if(response == ''){
    }else{
      let resp = JSON.parse(response);
         resp.map(res =>{
           $("#img1").attr('src',`<?= base_url()?>assets/images/espectaculares/${res.vista_corta}`);
           $("#img2").attr('src',`<?= base_url()?>assets/images/espectaculares/${res.vista_media}`);
           $("#img3").attr('src',`<?= base_url()?>assets/images/espectaculares/${res.vista_larga}`);
         })
    }
  })
}

$('#monto').mask('000000');

</script>