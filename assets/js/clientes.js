
$('#agregarCliente').submit(function(e){
    e.preventDefault()
    let formData = new FormData($("#agregarCliente")[0]);

    $.ajax({
        url:'guardarCliente',
        type:'post',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,


    })
    .done(function(response){
        console.log(response)
        let res =  JSON.parse(response);
        if(res.success){
            alertify.success(res.success)
        }
        if(res.error){
            alertify.error(res.error)
        }
        $("#agregarCliente")[0].reset();
    })
    .fail(function(e){
        console.log(e)
    })
})




$('#editarCliente').submit(function(e){
    e.preventDefault()
    let formData = new FormData($("#editarCliente")[0]);

    $.ajax({
        url:'../guardarClienteEditado',
        type:'post',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
    })
    .done(function(response){
        console.log(response)
        let res = JSON.parse(response);
        if(res.success){
            // $("#editarCliente")[0].reset();
            alertify.success(res.success)
        }
        if(res.error){
            alertify.error(res.error);
        }
        
    })
    .fail(function(e){
        console.log(e)
    })
})


$(document).ready(function(){
    $('#telefono').mask('000-000-00-00');
    $('#codigoPostal').mask('00000');
    $('#rfc').mask('AAAA000000AAAA');
})


$('.delete').click(function(e){
    e.preventDefault();
    console.log(this.value)


    $.ajax({
        url:'clientes/eliminarCliente',
        type: 'post',
        data: {id:this.value},
    })
    .done(function(response){
        console.log(response)

    })
    .fail(function(err){
        console.log(err)
    })
})