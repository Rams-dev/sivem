<h1 class=" text-center">Vallas</h1>
                <hr>

                <?php
if(empty($vallas_fijas)){?>
  <div class="no-data">
    <img src="<?= base_url("assets/images/404.jpg")?>" alt="sin-archivos" class="no-data__image">
    <div class="text-center">
      <h3 class="text-center text-info">AÚN NO EXISTEN REGISTROS DE VALLAS FIJAS</h3>
      <a class="btn btn-warning add" href="<?= base_url("admin/vallas_fijas/agregarVallaFija")?>" role="button"><i class="fas fa-plus"></i> <p>+ Agregar Valla +</p></a>

    </div>
  </div>
<?php }else{
?>
        <div class="d-flex justify-content-between my-4">
            <div class="d-flex">
                <input type="text" class="form-control mr-2" id="buscadorValla" name="buscadorValla" value=""  placeholder="Buscar Valla">
                <a class="btn btn-info search" href="Javascript:BuscaValla();" role="button"><i class="fas fa-search"></i> <p> Buscar </p></a>&nbsp;
            </div>
            <div class="d-flex">
                <a class="btn btn-warning add" href="<?= base_url("admin/vallas_fijas/agregarVallaFija")?>" role="button"><i class="fas fa-plus"></i> <p>+ Nueva Valla +</p></a>
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
            foreach($vallas_fijas as $valla):?>
            <tr>
            <th><?= $index?></th>
            <th><?= $valla['nocontrol']?></th>
            <td><?= $valla['nombre']?></td>
            <td><?= $valla['municipio']?></td>
            <td><?= $valla['localidad']?></td>
            <td><?= $valla['precio']?></td>
            <td><?= $valla['status']?></td>
            <td><button class="btn btn-info btn-sm" onclick="imagesEspecatulares(<?=$valla['id_medio']?>)" data-toggle="modal" data-target="#imagenes"><i class="fas fa-eye"></i></button>
            <a href="<?= base_url('admin/vallas_fijas/editarValla_fija/'.$valla['id_medio'])?>" class="btn btn-warning btn-sm"><i class="far fa-edit"></i></a>
            <button class="btn btn-danger btn-sm" onclick="eliminarValla_fija(<?=$valla['id_medio']?>)" ><i class="fas fa-trash"></i></button></td>
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
        <h5 class="modal-title" id="exampleModalLabel">Fotografías de la valla <?=$valla['nocontrol']?></h5>
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
<script src="<?= base_url('assets/js/vallas_fijas.js')?>"></script>

<script>


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
  console.log(id);
  $.get('vallas_fijas/obtenerImagenesVallasFijasPorId/'+id, function(response){
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

<?php } ?>
<script>vallasit.classList.add("selected");</script>
