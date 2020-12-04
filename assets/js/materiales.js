const formGuardarMaterial =  document.getElementById('formguardarmaterial');

formGuardarMaterial.addEventListener('submit', function(e){
    e.preventDefault()
    const formdata = new FormData(e.currentTarget)

    guardarMaterial(formdata);
})

async function guardarMaterial(data){
    const datos = await fetch('materiales/agregarMaterial',{
        method: 'post',
        body: data
    })
    const res = await datos.json()
    console.log(res)
    if(res.success){
        alertify.success(res.success)
        location.reload();
    }
    if(res.error){
        alertify.error(res.error)
    }

}


function obtenerMaterialPorId(id){
    console.log(id)
    $.get("materiales/obtenerMaterialPorId/"+id,function(response){
        let res = JSON.parse(response)
        if(res.error){
            console.log("error")
        }
        rellenarInputs(res);
        console.log(res)
    })

}
let id_material;

function rellenarInputs(data){
    data.map(d => {
        window.exampleModalLabel.value = `Editar ${d.material}`;

        id_material = d.id;
        window.nombre.value = d.material;
        window.precio.value = d.precio;
        window.unidad.value = d.unidad;
        window.descripcion.value = d.observaciones;
        window.id.value = d.id;
    })
}


$("#frmEditarMaterial").submit(function(e){
    e.preventDefault();
    let formdata = new FormData($("#frmEditarMaterial")[0]);

    $.ajax({
        url:'materiales/editarMaterial',
        type:'post',
        data: formdata,
        cache: false,
        contentType: false,
       processData: false,
   })
    .done(function(response){
        let res =  JSON.parse(response);
        console.log(res)
        if(res.success){
            alertify.success(res.success);
            $("#editarMaterial").model("hidden")
           location.reload();
       }
        if(res.error){
            alertify.error(res.error);
        }
        console.log(res);
     })
    .fail(function(err){
        console.log("error")
    })

})

async function eliminarMaterial(id){
    
        $.ajax({
             url:'materiales/eliminarMaterial',
             type:'post',
             data: {id:id}
        })
         .done(function(response){
             let res =  JSON.parse(response);
             if(res.success){
                alertify.success(res.success);
                location.reload();
            }
             if(res.error){
                 alertify.error(res.error);
             }
             console.log(res);
          })
         .fail(function(err){
             console.log("error")
         })
}

$("#preciomaterial").mask("0000.00")