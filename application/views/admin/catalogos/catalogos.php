<div class="container">
    <h1 class="text-center">CÁTALOGOS</h1>

    <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
        <h1 class="display-4 text-center">IMPORTANTE <i class="fas fa-exclamation"></i></h1>
            <p class="lead">Los archivos PDF tardan un poco en generarse.</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <hr>
    <h3>filtros</h3>
    <form action="<?=base_url("admin/catalogos/catalogoPdf")?>" method="post">
    <div class="row mt-5">
        <div class="col-md-3">
            <div class="form-group">
                <label for="TipoMedio">Tipo de medio </label>
                <select name="tipoMedio" id="tipoMedio" class="form-control">
                    <option value="">Todos</option>
                    <option value="espectaculares">Espectacular</option>
                    <option value="Vallas_fijas">Vallas fijas</option>
                    <option value="Vallas_moviles">Vallas moviles</option>
                </select>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group d-none"  id="divEstado">
                <label for="estado">Estado</label>
                <select name="estado" id="estado" class="form-control">
                    <option value="">Todos</option>
                    <?php foreach($estados  as $estado):?>
                    <option value="<?=$estado['id']?>"><?=$estado['nombre']?></option>
                    <?php endforeach?>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group d-none" id="divStatus">
                <label for="status">Disponiblilidad</label>
                <select name="status" id="status" class="form-control">
                    <option value="">Todos</option>
                    <option value="Disponible">Disponible</option>
                    <option value="Ocupado">Ocupado</option>
                    <option value="Proximamente">Proximamente</option>
                </select>
            </div>
        </div>
        <div class="col-md-3 mt-4">
            <div class="form-group">
                <button type="submit"  formtarget="_blank" class="btn btn-info">Imprimir catalogo</button>
            </div>
        </div>
        </form>

    </div>
    <div class="table-responsive mt-2">
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">N* control</th>
              <th scope="col">Tipo</th>
              <th scope="col">Ubicacion</th>
              <th scope="col">Precio</th>
              <th scope="col">Estatus</th>
            </tr>
          </thead>
          <tbody id="mediosdata">
           <!-- <?php foreach($medios  as $medio):?>
            <tr>
              <th scope="row"></th>
              <td><?=$medio['nocontrol']?></td>
              <td><?=$medio['tipo_medio']?></td>
              <td><?=$medio['calle'] .', '.$medio['municipio']. ", " .$medio['nombre_estado'] ?></td>
              <td><?= "$ ".$medio['monto']?></td>
              <td><?=$medio['status']?></td>
            </tr>
           
            <?php endforeach?>          </tbody>  -->
        </table>
    </div>

</div>
<script>catalogosit.classList.add("selected");</script>
<script>

    function obtenerDatos(){
        $.get('catalogos/obtenerDatosDeCatalogos',function(response){
            let res = JSON.parse(response);
            rellenarTabla(res);
        })

    }
    obtenerDatos()

    let filtros = {};
    $('#estado').change(function(){
        filtros.estado = this.value;
        getData()
    })

    $('#status').change(function(){
        filtros.status = this.value;
        getData()
    })


    $('#tipoMedio').change(function(){
        filtros.tipomedio = this.value;
        getData()
    })

     $('#tipoMedio').change(function(){
         mediosData.innerHTML = ""
         })


    function getData(){
        console.log(filtros)

         $.ajax({
             url:'catalogos/obtenerMedios',
             type:'post',
             data: filtros
         })
         .done(function(response){
            let res = JSON.parse(response);
            rellenarTabla(res)           

            //  console.log(res)
         })
         
        //  .fail(function(err){
        //      console.log(err)
        //  })
    }

    
let mediosData = document.querySelector("#mediosdata")
function rellenarTabla(data){
    console.log(data);
    mediosData.innerHTML = ""
    if(data == "error"){
        mediosData.innerHTML += `
                <tr>
                    <td colspan=5>No se han encontrado resultados</td>
                </tr>
               `

    }else{
      for(let i = 0; i< data.length; i++){
          console.log(data[i])
           mediosData.innerHTML += `
                <tr>
                    <td>1</td>
                    <td>${data[i]["nocontrol"]}</td>
                    <td>${data[i]["tipo_medio"]}</td>
                    <td>${data[i]["calle"]} ${data[i]["municipio"]} ${data[i]["nombre_estado"]}</td>
                    <td>$ ${data[i]["precio"]}</td>
                    <td>${data[i]["status"]}</td>
                </tr>
               `
     }
    }   
}


$("#btnObtenerCalatogos").click(function(e){
    e. preventDefault()
    console.log(filtros);
    $.ajax({
        url:"catalogos/catalogoPdf",
        type: "post",
        data: filtros,
    })
    .done(function(response){
        // let res = JSON.parse(response);
         console.log(res)
        console.log("ok")

    })
    .fail(function(err){
        console.log(err)
    })
})


$("#tipoMedio").change(function(e){
    e.preventDefault()
    if(this.value != ""){
        $("#divEstado").removeClass("d-none")
        $("#divStatus").removeClass("d-none")
    }else{
        $("#divEstado").addClass("d-none")
        $("#divStatus").addClass("d-none")

    }
})

</script>