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

}


async function editarMaterial(id){
    const datos= await fetch('materiales/editarMaterial',{
        method: 'post',
        body: id
    })
    const res = await datos.json();
    console.log(res)
}


async function eliminarMaterial(id){
    const datos= await fetch('materiales/eliminarMaterial',{
        method: 'post',
        body: id
    })
    const res = await datos.json();
    console.log(res)
}