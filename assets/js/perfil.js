

$("#EfrmPerfil").submit(function(e){
    e.preventDefault();
    let formData = new FormData($("#EfrmPerfil")[0])
    console.log("hola")

    $.ajax({
        url:"perfil/guargarDatosEditados",
        type:"post",
        data:formData,
        contentType:false,
        cache:false,
        processData:false,
    })
    .done(function(response){
        let res = JSON.parse(response);
        console.log(res)
         if(res.success){
             alertify.success(res.success)
         }
         if(res.error){
             alertify.error(res.error)
         }
    })
    .fail(function(err){
        console.log("ha ocurrido un error")
    })
})