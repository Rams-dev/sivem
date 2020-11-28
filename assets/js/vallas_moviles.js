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
    })
    .fail(function(err){
        alertify.error("Error, intenta mas tarde");
    })

})




