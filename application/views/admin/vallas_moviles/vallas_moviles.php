<h1 class=" text-center">Vallas Moviles</h1>
    <hr>
<!-- <?php var_dump($vallas_moviles)?> -->

<div class="d-flex justify-content-between my-4">
    <div class="d-flex align-items-center">
        <input type="text" class="form-control mr-2" id="buscadorVallaMovil" name="buscadorVallaMovil" value=""  placeholder="Buscar Valla Movil">
        <a class="btn btn-info search" href="Javascript:BuscaVallaMovil();" role="button"><i class="fas fa-search"></i><span>Buscar</span></a>&nbsp;
    </div>
    <div class="d-flex align-items-center">
        <a class="btn btn-warning add" href="<?= base_url("admin/vallas_moviles/agregarValla_movil")?>" role="button"><i class="fas fa-plus"></i><span>+ Nueva Valla Movil +</span></a>
    </div>
</div>
<div class="" id="clientesContainer">
    <div class="table-responsive" id="espectacularesContainer">
        <table class="table" id="table">
        <thead class="thead-dark">
            <tr>
            <th>#</th>
            <th>No control</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Año</th>
            <th>Precio</th>
            <th>Status</th>
            <th>Opciones</th>
            
            </tr>
        </thead>

        <tbody>
            <?php 
            $i =1;
            foreach($vallas_moviles as $valla):?>
                <tr>
                    <td><?=$i?></td>
                    <td><?=$valla['nocontrol']?></td>
                    <td><?=$valla['marca']?></td>
                    <td><?=$valla['modelo']?></td>
                    <td><?=$valla['anio']?></td>
                    <td>$ <?=$valla['precio']?></td>
                    <td><?=$valla['status']?></td>
                    <td>
                        <button class="btn btn-info btn-sm" onclick="imagesVallas(<?=$valla['id_medio']?>)" data-toggle="modal" data-target="#imagenes"><i class="fas fa-eye"></i></button>
                        <a href="<?= base_url('admin/vallas_moviles/editarValla_movil/'.$valla['id_medio'])?>" class="btn btn-warning btn-sm"><i class="far fa-edit"></i></a>
                        <?php if($this->session->userdata("tipo") == 1){?>                        
                        <button class="btn btn-danger btn-sm" onclick="eliminarValla(<?=$valla['id_medio']?>)" ><i class="fas fa-trash"></i></button>
                        <?php }?>
                    </td>
                </tr>

            <?php $i++; 
            endforeach?>

        </tbody>
        </table>
    </div>
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
<script src="<?= base_url('assets/js/vallas_moviles.js')?>"></script>

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

function imagesVallas(id){
  console.log(id);
  $.get('vallas_moviles/obtenerImagenesVallasMovilesPorId/'+id, function(response){
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

<script>vallasmovilesit.classList.add("selected");</script>