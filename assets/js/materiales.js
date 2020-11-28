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
        id_material = d.id;
        window.nombre.value = d.material;
        window.precio.value = d.precio;
        window.descripcion.value = d.observaciones;
    })
}


$("#frmEditarMaterial").submit(function(e){
    e.preventDefault();
    console.log("hola");
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