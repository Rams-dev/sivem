
    function obtenerDatos(){
        $.get('catalogos/obtenerDatosDeCatalogos',function(response){
            let res = JSON.parse(response);
            console.log(res)
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
    $("#municipio").keyup(function(){
        filtros.municipio = this.value;
        getData();
    })


    $('#tipoMedio').change(function(){
        $("#estado").val("")
        $("#status").val("")
        filtros.status = "";
        filtros.estado = "";
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
                    <td>${i+1}</td>
                    <td>${data[i]["nocontrol"]}</td>
                    <td>${data[i]["tipo_medio"]}</td>
                    <td>${data[i]["calle"]} ${data[i]["municipio"]} ${data[i]["nombre_estado"]}</td>
                    <td>$ ${data[i]["precio"]}</td>
                    <td>${data[i]["alto"]}m x ${data[i]["ancho"]}m</td>
                    <td>$${data[i]["precio_material"]}</td>
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
        $("#divMunicipio").removeClass("d-none")
        $("#divStatus").removeClass("d-none")
    }else{
        $("#divEstado").addClass("d-none")
        $("#divMunicipio").addClass("d-none")
        $("#divStatus").addClass("d-none")

    }
})