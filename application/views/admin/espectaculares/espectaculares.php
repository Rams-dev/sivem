<h1 class=" text-center">Espectaculares</h1>
<!-- <?php var_dump($espectaculares)?> -->
<hr>
<?php
if(empty($espectaculares)){?>
  <div class="no-data">
    <img src="<?= base_url("assets/images/404.jpg")?>" alt="sin-archivos" class="no-data__image">
    <div class="text-center">
      <h3 class="text-center text-info">AÚN NO EXISTEN REGISTROS DE ESPECTACULARES</h3>
      <a class="btn btn-warning add " href="<?php echo base_url('admin/espectaculares/agregarEspectacular')?>" role="button"><i class="fas fa-plus"></i> <p>+ Agregar Espectacular +</p></a>

    </div>
  </div>
<?php }else{
?>
<div class="d-flex justify-content-between my-4">
    <div class="d-flex align-items-center">
        <input type="text" class="form-control mr-2" id="buscadorespactacular" name="buscadorespactacular" value=""
            placeholder="Busca espectacular">
        <a class="btn btn-info search" href="Javascript:BuscaEspectacular();" role="button"><i class="fas fa-search"></i><span> Buscar</span></a>&nbsp;
    </div>
    <div class="d-flex align-items-center">
        <a class="btn btn-warning add" href="<?php echo base_url('admin/espectaculares/agregarEspectacular')?>" role="button"><i class="fas fa-plus"></i> <span>+ Nuevo Espectacular +</span></a>
    </div>
</div>
<div class="table-responsive" id="espectacularesContainer">
<table class="table" id="table">
  <thead class="thead-dark">
    <tr>
      <th>#</th>
      <th>Clave master</th>
      <th>Localidad</th>
      <th>Municipio</th>
      <th>Estado</th>
      <th>medidas</th>
      <th>Status</th>
      <th>Costo mensual</th>
      <th>Costo impresión</th>
      <th>Costo instalacion</th>
      <th>Costo material</th>
      <th>Costo total</th>
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
      <td><?= $espectacular['localidad']?></td>
      <td><?= $espectacular['municipio']?></td>
      <td><?= $espectacular['nombre_estado']?></td>
      <td><?= $espectacular['ancho'] . "m x ". $espectacular['alto']."m"?></td>
      <td><?= $espectacular['status']?></td>
      <td>$<?= $espectacular['costo_renta']?></td>
      <td>$<?= $espectacular['costo_impresion']?></td>
      <td>$<?= $espectacular['costo_instalacion']?></td>
      <td>$<?= $espectacular['precio_material']?></td>
      <td>$<?= $espectacular['precio']?></td>
      <td><button class="btn btn-info btn-sm" onclick="imagesEspecatulares(<?=$espectacular['id']?>)" data-toggle="modal" data-target="#imagenes"><i class="fas fa-eye"></i></button>
      <a href="<?= base_url('admin/espectaculares/editarEspectacular/'.$espectacular['id'])?>" class="btn btn-warning btn-sm"><i class="far fa-edit"></i></a>
      <button class="btn btn-danger btn-sm" onclick="eliminarEspectacular(<?=$espectacular['id']?>)" ><i class="fas fa-trash"></i></button></td>
    </tr>
    <?php
    $index++;
    endforeach?>
  </tbody>
</table>
</div>

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
        <div class="owl-carousel">
            <div><img id="img1" class="img-carousel" alt=""></div>
            <div><img id="img2" class="img-carousel" alt=""></div>
            <div><img id="img3" class="img-carousel" alt=""></div>
        </div>
      </div>
  </div>
</div>
</div>
<script src="<?= base_url('assets/js/espectaculares.js')?>"></script>

<script>


$('.owl-carousel').owlCarousel({
    loop:true,
    margin:0,
    responsiveClass:true,
    nav: true,
    center: true,
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

$('.owl-carousel').on('mousewheel', '.owl-stage', function (e) {
    if (e.deltaY>0) {
        owl.trigger('next.owl');
    } else {
        owl.trigger('prev.owl');
    }
    e.preventDefault();
});

function imagesEspecatulares(id){
  $.get('espectaculares/obtenerImagenesEspectacularPorId/'+id, function(response){
    console.log(response);
    if(response == ''){
    }else{
      let resp = JSON.parse(response);
         resp.map(res =>{
           $("#img1").attr('src',`<?= base_url()?>assets/images/medios/${res.vista_corta}`);
           $("#img2").attr('src',`<?= base_url()?>assets/images/medios/${res.vista_media}`);
           $("#img3").attr('src',`<?= base_url()?>assets/images/medios/${res.vista_larga}`);
         })
    }
  })
}

$('#monto').mask('000000');

</script>

<?php }?>
<script>espectacularesit.classList.add("selected");</script>
