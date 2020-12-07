
  const selectStatus = document.querySelector("#status");
  const inicioOcupacion = document.querySelector("#desdeDiv");
  const terminoOcupacion = document.querySelector("#hastaDiv");


selectStatus.addEventListener("change", function(e){
    e.preventDefault();
    console.log(this.value)
    if(this.value == "OCUPADO"){
        terminoOcupacion.classList.remove("d-none");
        inicioOcupacion.classList.add("d-none");

    }else if(this.value == "APARTADO"){
        inicioOcupacion.classList.remove("d-none");
        terminoOcupacion.classList.remove("d-none");
    }else{
        inicioOcupacion.classList.add("d-none");
        terminoOcupacion.classList.add("d-none");
    }
})



$("#guardarValla_movil").submit(function(e){
    e.preventDefault();

    let formData = new FormData($("#guardarValla_movil")[0]);
    $.ajax({
        url:"guardarValla_movil",
        type:"post",
        data: formData,
        cache:false,
        contentType:false,
        processData:false
    })
    .done(function(response){
        let res = JSON.parse(response);
        console.log(res);
        respuesta(res)        
    })
    .fail(function(err){
        alertify.error("Error, intenta mas tarde");
    })

})


function respuesta(res){
    if(res.success){
        alertify.success(res.success);
        location.reload();
    }
    if(res.error){
        alertify.error(res.error);
        console.log(res.error)
    }
}


function eliminarValla(id_medio){
    console.log(id_medio)
    $.ajax({
        url:"vallas_moviles/eliminarValla",
        type:"post",
        data:{id_medio:id_medio},
    })
    .done(function(response){
        let res = JSON.parse(response);
        console.log(res);
        respuesta(res);
    })
    .fail(function(err){
        alertify.error("ocurrio un error");
    })
}


$("#editarValla_movil").submit(function(e){
    e.preventDefault();
    let formData = new FormData($("#editarValla_movil")[0]);

    $.ajax({
        url:'../guardarValla_movilEditado',
        type:"post",
        data:formData,
        cache:false,
        contentType:false,
        processData:false
    })
    .done(function(response){
        let res = JSON.parse(response);
        console.log(res)
        respuesta(res)
    })
    .fail(function(err){
        console.log("Error, intenta más tarde");
    })

})


$("#anio").mask("0000")

